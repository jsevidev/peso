<?php
include 'config.php';
session_start();

// (optional during dev)
// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_POST['login'])) {
    // Connect
    $mysqli = new mysqli("localhost", "root", "", "peso");
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Input
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // 1) applicant_account
    $stmt = $mysqli->prepare("SELECT appl_id, appl_name, email, password FROM applicant_account WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res && $res->num_rows === 1) {
        $row = $res->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['applicant_id']   = $row['appl_id'];
            $_SESSION['applicant_name'] = $row['appl_name'];
            $_SESSION['email']          = $row['email'];
            $stmt->close();
            $mysqli->close();
            header("Location: home.php");
            exit();
        }
    }
    $stmt->close();

    // 2) employers_acc
    $stmt = $mysqli->prepare("SELECT employer_id, employer_name, email, password FROM employers_acc WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res && $res->num_rows === 1) {
        $row = $res->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['employer_id']   = $row['employer_id'];
            $_SESSION['employer_name'] = $row['employer_name'];
            $_SESSION['email']         = $row['email'];
            $stmt->close();
            $mysqli->close();
            header("Location: emp_jobfair.php");
            exit();
        }
    }
    $stmt->close();

    // 3) admin  (uses email now)
    $stmt = $mysqli->prepare("SELECT admin_id, email, password FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res && $res->num_rows === 1) {
        $row = $res->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['email']    = $row['email'];
            $stmt->close();
            $mysqli->close();
            header("Location: admin/admin.php");
            exit();
        }
    }
    $stmt->close();

    // No match
    $error = "Invalid email or password!";
    $mysqli->close();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login</title>
  <link rel="stylesheet" href="newlogin.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>
<body>
  <main id="login-section" class="login-section">
    <div class="login-card">
      <form method="POST" action="" class="login-form">
        <div class="form-header">
          <h1 class="form-title">Log in</h1>
          <p class="form-subtitle">Access your account</p>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" id="email" name="email" placeholder="Enter your email" required />
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required />
        </div>

        <?php if (!empty($error)): ?>
          <p style="color:red; text-align:center;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <button type="submit" name="login" class="btn-submit">Login</button>
      </form>
    </div>
  </main>
</body>
</html>
