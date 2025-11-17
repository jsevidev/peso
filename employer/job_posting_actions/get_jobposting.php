<?php
include '../../config.php';

$mysqli = new mysqli("localhost", "root", "", "peso");

$job_id = $_GET['job_id'];

$sql = "
    SELECT jp.*, e.company_name 
    FROM job_posting jp
    LEFT JOIN employers e ON jp.employer_id = e.employer_id
    WHERE jp.job_id = ?
";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $job_id);
$stmt->execute();

echo json_encode($stmt->get_result()->fetch_assoc());
