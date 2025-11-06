<!doctype html>
<html lang="en">
<?php
include '../config.php';
session_start();

?>
<head>
    <meta charset="UTF-8">
    <title>AAdmin Sign Up</title>
        <link rel="stylesheet" href="application.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <script src="script.js"></script>  
</head>

<header class="site-header">
        <div class="header-container">
            <div class="logo-container">
                <img src="../PESO_logo.png" alt="PESO Log" class="logo-img">
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
                    <li class="active"><a href="#">Applications</a></li>
                    <li><a href="job_fair.php">Job Fairs</a></li>
                    <li><a href="anncmnt.php">Announcements</a></li>
                </ul>
            </nav>
            <a href="admin.php" class="logout-button">
                <span>Logout</span>
                <i class="fa-solid fa-arrow-right-from-bracket fa-lg" alt="Logout icon"></i>
            </a>
        </aside>

        <div class="main-content-grid">
        <main class="main-content">
            <div class="content-header">
            <h2 class="content-title">Applications</h2>
            <div class="content-actions">
                <a  href="forms/add_application.php" class="btn btn-primary btn-with-icon">
                    <i class="fa-solid fa-plus fa-xl" style="color: #ffffff;"></i>
                    ADD APPLICATION
                </a>
                <button class="btn btn-primary">EXPORT</button>
            </div>
            </div>
            <div class="filter-bar">
            <div class="filter-search">
                <input type="text" placeholder="Search a Jobs">
                <button class="btn btn-secondary">Search</button>
            </div>
            <div class="filter-dropdown">
                <span>Employer</span>
                <img src="${ASSET_PATH}/238_923.svg" alt="dropdown arrow">
            </div>
            <div class="filter-dropdown">
                <span>Status</span>
                <img src="${ASSET_PATH}/238_926.svg" alt="dropdown arrow">
            </div>
            <div class="filter-date">
                <span>Date</span>
                <img src="${ASSET_PATH}/238_929.svg" alt="calendar icon">
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
                <tr>
                    <td class="row-index">1</td>
                    <td>Maria Santos</td>
                    <td>Service Crew</td>
                    <td>Jollibee</td>
                    <td class="status-pending">Pending</td>
                    <td>
                    <div class="action-links">
                        <a href="#">Update Status</a>
                        <a href="#">Match to Job</a>
                        <a href="#">Export</a>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td class="row-index">2</td>
                    <td>Juan Dela Cruz</td>
                    <td>Cashier</td>
                    <td>McDonald’s</td>
                    <td class="status-interview">Interview</td>
                    <td>
                    <div class="action-links">
                        <a href="#">Update Status</a>
                        <a href="#">Match to Job</a>
                        <a href="#">Export</a>
                    </div>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
        </main>
        </div>
    </div>
    </section>
</body>

</html>


