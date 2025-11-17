<!doctype html>
<html lang="en">
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }
    include '../config.php';
    include '../header/admin_header.php';

    // CONNECT TO DATABASE
    $mysqli = new mysqli("localhost", "root", "", "peso");
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // FETCH APPLICATION LIST
    $sql = "
        SELECT 
            a.application_id,
            a.appl_profile_id,
            a.job_id,
            ap.full_name AS applicant_name,
            jp.job_title,
            e.company_name,
            a.status
        FROM applications a
        LEFT JOIN applicant_profile ap 
            ON a.appl_profile_id = ap.appl_profile_id
        LEFT JOIN job_posting jp 
            ON a.job_id = jp.job_id
        LEFT JOIN employers e 
            ON jp.employer_id = e.employer_id
        ORDER BY a.application_id ASC
    ";

    $result = $mysqli->query($sql);

?>
<head>
    <meta charset="UTF-8">
    <title>AAdmin Sign Up</title>
        <link rel="stylesheet" href="application.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <script src="script.js"></script>  
</head>

<body>
    <!-- <section class="dashboard-body"> -->
    
        <div class="main-content-grid">
        <main class="main-content">
            <div class="content-header">
            <h2 class="content-title">Applications</h2>
            <div class="content-actions">
                <!-- <a  href="forms/add_application.php" class="btn btn-primary btn-with-icon">
                    <i class="fa-solid fa-plus fa-xl" style="color: #ffffff;"></i>
                    ADD APPLICATION
                </a> -->
                <button class="btn btn-primary">EXPORT</button>
            </div>
            </div>
            <div class="filter-bar">
            <!-- <div class="filter-search">
                <input type="text" placeholder="Search a Jobs">
                <button class="btn btn-secondary">Search</button>
            </div> -->
            <div class="filter-dropdown">
                <span>Employer</span>
                <i class="fa-solid fa-caret-down" style="color: #000000;" alt="dropdown arrow"></i>
            </div>
            <div class="filter-dropdown">
                <span>Status</span>
                <i class="fa-solid fa-caret-down" style="color: #000000;" alt="dropdown arrow"></i>
            </div>
            <div class="filter-date">
                <span>Date</span>
                <i class="fa-solid fa-caret-down" style="color: #000000;" alt="dropdown arrow"></i>
            </div>
            </div>
            <div class="table-wrapper">
            <table class="data-table">
                <thead>
                <tr>
                    <th></th>
                    <th>Applicant Name</th>
                    <th>Job Title</th>
                    <th>Employer</th>
                    <th>Status</th>
                    <!-- <th>Actions</th> -->
                </tr>
                </thead>

                <tbody>
                    <?php
                    $counter = 1;

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            // Status CSS Classes
                            $statusClass = "";
                            if ($row['status'] === "Pending") $statusClass = "status-pending";
                            if ($row['status'] === "Interview") $statusClass = "status-interview";
                            if ($row['status'] === "Rejected") $statusClass = "status-rejected";
                            if ($row['status'] === "Hired") $statusClass = "status-hired";
                            ?>
                            
                            <tr>
                                <td class="row-index"><?= $counter ?></td>
                                <td><?= $row['applicant_name'] ?></td>
                                <td><?= $row['job_title'] ?></td>
                                <td><?= $row['company_name'] ?></td>
                                <td class="<?= $statusClass ?>"><?= $row['status'] ?></td>

                                <!-- <td>
                                    <div class="action-links">
                                        <a href="update_status.php?id=<?= $row['application_id'] ?>">Update Status</a>
                                        <a href="match_job.php?id=<?= $row['application_id'] ?>">Match to Job</a>
                                        <a href="export_application.php?id=<?= $row['application_id'] ?>">Export</a>
                                    </div>
                                </td> -->
                            </tr>

                            <?php
                            $counter++;
                        }
                    } else { ?>
                        <tr>
                            <td colspan="6" style="text-align:center;">No applications found.</td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>
            </div>
        </main>
        </div>
    </div>
    </section>
</body>

</html>


