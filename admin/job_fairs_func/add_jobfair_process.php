<?php
include '../../config.php';

$dbname = "peso";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$title = $_POST['title'];
$companies = $_POST['participating_companies'];
$location = $_POST['location'] ?? '';
$date = $_POST['date'];
$status = $_POST['status'];
$link = $_POST['link'];

$sql = "INSERT INTO job_fairs (title, participating_companies, location, date, status, link)
        VALUES (?,?,?,?,?,?)";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ssssss", $title, $companies, $location, $date, $status, $link);

if ($stmt->execute()) {
    header("Location: ../job_fair.php?added=1");
    exit;
} else {
    echo "Error: " . $stmt->error;
}
