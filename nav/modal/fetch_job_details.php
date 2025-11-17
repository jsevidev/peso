<?php
include '../../config.php';

// Check if job_id is set
if (isset($_GET['job_id'])) {
    $job_id = intval($_GET['job_id']);

    // Fetch job details
    $sql = "SELECT 
                jp.job_id,
                jp.job_title,
                jp.employment_type,
                jp.posted_date,
                jp.salary_min,
                jp.salary_max,
                jp.skills,
                jp.caption,
                e.company_name
            FROM job_posting jp
            INNER JOIN employers e ON jp.employer_id = e.employer_id
            WHERE jp.job_id = ? AND jp.visibility = 'Published' AND jp.moderation = 'Approved'";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch job data
        $job = $result->fetch_assoc();

        // Prepare response as JSON
        $response = [
            'job_id' => $job['job_id'],
            'job_title' => $job['job_title'],
            'company_name' => $job['company_name'],
            'employment_type' => $job['employment_type'],
            'posted_date' => date('M d, Y', strtotime($job['posted_date'])),
            'salary_min' => $job['salary_min'],
            'salary_max' => $job['salary_max'],
            'skills' => $job['skills'],
            'caption' => $job['caption']
        ];

        // Return JSON response
        echo json_encode($response);
    } else {
        // Return empty response if no job found
        echo json_encode([]);
    }
}
?>
