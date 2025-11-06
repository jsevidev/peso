<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    // connect to DB
    $mysqli = new mysqli("localhost", "root", "", "peso");
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // collect form data safely
    $appl_name = trim($_POST['appl_name'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $password  = $_POST['password'] ?? '';

    if ($appl_name === '' || $email === '' || $password === '') {
        header("Location: login.php?err=missing");
        exit();
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // insert to DB
    $stmt = $mysqli->prepare("INSERT INTO applicant_account (appl_name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $appl_name, $email, $hashed);

    if ($stmt->execute()) {
        header("Location: login.php?ok=1");
    } else {
        header("Location: login.php?err=insert");
    }

    $stmt->close();
    $mysqli->close();
    exit();
}

// if accessed directly, just go back
header("Location: landingpage.php");
exit();
