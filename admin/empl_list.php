<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include '../config.php';
    include '../header/admin_header.php';

    // ✅ Connect to Database
    $mysqli = new mysqli("localhost", "root", "", "peso");
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // ✅ Fetch employers from the table
    $sql = "SELECT employer_id, company_name, contact_person, accreditation FROM employers";
    $result = $mysqli->query($sql);

?>

<head>
    <meta charset="UTF-8">
    <title>Employers</title>
        <link rel="stylesheet" href="empl_list.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <script src="script.js"></script>  
</head>
  
    <main class="main-content">
        <section class="content-card">
            <div class="card-header">
                <h2 class="card-title">List of Employers</h2>
                    <div class="card-actions">
                        <!-- <form class="card-search-form">
                            <input type="text" placeholder="Search a Applicants">
                            <button type="submit">Search</button>
                        </form> -->
                            <a href="forms/add_empl.php" class="add-employer-button">
                                <i class="fa-solid fa-file-arrow-down" style="color: #ffffff;"></i>
                                <span>EXPORT EMPLOYER LIST</span>
                            </a>
                    </div>
            </div>
            <div class="card-body">
                <div class="employer-table">
                    <div class="table-header">
                        <div class="header-cell">#</div>
                        <div class="header-cell">Company Name</div>
                        <div class="header-cell">Contact Person</div>
                        <div class="header-cell">Accreditation Status</div>
                        <div class="header-cell">Actions</div>
                    </div>

                    <?php
                    if ($result->num_rows > 0) {
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            $statusClass = '';
                            if ($row['accreditation'] === 'Verified') $statusClass = 'status-verified';
                            elseif ($row['accreditation'] === 'Rejected') $statusClass = 'status-rejected';
                            elseif ($row['accreditation'] === 'Pending') $statusClass = 'status-pending';
                    ?>
                            <div class="table-row">
                                <div class="table-cell row-index"><?php echo $count++; ?></div>
                                <div class="table-cell"><?php echo htmlspecialchars($row['company_name']); ?></div>
                                <div class="table-cell"><?php echo htmlspecialchars($row['contact_person']); ?></div>
                                <div class="table-cell <?php echo $statusClass; ?>">
                                    <?php echo htmlspecialchars(!empty($row['accreditation']) ? $row['accreditation'] : 'Pending'); ?>
                                </div>

                                <div class="table-cell action-icons">
                                    <button class="icon-button approve-btn" 
                                        data-id="<?php echo $row['employer_id']; ?>" 
                                        data-status="Verified" 
                                        title="Approve">
                                        <i class="fa-regular fa-square-check fa-xl" style="color: #00ff11;"></i>
                                    </button>

                                    <button class="icon-button reject-btn" 
                                        data-id="<?php echo $row['employer_id']; ?>" 
                                        data-status="Rejected" 
                                        title="Reject">
                                        <i class="fa-solid fa-square-xmark fa-xl" style="color: #ff0000;"></i>
                                    </button>

                                    <button class="icon-button view-btn" title="View Details">
                                        <i class="fa-solid fa-eye fa-xl" style="color: #105ada;"></i>
                                    </button>
                                </div>


                            </div>
                    <?php
                        }
                    } else {
                        echo '<div class="table-row"><div class="table-cell" colspan="5">No employers found.</div></div>';
                    }
                    ?>
                </div>
            </div>

        </section>
    </main>

    <!-- Employer Details Modal -->
    <div id="employerModal" class="modal-overlay">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Employer Details</h2>
        <p><strong>Company Name:</strong> <span id="modalCompanyName"></span></p>
        <p><strong>Contact Person:</strong> <span id="modalContactPerson"></span></p>
        <p><strong>Accreditation Status:</strong> <span id="modalStatus"></span></p>
    </div>
    </div>


    <!-- Toast Notification -->
    <div id="toast" class="toast"></div>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const approveButtons = document.querySelectorAll(".approve-btn");
    const rejectButtons = document.querySelectorAll(".reject-btn");
    const toast = document.getElementById("toast");

    function showToast(message, color = "#333") {
        toast.textContent = message;
        toast.style.backgroundColor = color;
        toast.className = "toast show";
        setTimeout(() => {
            toast.className = toast.className.replace("show", "");
        }, 2000);
    }

    function updateStatus(id, status, rowElement) {
        fetch("statuses/update_employer_status.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `employer_id=${id}&status=${status}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const statusCell = rowElement.querySelector(".table-cell:nth-child(4)");
                statusCell.textContent = status;
                statusCell.className = "table-cell " + 
                    (status === "Verified" ? "status-verified" :
                     status === "Rejected" ? "status-rejected" : "status-pending");

                // ✅ Success toast
                const color = (status === "Verified") ? "#00b300" : "#d32f2f";
                const message = (status === "Verified") 
                    ? "Employer verified successfully!" 
                    : "Employer rejected.";
                showToast(message, color);
            } else {
                showToast("Failed to update status.", "#ff9800");
            }
        })
        .catch(err => showToast("Error updating status.", "#ff9800"));
    }

    approveButtons.forEach(btn => {
        btn.addEventListener("click", function() {
            const id = this.dataset.id;
            const status = this.dataset.status;
            const row = this.closest(".table-row");
            updateStatus(id, status, row);
        });
    });

    rejectButtons.forEach(btn => {
        btn.addEventListener("click", function() {
            const id = this.dataset.id;
            const status = this.dataset.status;
            const row = this.closest(".table-row");
            updateStatus(id, status, row);
        });
    });

    // --- Modal View Logic ---
    const viewButtons = document.querySelectorAll(".view-btn");
    const modal = document.getElementById("employerModal");
    const closeModal = document.querySelector(".close-btn");
    const modalCompanyName = document.getElementById("modalCompanyName");
    const modalContactPerson = document.getElementById("modalContactPerson");
    const modalStatus = document.getElementById("modalStatus");

    viewButtons.forEach(btn => {
    btn.addEventListener("click", function() {
        const row = this.closest(".table-row");
        const companyName = row.querySelector(".table-cell:nth-child(2)").textContent;
        const contactPerson = row.querySelector(".table-cell:nth-child(3)").textContent;
        const status = row.querySelector(".table-cell:nth-child(4)").textContent;

        modalCompanyName.textContent = companyName;
        modalContactPerson.textContent = contactPerson;
        modalStatus.textContent = status;

        modal.style.display = "flex";
    });
    });

    closeModal.addEventListener("click", () => modal.style.display = "none");

    window.addEventListener("click", (e) => {
    if (e.target === modal) modal.style.display = "none";
    });

});
</script>


</body>

</html>


