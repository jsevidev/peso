<!doctype html>
<html lang="en">
<?php
include '../config.php';
session_start();

?>
<head>
    <meta charset="UTF-8">
    <title>AAdmin Sign Up</title>
        <link rel="stylesheet" href="empl_list.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <script src="script.js"></script>  
</head>


    <header class="site-header">
    <div class="header-container">
        <div class="header-brand">
        <img src="../PESO_logo.png" alt="PESO Logo" class="logo">
        <h1 class="site-title">PESO Ozamiz</h1>
        </div>
        <div class="header-controls">
        <form class="search-form">
            <input type="search" class="search-input" placeholder="Search Something....">
            <button type="submit" class="search-button">Search</button>
        </form>
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
                    <li class="active"><a href="#">Employers</a></li>
                    <li><a href="job_posting.php">Job Posting</a></li>
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
        <section class="content-card">
        <div class="card-header">
            <h2 class="card-title">List of Employers</h2>
            <div class="card-actions">
            <form class="card-search-form">
                <input type="text" placeholder="Search a Applicants">
                <button type="submit">Search</button>
            </form>
            <a href="forms/add_empl.php" class="add-employer-button">
                <i class="fa-solid fa-plus fa-xl" style="color: #ffffff;"></i>
                <span>ADD EMPLOYER</span>
            </a>
            </div>
        </div>
        <div class="card-body">
            <div class="employer-table">
            <div class="table-header">
                <div class="header-cell"></div>
                <div class="header-cell">Company Name</div>
                <div class="header-cell">Contact Person</div>
                <div class="header-cell">Accreditation Status</div>
                <div class="header-cell">Actions</div>
            </div>
            <div class="table-row">
                <div class="table-cell row-index">1</div>
                <div class="table-cell">McDonald’s</div>
                <div class="table-cell">Anna Dela Cruz</div>
                <div class="table-cell status-verified">Verified</div>
                <div class="table-cell action-icons">
                <button class="icon-button">
                    <i class="fa-regular fa-square-check fa-xl" style="color: #00ff11;" alt="Approve"></i> 
                </button>
                <button class="icon-button">
                    <i class="fa-solid fa-square-xmark fa-xl" style="color: #ff0000;"></i>
                </button>
                <button class="icon-button">
                    <i class="fa-solid fa-eye fa-xl" style="color: #105ada;"></i>
                </button>
                </div>
            </div>
            </div>
        </div>
        </section>
    </main>
    </div>

    <script>
    // Add data-label attributes for mobile view
    document.addEventListener('DOMContentLoaded', function() {
        if (window.innerWidth <= 768) {
        const headers = Array.from(document.querySelectorAll('.table-header .header-cell')).map(h => h.textContent.trim());
        const rows = document.querySelectorAll('.table-row');
        rows.forEach(row => {
            const cells = row.querySelectorAll('.table-cell');
            cells.forEach((cell, index) => {
            if (headers[index]) {
                cell.setAttribute('data-label', headers[index]);
            }
            });
        });
        }
    });
    </script>
</body>

</html>


