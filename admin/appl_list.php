<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }
    include '../config.php';
    include '../header/admin_header.php';

// connect to database
$mysqli = new mysqli("localhost", "root", "", "peso");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// fetch applicants and their verification status
$sql = " SELECT 
    ap.appl_profile_id,
    ap.profile_pic,
    ap.full_name,
    ap.date_of_birth,
    ap.gender,
    ap.contact_no,
    ap.email,
    ap.current_address,
    ap.education,
    ap.skills,
    ap.work_experience,
    ap.status,
        IFNULL(av.status, 'Pending') AS verification_status
    FROM applicant_profile ap
    LEFT JOIN appl_verification av 
        ON ap.appl_profile_id = av.appl_profile_id ";
$result = $mysqli->query($sql);
?>

<head>
    <meta charset="UTF-8">  
    <title>Applicant List</title>
        <link rel="stylesheet" href="appl_list.css">
        <link rel="stylesheet" href="forms/add_appl.css">
        <!-- <link rel="stylesheet" href="forms/appl_profile.css"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <script src="modal.js"></script>
        <script src="../script.js"></script>  

</head>
        
        <main class="main-content">
            <div class="applicants-card">
            <div class="card-header">
                <?php if (isset($_GET['added'])): ?>
                    <div class="alert success">
                        ✅ Applicant added successfully!
                    </div>
                <?php endif; ?>

                <h2 class="card-title">List of Applicants</h2>
                <button class="add-btn" id="open-form-btn">
                    <i class="fa-solid fa-plus fa-xl" style="color: #ffffff;"></i>
                <span>EXPORT APPLICANT LIST</span>
                </button>
            </div>
            <div class="filter-controls">
                <!-- <div class="applicant-search">
                    <input type="text" placeholder="Search a Applicants">
                    <button class="search-btn">Search</button>
                </div> -->
                <button class="filter-btn">Filter by</button>
            </div>
            <div class="table-wrapper">
                <table class="applicants-table">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Skills</th>
                    <th>Status</th>
                    <th>Verification</th>  <!-- newly added -->
                    <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                    if ($result && $result->num_rows > 0) {
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            $isActive = ($row['status'] === 'Active');
                    ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['contact_no']); ?></td>
                            <td>
                                <div class="skills-wrapper">
                                    <?php
                                    // split the skills string by comma and trim extra spaces
                                    $skillsArray = array_map('trim', explode(',', $row['skills']));

                                    foreach ($skillsArray as $index => $skill) {
                                        if (!empty($skill)) {
                                            echo '<span class="skill-tag">' . htmlspecialchars($skill) . '</span>';
                                        }
                                    }
                                    ?>
                                </div>
                            </td>

                            <!-- <td><?php echo htmlspecialchars($row['skills']); ?></td> -->
                            <!-- <td>
                                <label class="toggle-switch">
                                    <input 
                                        type="checkbox" 
                                        class="status-toggle" 
                                        data-id="<?php echo $row['appl_profile_id']; ?>" 
                                        <?php echo $isActive ? 'checked' : ''; ?>
                                    >
                                    <span class="slider"></span>
                                </label>
                                <span class="status-text"><?php echo $row['status']; ?></span>
                            </td> -->
                            <td>
                                <div class="status-container">
                                    <label class="toggle-switch">
                                        <input type="checkbox" class="status-toggle" data-id="<?php echo $row['appl_profile_id']; ?>" <?php echo $isActive ? 'checked' : ''; ?>>
                                        <span class="slider"></span>
                                    </label>
                                    <span class="status-text"><?php echo $row['status']; ?></span>
                                </div>
                            </td>

                            <td>
                                <span class="verification-tag <?php echo strtolower($row['verification_status']); ?>"
                                        data-id="<?php echo $row['appl_profile_id']; ?>">
                                    <?php echo htmlspecialchars($row['verification_status']); ?>
                                </span>
                            </td>


                            <td>
                                <div class="action-icons">
                                <form action="view_applicant.php" method="get" style="display:inline;">
                                    <button 
                                        type="button" 
                                        class="action-btn view-btn"
                                        data-id="<?php echo htmlspecialchars($row['appl_profile_id']); ?>"
                                        data-pic="<?php echo !empty($row['profile_pic']) ? '..' . htmlspecialchars($row['profile_pic']) : '../upload/profile_pics/default_profile.png'; ?>"
                                        data-name="<?php echo htmlspecialchars($row['full_name']); ?>"
                                        data-birth="<?php echo htmlspecialchars($row['date_of_birth']); ?>"
                                        data-gender="<?php echo htmlspecialchars($row['gender']); ?>"
                                        data-contact="<?php echo htmlspecialchars($row['contact_no']); ?>"
                                        data-email="<?php echo htmlspecialchars($row['email']); ?>"
                                        data-address="<?php echo htmlspecialchars($row['current_address']); ?>"
                                        data-education="<?php echo htmlspecialchars($row['education']); ?>"
                                        data-skills="<?php echo htmlspecialchars($row['skills']); ?>"
                                        data-experience="<?php echo htmlspecialchars($row['work_experience']); ?>"
                                        title="View Applicant"
                                        >
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </form>

                                <form action="verify_applicant.php" method="get" style="display:inline;">
                                    <button 
                                    type="button"
                                        class="action-btn verify-btn"
                                        data-id="<?php echo $row['appl_profile_id']; ?>"
                                        data-name="<?php echo htmlspecialchars($row['full_name']); ?>"
                                        title="Verify Applicant">
                                        <i class="fa-solid fa-file-circle-check"></i>
                                    </button>
                                </form>

                                <form action="upload_resume.php" method="get" style="display:inline;">
                                    <button type="submit" name="id" value="<?php echo $row['appl_profile_id']; ?>" class="action-btn upload-btn" title="Upload Resume">
                                        <i class="fa-solid fa-upload"></i>
                                    </button>
                                </form>
                            </div>
                            </td>
                        </tr>
                    <?php
                            $count++;
                        }
                    } else {
                        echo "<tr><td colspan='7'>No applicants found.</td></tr>";
                    }
                    ?>
                </tbody>
                </table>
            </div>
            </div>

            <!-- View Applicant Modal -->
            <div id="viewModal" class="modal-overlay" style="display:none;">
            <div class="modal-content">
                <div class="modal-header">
                <h2>Applicant Details</h2>
                <button class="close-modal">&times;</button>
                </div>

                <div class="modal-body">
                <div class="profile-section" style="text-align:center; margin-bottom:15px;">
                    <img id="viewProfilePic" src="" alt="Profile Picture" style="width:120px;height:120px;border-radius:50%;object-fit:cover;border:2px solid #ccc;">
                </div>
                <p><strong>Full Name:</strong> <span id="viewFullName"></span></p>
                <p><strong>Date of Birth:</strong> <span id="viewBirthDate"></span></p>
                <p><strong>Gender:</strong> <span id="viewGender"></span></p>
                <p><strong>Contact No:</strong> <span id="viewContact"></span></p>
                <p><strong>Email:</strong> <span id="viewEmail"></span></p>
                <p><strong>Address:</strong> <span id="viewAddress"></span></p>
                <p><strong>Education:</strong> <span id="viewEducation"></span></p>
                <p><strong>Skills:</strong> <span id="viewSkills"></span></p>
                <p><strong>Work Experience:</strong> <span id="viewExperience"></span></p>
                </div>

                <!-- <div class="modal-footer"> -->
                <!-- <button class="close-modal">Close</button> -->
                </div>
            </div>
            </div>

            <!-- VERIFY APPLICANT MODAL -->
            <div id="verifyModal" class="modal-overlay" style="display:none;">
            <div class="modal-content">
                <div class="modal-header">
                <h2>Verify Applicant</h2>
                <button class="close-modal">&times;</button>
                </div>

                <div class="modal-body">
                <p><strong>Applicant Name:</strong> <span id="verifyName"></span></p>

                <p><strong>Current Verification Status:</strong>
                    <span id="verifyStatus" class="verification-badge pending">Pending</span>
                </p>

                <p><strong>Document Submitted:</strong></p>
                <a id="verifyDocLink" href="#" target="_blank">
                    <img id="verifyDocument" src="" alt="No document available"
                        style="width:100%;max-height:250px;object-fit:contain;
                            border:1px solid #ccc;border-radius:8px;margin-bottom:10px;">
                </a>
                <p><strong>Remarks (optional):</strong></p>
                <textarea id="verifyRemarks" placeholder="Add remarks..."
                            style="width:100%;height:80px;border-radius:8px;padding:8px;"></textarea>
                </div>

                <div class="modal-footer">
                <button id="approveBtn" class="approve-btn">✅ Verify</button>
                <button id="rejectBtn" class="reject-btn">❌ Reject</button>
                </div>
            </div>
            </div>




        </main>

        
    </section>

    <!-- AJAX toggle logic -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.status-toggle').forEach(cb => {
    cb.addEventListener('change', async (e) => {
      const checkbox   = e.currentTarget;
      const id         = checkbox.dataset.id;
      const newStatus  = checkbox.checked ? 'Active' : 'Inactive';
      const statusText = checkbox.closest('td').querySelector('.status-text');

      // optimistic UI
      statusText.textContent = newStatus;

      try {
        const body = new URLSearchParams({ id, status: newStatus });
        const res  = await fetch('update_status.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body
        });
        const text = (await res.text()).trim();

        if (text !== 'success') {
          // rollback UI when backend fails
          checkbox.checked = !checkbox.checked;
          statusText.textContent = checkbox.checked ? 'Active' : 'Inactive';
          alert('Failed to update: ' + text);
        }
      } catch (err) {
        checkbox.checked = !checkbox.checked;
        statusText.textContent = checkbox.checked ? 'Active' : 'Inactive';
        alert('AJAX error: ' + err);
      }
    });
  });
});
</script>

<!-- Include the Add/Edit Applicant Modal -->
<?php include 'forms/add_appl.php'; ?>

    <script src="appl_modal.js"></script>
    <script src="view_profile.js"></script>
    <script src="verify_modal.js"></script>



</body>

</html>


