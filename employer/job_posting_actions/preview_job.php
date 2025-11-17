<?php
include '../../config.php';

$mysqli = new mysqli("localhost", "root", "", "peso");
if ($mysqli->connect_error) {
    die("DB Error");
}

$job_id = $_GET['job_id'];

$sql = "SELECT jp.*, e.company_name 
        FROM job_posting jp
        LEFT JOIN employers e ON jp.employer_id = e.employer_id
        WHERE jp.job_id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $job_id);
$stmt->execute();
$result = $stmt->get_result();
$job = $result->fetch_assoc();

if (!$job) {
    echo "Invalid job ID.";
    exit;
}
?>

<div class="preview-wrapper">

    <h2 class="preview-title"><?= $job['job_title'] ?></h2>
    <p class="preview-company"><?= $job['company_name'] ?></p>

    <div class="preview-grid">

        <div class="preview-item">
            <label>Employment Type</label>
            <p><?= $job['employment_type'] ?></p>
        </div>

        <div class="preview-item">
            <label>Salary Range</label>
            <p>₱<?= $job['salary_min'] ?> - ₱<?= $job['salary_max'] ?> / month</p>
        </div>

        <div class="preview-item">
            <label>Posted Date</label>
            <p><?= $job['posted_date'] ?></p>
        </div>

        <div class="preview-item full">
            <label>Skills</label>
            <div class="skills-list">
                <?php foreach (explode(',', $job['skills']) as $skill): ?>
                    <span class="tag tag-skill"><?= trim($skill) ?></span>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="preview-item full">
            <label>Caption</label>
            <p><?= $job['caption'] ?></p>
        </div>

        <div class="preview-item">
            <label>Moderation</label>
            <p><?= $job['moderation'] ?></p>
        </div>

        <div class="preview-item">
            <label>Visibility</label>
            <p><?= $job['visibility'] ?></p>
        </div>

        <div class="preview-item">
            <label>Period</label>
            <p><?= $job['period'] ?></p>
        </div>

    </div>

</div>
