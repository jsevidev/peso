<?php
include '../../config.php';

$dbname = "peso";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$id = $_POST['jobfair_id'];
$title = $_POST['title'];
$companies = $_POST['participating_companies'];
$location = $_POST['location'];
$date = $_POST['date'];
$status = $_POST['status'];
$link = $_POST['link'];

$sql = "UPDATE job_fairs 
        SET title=?, participating_companies=?, location=?, date=?, status=?, link=? 
        WHERE jobfair_id=?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ssssssi", $title, $companies, $location, $date, $status, $link, $id);

if ($stmt->execute()) {
    header("Location: ../job_fair.php?updated=1");
    exit;
} else {
    echo "Error: " . $stmt->error;
}
?>
