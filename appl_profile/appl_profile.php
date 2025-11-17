<!DOCTYPE html>
<html lang="en">
    <?php
        include '../config.php';
        include '../header/header.php';
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

        // var_dump($_SESSION);
        // exit;


        $mysqli = new mysqli("localhost", "root", "", "peso");
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        $appl_id = $_SESSION['applicant_id'] ?? null;
        $profile = null;

        // === Handle form submission ===
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['full-name'])) {
            $full_name = $_POST['full-name'] ?? '';
            $date_of_birth = $_POST['birth-date'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $contact_no = $_POST['contact-no'] ?? '';
            $email = $_POST['email'] ?? '';
            $address = $_POST['current-address'] ?? '';
            $education = $_POST['education-main'] ?? '';
            $skills = $_POST['skills'] ?? '';
            $work_experience = $_POST['work-experience'] ?? '';

            // ✅ Check if applicant already has a profile
            $check = $mysqli->prepare("SELECT appl_profile_id FROM applicant_profile WHERE appl_id = ?");
            $check->bind_param("i", $appl_id);
            $check->execute();
            $exists = $check->get_result()->num_rows > 0;

            if ($exists) {
                // ✅ Update existing record
                $stmt = $mysqli->prepare("
                    UPDATE applicant_profile 
                    SET full_name=?, date_of_birth=?, gender=?, contact_no=?, email=?, 
                        current_address=?, education=?, skills=?, work_experience=? 
                    WHERE appl_id=?");
                $stmt->bind_param("sssssssssi", $full_name, $date_of_birth, $gender, $contact_no, $email, 
                                                $address, $education, $skills, $work_experience, $appl_id);
            } else {
                // ✅ Insert new record
                $stmt = $mysqli->prepare("
                    INSERT INTO applicant_profile 
                    (appl_id, full_name, date_of_birth, gender, contact_no, email, current_address, education, skills, work_experience)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isssssssss", $appl_id, $full_name, $date_of_birth, $gender, $contact_no, 
                                                    $email, $address, $education, $skills, $work_experience);
            }
                
            $stmt->execute();

            $_SESSION['applicant_name'] = $full_name; // Update session name if changed

            // ✅ Redirect to refresh and load updated data
            header("Location: appl_profile.php?updated=1");
            exit;
}

        // === Fetch latest profile on page load or after redirect ===
        if ($appl_id) {
            $stmt = $mysqli->prepare("SELECT * FROM applicant_profile WHERE appl_id = ?");
            $stmt->bind_param("i", $appl_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $profile = $result->fetch_assoc();
            }
        }

                // === Handle profile picture upload ===
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile-pic'])) {
            $uploadDir = '../upload/profile_pics/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = time() . '_' . basename($_FILES['profile-pic']['name']);
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['profile-pic']['tmp_name'], $targetPath)) {
                // $profile_pic = '/upload/profile_pics/' . $fileName;
                $profile_pic = str_replace('..', '', $targetPath);


                $stmt = $mysqli->prepare("UPDATE applicant_profile SET profile_pic = ? WHERE appl_id = ?");
                $stmt->bind_param("si", $profile_pic, $appl_id);
                $stmt->execute();
                $stmt->close();

                // ✅ Refresh to show the new photo
                header("Location: appl_profile.php?pic=1");
                exit;
            }
}


    ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="appl_profile.css">
    <link rel="stylesheet" href="form/edit_profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>

    <!-- <?php if (!empty($success_message)): ?>
    <div style="
        background-color: #d4edda;
        color: #155724;
        padding: 10px 20px;
        margin: 15px auto;
        border-radius: 8px;
        text-align: center;
        width: 80%;
        font-weight: bold;
    ">
        <?= htmlspecialchars($success_message) ?>
    </div>
    <?php endif; ?> -->

    <section id="profile">
    <div class="profile-banner"></div>
    <div class="container profile-body">
        <div class="profile-layout">
        <aside class="profile-sidebar">
            <!--merged image-->
            <div class="avatar-container">
                <!-- Profile Picture Preview -->
                <div class="avatar-wrapper">
                    <img 
                        src="<?php 
                            if (!empty($profile['profile_pic'])) {
                                // Ensure correct relative path (prepend /PESO if missing)
                                $picPath = $profile['profile_pic'];
                                if (strpos($picPath, 'PESO') === false) {
                                    $picPath = '/PESO' . $picPath; 
                                }
                                echo htmlspecialchars($picPath);
                            } else {
                                echo '../white.jpg';
                            }
                        ?>" 
                        alt="Profile Picture" 
                        class="avatar-img">
                </div>

                <!-- Change Picture Button -->
                <form id="profile-pic-form" method="POST" action="" enctype="multipart/form-data" class="avatar-form">
                    <label for="profile-pic" class="upload-btn">
                    <i class="fa-solid fa-camera"></i> Change Photo
                    </label>
                    <input type="file" id="profile-pic" name="profile-pic" accept="image/*" onchange="this.form.submit();" hidden>
                </form>
            </div>

            <nav class="sidebar-menu">
            <button class="sidebar-button edit-profile-btn">
                <i class="fa-regular fa-pen-to-square" alt=""></i> 
                <span>EDIT PROFILE</span>
            </button>
                <a href="verification.php" class="sidebar-button"><span>VERIFICATION</span></a>
                <a href="upload_resume.php" class="sidebar-button"><span>UPLOAD RESUME</span></a>
                <a href="my_applications.php" class="sidebar-button"><span>MY APPLICATIONS</span></a>
            </nav>
            <a href="../login.php" class="sidebar-button logout-button">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>LOG OUT</span>
            </a>
        </aside>
        <main class="profile-main-content">
            <header class="profile-header">
            <h1>
                <?php echo htmlspecialchars($profile['full_name'] ?? ($_SESSION['applicant_name'] ?? 'Applicant Name')); ?>
            </h1>
            <p>Job Description 
                <i class="fa-regular fa-pen-to-square" alt="Edit Job Description"></i>
                <!-- <a href="#"><img src="${ASSET_PATH}/30_289.svg" alt="Edit Job Description">
                </a> -->
            </p>
            </header>

            <section id="basic-info" class="info-card">
            <h2 class="card-title">Basic Information 
                <a href="#" class="edit-section" data-target="#basic-info">
                    <i class="fa-regular fa-pen-to-square" alt="Edit Basic Information"></i> 
                </a>
            </h2>

            <dl class="info-list">
                <div class="info-item">
                    <dt>Full Name</dt>
                        <dd><?php echo htmlspecialchars($profile['full_name'] ?? 'Applicant Name'); ?></dd>
                </div>
                <div class="info-item">
                    <dt>Date of Birth</dt>
                        <dd><?php echo htmlspecialchars($profile['date_of_birth'] ?? 'mm/dd/yyyy'); ?></dd>
                </div>
                <div class="info-item">
                    <dt>Gender</dt>
                        <dd><?php echo htmlspecialchars($profile['gender'] ?? '---'); ?></dd>
                </div>
                <div class="info-item">
                    <dt>Contact No.</dt>
                        <dd><?php echo htmlspecialchars($profile['contact_no'] ?? '----'); ?></dd>
                </div>
                <div class="info-item">
                    <dt>Email</dt>
                        <dd><?php echo htmlspecialchars($profile['email'] ?? '---'); ?></dd>
                </div>
                <div class="info-item">
                    <dt>Current Address</dt>
                        <dd><?php echo htmlspecialchars($profile['current_address'] ?? '----'); ?></dd>
                </div>
            </dl>
            </section>

            <section id="education" class="info-card">
                <h2 class="card-title">Education 
                    <a href="#" class="edit-section" data-target="#education">
                    <i class="fa-regular fa-pen-to-square" alt="Edit Education"></i> 
                    </a>
                </h2>

                <div class="education-list">
                    <?php 
                    if (!empty($profile['education'])) {
                        // Split by commas
                        $education_list = explode(',', $profile['education']);
                        foreach ($education_list as $edu) {
                            echo '<p>' . htmlspecialchars(trim($edu)) . '</p>';
                        }
                    } else {
                        echo '<p>Undergraduate/Graduate Degree<br>School Name</p>';
                    }
                    ?>
                </div>
            </section>

            <section id="skills" class="info-card">
                <h2 class="card-title">Skills 
                    <a href="#" class="edit-section" data-target="#skills">
                        <i class="fa-regular fa-pen-to-square" alt="Edit Skills"></i> 
                    </a>
                </h2>
            </section>

            <div class="skills-container">
                <?php 
                    if (!empty($profile['skills'])) {
                        $skills = explode(',', $profile['skills']);
                        foreach ($skills as $skill) {
                            echo '<span class="skill-tag">' . htmlspecialchars(trim($skill)) . '</span>';
                        }
                    } else {
                        echo '<span class="skill-tag">-Skill-</span>';
                    }
                ?>
                <!-- <span class="skill-tag">-Skill-</span> -->
                <!-- <span class="skill-tag">Communication skills</span>
                <span class="skill-tag">Inventory and stock checking</span> -->
            </div>
            <!-- </section> -->

            <section id="work-experience" class="info-card">
                <h2 class="card-title">Work Experience 
                    <a href="#" class="edit-section" data-target="#work-experience">
                        <i class="fa-regular fa-pen-to-square" alt="Edit Work Experience"></i> 
                    </a>
                </h2>
                    <ul class="experience-list">
                        <?php 
                            if (!empty($profile['work_experience'])) {
                                // Split work experience by commas
                                $experiences = explode(',', $profile['work_experience']);
                                foreach ($experiences as $exp) {
                                    // Trim spaces and display each entry on a new line
                                    echo '<li>' . htmlspecialchars(trim($exp)) . '</li>';
                                }
                            } else {
                                echo '<li>Position – Company (Duration)</li>';
                            }
                        ?>
                    </ul>
            </section>
        </main>
        </div>
    </div>
    </section>



    <!-- Edit Profile Form -->
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

    <script src="edit_profile.js"></script>
</body>

</html>