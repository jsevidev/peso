<?php
include '../../config.php';

// Fetch the interview schedule details
if (isset($_GET['id'])) {
    $application_id = intval($_GET['id']);
    $stmt = $mysqli->prepare("
        SELECT 
            a.application_id,
            jp.job_title,
            e.company_name,
            a.status,
            i.interview_date,
            i.interview_time,
            i.method AS interview_method,
            i.location AS interview_location,
            i.notes
        FROM applications a
        JOIN job_posting jp ON a.job_posting_id = jp.job_posting_id
        JOIN employers e ON jp.employer_id = e.employer_id
        LEFT JOIN interview_schedule i ON i.application_id = a.application_id
        WHERE a.application_id = ?
    ");
    $stmt->bind_param("i", $application_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the result as an associative array
    if ($row = $result->fetch_assoc()) {
        // Return the data as JSON
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Interview schedule not found']);
    }
}
?>
