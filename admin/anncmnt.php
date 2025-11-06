<!doctype html>
<html lang="en">
<?php
include '../config.php';
session_start();

?>
<head>
    <meta charset="UTF-8">
    <title>Admin Sign Up</title>
        <link rel="stylesheet" href="anncmnt.css">
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
                    <li><a href="job_fair.php">Job Fairs</a></li>
                    <li class="active"><a href="#">Announcements</a></li>
                </ul>
            </nav>
            <a href="admin.php" class="logout-button">
                <span>Logout</span>
                <i class="fa-solid fa-arrow-right-from-bracket fa-lg" alt="Logout icon"></i>
            </a>
        </aside>

    <div class="main-panel">
        <main class="content-area" id="announcements">
        <section class="announcements-section">
            <div class="announcements-header">
            <h2>Announcements</h2>
            <button class="new-announcement-btn">
                <i class="fa-solid fa-plus fa-xl" style="color: #ffffff;"></i>
                <span>NEW ANNOUNCEMENT</span>
            </button>
            </div>

            <div class="announcements-filters">
            <div class="filter-search">
                <input type="text" placeholder="Search a Jobs">
                <button>Search</button>
            </div>
            <div class="filter-dropdown">
                <span>Audience</span>
                <!--merged image-->
                <div class="icon-container">
                <img src="${ASSET_PATH}/118_749.svg" alt="Calendar icon" class="icon-calendar">
                <img src="${ASSET_PATH}/120_859.svg" alt="Dropdown arrow" class="icon-arrow">
                </div>
            </div>
            <div class="filter-dropdown">
                <span>Status</span>
                <img src="${ASSET_PATH}/120_862.svg" alt="Dropdown arrow">
            </div>
            <button class="filter-clear-btn">Clear</button>
            </div>

            <div class="announcements-table">
            <div class="table-header">
                <div class="col-title">Title & Description</div>
                <div class="col-date">Date</div>
                <div class="col-audience">Audience</div>
                <div class="col-status">Status</div>
                <div class="col-action">Action</div>
            </div>

            <div class="table-row">
                <div class="col-title">
                <p class="item-title">Government Hiring Caravan</p>
                <p class="item-desc">Multiple agencies will be hiring on-site bring government IDs and NSO/PSA copies.</p>
                </div>
                <div class="col-date">2025-09-20</div>
                <div class="col-audience">All</div>
                <div class="col-status status-published">Published</div>
                <div class="col-action">
                <button class="action-btn btn-edit">Edit</button>
                <button class="action-btn btn-delete">Delete</button>
                <button class="action-btn btn-unpublish">Unpublished</button>
                </div>
            </div>

            <div class="table-row">
                <div class="col-title">
                <p class="item-title">BPO Hiring Week</p>
                <p class="item-desc">Walk-in interviews for customer service roles. Competitive salary plus incentives</p>
                </div>
                <div class="col-date">2025-09-18</div>
                <div class="col-audience">All</div>
                <div class="col-status status-published">Published</div>
                <div class="col-action">
                <button class="action-btn btn-edit">Edit</button>
                <button class="action-btn btn-delete">Delete</button>
                <button class="action-btn btn-unpublish">Unpublished</button>
                </div>
            </div>

            <div class="table-row">
                <div class="col-title">
                <p class="item-title">PESO Mega Job Fair</p>
                <p class="item-desc">Join our Mega Job Fair at Ozamiz City Hall Gym. Bring valid IDs and multiple copies of your resume.</p>
                </div>
                <div class="col-date">2025-09-15</div>
                <div class="col-audience">All</div>
                <div class="col-status status-unpublished">Unpublished</div>
                <div class="col-action">
                <button class="action-btn btn-edit">Edit</button>
                <button class="action-btn btn-delete">Delete</button>
                <button class="action-btn btn-publish">Published</button>
                </div>
            </div>
            </div>
        </section>
        </main>
    </div>
    </div>
</body>

</html>


