<!-- <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?> -->

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../header/css/header.css">
</head>

<header class="site-header">
  <div class="container header-container">
    <a href="../index.php" class="logo-link">
      <img src="../PESO_logo.png" alt="PESO Ozamiz Logo" class="logo-img">
      <h1 class="logo-text">PESO Ozamiz</h1>
    </a>

    <nav class="main-nav">
      <a href="../nav/home.php" class="<?= basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : '' ?>">Home</a>
      <a href="../nav/joblisting.php" class="<?= basename($_SERVER['PHP_SELF']) == 'joblisting.php' ? 'active' : '' ?>">Job Listing</a>
      <a href="../nav/aboutus.php" class="<?= basename($_SERVER['PHP_SELF']) == 'aboutus.php' ? 'active' : '' ?>">About Us</a>
      <a href="../nav/contactus.php" class="<?= basename($_SERVER['PHP_SELF']) == 'contactus.php' ? 'active' : '' ?>">Contact Us</a>
    </nav>

    <div class="user-profile">
      <?php if (isset($_SESSION['employer_name'])): ?>
          <a href="../appl_profile/appl_profile.php" 
            class="user-name <?= basename($_SERVER['PHP_SELF']) == 'appl_profile.php' ? 'active' : '' ?>">
            <?= htmlspecialchars($_SESSION['applicant_name'] ?? 'User'); ?>
          </a>
        <?php else: ?>
          <a href="../login.php" class="user-name">Login</a>
        <?php endif; ?>
        
        <i class="fa-solid fa-user fa-xl" style="color: #ffffff;"></i>  
    </div>
  </div>
</header>

