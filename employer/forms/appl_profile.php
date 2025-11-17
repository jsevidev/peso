<?php

?>
<!-- Remove the <head> and <body> tags since this is included in another page -->
<section id="applicant-profile">
    <div class="applicant-profile-card">
        <header class="profile-header">
            <h1 class="profile-title">Applicant Profile</h1>
            <button class="close-button">CLOSE</button>
        </header>
        <main class="profile-body">
            <form class="profile-form">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="tel" id="contact" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" id="status" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="employment-type" class="form-label">Employment Type</label>
                        <div class="select-wrapper">
                            <select id="employment-type" class="form-select">
                                <option value="" disabled selected></option>
                                <option value="full-time">Full-time</option>
                                <option value="part-time">Part-time</option>
                                <option value="contract">Contract</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="education" class="form-label">Education</label>
                        <input type="text" id="education" class="form-input">
                    </div>
                    <div class="form-group full-width">
                        <label for="skills" class="form-label">Skills (comma separated)</label>
                        <input type="text" id="skills" class="form-input">
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="save-button">SAVE</button>
                </div>
            </form>
        </main>
    </div>
</section>