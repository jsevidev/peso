<?php

?>
<link rel="stylesheet" href="add_job.css">

<section id="add-job" class="add-job-section">
  <div class="modal-container">
    <header class="modal-header">
      <h1 class="modal-title">Add Job</h1>
      <button class="close-btn">CLOSE</button>
    </header>
    <main class="modal-content">
      <form class="job-form">
        <div class="form-grid">
          <div class="form-group">
            <label for="job-title">Job Title</label>
            <input type="text" id="job-title" class="form-input">
          </div>
          <div class="form-group">
            <label for="employer">Employer</label>
            <input type="text" id="employer" class="form-input">
          </div>
          <div class="form-group">
            <label for="employment-type">Employment Type</label>
            <div class="select-wrapper">
              <select id="employment-type" class="form-input"></select>
            </div>
          </div>
          <div class="form-group">
            <label for="posted-date">Posted Date</label>
            <div class="input-wrapper">
              <input type="text" id="posted-date" class="form-input" placeholder="">
              <img src="${ASSET_PATH}/177_1434.svg" alt="Calendar Icon" class="input-icon">
            </div>
          </div>
          <div class="form-group">
            <label for="salary-type">Salary Type (₱)</label>
            <input type="text" id="salary-type" class="form-input">
          </div>
          <div class="form-group">
            <label for="salary-max">Salary Max (₱)</label>
            <input type="text" id="salary-max" class="form-input">
          </div>
          <div class="form-group">
            <label for="period">Period</label>
            <div class="select-wrapper">
              <select id="period" class="form-input"></select>
            </div>
          </div>
          <div class="form-group full-width">
            <label for="skills">Skills (comma separated)</label>
            <input type="text" id="skills" class="form-input">
          </div>
          <div class="form-group full-width">
            <div class="moderation-fields">
              <div class="form-group">
                <label for="moderation">Moderation</label>
                <div class="select-wrapper">
                  <select id="moderation" class="form-input"></select>
                </div>
              </div>
              <div class="form-group">
                <label for="visibility">Visibility</label>
                <div class="select-wrapper">
                  <select id="visibility" class="form-input"></select>
                </div>
              </div>
              <div class="form-group">
                <label for="featured">Featured</label>
                <div class="select-wrapper">
                  <select id="featured" class="form-input"></select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-actions">
          <button type="submit" class="save-btn">SAVE</button>
        </div>
      </form>
    </main>
  </div>
</section>