<?php
include '../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appl_profile_id = intval($_POST['id']);
    $status = $_POST['status'];
    $remarks = $_POST['remarks'] ?? '';
    $verified_by = $_SESSION['admin_name'] ?? 'Admin';

    $mysqli = new mysqli("localhost", "root", "", "peso");
    if ($mysqli->connect_error) {
        die("DB connection failed: " . $mysqli->connect_error);
    }

    // Check if the applicant already has a verification record
    $check = $mysqli->prepare("SELECT ver_id FROM appl_verification WHERE appl_profile_id = ?");
    if (!$check) {
        die("Check prepare failed: " . $mysqli->error);
    }

    $check->bind_param("i", $appl_profile_id);
    if (!$check->execute()) {
        die("Check execute failed: " . $check->error);
    }

    $result = $check->get_result();

    if ($result->num_rows === 0) {
        // Insert a new record
        $insert = $mysqli->prepare("INSERT INTO appl_verification 
            (appl_profile_id, status, remarks, verified_by, verified_at)
            VALUES (?, ?, ?, ?, NOW())");
        if (!$insert) {
            die("Insert prepare failed: " . $mysqli->error);
        }
        $insert->bind_param("isss", $appl_profile_id, $status, $remarks, $verified_by);
        if (!$insert->execute()) {
            die("Insert execute failed: " . $insert->error);
        }
        $insert->close();
    } else {
        // Update existing record
        $update = $mysqli->prepare("UPDATE appl_verification
            SET status = ?, remarks = ?, verified_by = ?, verified_at = NOW()
            WHERE appl_profile_id = ?");
        if (!$update) {
            die("Update prepare failed: " . $mysqli->error);
        }
        $update->bind_param("sssi", $status, $remarks, $verified_by, $appl_profile_id);
        if (!$update->execute()) {
            die("Update execute failed: " . $update->error);
        }
        $update->close();
    }

    echo 'success';
    $check->close();
    $mysqli->close();
}
?>
