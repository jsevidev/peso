<!doctype html>
<html lang="en">
<?php
include 'config.php';
session_start();

if (isset($_POST['signup'])) {
    // connect to database
    $mysqli = new mysqli("localhost", "root", "", "peso");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // get form values safely
    $appl_name = $_POST['appl_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // insert to applicant_account table
    $stmt = $mysqli->prepare("INSERT INTO applicant_account (appl_name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $appl_name, $email, $password);

    if ($stmt->execute()) {
        // redirect after success
        header("Location: newlogin.php");
        exit();
    } else {
        echo "<script>alert('Error: " . addslashes($stmt->error) . "');</script>";
    }

    $stmt->close();
    $mysqli->close();
}
?>
<head>
  <meta charset="UTF-8">
  <title>Applicant Signup</title>
</head>

<body>
  <!-- ================== APPLICANT SIGN-UP MODAL ================== -->
  <div id="applicantModal"
       class="modal"
       role="dialog"
       aria-modal="true"
       aria-hidden="true"
       aria-labelledby="applicantModalTitle">
    <div class="modal__backdrop js-close-applicant" data-backdrop></div>

    <div class="modal__dialog" role="document">
      <button class="modal__close js-close-applicant" aria-label="Close sign up form">
        <i class="fa-solid fa-xmark"></i>
      </button>

      <!-- Applicant Sign-Up Form -->
      <section id="applicant-signup-form" class="signup-section">
        <div class="signup-card">
          <h1 class="title" id="applicantModalTitle">Create an Applicant account</h1>
          <p class="login-prompt">
            Already have an account? <a href="login.php">Log in</a>
          </p>

          <!-- 👇 Add "method=post" and name attributes to match PHP code -->
          <form class="signup-form" method="post" action="applicant_signup_handler.php">
            <div class="form-group">
              <label for="appl_name">What should we call you?</label>
              <input type="text" id="appl_name" name="appl_name" placeholder="Enter your profile name" required>
            </div>

            <div class="form-group">
              <label for="email">What’s your email?</label>
              <input type="email" id="email" name="email" placeholder="Enter your email address" required>
            </div>

            <div class="form-group">
              <div class="password-header">
                <label for="password">Create a password</label>
                <button type="button" class="hide-btn" id="app-togglePwd">
                  <img src="${ASSET_PATH}/I331_1212_2_54_2_40.svg" alt="Toggle visibility icon" aria-hidden="true">
                  <span>Hide</span>
                </button>
              </div>
              <input type="password" id="password" name="password" placeholder="Enter your password" minlength="8" required>
              <p class="password-hint">Use 8 or more characters with a mix of letters, numbers & symbols</p>
            </div>

            <!-- Important: "name=signup" matches PHP if-check -->
            <button type="submit" name="signup" class="btn btn-primary">Create Account</button>
          </form>
        </div>
      </section>
      <!-- ================== /APPLICANT SIGN-UP ================== -->
    </div>
  </div>
  <!-- ================== /APPLICANT SIGN-UP MODAL ================== -->
</body>
</html>
