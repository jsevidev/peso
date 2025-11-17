<!doctype html>
<html lang="en">
    
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }
    include '../config.php';
    include '../header/admin_header.php';

     // Connect to database
    $mysqli = new mysqli("localhost", "root", "", "peso");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Fetch all job fairs
    $sql = "SELECT * FROM job_fairs ORDER BY date DESC";
    $result = $mysqli->query($sql);

?>
<head>
    <meta charset="UTF-8">
    <title>Admin Sign Up</title>
        <link rel="stylesheet" href="job_fair.css">
        <link rel="stylesheet" href="forms/add_jobfair.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <script src="script.js"></script>  
</head>

<body> 
    <!-- <section class="dashboard-body"> -->
    <main class="main-content">
        <section class="job-fairs-card">
        <div class="card-header">
            <h2 class="card-title">Job Fairs</h2>
            <a href="#" class="add-job-fair-button" onclick="openJobFairModal()">

            <i class="fa-solid fa-plus fa-xl" style="color: #ffffff;"></i>
                ADD JOB FAIR
            </a>
        </div>

            
        <div class="filters">

            <!-- <div class="filter-search">
            <input type="text" placeholder="Search a Jobs">
            <button>Search</button>
            </div> -->

            <div class="date-wrapper">
                <span class="date-label">Date From</span>
                <input type="date" id="date-from" class="date-input">
                <i class="fa-regular fa-calendar calendar-icon"></i>
            </div>

            <div class="date-wrapper">
                <span class="date-label">Date To</span>
                <input type="date" id="date-to" class="date-input">
                <i class="fa-regular fa-calendar calendar-icon"></i>
            </div>

            <button class="filter-clear">Clear</button>

        </div>


        <div class="job-fairs-table">
            <div class="table-header">
            <div class="col-title">Title</div>
            <div class="col-date">Date</div>
            <div class="col-location">Location</div>
            <div class="col-companies">Participating Companies</div>
            <div class="col-announcements">Announcements</div>
            <div class="col-status">Status</div>
            <div class="col-action">Action</div>
            </div>
            
                <div class="table-body">
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>

                            <div class="table-row">
                                
                                <!-- Title -->
                                <div class="col-title">
                                    <?= htmlspecialchars($row['title']) ?>
                                </div>

                                <!-- Date -->
                                <div class="col-date">
                                    <?= htmlspecialchars($row['date']) ?>
                                </div>

                                <!-- Location -->
                                <div class="col-location">
                                    <?= htmlspecialchars($row['location']) ?>
                                </div>

                                <!-- Participating companies -->
                                <div class="col-companies">
                                    <?php 
                                        $companies = explode(",", $row['participating_companies']);
                                        foreach ($companies as $c):
                                    ?>
                                        <span class="company-tag"><?= htmlspecialchars(trim($c)) ?></span>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Announcement link -->
                                <div class="col-announcements">
                                    <?php if (!empty($row['link'])): ?>
                                        <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank" class="link-view">View Here</a>
                                    <?php else: ?>
                                        <a href="#" class="link">Add link</a>
                                    <?php endif; ?>
                                </div>

                                <!-- Status -->
                                <div class="col-status <?= strtolower($row['status']) === 'past' ? 'status-past' : 'status-upcoming' ?>">
                                    <?= htmlspecialchars($row['status']) ?>
                                </div>

                                <!-- Action Buttons -->
                                <div class="col-action">
                                    <button class="action-btn edit-btn" onclick="editJobFair(<?= $row['jobfair_id'] ?>)">Edit</button>
                                    <button class="action-btn delete-btn" onclick="deleteJobFair(<?= $row['jobfair_id'] ?>)">Delete</button>
                                </div>

                            </div>

                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="table-row">
                            <div class="col-title">No job fairs found.</div>
                        </div>
                    <?php endif; ?>
                </div>

        </div>
        </section>
    </main>
    </div>

    <!-- ADD JOB FAIR MODAL -->
    <div id="addJobFairModal" class="modal-overlay">
        <div class="modal-box">
            
            <div class="modal-header">
                <h2>New Job Fair</h2>
                <button class="close-btn" onclick="closeAddJobFairModal()">CLOSE</button>

            </div>

            <form action="job_fairs_func/add_jobfair_process.php" method="POST" class="modal-form">

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" required>
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label>Date</label>
                        <input type="date" name="date" required>
                    </div>

                    <div class="form-group half">
                        <label>Status</label>
                        <select name="status" required>
                            <option value="Upcoming">Upcoming</option>
                            <option value="Past">Past</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" required>
                </div>

                <div class="form-group">
                    <label>Participating Companies (comma-separated)</label>
                    <textarea name="participating_companies" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label>Link</label>
                    <input type="text" name="link">
                </div>

                <button type="submit" class="save-btn">SAVE</button>

            </form>

        </div>
    </div>

    <!-- EDIT JOB FAIR MODAL -->
    <div id="jobfair-modal" class="modal-overlay" style="display:none;">
        <div class="frame"> <!-- reusing the .frame styling from add_jobfair.css -->

            <!-- TOP HEADER -->
            <div class="rectangle"></div>
            <div class="text-wrapper">Edit Job Fair</div>

            <!-- CLOSE BUTTON -->
            <div class="group" onclick="closeEditJobFairModal()">
                <div class="div"></div>
                <div class="text-wrapper-2">CLOSE</div>
            </div>

            <form action="job_fairs_func/update_jobfair_process.php" method="POST">

                <!-- hidden ID -->
                <input type="hidden" id="jf_id" name="jobfair_id">

                <!-- TITLE -->
                <div class="text-wrapper-3">Title</div>
                <input class="rectangle-2" type="text" id="title" name="title" required>

                <!-- PARTICIPATING COMPANIES -->
                <div class="text-wrapper-4">Participating Companies</div>
                <textarea class="rectangle-3" id="participating_companies" name="participating_companies"></textarea>

                <!-- LOCATION -->
                <div class="text-wrapper-5">Location</div>
                <input class="rectangle-4" type="text" id="location" name="location" required>

                <!-- STATUS -->
                <div class="text-wrapper-6">Status</div>
                <select class="rectangle-5" id="status" name="status">
                    <option value="Upcoming">Upcoming</option>
                    <option value="Past">Past</option>
                </select>

                <!-- DATE -->
                <div class="text-wrapper-7">Date</div>
                <input class="rectangle-6" type="date" id="date" name="date" required>

                <!-- LINK -->
                <div class="text-wrapper-8">Link</div>
                <input class="rectangle-7" type="text" id="link" name="link">

                <!-- SAVE BUTTON -->
                <button class="rectangle-8" type="submit">SAVE</button>


            </form>
        </div>
    </div>




    <script src="job_fairs_func/date_text.js"></script>
    <script src="job_fairs_func/add_jobfair.js"></script>

    <script>
        function openJobFairModal() {
            document.getElementById("addJobFairModal").style.display = "flex";
        }

        // CLOSE ADD MODAL
        function closeAddJobFairModal() {
            document.getElementById("addJobFairModal").style.display = "none";
        }

        // CLOSE EDIT MODAL
        function closeEditJobFairModal() {
            document.getElementById("jobfair-modal").style.display = "none";
        }

        // CLICK OUTSIDE HANDLER
        window.addEventListener("click", function (e) {
            if (e.target.id === "addJobFairModal") {
                closeAddJobFairModal();
            }
            if (e.target.id === "jobfair-modal") {
                closeEditJobFairModal();
            }
        });
    </script>


</body>

</html>


