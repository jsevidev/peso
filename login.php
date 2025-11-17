<!DOCTYPE html>
<html lang="en">
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'config.php';

if (isset($_POST['login'])) {

    $mysqli = new mysqli("localhost", "root", "", "peso");
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    /* -------------------------
       1. CHECK ADMIN (Plain)
       ------------------------- */
    $stmt = $mysqli->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $admin = $stmt->get_result();

    if ($admin->num_rows === 1) {
        $row = $admin->fetch_assoc();

        if ($password == $row['password']) {

            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = "admin";

            header("Location: admin/dashboard.php");
            exit();
        }
    }


    /* -------------------------
       2. CHECK APPLICANT (Hashed)
       ------------------------- */
    $stmt = $mysqli->prepare("SELECT * FROM applicant_account WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $appl = $stmt->get_result();

    if ($appl->num_rows === 1) {
        $row = $appl->fetch_assoc();

        if (password_verify($password, $row['password'])) {

            $_SESSION['applicant_id'] = $row['appl_id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = "applicant";

            header("Location: appl_profile/appl_profile.php");
            exit();
        }
    }


    /* -------------------------
       3. CHECK EMPLOYER (Hashed)
       ------------------------- */
    $stmt = $mysqli->prepare("SELECT * FROM employers_acc WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $emp = $stmt->get_result();

    if ($emp->num_rows === 1) {
        $row = $emp->fetch_assoc();

        if (password_verify($password, $row['password'])) {

            $_SESSION['employer_id'] = $row['employer_id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = "employer";

            header("Location: employer/emp_job_posting.php");
            exit();
        }
    }

    /* Failed login */
    $error = "Invalid username or password!";

    if (isset($stmt)) $stmt->close();
    $mysqli->close();
}
?>

    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="script.js"></script>

</head>

<body>
    <header id="section-header" class="site-header">
    <div class="header-container">
        <a href="#" class="logo-container">
        <img src="PESO_logo.png" alt="PESO Ozamiz Logo" class="logo-img">
        <span class="logo-text">PESO Ozamiz</span>
        </a>
        <nav class="main-nav">
        <!-- <a href="#">Home</a>
        <a href="#">Job Listing</a> -->
        <!-- <a href="aboutus.php">About Us</a>
        <a href="contactus.php">Contact Us</a> -->
        </nav>
        <a href="signup.php" class="btn btn-header-login">Create Account</a>
    </div>
    </header>
    
    <main id="section-login-form" class="login-section">
    <div class="login-card">
        <div class="login-header">
        <h1>Log in</h1>
        <p>Login your account</p>
        </div>

        <div class="social-login">
        <!-- <a href="#" class="social-btn">
            <i class="fa-brands fa-google" alt="Google-logo"></i>
            <span>Continue with Google</span>
        </a> -->
        <!-- <a href="#" class="social-btn">
            <i class="fa-brands fa-facebook" alt="Facebook icon"></i>
            <span>Continue with Facebook</span>
        </a> -->
        </div>

        <!-- <div class="divider">
        <span class="divider-line"></span>
        <span class="divider-text">OR</span>
        <span class="divider-line"></span>
        </div> -->

        <form method="POST" action="" class="login-form"  >
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address" required>
        </div>

        <div class="form-group">
            <div class="label-row">
            <label for="password">Password</label>
            <button type="button" class="toggle-password" onclick="show_pass_func()">
                <i class="fa-solid fa-eye-slash" style="color: #6a6d71;"></i>
                <span>Hide</span>
            </button>
            </div>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <div class="form-options">
            <label for="remember" class="remember-me">
            <!-- <input type="checkbox" id="remember" name="remember" class="visually-hidden" checked>
            <img src="${ASSET_PATH}/I20_3016_6_1918.svg" alt="Checkbox icon" class="custom-checkbox-img"> --> 
            <!-- <span>Remember me</span> -->
            </label>
            <a href="#" class="forgot-password">Forget your password</a>
        </div>

        <!-- change to button type="submit" for validation of account -->
        <button type="submit" class="btn btn-main-login" name="login">Login</button>
        <?php 
            if (isset($error)) {
                echo "<p style='color:red; margin-top:10px; text-align:center;'>$error</p>";
            }
        ?>
        </form>
    </div>
    </main>

</body>
</html>