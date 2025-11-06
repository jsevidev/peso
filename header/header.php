<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/PESO/css/header.css">
</head>

<header class="site-header">
  <div class="container header-container">
    <a href="../index.php" class="logo-link">
      <img src="../PESO_logo.png" alt="PESO Ozamiz Logo" class="logo-img">
      <h1 class="logo-text">PESO Ozamiz</h1>
    </a>

    <nav class="main-nav">
      <a href="home.php" class="<?= basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : '' ?>">Home</a>
      <a href="joblisting.php" class="<?= basename($_SERVER['PHP_SELF']) == 'joblisting.php' ? 'active' : '' ?>">Job Listing</a>
      <a href="aboutus.php" class="<?= basename($_SERVER['PHP_SELF']) == 'aboutus.php' ? 'active' : '' ?>">About Us</a>
      <a href="contactus.php" class="<?= basename($_SERVER['PHP_SELF']) == 'contactus.php' ? 'active' : '' ?>">Contact Us</a>
    </nav>

    <div class="user-profile">
        <a href="appl_profile.php" class="user-name" class="<?= basename($_SERVER['PHP_SELF']) == 'appl_profile.php' ? 'active' : '' ?>">Alvin</a>
        <!-- <span class="user-name" onclick="window.location.href='appl_profile.php'">Alvin</span> -->
        <i class="fa-solid fa-user fa-xl" style="color: #ffffff;"></i>
   
    </div>
  </div>
</header>

