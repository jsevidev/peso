<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }
    include '../config.php';
    include '../header/empl_header.php';

    // ✅ Connect to database
    $mysqli = new mysqli("localhost", "root", "", "peso");
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // ✅ Fetch job postings with employer info
    $sql = "SELECT jp.*, e.company_name 
            FROM job_posting jp
            LEFT JOIN employers e ON jp.employer_id = e.employer_id
            ORDER BY jp.posted_date DESC";
    $result = $mysqli->query($sql);
?>

<head>
    <meta charset="UTF-8">
    <title>Job Posting</title>
        <link rel="stylesheet" href="emp_job_posting.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <script src="script.js"></script>  
</head>

<body>
    
        <main class="main-content">
            <div class="content-wrapper">
                <div class="content-header">
                    <h2 class="content-title">Job Postings</h2>

                    <button id="openAddJob" class="add-job-button">
                        <i class="fa-solid fa-plus fa-xl" style="color: #ffffff;"></i>
                        ADD JOB POSTING
                    </button>

                </div>
                <div class="filters-bar">
                    <!-- <div class="filter-search-group">
                        <input type="text" placeholder="Search a Jobs">
                        <button class="filter-search-btn">Search</button>
                    </div> -->
                    <button class="filter-dropdown">
                        <span>Employment Type</span>
                        <i class="fa-solid fa-caret-down" style="color: #000000;"alt="dropdown arrow"></i>
                    </button>
                    <button class="filter-dropdown">
                        <span>Moderation</span>
                        <i class="fa-solid fa-caret-down" style="color: #000000;"alt="dropdown arrow"></i>
                    </button>
                    <button class="filter-dropdown">
                        <span>Visibilty</span>
                        <i class="fa-solid fa-caret-down" style="color: #000000;"alt="dropdown arrow"></i>
                    </button>
                    <button class="clear-button">Clear</button>
                </div>
                
                <div class="table-container">
                    <table class="job-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Salary</th>
                                <th>Date</th>
                                <th>Skills</th>
                                <th>Moderation</th>
                                <th>Visibility</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $job_id = $row['job_id'];
                                    $title = htmlspecialchars($row['job_title']);
                                    $company = htmlspecialchars($row['company_name']);
                                    $type = htmlspecialchars($row['employment_type']);
                                    $salary_min = htmlspecialchars($row['salary_min']);
                                    $salary_max = htmlspecialchars($row['salary_max']);
                                    $skills = htmlspecialchars($row['skills']);
                                    $moderation = htmlspecialchars($row['moderation']);
                                    $visibility = htmlspecialchars($row['visibility']);
                                    $posted_date = htmlspecialchars($row['posted_date']);

                                    // Tag color class
                                    $typeClass = '';
                                    if ($type == 'Full Time') $typeClass = 'tag-full-time';
                                    elseif ($type == 'Part Time') $typeClass = 'tag-part-time';
                                    elseif ($type == 'Gig') $typeClass = 'tag-gig';

                                    echo "
                                    <tr>
                                        <td>
                                            <div class='job-title'>$title</div>
                                            <div class='job-company'>$company</div>
                                        </td>
                                        <td><span class='tag $typeClass'>$type</span></td>
                                        <td>₱$salary_min - ₱$salary_max / month</td>
                                        <td>$posted_date</td>
                                        <td>
                                            <div class='skills-cell'>";
                                                $skillsArray = explode(',', $skills);
                                                foreach ($skillsArray as $skill) {
                                                    echo "<span class='tag tag-skill'>" . trim($skill) . "</span>";
                                                }
                                    echo    "</div>
                                        </td>
                                        <td class='".($moderation == "Approved" ? "status-approved" : "status-unpublished")."'>$moderation</td>
                                        <td class='".($visibility == "Published" ? "status-published" : "status-unpublished")."'>$visibility</td>
                                        <td>
                                            <div class='action-cell'>
                                                <button class='action-btn preview-btn' data-jobid='$job_id'>Preview</button>
                                                <button class='action-btn edit-btn' data-jobid='$job_id'>Edit</button>


                                                </button>

                                                <a href='job_posting_actions/delete_job.php?job_id=$job_id' class='action-btn action-delete'>Delete</a>
                                                
                                            

                                            </div>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8' style='text-align:center;'>No job postings found.</td></tr>";
                            }
                            ?>
                        </tbody>


                    </table>
                </div>
            </div>
        </main>
    </section>

        <!-- Preview Modal -->
    <div id="previewModal" class="modal-overlay" style="display:none;">
    <div class="modal-container" style="max-width: 700px;">
        <header class="modal-header">
        <h2 class="modal-title">Job Preview</h2>
        <button id="closePreview" class="close-btn">CLOSE</button>
        </header>

        <main class="modal-content">
        <div id="previewContent">
            <!-- AJAX Content Here -->
        </div>
        </main>
    </div>
    </div>


    <!-- Dynamic Modal Container -->
    <?php include 'forms/add_job.php'; ?>
    <?php include 'forms/edit_job_modal.php'; ?>

    <script src="modals/add_job_modal.js"></script>
    <script src="job_posting_actions/job_preview_modal.js"></script>
    <!-- <script src="job_posting_actions/toggle_visibility.js"></script> -->
    <script src="job_posting_actions/edit_job.js"></script>

    <script>
        document.querySelectorAll(".action-delete").forEach(btn => {
            btn.addEventListener("click", function(e) {
                if (!confirm("Are you sure you want to delete this job posting?")) {
                    e.preventDefault();
                }
            });
        });
    </script>

    
</body>

</html>


