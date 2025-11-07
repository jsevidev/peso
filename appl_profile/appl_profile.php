<!DOCTYPE html>
<html lang="en">
    <?php
        include '../config.php';
        include '../header/header.php';
        session_start();

    $appl_id = $_SESSION['applicant_id'] ?? null;
    $row = [];

if ($appl_id) {
    $stmt = $mysqli->prepare("SELECT * FROM applicant_profile WHERE appl_id = ?");
    $stmt->bind_param("i", $appl_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appl_id = $_SESSION['applicant_id'] ?? null;  // assuming this is set on login

    $full_name = $_POST['full-name'] ?? '';
    $date_of_birth = $_POST['posted-date'] ?? null;
    $gender = $_POST['gender'] ?? '';
    $contact_no = $_POST['contact-no'] ?? '';
    $email = $_POST['email'] ?? '';
    $current_address = $_POST['current-address'] ?? '';
    $education = $_POST['education-basic'] ?? '';
    $skills = $_POST['skills'] ?? '';
    $work_experience = $_POST['work-experience'] ?? '';

    if ($appl_id) {
        $stmt = $mysqli->prepare("
            UPDATE applicant_profile
            SET 
                full_name = ?, 
                date_of_birth = ?, 
                gender = ?, 
                contact_no = ?, 
                email = ?, 
                current_address = ?, 
                education = ?, 
                skills = ?, 
                work_experience = ?
            WHERE appl_id = ?
        ");

        if (!$stmt) {
            die("Prepare failed: " . $mysqli->error);
        }

        $stmt->bind_param(
            "sssssssssi",
            $full_name,
            $date_of_birth,
            $gender,
            $contact_no,
            $email,
            $current_address,
            $education,
            $skills,
            $work_experience,
            $appl_id
        );

        if ($stmt->execute()) {
            echo "<script>console.log('✅ Profile updated successfully');</script>";
        } else {
            echo "<script>console.error('❌ Update failed: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>console.warn('⚠️ Missing applicant ID in session');</script>";
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
    <section id="profile">
    <div class="profile-banner"></div>
    <div class="container profile-body">
        <div class="profile-layout">
        <aside class="profile-sidebar">
            <!--merged image-->
            <div class="avatar-container">
                <i class="fa-regular fa-circle-user fa-2xl avatar-icon"></i>
                <img src="../white.jpg" alt="Profile avatar background" class="avatar-bg">
                
                <!-- <img src="${ASSET_PATH}/87_193.svg" alt="Profile avatar icon" class="avatar-icon"> -->
            </div>

            <nav class="sidebar-menu">
            <button class="sidebar-button edit-profile-btn">
                <i class="fa-regular fa-pen-to-square" alt=""></i> 
                <span>EDIT PROFILE</span>
            </button>
            <a href="#" class="sidebar-button"><span>VERIFICATION</span></a>
            <a href="#" class="sidebar-button"><span>REFFERAL</span></a>
            <a href="#" class="sidebar-button"><span>UPLOAD RESUME</span></a>
            </nav>
            <a href="" class="sidebar-button logout-button">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>LOG OUT</span>
            </a>
        </aside>
        <main class="profile-main-content">
            <header class="profile-header">
            <h1>Alvin Joseph A. Gumapac</h1>
            <p>Job Description 
                <i class="fa-regular fa-pen-to-square" alt="Edit Job Description"></i>
                <!-- <a href="#"><img src="${ASSET_PATH}/30_289.svg" alt="Edit Job Description">
                </a> -->
            </p>
            </header>

            <section id="basic-info" class="info-card">
            <h2 class="card-title">Basic Information 
                <a href="#">
                    <i class="fa-regular fa-pen-to-square" alt="Edit Basic Information"></i> 
                </a>
            </h2>

            <dl class="info-list">
                <div class="info-item">
                <dt>Full Name</dt>
                <dd>Alvin Joseph A. Gumapac Jr.</dd>
                </div>
                <div class="info-item">
                <dt>Date of Birth</dt>
                <dd>December 20, 2004</dd>
                </div>
                <div class="info-item">
                <dt>Gender</dt>
                <dd>Male</dd>
                </div>
                <div class="info-item">
                <dt>Contact No.</dt>
                <dd>+63 9686844967</dd>
                </div>
                <div class="info-item">
                <dt>Email</dt>
                <dd>alvin.gumapac@lsu.edu.ph</dd>
                </div>
                <div class="info-item">
                <dt>Current Address</dt>
                <dd>Bagakay, Ozamiz City, Misamis Occidental</dd>
                </div>
            </dl>
            </section>

            <section id="education" class="info-card">
            <h2 class="card-title">Education
                <i class="fa-regular fa-pen-to-square" alt="Edit Education"></i>  
                <!-- <a href="#"><img src="${ASSET_PATH}/30_280.svg" alt="Edit Education">
                </a> -->
            </h2>
            <p>Bachelor of Science in Information Technology (Ongoing, 3rd Year)<br>La Salle University – <strong>Ozamiz City</strong></p>
            </section>

            <section id="skills" class="info-card">
            <h2 class="card-title">Skills
                <i class="fa-regular fa-pen-to-square" alt="Edit Skills"></i>  
                <!-- <a href="#"><img src="${ASSET_PATH}/30_283.svg" alt="Edit Skills">
                </a> -->
            </h2>
            <div class="skills-container">
                <span class="skill-tag">Customer Service</span>
                <span class="skill-tag">Communication skills</span>
                <span class="skill-tag">Inventory and stock checking</span>
            </div>
            </section>

            <section id="work-experience" class="info-card">
            <h2 class="card-title">Work Experience
                <i class="fa-regular fa-pen-to-square" alt="Edit Basic Information"></i>  
                <!-- <a href="#"><img src="${ASSET_PATH}/30_286.svg" alt="Edit Work Experience"></a> -->
            </h2>
            <ul class="experience-list">
                <li>Service Crew – Inasal (Jan 2023 – May 2023)</li>
                <li>Service Crew – Jollibee (Jan 2023 – May 2023)</li>
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

        <form class="profile-form">
            <h2 class="section-title col-span-2">Basic Information</h2>

            <div class="form-field">
            <label for="full-name">Full Name</label>
            <input type="text" id="full-name" name="full-name">
            </div>

            <div class="form-field">
            <label for="posted-date">Birthdate</label>
                <div class="input-wrapper">
                    <input 
                        type="text" 
                        id="posted-date" 
                        name="posted-date" 
                        value="<?php echo htmlspecialchars($row['date_of_birth'] ?? '', ENT_QUOTES); ?>">
                    <i class="fa-regular fa-calendar-days" alt="Calendar icon" class="input-icon"></i>
                </div>
            </div>

            <div class="form-field">
            <label for="gender">Gender</label>
            <div class="select-wrapper">
                <select id="gender" name="gender">
                <option value=""></option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                </select>
            </div>
            </div>

            <div class="form-field">
            <label for="contact-no">Contact No.</label>
            <input type="tel" id="contact-no" name="contact-no">
            </div>

            <div class="form-field">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
            </div>

            <div class="form-field">
            <label for="education-basic">Education</label>
            <input type="text" id="education-basic" name="education-basic">
            </div>

            <div class="form-field col-span-2">
            <label for="current-address">Current Address</label>
            <input type="text" id="current-address" name="current-address">
            </div>

            <h2 class="section-title col-span-2">Education</h2>

            <div class="form-field col-span-2">
            <input type="text" id="education-main" name="education-main" aria-label="Education">
            </div>

            <div class="form-field">
            <label for="skills">Skills</label>
            <input type="text" id="skills" name="skills">
            </div>

            <div class="form-field">
            <label for="work-experience">Work Experience</label>
            <div class="select-wrapper">
                <select id="work-experience" name="work-experience">
                <option value=""></option>
                <option value="entry">Entry Level</option>
                <option value="mid">Mid Level</option>
                <option value="senior">Senior Level</option>
                </select>
            </div>
            </div>
        </form>
        </main>
        <footer class="modal-footer">
        <button type="submit" form="profile-form" class="save-btn">SAVE</button>
        </footer>
    </div>
    </section>   

    <script src="edit_profile.js"></script>
</body>

</html>