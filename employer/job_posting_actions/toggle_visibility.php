<?php
include '../../config.php';

$mysqli = new mysqli("localhost", "root", "", "peso");
if ($mysqli->connect_error) {
    die(json_encode(["status" => "error", "message" => "DB error"]));
}

$job_id = $_POST['job_id'];

// Get current visibility
$query = $mysqli->prepare("SELECT visibility FROM job_posting WHERE job_id = ?");
$query->bind_param("i", $job_id);
$query->execute();
$result = $query->get_result()->fetch_assoc();

$current = $result['visibility'];

// Toggle logic
$new_visibility = ($current === "Published") ? "Unpublished" : "Published";

// Update visibility
$update = $mysqli->prepare("UPDATE job_posting SET visibility = ? WHERE job_id = ?");
$update->bind_param("si", $new_visibility, $job_id);
$update->execute();

echo json_encode([
    "status" => "success",
    "newVisibility" => $new_visibility,
    "buttonLabel" => ($new_visibility === "Published") ? "Unpublish" : "Publish",
    "buttonClass" => ($new_visibility === "Published") ? "action-unpublished" : "action-published"
]);
?>
