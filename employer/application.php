<!doctype html>
<html lang="en">
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// EMPLOYER LOGIN CHECK
if (!isset($_SESSION['employer_id'])) {
    header("Location: ../login.php");
    exit();
}

include '../config.php';
include '../header/empl_header.php';

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
                    <th>Actions</th>
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
                            if ($row['status'] === "Shortlisted") $statusClass = "status-shortlisted";
                            if ($row['status'] === "Rejected") $statusClass = "status-rejected";
                            if ($row['status'] === "Hired") $statusClass = "status-hired";
                            ?>
                            
                             <tr>
                                <td><?= $counter ?></td>
                                <td><?= $row['applicant_name'] ?></td>
                                <td><?= $row['job_title'] ?></td>
                                <td><?= $row['company_name'] ?></td>
                                <td class="<?= $statusClass ?>"><?= $row['status'] ?></td>

                                <td>
                                    <div class="action-links">
                                        <button class="btn-view" onclick="viewApplicant(<?= $row['appl_profile_id'] ?>)">View</button>
                                        <button class="btn-schedule" 
                                            onclick="openScheduleModal(
                                                <?= $row['application_id'] ?>,
                                                <?= $_SESSION['employer_id'] ?>,
                                                <?= $row['appl_profile_id'] ?>,
                                                <?= $row['job_id'] ?>
                                            )">
                                            Schedule Interview
                                        </button>
                                        <button class="btn-reject" onclick="rejectApplicant(<?= $row['application_id'] ?>)">Reject</button>
                                        <button class="btn-hire" onclick="hireApplicant(<?= $row['application_id'] ?>, <?= $row['job_id'] ?>)">Hired</button>
                                    </div>
                                </td>
                            </tr>


                            <?php
                            $counter++;
                        }
                    } else { ?>
                        <tr>
                            <td colspan="6" style="text-align:center;">No applications found.</td>
                        </tr>
                            <?php 
                        } 
                            ?>
                </tbody>

            </table>
            </div>
        </main>
        </div>
    </div>
    </section>

    <!-- View Applicant Modal -->
    <div id="viewModal" class="modal-overlay" style="display:none;">
        <div class="modal-container">
            <div class="modal-header">
                <h2>Applicant Details</h2>
                <span class="close-btn" onclick="closeViewModal()">×</span>
            </div>
            <hr>

            <div id="viewModalContent" class="modal-body">
                <!-- Details will load here via AJAX -->
            </div>
        </div>
    </div>

    <!-- Schedule Interview Modal -->
    <div id="scheduleModal" class="modal-overlay schedule-overlay" style="display:none;">
        <div class="modal-container schedule-container">

            <div class="modal-header schedule-header">
                <h2>Schedule Interview</h2>
                <span class="close-btn schedule-close" onclick="closeScheduleModal()">×</span>
            </div>
            <hr>

            <form id="scheduleForm" class="schedule-form">

                <input type="hidden" id="sched_application_id">
                <input type="hidden" id="sched_employer_id">
                <input type="hidden" id="sched_appl_profile_id">
                <input type="hidden" id="sched_job_posting_id">

                <label>Interview Date:</label>
                <input type="date" id="interview_date" required>

                <label>Interview Time:</label>
                <input type="time" id="interview_time" required>

                <label>Method:</label>
                <select id="method">
                    <option value="Face-to-face">Face-to-face</option>
                    <option value="Online">Online</option>
                </select>

                <label>Location / Link:</label>
                <input type="text" id="location" placeholder="Enter venue or online link" required>

                <label>Notes (optional):</label>
                <textarea id="notes" placeholder="Add any notes..."></textarea>

                <button type="button" class="btn-primary schedule-submit" onclick="saveSchedule()">
                    Save Schedule
                </button>
            </form>
        </div>
    </div>



    <script src="modals/viewappl.js"></script>
    <script src="modals/schedule_modal.js"></script>
    <script src="backend/reject_application.js"></script>



</body>

</html>


