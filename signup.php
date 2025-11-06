<!doctype html>
<html lang="en">
<?php
include 'config.php';
session_start();

if (isset($_POST['signup'])) {
    //connect to database
    $mysqli = new mysqli("localhost", "root", "", "peso");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    //get form values
    $appl_name = $_POST['appl_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //insert to applicant_account table
    $stmt = $mysqli->prepare("INSERT INTO applicant_account (appl_name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $appl_name, $email, $password);

    if ($stmt->execute()) {
        //redirect to login page after success
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
?>

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <script src="script.js"></script>  
</head>

    <header class="site-header">
        <div class="container header-container">
            <div class="logo-wrapper">
                <img src="PESO_logo.png" alt="PESO Logo" class="logo">
                <span class="brand-name">PESO Ozamiz</span>
            </div>
            <a href="login.php" class="login-button">Login</a>
        </div>
    </header>

<body>
    <main class="signup-section">
        <div class="signup-container">
            <div class="signup-header">
                <h1 class="signup-title">Create an account</h1>
                <p class="login-prompt">Already have an ccount? <a href="#">Log in</a></p>
            </div>

            <form method="POST" action="" class="signup-form">
                <div class="form-group">
                    <label for="profile-name">What should we call you?</label>
                    <input type="text" id="profile-name" name="appl_name" placeholder="Enter your profile name">
                </div>
                <div class="form-group">
                    <label for="email">What’s your email?</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email address">
                </div>

                <!-- password  -->
                <div class="form-group">
                    <div class="label-wrapper">
                        <label for="password">Create a password</label>
                        <button type="button" class="toggle-password" onclick="show_pass_func()">
                            <i class="fa-solid fa-eye-slash" style="color: #6a6d71;"></i>
                            <!-- <img src="${ASSET_PATH}/I20_2823_2_54_2_40.svg" alt="Toggle password visibility"> -->
                            <span>Hide</span>
                        </button>
                    </div>
                    <input type="password" id="password" name="password" placeholder="Enter your password">
                    <p class="password-hint">Use 8 or more characters with a mix of letters, numbers & symbols</p>
                </div>

                <!-- change to button type="submit" for validation of account -->
                <!-- onclick="window.location.href='login.php' -->
                <button type="submit" class="btn btn-primary" name="signup"> Create Account</button>
            </form>

            <div class="divider">
                <span class="divider-line"></span>
                <span class="divider-text">OR</span>
                <span class="divider-line"></span>
            </div>

            <div class="social-login">
                <button class="btn btn-social">
                    <i class="fa-brands fa-google" alt="Google-logo"></i>
                    <span>Continue with Google</span>
                </button>
                <button class="btn btn-social">
                    <i class="fa-brands fa-facebook" alt="Facebook icon"></i>
                    <span>Continue with Facebook</span>
                </button>
            </div>
        </div>
    </main>

    
</body>

</html>


