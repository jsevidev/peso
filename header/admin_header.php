<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Header Nav</title>
        <link rel="stylesheet" href="../header/css/admin_header.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> 
</head>

<body>

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
    
<section class="dashboard-body">
    <aside class="sidebar">
        <nav class="sidebar-nav">
            <ul>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>"><a href="../admin/dashboard.php">Dashboard</a></li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'appl_list.php' ? 'active' : '' ?>"><a href="../admin/appl_list.php">Applicants</a></li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'empl_list.php' ? 'active' : '' ?>"><a href="../admin/empl_list.php">Employers</a></li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'job_posting.php' ? 'active' : '' ?>"><a href="../admin/job_posting.php">Job Posting</a></li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'application.php' ? 'active' : '' ?>"><a href="../admin/application.php">Applications</a></li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'job_fair.php' ? 'active' : '' ?>"><a href="../admin/job_fair.php">Job Fairs</a></li>
                <!-- <li class="<?= basename($_SERVER['PHP_SELF']) == 'anncmnt.php' ? 'active' : '' ?>"><a href="../admin/anncmnt.php">Announcements</a></li> -->
            </ul>
        </nav>
        <a href="../login.php" class="logout-button">
            <span>Logout</span>
            <i class="fa-solid fa-arrow-right-from-bracket fa-lg" alt="Logout icon"></i>
        </a>
    </aside>
<!-- </section> 
</body> -->




