<?php
include 'config.php';
session_start();

if (isset($_POST['signup'])) {
    // Connect to database
    $mysqli = new mysqli("localhost", "root", "", "peso");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Get form values
    $employer_name = $_POST['employer_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert into employers_acc table
    $stmt = $mysqli->prepare("INSERT INTO employers_acc (employer_name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $employer_name, $email, $password);

    if ($stmt->execute()) {
        // Redirect to login page after success
        header("Location: newlogin.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
?>
