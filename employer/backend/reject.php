<?php
include '../../config.php';

$mysqli = new mysqli("localhost", "root", "", "peso");

$id = $_POST['id'];

$sql = "UPDATE applications SET status='Rejected' WHERE application_id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Applicant rejected.";
} else {
    echo "Error: " . $mysqli->error;
}
