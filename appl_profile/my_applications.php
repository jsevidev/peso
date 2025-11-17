<!doctype html>
<html lang="en">

<?php
include '../config.php';
include '../header/header.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$mysqli = new mysqli("localhost", "root", "", "peso");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


$viewData = null;

if (isset($_GET['view_id'])) {
    $view_id = intval($_GET['view_id']);

    // Query to pull application + job + employer + interview
    $stmt = $mysqli->prepare("
        SELECT 
            a.application_id,
            a.status AS application_status,
            a.applied_date,
            jp.job_title,
            jp.job_description,
            e.company_name,
            i.interview_date,
            i.interview_time,
            i.method AS interview_method,
            i.location AS interview_location
        FROM applications a
        JOIN job_posting jp ON a.job_posting_id = jp.job_posting_id
        JOIN employers e ON jp.employer_id = e.employer_id
        LEFT JOIN interview_schedule i ON i.application_id = a.application_id
        WHERE a.application_id = ?
    ");
    $stmt->bind_param("i", $view_id);
    $stmt->execute();
    $viewData = $stmt->get_result()->fetch_assoc();
}

?>

<head>
    <meta charset="UTF-8">
    <title>My Applications</title>
    <link rel="stylesheet" href="my_applications.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href='https://cdn.boxicons.com/3.0.3/fonts/basic/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <main id="resume-upload" class="page-wrapper">

        <h1 class="upload-title">MY APPLICATIONS</h1>
        <p class="upload-subtitle">You can view the progress of your job applications in here!</p>

        <!-- STATUS FILTER TABS -->
        <div class="app-tabs">
            <button class="app-tab active">All</button>
            <button class="app-tab">Pending</button>
            <button class="app-tab">Shortlisted</button>
            <button class="app-tab">Interview</button>
            <button class="app-tab">Hired</button>
            <button class="app-tab">Rejected</button>
        </div>

        <!-- APPLICATIONS TABLE -->
        <div class="app-table-wrapper">
            <table class="app-table">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Employer</th>
                        <th>Status</th>
                        <th>Interview</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // ================================
                    // GET applicant_profile_id correctly
                    // ================================
                    
                    // This comes from login (applicant_account.appl_id)
                    $account_id = $_SESSION['applicant_id'];

                    // Convert appl_id → appl_profile_id
                    $profileStmt = $mysqli->prepare("
                        SELECT appl_profile_id 
                        FROM applicant_profile 
                        WHERE appl_id = ?
                    ");
                    $profileStmt->bind_param("i", $account_id);
                    $profileStmt->execute();
                    $profileRow = $profileStmt->get_result()->fetch_assoc();

                    if (!$profileRow) {
                        echo "<tr><td colspan='5' style='text-align:center; padding:20px;'>No applications found.</td></tr>";
                        exit();
                    }

                    $applicant_profile_id = $profileRow['appl_profile_id'];

                    // ================================
                    // MAIN QUERY: Fetch applications
                    // ================================

                    $query = "
                        SELECT 
                            a.application_id,
                            jp.job_title,
                            e.company_name,
                            a.status,
                            i.interview_date,
                            i.interview_time


                        FROM applications a
                        LEFT JOIN job_posting jp 
                            ON a.job_id = jp.job_id
                        LEFT JOIN employers e
                            ON jp.employer_id = e.employer_id
                        LEFT JOIN interview_schedule i
                            ON i.application_id = a.application_id

                        WHERE a.appl_profile_id = ?
                        ORDER BY a.application_id DESC
                    ";

                    $stmt = $mysqli->prepare($query);
                    $stmt->bind_param("i", $applicant_profile_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0):
                        while ($row = $result->fetch_assoc()):
                            
                            // Format badge style
                            $statusClass = strtolower($row['status']); // pending, shortlisted, hired, rejected

                            // Format interview date/time
                            if (!empty($row['interview_date']) && !empty($row['interview_time'])) {
                                $interview = date("M j, g:i A", strtotime($row['interview_date'] . " " . $row['interview_time']));
                            } else {
                                $interview = "---";
                            }
                    ?>
                        <tr>
                            <td><?= $row['job_title']; ?></td>
                            <td><?= $row['company_name']; ?></td>

                            <td><span class="badge <?= $statusClass; ?>"><?= $row['status']; ?></span></td>

                            <td><?= $interview; ?></td>

                            <td>
                                <button type="button" class="view-btn" onclick="openViewScheduleModal(<?= $row['application_id']; ?>)">View</button>
                            </td>

                        </tr>

                    <?php
                        endwhile;
                    else:
                    ?>
                    <tr>
                        <td colspan="5" style="text-align:center; padding:20px;">No applications found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>


            <div class="back-button-container">
                <a href="../appl_profile/appl_profile.php" class="back-to-profile-btn">Back to Profile</a>
            </div>
        
    </main>

    <!-- View Interview Schedule Modal -->
    <div id="viewScheduleModal" class="modal-overlay" style="display:none;">
        <div class="modal-container">
            <div class="modal-header">
                <h2>Interview Details</h2>
                <span class="close-btn" onclick="closeViewScheduleModal()">×</span>
            </div>
            <hr>
            <div id="viewModalContent" class="modal-body">
                <!-- Details will load here via JavaScript -->
            </div>
        </div>
    </div>


    <script src="applications/modal.js"></script>

</body>

</html>
