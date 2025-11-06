<?php

?>
<link rel="stylesheet" href="add_application.css">

<section id="application-form">
  <div class="application-card">
    <header class="card-header">
      <h1 class="card-title">Add Application</h1>
      <button class="close-btn">CLOSE</button>
    </header>
    <form class="application-form-body">
      <div class="form-group full-span">
        <label for="applicant">Applicant</label>
        <input type="text" id="applicant" name="applicant">
      </div>
      <div class="form-group full-span">
        <label for="job-title">Job title</label>
        <input type="text" id="job-title" name="job-title">
      </div>
      <div class="form-group">
        <label for="employer">Employer</label>
        <input type="text" id="employer" name="employer">
      </div>
      <div class="form-group">
        <label for="status">Status</label>
        <div class="input-wrapper">
          <select id="status" name="status">
            <option value="" disabled selected></option>
            <option value="applied">Applied</option>
            <option value="interviewing">Interviewing</option>
            <option value="offered">Offered</option>
            <option value="rejected">Rejected</option>
          </select>
          <span class="select-arrow" aria-hidden="true"></span>
        </div>
      </div>
      <div class="form-group">
        <label for="date">Date</label>
        <div class="input-wrapper">
          <input type="text" id="date" name="date">
          <img class="input-icon" src="${ASSET_PATH}/177_1392.svg" alt="Calendar Icon">
        </div>
      </div>
      <div class="form-footer full-span">
        <button type="submit" class="save-btn">SAVE</button>
      </div>
    </form>
  </div>
</section>