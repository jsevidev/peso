<?php
include '../../config.php';

$mysqli = new mysqli("localhost", "root", "", "peso");

$job_id         = $_POST['job_id'];
$job_title      = $_POST['job_title'];
$employer_id    = $_POST['employer_id'];
$employment_type = $_POST['employment_type'];
$posted_date    = $_POST['posted_date'];
$salary_min     = $_POST['salary_min'];
$salary_max     = $_POST['salary_max'];
$skills         = $_POST['skills'];
$caption        = $_POST['caption'];
$moderation     = $_POST['moderation'];
$visibility     = $_POST['visibility'];

$sql = "
    UPDATE job_posting
    SET employer_id=?, job_title=?, employment_type=?, posted_date=?, salary_min=?, salary_max=?, skills=?, caption=?, moderation=?, visibility=?
    WHERE job_id=?
";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param(
    "isssssssssi",
    $employer_id,
    $job_title,
    $employment_type,
    $posted_date,
    $salary_min,
    $salary_max,
    $skills,
    $caption,
    $moderation,
    $visibility,
    $job_id
);

if ($stmt->execute()) {
    header("Location: ../emp_job_posting.php?updated=1");
    exit;
} else {
    echo "Error: " . $stmt->error;
}
