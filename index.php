<!doctype html>
<html lang="en">

    <?php
    include 'config.php';
    session_start();
    ?>

<head>
  <meta charset="UTF-8">
  <title>Index</title>
  <link rel="stylesheet" href="index.css">
</head>

<body>
    <section id="section-header">
    <header class="site-header">
      <div class="container header-container">
        <a href="#" class="logo-container">
          <img src="PESO_logo.png" alt="PESO Logo" class="logo">
          <span class="site-title">PESO Ozamiz</span>
        </a>
        <nav class="main-nav">
          <ul>
            <!-- <li><a href="#">Home</a></li>
            <li><a href="#">Job Listing</a></li> -->
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
          </ul>
        </nav>
        <!-- <a href="#" class="login-button">Login</a> -->
      </div>
    </header>
  </section>

  <section id="section-hero">
    <main class="hero-section">
      <div class="login-card">
        <h2 class="login-title">PESO Ozamiz</h2>
        <div class="button-group">
          <a href="signup.php" class="btn btn-applicant">Applicant</a>
          <a href="admin/admin.php" class="btn btn-admin">Admin</a>
        </div>
      </div>
    </main>
  </section>

</body>
</html>


