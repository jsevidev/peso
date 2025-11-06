<!doctype html>
<html lang="en">
<?php
include '../config.php';
session_start();

?>
<head>
    <meta charset="UTF-8">
    <title>Admin Sign Up</title>
        <link rel="stylesheet" href="job_fair.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <script src="script.js"></script>  
</head>

    <header class="site-header">
        <div class="header-container">
            <div class="logo-container">
                <img src="../PESO_logo.png" alt="PESO Logo" class="logo-img">
                <h1 class="site-title">PESO Ozamiz</h1>
            </div>
            <div class="header-controls">
                <form class="search-form">
                    <input type="search" class="search-input" placeholder="Search Something....">
                    <button type="submit" class="search-button">Search</button>
                </form>
                <button class="notification-button">
                    <i class="fa-solid fa-bell fa-2xl" style="color: #ffffff;" alt="Notifications"></i>
                </button>
            </div>
        </div>
    </header>

<body> 
    <section class="dashboard-body">
        <aside class="sidebar">
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="appl_list.php">Applicants</a></li>
                    <li><a href="empl_list.php">Employers</a></li>
                    <li><a href="job_posting.php">Job Posting</a></li>
                    <li><a href="application.php">Applications</a></li>
                    <li class="active"><a href="#">Job Fairs</a></li>
                    <li><a href="anncmnt.php">Announcements</a></li>
                </ul>
            </nav>
            <a href="admin.php" class="logout-button">
                <span>Logout</span>
                <i class="fa-solid fa-arrow-right-from-bracket fa-lg" alt="Logout icon"></i>
            </a>
        </aside>

    <main class="main-content">
        <section class="job-fairs-card">
        <div class="card-header">
            <h2 class="card-title">Job Fairs</h2>
            <a  href="forms/add_jobfair.php" class="add-job-fair-button">
            <i class="fa-solid fa-plus fa-xl" style="color: #ffffff;"></i>
            ADD JOB FAIR
            </a>
        </div>

        <div class="filters">
            <div class="filter-search">
            <input type="text" placeholder="Search a Jobs">
            <button>Search</button>
            </div>
            <div class="filter-date">
            <label for="date-from">Date From</label>
            <img src="${ASSET_PATH}/117_576.svg" alt="Calendar">
            </div>
            <div class="filter-date">
            <label for="date-to">Date To</label>
            <img src="${ASSET_PATH}/117_580.svg" alt="Calendar">
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
            <div class="table-row">
                <div class="col-title">Retail & Services Job Match</div>
                <div class="col-date">2025-09-20</div>
                <div class="col-location">Gaisano Mall Activity Center</div>
                <div class="col-companies">
                <span class="company-tag">Gaisano</span>
                <span class="company-tag">Watsons</span>
                <span class="company-tag">MR.DIY</span>
                </div>
                <div class="col-announcements"><a href="#" class="link">Add link</a></div>
                <div class="col-status status-past">Past</div>
                <div class="col-action">
                <button class="action-btn edit-btn">Edit</button>
                <button class="action-btn delete-btn">Delete</button>
                </div>
            </div>
            <div class="table-row">
                <div class="col-title">PESO Ozamiz Mega Job Fair</div>
                <div class="col-date">2025-10-15</div>
                <div class="col-location">Ozamiz City Hall Gym</div>
                <div class="col-companies">
                <span class="company-tag">Jollibee</span>
                <span class="company-tag">Gaisano</span>
                <span class="company-tag">MR.DIY</span>
                </div>
                <div class="col-announcements"><a href="#" class="link-view">View<br>Announcement</a></div>
                <div class="col-status status-upcoming">Upcoming</div>
                <div class="col-action">
                <button class="action-btn edit-btn">Edit</button>
                <button class="action-btn delete-btn">Delete</button>
                </div>
            </div>
            <div class="table-row">
                <div class="col-title">BPO & Customer Care Fair</div>
                <div class="col-date">2025-10-18</div>
                <div class="col-location">City Multipurpose Hall</div>
                <div class="col-companies">
                <span class="company-tag">Jollibee</span>
                <span class="company-tag">DOH</span>
                <span class="company-tag">MR.DIY</span>
                </div>
                <div class="col-announcements"><a href="#" class="link">Add link</a></div>
                <div class="col-status status-past">Past</div>
                <div class="col-action">
                <button class="action-btn edit-btn">Edit</button>
                <button class="action-btn delete-btn">Delete</button>
                </div>
            </div>
            <div class="table-row">
                <div class="col-title">Government Hiring Caravan</div>
                <div class="col-date">2025-10-25</div>
                <div class="col-location">City Engineers Office Grounds</div>
                <div class="col-companies">
                <span class="company-tag">City Hall</span>
                <span class="company-tag">City Engineers</span>
                <span class="company-tag">MR.DIY</span>
                <span class="company-tag">DSWD</span>
                </div>
                <div class="col-announcements"><a href="#" class="link">Add link</a></div>
                <div class="col-status status-upcoming">Upcoming</div>
                <div class="col-action">
                <button class="action-btn edit-btn">Edit</button>
                <button class="action-btn delete-btn">Delete</button>
                </div>
            </div>
            <div class="table-row">
                <div class="col-title">Hospital & Health Jobs Day</div>
                <div class="col-date">2025-10-30</div>
                <div class="col-location">Medina Hospital Lobby</div>
                <div class="col-companies">
                <span class="company-tag">DOH</span>
                <span class="company-tag">PhilHealth</span>
                <span class="company-tag">Medina Hospital</span>
                </div>
                <div class="col-announcements"><a href="#" class="link">Add link</a></div>
                <div class="col-status status-past">Past</div>
                <div class="col-action">
                <button class="action-btn edit-btn">Edit</button>
                <button class="action-btn delete-btn">Delete</button>
                </div>
            </div>
            </div>
        </div>
        </section>
    </main>
    </div>
</body>

</html>


