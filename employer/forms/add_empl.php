<?php

?>
<link rel="stylesheet" href="add_empl.css">

<section id="add-employer">
  <div class="add-employer-modal">
    <header class="modal-header">
      <h1 class="modal-title">Add Employer</h1>
      <button class="close-button">CLOSE</button>
    </header>
    <main class="modal-body">
      <form class="employer-form">
        <div class="form-grid">
          <div class="form-group">
            <label for="company-name">Company Name</label>
            <input type="text" id="company-name" name="company-name">
          </div>
          <div class="form-group">
            <label for="contact-person">Contact Person</label>
            <input type="text" id="contact-person" name="contact-person">
          </div>
          <div class="form-group">
            <label for="accreditation">Accreditation</label>
            <input type="text" id="accreditation" name="accreditation">
          </div>
          <div class="form-group">
            <label for="jobs-posted">Jobs Posted</label>
            <input type="text" id="jobs-posted" name="jobs-posted">
          </div>
          <div class="form-group">
            <label for="active-status">Active?</label>
            <div class="custom-select-wrapper">
              <select id="active-status" name="active-status">
                <option value=""></option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>
        </div>
      </form>
    </main>
    <footer class="modal-footer">
      <button type="submit" form="employer-form" class="save-button">SAVE</button>
    </footer>
  </div>
</section>