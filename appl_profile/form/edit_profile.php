  <?php
        include '../../config.php';
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="edit_profile.css">
    <!-- <link rel="stylesheet" href="form/edit_profile.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<section id="edit-profile" class="edit-profile-container">
    <div class="profile-modal">
        <header class="modal-header">
        <h1 class="header-title">Edit Profile</h1>
        <button class="close-btn">CLOSE</button>
        </header>

        <main class="modal-body">
        <form id="profile-form" class="profile-form" method="POST" action="" enctype="multipart/form-data">
            <h2 class="section-title col-span-2">Basic Information</h2>

            <div class="form-field">
                <label for="full-name">Full Name</label>
                <input type="text" id="full-name" name="full-name"
                    value="<?php echo htmlspecialchars($profile['full_name'] ?? ''); ?>">
            </div>

            <div class="form-field">
                <label for="birth-date">Birthdate</label>
                <div class="input-wrapper">
                <input type="date" id="birth-date" name="birth-date"
                        value="<?php echo htmlspecialchars($profile['date_of_birth'] ?? ''); ?>">
                </div>
            </div>

            <div class="form-field">
                <label for="gender">Gender</label>
                <div class="select-wrapper">
                <select id="gender" name="gender">
                    <option value="">Select Gender</option>
                    <option value="Male" <?php if (($profile['gender'] ?? '') === 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if (($profile['gender'] ?? '') === 'Female') echo 'selected'; ?>>Female</option>
                </select>
                </div>
            </div>

            <div class="form-field">
                <label for="contact-no">Contact No.</label>
                <input type="tel" id="contact-no" name="contact-no"
                    value="<?php echo htmlspecialchars($profile['contact_no'] ?? ''); ?>">
            </div>

            <div class="form-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                    value="<?php echo htmlspecialchars($profile['email'] ?? ''); ?>">
            </div>

            <div class="form-field col-span-2">
                <label for="current-address">Current Address</label>
                <input type="text" id="current-address" name="current-address"
                    value="<?php echo htmlspecialchars($profile['current_address'] ?? ''); ?>">
            </div>

            <h2 class="section-title col-span-2">Education</h2>
            <div class="form-field col-span-2">
                <label for="education-main">Education</label>
                <input type="text" id="education-main" name="education-main"
                    value="<?php echo htmlspecialchars($profile['education'] ?? ''); ?>">
            </div>

            <div class="form-field">
                <label for="skills">Skills</label>
                <input type="text" id="skills" name="skills"
                    value="<?php echo htmlspecialchars($profile['skills'] ?? ''); ?>">
            </div>

            <div class="form-field">
                <label for="work-experience">Work Experience</label>
                <input type="text" id="work-experience" name="work-experience"
                    value="<?php echo htmlspecialchars($profile['work_experience'] ?? ''); ?>">
            </div>
        </form>
        </main>
            <footer class="modal-footer">
                <button type="submit" form="profile-form" class="save-btn">SAVE</button>
                <!-- <button type="submit" class="save-btn">SAVE</button> -->

            </footer> 
    </div>
    </section>   