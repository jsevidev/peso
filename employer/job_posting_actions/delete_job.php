<?php
include '../../config.php';

if (!isset($_GET['job_id'])) {
    die("Invalid request.");
}

$job_id = intval($_GET['job_id']);

$mysqli = new mysqli("localhost", "root", "", "peso");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$stmt = $mysqli->prepare("DELETE FROM job_posting WHERE job_id=?");
$stmt->bind_param("i", $job_id);

if ($stmt->execute()) {
    header("Location: ../emp_job_posting.php?deleted=1");
    exit();
} else {
    echo "Error deleting: " . $stmt->error;
}

?>
