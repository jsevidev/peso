<?php
include '../../config.php';

$dbname = "peso";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM job_fairs WHERE jobfair_id=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../job_fair.php?deleted=1");
    exit;
} else {
    echo "Error deleting record: " . $stmt->error;
}
?>
