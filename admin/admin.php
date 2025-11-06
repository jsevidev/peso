<!doctype html>
<html lang="en">
<?php
include '../config.php';
session_start();

if (isset($_POST['login'])) {
    //connect to database
    $mysqli = new mysqli("localhost", "root", "", "peso");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    //check if account exists
    $stmt = $mysqli->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Admin not found or incorrect password.";
    }
}
?>
<head>
    <meta charset="UTF-8">
    <title>Admin Sign Up</title>
        <link rel="stylesheet" href="admin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <script src="script.js"></script>  
</head>

    <header id="section-header" class="site-header">
    <div class="header-container">
        <div class="logo-container">
        <img src="../PESO_logo.png" alt="PESO Logo" class="logo">
        <h1 class="site-title">PESO Ozamiz</h1>
        </div>
        <a href="#" class="admin-button">Admin</a>
    </div>
    </header>

<body>
    <main id="section-login" class="login-section">
    <div class="login-card">
        <h2 class="login-title">Admin</h2>
        <p class="login-subtitle">Login your account</p>
        <form class="login-form" method="POST" action="">
        <div class="form-group">
            <label for="form" class="form-label">Username</label>
            <input type="form" id="username" name="username" class="form-input" placeholder="Enter your username">
        </div>
        <div class="form-group">
            <div class="label-wrapper">
            <label for="password" class="form-label">Password</label>
            <button type="button" class="toggle-password">
                <img src="${ASSET_PATH}/I103_416_2_54_2_40.svg" alt="Toggle password visibility">
                <span>Hide</span>
            </button>
            </div>
            <input type="password" id="password" name="password" class="form-input" placeholder="Enter your password">
        </div>
        <div class="form-options">
            <div class="checkbox-group">
            <img src="${ASSET_PATH}/I103_424_6_1918.svg" alt="Checkbox icon" class="checkbox-icon">
            <label class="checkbox-label">Remember me</label>
            </div>
            <a href="#" class="forgot-password-link">Forget your password</a>
        </div>
        <button type="submit" class="submit-button" name="login">Login Admin</button>
        </form>
    </div>
    </main>
</body>

</html>


