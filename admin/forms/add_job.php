<?php
include '../config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// DB CONNECTION
$mysqli = new mysqli("localhost", "root", "", "peso");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// FETCH EMPLOYERS FOR DROPDOWN
$employers = [];
$getEmp = $mysqli->query("SELECT employer_id, company_name FROM employers");
while ($row = $getEmp->fetch_assoc()) {
    $employers[] = $row;
}

// HANDLE ADD JOB FORM SUBMISSION
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $job_title      = $_POST['job_title'] ?? '';
    $employer_id    = $_POST['employer_id'] ?? '';
    $employment_type = $_POST['employment_type'] ?? '';
    $posted_date    = $_POST['posted_date'] ?? '';
    $salary_min     = $_POST['salary_min'] ?? '';
    $salary_max     = $_POST['salary_max'] ?? '';
    $skills         = $_POST['skills'] ?? '';
    $caption        = $_POST['caption'] ?? '';
    $moderation     = $_POST['moderation'] ?? 'Approved';
    $visibility     = $_POST['visibility'] ?? 'Published';

    // default period (based on your DB structure)
    $period = '2025-2026';

    $stmt = $mysqli->prepare("
        INSERT INTO job_posting 
        (employer_id, job_title, employment_type, posted_date, salary_min, salary_max, skills, caption, moderation, visibility, period)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if ($stmt) {
        $stmt->bind_param(
            "issssssssss",
            $employer_id,
            $job_title,
            $employment_type,
            $posted_date,
            $salary_min,
            $salary_max,
            $skills,
            $caption,
            $moderation,
            $visibility,
            $period
        );

        if ($stmt->execute()) {
            header("Location: ../job_posting.php?added=1");
            exit();
        } else {
            echo "❌ SQL Execution Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "❌ SQL Prepare Error: " . $mysqli->error;
    }
}
?>

<link rel="stylesheet" href="add_job.css">

<section id="addJobModal" class="modal-overlay">
  <div class="modal-container">
    <header class="modal-header">
      <h2 class="modal-title">Add Job</h2>
      <button type="button" class="close-btn" id="closeModal">CLOSE</button>
    </header>

    <main class="modal-content">
      <!-- <form method="POST" action="" class="job-form"> -->
      <form method="POST" action="forms/add_job_process.php">
        <div class="form-grid">
          <div class="form-group">
            <label for="job_title">Job Title</label>
            <input type="text" name="job_title" id="job_title" class="form-input" required>
          </div>

          <div class="form-group">
            <label for="employer_id">Company</label>
            <select name="employer_id" id="employer_id" class="form-input" required>
              <option value="">Select Company</option>
              <?php foreach ($employers as $emp): ?>
                <option value="<?= $emp['employer_id']; ?>"><?= $emp['company_name']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="employment_type">Employment Type</label>
            <select name="employment_type" id="employment_type" class="form-input">
              <option>Full Time</option>
              <option>Part Time</option>
              <option>Gig</option>
            </select>
          </div>

          <div class="form-group">
            <label for="posted_date">Posted Date</label>
            <input type="date" name="posted_date" id="posted_date" class="form-input" required>
          </div>

          <div class="form-group">
            <label for="salary_min">Salary Min (₱)</label>
            <input type="text" name="salary_min" id="salary_min" class="form-input" placeholder="Minimum Salary">
          </div>

          <div class="form-group">
            <label for="salary_max">Salary Max (₱)</label>
            <input type="text" name="salary_max" id="salary_max" class="form-input" placeholder="Maximum Salary / month">
          </div>

          <div class="form-group full-width">
            <label for="skills">Skills (comma separated)</label>
            <input type="text" name="skills" id="skills" class="form-input">
          </div>

          <div class="form-group full-width">
            <label for="caption">Caption</label>
            <input type="text" name="caption" id="caption" class="form-input">
          </div>

          <div class="form-group">
            <label for="moderation">Moderation</label>
            <select name="moderation" id="moderation" class="form-input">
              <option>Approved</option>
              <option>Unapproved</option>
            </select>
          </div>

          <div class="form-group">
            <label for="visibility">Visibility</label>
            <select name="visibility" id="visibility" class="form-input">
              <option>Published</option>
              <option>Unpublished</option>
            </select>
          </div>
        </div>

        <div class="form-actions">
          <button type="submit" class="save-btn">SAVE</button>
        </div>
      </form>
    </main>
  </div>
</section>


