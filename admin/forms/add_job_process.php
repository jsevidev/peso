<?php
include '../../config.php';

$mysqli = new mysqli("localhost", "root", "", "peso");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

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
    $period         = '2025-2026';

    $stmt = $mysqli->prepare("
        INSERT INTO job_posting 
        (employer_id, job_title, employment_type, posted_date, salary_min, salary_max, skills, caption, moderation, visibility, period)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("issssssssss",
        $employer_id, $job_title, $employment_type, $posted_date,
        $salary_min, $salary_max, $skills, $caption, $moderation,
        $visibility, $period
    );

    if ($stmt->execute()) {
        header("Location: ../job_posting.php?added=1");
        exit();
    }

    echo "SQL ERROR: " . $stmt->error;
}
