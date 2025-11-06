<!DOCTYPE html>
<html lang="en">
    <?php
        include '../config.php';
        include '../header/header.php';
        session_start();
    ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="appl_profile.css">
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
            <a href="#" class="sidebar-button">
                <i class="fa-regular fa-pen-to-square" alt=""></i> 
                <span>EDIT PROFILE</span>
            </a>
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
</body>
</html>