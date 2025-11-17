<?php
include '../config.php';

$id = $_GET['id'] ?? 0;
$mysqli = new mysqli("localhost", "root", "", "peso");

if ($mysqli->connect_error) {
    die(json_encode(["error" => "DB connection failed"]));
}

$sql = "SELECT 
            ap.full_name,
            ap.verification AS document_file,
            av.remarks,
            av.status
        FROM applicant_profile ap
        LEFT JOIN appl_verification av 
            ON ap.appl_profile_id = av.appl_profile_id
        WHERE ap.appl_profile_id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

echo json_encode($result ?: []);
$stmt->close();
$mysqli->close();
?>
