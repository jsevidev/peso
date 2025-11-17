<?php
include '../../config.php';

$mysqli = new mysqli("localhost", "root", "", "peso");

$application_id   = $_POST['application_id'];
$employer_id      = $_POST['employer_id'];
$appl_profile_id  = $_POST['appl_profile_id'];
$job_posting_id   = $_POST['job_posting_id'];
$interview_date   = $_POST['interview_date'];
$interview_time   = $_POST['interview_time'];
$method           = $_POST['method'];
$location         = $_POST['location'];
$notes            = $_POST['notes'];

// --------------------------------------------------------------
// CHECK IF SCHEDULE ALREADY EXISTS FOR THIS APPLICATION
// --------------------------------------------------------------
$check = $mysqli->prepare("SELECT interview_id FROM interview_schedule WHERE application_id = ?");
$check->bind_param("i", $application_id);
$check->execute();
$existing = $check->get_result()->fetch_assoc();

// --------------------------------------------------------------
// IF EXISTS → UPDATE
// --------------------------------------------------------------
if ($existing) {

    $update = $mysqli->prepare("
        UPDATE interview_schedule 
        SET interview_date = ?, 
            interview_time = ?, 
            method = ?, 
            location = ?, 
            notes = ?, 
            status = 'Scheduled'
        WHERE application_id = ?
    ");

    $update->bind_param(
        "sssssi",
        $interview_date,
        $interview_time,
        $method,
        $location,
        $notes,
        $application_id
    );

    if ($update->execute()) {
        echo "Interview schedule updated successfully!";
    } else {
        echo "Update failed: " . $mysqli->error;
    }

}
// --------------------------------------------------------------
// ELSE → INSERT NEW
// --------------------------------------------------------------
else {

    $insert = $mysqli->prepare("
        INSERT INTO interview_schedule 
        (application_id, employer_id, appl_profile_id, job_posting_id, interview_date, interview_time, method, location, notes, status, created_at)
        VALUES (?,?,?,?,?,?,?,?,?, 'Scheduled', NOW())
    ");

    $insert->bind_param(
        "iiiisssss",
        $application_id,
        $employer_id,
        $appl_profile_id,
        $job_posting_id,
        $interview_date,
        $interview_time,
        $method,
        $location,
        $notes
    );

    if ($insert->execute()) {
        echo "Interview schedule added successfully!";
    } else {
        echo "Insert failed: " . $mysqli->error;
    }
}

// --------------------------------------------------------------
// UPDATE application status to Shortlisted
// --------------------------------------------------------------
$mysqli->query("UPDATE applications SET status = 'Shortlisted' WHERE application_id = $application_id");

?>
