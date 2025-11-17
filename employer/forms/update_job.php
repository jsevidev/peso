<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "peso");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$job_id = $_POST['job_id'];
$title = $_POST['job_title'];
$type = $_POST['employment_type'];
$salary_min = $_POST['salary_min'];
$salary_max = $_POST['salary_max'];
$skills = $_POST['skills'];

$stmt = $mysqli->prepare("
    UPDATE job_posting 
    SET job_title=?, employment_type=?, salary_min=?, salary_max=?, skills=?
    WHERE job_id=?
");

$stmt->bind_param("ssddsi", $title, $type, $salary_min, $salary_max, $skills, $job_id);

if ($stmt->execute()) {
    header("Location: ../emp_job_posting.php?updated=1");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>
