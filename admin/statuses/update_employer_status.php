<?php
include '../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employer_id = intval($_POST['employer_id']);
    $status = $_POST['status'];

    // Validate status input
    $valid_status = ['Verified', 'Rejected', 'Pending'];
    if (!in_array($status, $valid_status)) {
        echo json_encode(['success' => false, 'message' => 'Invalid status']);
        exit;
    }

    // Connect to DB
    $mysqli = new mysqli("localhost", "root", "", "peso");
    if ($mysqli->connect_error) {
        die(json_encode(['success' => false, 'message' => 'Database connection failed']));
    }

    // Update accreditation
    $stmt = $mysqli->prepare("UPDATE employers SET accreditation = ? WHERE employer_id = ?");
    $stmt->bind_param("si", $status, $employer_id);
    $success = $stmt->execute();

    echo json_encode(['success' => $success]);
}
?>
