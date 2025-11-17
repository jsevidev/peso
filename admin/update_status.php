<?php
include '../config.php';

// Check if parameters are received
if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = intval($_POST['id']);
    $status = $_POST['status'];

    // Create a new database connection
    $mysqli = new mysqli("localhost", "root", "", "peso");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // ✅ Make sure the column names match your database
    $stmt = $mysqli->prepare("UPDATE applicant_profile SET status = ? WHERE appl_profile_id = ?");
    if (!$stmt) {
        echo "Prepare failed: " . $mysqli->error;
        exit;
    }

    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "SQL Error: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
} else {
    echo "Missing parameters";
}
?>
