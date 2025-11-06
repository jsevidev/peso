<!doctype html>
<html lang="en">
<?php
include '../config.php';
session_start();



$mysqli = new mysqli("localhost", "root", "", "peso");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

//Get Total Applicants Count 
$sql_applicants = "SELECT COUNT(*) AS total_applicants FROM applicant_account";
$result_applicants = $mysqli->query($sql_applicants);

if ($result_applicants) {
    $row_applicants = $result_applicants->fetch_assoc();
    $total_applicants = $row_applicants['total_applicants'];
} else {
    $total_applicants = 'Error'; // Handle database query error
}

// --- 2. Get Total Employers Count ---
// Table: employers
$sql_employers = "SELECT COUNT(*) AS total_employers FROM employers";
$result_employers = $mysqli->query($sql_employers);

if ($result_employers) {
    $row_employers = $result_employers->fetch_assoc();
    $total_employers = $row_employers['total_employers'];
} else {
    $total_employers = 'Error'; // Handle database query error
}

// Close connection (optional, but good practice if done early)
$mysqli->close();

// Placeholder variables for the remaining cards (to avoid errors)
$active_jobs = '0';
$jobs_filled = '0';



?>


<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
        <link rel="stylesheet" href="dashboard.css">
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
                    <li class="active"><a href="#">Dashboard</a></li>
                    <li><a href="appl_list.php">Applicants</a></li>
                    <li><a href="empl_list.php">Employers</a></li>
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
            <div class="stats-grid">
                <article class="stat-card">
                    <h2 class="stat-title">Total Applicants</h2>
                    <p class="stat-number"><?php echo $total_applicants; ?></p>
                </article>
                <article class="stat-card">
                    <h2 class="stat-title">Total Employers</h2>
                    <p class="stat-number"><?php echo $total_employers; ?></p>
                </article>
                <article class="stat-card">
                    <h2 class="stat-title">Active Jobs</h2>
                    <p class="stat-number"><?php echo $active_jobs; ?></p>
                </article>
                <article class="stat-card">
                    <h2 class="stat-title">Jobs Filled</h2>
                    <p class="stat-number"><?php echo $jobs_filled; ?></p>
                </article>
            </div>
        </main>
    </section>
</body>

</html>


