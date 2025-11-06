<!doctype html>
<html lang="en">
<?php
include 'config.php';
session_start();
?>
<head>
  <meta charset="UTF-8">
  <title>Landing Page</title>

  <!-- Your base styles -->
  <link rel="stylesheet" href="landingpage.css">

  <!-- Modal shell + namespaced signup styles -->
  <link rel="stylesheet" href="signup.modal.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
  <header class="site-header">
    <div class="header-container">
      <a href="#" class="logo">
        <img src="PESO_logo.png" alt="PESO Logo">
        <span class="logo-text">PESO Ozamiz</span>
      </a>
      <nav class="main-navigation">
        <a href="#">Job Listing</a>
        <a href="#">Job Fairs</a>
        <a href="#">About Us</a>
        <a href="#">Contact Us</a>
      </nav>
      <div class="header-actions">
        <!-- OPEN MODAL -->
        <a href="#" class="btn-post-fairs js-open-signup">POST JOB FAIRS</a>
        <a href="#" class="auth-link">LOG IN</a>
        <a href="#" class="auth-link js-open-signup">SIGN UP</a>
      </div>
    </div>
  </header>

  <section id="hero" class="hero-section">
    <div class="page-wrapper">
      <div class="decorative-overlays">
        <img src="${ASSET_PATH}/285_1027.svg" alt="" class="deco-shape shape-1">
      </div>

      <div class="hero-content">
        <div class="hero-panel employer-panel">
          <div class="panel-content">
            <h2 class="panel-title">I'm an Employer</h2>
            <!-- OPEN MODAL -->
            <a href="#" class="btn-action js-open-signup">START POSTING FOR JOB FAIRS</a>
          </div>
        </div>

            <!-- Applicant panel button: add opener class -->
        <div class="hero-panel applicant-panel">
        <div class="panel-content">
            <h2 class="panel-title">I'm an Applicant</h2>
            <!-- OPEN APPLICANT MODAL -->
            <a href="#" class="btn-action js-open-applicant">START APPLYING FOR JOBS</a>
        </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SIGN-UP MODAL -->
  <div id="signupModal"
       class="modal"
       role="dialog"
       aria-modal="true"
       aria-hidden="true"
       aria-labelledby="signupModalTitle">
    <div class="modal__backdrop js-close-signup" data-backdrop></div>

    <div class="modal__dialog" role="document">
      <button class="modal__close js-close-signup" aria-label="Close sign up form">
        <i class="fa-solid fa-xmark"></i>
      </button>

      
      <section id="signup-form" class="signup-section">
        <div class="signup-card">
          <h1 class="title" id="signupModalTitle">Create an Employer account</h1>
          <p class="login-prompt">
            Already have an ccount? <a href="#">Log in</a>
          </p>

          <form method="POST" action="employer_signup_handler.php" class="signup-form">
            <div class="form-group">
              <label for="profile-name">What should we call you?</label>
              <input type="text" name="employer_name" id="profile-name" placeholder="Enter your profile name">
            </div>

            <div class="form-group">
              <label for="email">What’s your email?</label>
              <input type="email" name="email" id="email" placeholder="Enter your email address">
            </div>

            <div class="form-group">
              <div class="password-header">
                <label for="password">Create a password</label>
                <button type="button" class="hide-btn" id="togglePwd">
                  <img src="${ASSET_PATH}/I331_1212_2_54_2_40.svg" alt="Toggle visibility icon">
                  <span>Hide</span>
                </button>
              </div>
              <input type="password" name="password" id="password" placeholder="Enter your password">
              <p class="password-hint">Use 8 or more characters with a mix of letters, numbers & symbols</p>
            </div>

            <button type="submit" name="signup" class="btn btn-primary">Create Account</button>
          </form>

          <div class="divider-container">
            <div class="divider-line"></div>
            <span class="divider-text">OR</span>
            <div class="divider-line"></div>
          </div>

          <a href="#" class="btn btn-secondary">
            <img src="${ASSET_PATH}/I331_1222_2_979.svg" alt="Google logo">
            <span>Continue with Google</span>
          </a>
        </div>
      </section>
      <!-- ================== /SIGN-UP ================== -->
    </div>
  </div>
  <!-- ================== /SIGN-UP MODAL ================== -->

    

    <!-- ...somewhere near the end of <body>, after employer modal -->
    <?php include 'applicant.modal.php'; ?>

    <!-- Scripts (keep your employer modal JS, then add this line) -->
    <script src="applicant.modal.js"></script>


  <script src="signup.modal.js"></script>
</body>
</html>


