<?php
include '../../config.php';

$mysqli = new mysqli("localhost", "root", "", "peso");

$id = $_POST['id'];        // application_id
$job_id = $_POST['job_id'];  // job_posting_id

// 1. Update application status
$sql1 = "UPDATE applications SET status='Hired' WHERE application_id = ?";
$stmt1 = $mysqli->prepare($sql1);
$stmt1->bind_param("i", $id);

// 2. Set job visibility to Unpublished
$sql2 = "UPDATE job_posting SET visibility='Unpublished' WHERE job_id = ?";
$stmt2 = $mysqli->prepare($sql2);
$stmt2->bind_param("i", $job_id);

if ($stmt1->execute() && $stmt2->execute()) {
    echo "Applicant marked as Hired. Job posting is now Unpublished.";
} else {
    echo "Error: " . $mysqli->error;
}
