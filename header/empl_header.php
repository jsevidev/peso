<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Employer Header Nav</title>
        <link rel="stylesheet" href="../header/css/empl_header.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> 
</head>

<body>

<header class="site-header">
    <div class="container header-container">
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

        <?php if (isset($_SESSION['employer_name'])): ?>
            <a href="../employer/emp_profile.php" 
                class="user-name <?= basename($_SERVER['PHP_SELF']) == 'emp_profile.php' ? 'active' : '' ?>">
                <?= htmlspecialchars($_SESSION['employer_name']); ?>
            </a>
        <?php else: ?>
            <a href="../login.php" class="user-name">Login</a>
        <?php endif; ?>
        <i class="fa-solid fa-user fa-xl" style="color: #ffffff;"></i>
    </div>

</header>
    
<section class="dashboard-body">
    <aside class="sidebar">
        <nav class="sidebar-nav">
            <ul>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'emp_job_posting.php' ? 'active' : '' ?>"><a href="../employer/emp_job_posting.php">Job Posting</a></li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'application.php' ? 'active' : '' ?>"><a href="../employer/application.php">Applications</a></li>
            </ul>
        </nav>
        <a href="../login.php" class="logout-button">
            <span>Logout</span>
            <i class="fa-solid fa-arrow-right-from-bracket fa-lg" alt="Logout icon"></i>
        </a>
    </aside>
<!-- </section> 
</body> -->




