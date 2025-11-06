<!doctype html>
<html lang="en">
<?php
include '../config.php';
session_start();

?>
<head>
    <meta charset="UTF-8">
    <title>Job Posting</title>
        <link rel="stylesheet" href="job_posting.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <script src="script.js"></script>  
</head>

    <header class="site-header">
        <div class="header-container">
            <div class="logo-container">
                <img src="../PESO_logo.png" alt="PESO Logo" class="logo-img">
                <h1 class="site-title">PESO Ozamiz</h1>
            </div>
            <div class="controls-container">
                <div class="search-bar">
                    <input type="text" placeholder="Search Something....">
                    <button class="search-button">Search</button>
                </div>
                <button class="icon-button">
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
                    <li class="active"><a href="#">Job Posting</a></li>
                    <li><a href="application.php">Applications</a></li>
                    <li><a href="job_fair.php">Job Fairs</a></li>
                    <li><a href="anncmnt.php">Announcements</a></li>
                </ul>
            </nav>
            <a href="admin.php" class="logout-button">
                <span>Logout</span>
                <i class="fa-solid fa-arrow-right-from-bracket fa-lg" alt="Logout icon"></i>
            </a>
        </aside>

        <main class="main-content">
            <div class="content-wrapper">
                <div class="content-header">
                    <h2 class="content-title">Job Postings</h2>
                    <a href="forms/add_job.php" class="add-job-button">
                        <i class="fa-solid fa-plus fa-xl" style="color: #ffffff;"></i>
                        ADD JOB POSTING
                    </a>
                </div>
                <div class="filters-bar">
                    <div class="filter-search-group">
                        <input type="text" placeholder="Search a Jobs">
                        <button class="filter-search-btn">Search</button>
                    </div>
                    <button class="filter-dropdown">
                        <span>Employment Type</span>
                        <img src="${ASSET_PATH}/123_1067.svg" alt="dropdown arrow">
                    </button>
                    <button class="filter-dropdown">
                        <span>Moderation</span>
                        <img src="${ASSET_PATH}/123_1070.svg" alt="dropdown arrow">
                    </button>
                    <button class="filter-dropdown">
                        <span>Visibilty</span>
                        <img src="${ASSET_PATH}/123_1075.svg" alt="dropdown arrow">
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
                            <tr>
                                <td>
                                    <div class="job-title">Service Crew</div>
                                    <div class="job-company">Jollibee</div>
                                </td>
                                <td><span class="tag tag-full-time">Full Time</span></td>
                                <td>₱12,100–₱15,000</td>
                                <td>Oct 01 2025</td>
                                <td>
                                    <div class="skills-cell">
                                        <span class="tag tag-skill">Service Crew</span>
                                        <span class="tag tag-skill">Cashier</span>
                                    </div>
                                </td>
                                <td class="status-approved">Approved</td>
                                <td class="status-published">Published</td>
                                <td>
                                    <div class="action-cell">
                                        <a href="#" class="action-btn">Preview</a>
                                        <a href="#" class="action-btn">Edit</a>
                                        <a href="#" class="action-btn action-reject">Reject</a>
                                        <a href="#" class="action-btn action-delete">Delete</a>
                                        <a href="#" class="action-btn action-unpublished">Unpublished</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="job-title">Utility Worker</div>
                                    <div class="job-company">Gaisano</div>
                                </td>
                                <td><span class="tag tag-part-time">Part Time</span></td>
                                <td>₱12,100–₱15,000</td>
                                <td>Oct 01 2025</td>
                                <td>
                                    <div class="skills-cell">
                                        <span class="tag tag-skill">Service Crew</span>
                                        <span class="tag tag-skill">Cashier</span>
                                    </div>
                                </td>
                                <td class="status-approved">Approved</td>
                                <td class="status-published">Published</td>
                                <td>
                                    <div class="action-cell">
                                        <a href="#" class="action-btn">Preview</a>
                                        <a href="#" class="action-btn">Edit</a>
                                        <a href="#" class="action-btn action-reject">Reject</a>
                                        <a href="#" class="action-btn action-delete">Delete</a>
                                        <a href="#" class="action-btn action-unpublished">Unpublished</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="job-title">Saleslady</div>
                                    <div class="job-company">MR.DIY</div>
                                </td>
                                <td><span class="tag tag-gig">Gig</span></td>
                                <td>₱12,100–₱15,000</td>
                                <td>Oct 01 2025</td>
                                <td>
                                    <div class="skills-cell">
                                        <span class="tag tag-skill">Service Crew</span>
                                        <span class="tag tag-skill">Cashier</span>
                                    </div>
                                </td>
                                <td class="status-approved">Approved</td>
                                <td class="status-unpublished">Unpublished</td>
                                <td>
                                    <div class="action-cell">
                                        <a href="#" class="action-btn">Preview</a>
                                        <a href="#" class="action-btn">Edit</a>
                                        <a href="#" class="action-btn action-reject">Reject</a>
                                        <a href="#" class="action-btn action-delete">Delete</a>
                                        <a href="#" class="action-btn action-published">Published</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </section>

</body>

</html>


