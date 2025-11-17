<?php
$mysqli = new mysqli("localhost", "root", "", "peso");
$employers = [];
$getEmp = $mysqli->query("SELECT employer_id, company_name FROM employers");
while ($row = $getEmp->fetch_assoc()) {
    $employers[] = $row;
}
?>

<link rel="stylesheet" href="add_job.css">

<section id="editJobModal" class="modal-overlay" style="display:none;">
  <div class="modal-container">

    <header class="modal-header">
      <h2 class="modal-title">Edit Job</h2>
      <button id="closeEditJob" class="close-btn">CLOSE</button>
    </header>

    <main class="modal-content">

      <form action="job_posting_actions/update_jobposting.php" method="POST" class="job-form">

        <input type="hidden" id="edit_job_id" name="job_id">

        <div class="form-grid">

          <div class="form-group">
            <label>Job Title</label>
            <input type="text" id="edit_job_title" name="job_title" class="form-input" required>
          </div>

          <div class="form-group">
            <label>Company</label>
            <select id="edit_employer_id" name="employer_id" class="form-input" required>
              <option value="">Select Company</option>
              <?php foreach ($employers as $emp): ?>
                <option value="<?= $emp['employer_id']; ?>"><?= $emp['company_name']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label>Employment Type</label>
            <select id="edit_job_type" name="employment_type" class="form-input" required>
              <option value="Full Time">Full Time</option>
              <option value="Part Time">Part Time</option>
              <option value="Gig">Gig</option>
            </select>
          </div>

          <div class="form-group">
            <label>Posted Date</label>
            <input type="date" id="edit_posted_date" name="posted_date" class="form-input" required>
          </div>

          <div class="form-group">
            <label>Salary Min (₱)</label>
            <input type="text" id="edit_salary_min" name="salary_min" class="form-input">
          </div>

          <div class="form-group">
            <label>Salary Max (₱)</label>
            <input type="text" id="edit_salary_max" name="salary_max" class="form-input">
          </div>

          <div class="form-group full-width">
            <label>Skills (comma separated)</label>
            <input type="text" id="edit_skills" name="skills" class="form-input">
          </div>

          <div class="form-group full-width">
            <label>Caption</label>
            <input type="text" id="edit_caption" name="caption" class="form-input">
          </div>

          <div class="form-group">
            <label>Moderation</label>
            <select id="edit_moderation" name="moderation" class="form-input">
              <option value="Approved">Approved</option>
              <option value="Unapproved">Unapproved</option>
            </select>
          </div>

          <div class="form-group">
            <label>Visibility</label>
            <select id="edit_visibility" name="visibility" class="form-input">
              <option value="Published">Published</option>
              <option value="Unpublished">Unpublished</option>
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
