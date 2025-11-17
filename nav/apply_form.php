<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../config.php';

// Fetch job details based on job_id from the URL
if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];

    // Query to fetch job details
    $mysqli = new mysqli("localhost", "root", "", "peso");
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $sql = "SELECT * FROM job_posting WHERE job_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $job = $result->fetch_assoc();
        // Extract job details
        $job_title = htmlspecialchars($job['job_title']);
        $company_name = htmlspecialchars($job['company_name']);
        $salary_range = htmlspecialchars($job['salary_min']) . " - " . htmlspecialchars($job['salary_max']);
        $job_description = htmlspecialchars($job['caption']);
        $skills = htmlspecialchars($job['skills']);
        $employment_type = htmlspecialchars($job['employment_type']);
        $posted_date = date('M d, Y', strtotime($job['posted_date']));
    } else {
        echo "Job not found.";
    }
    $mysqli->close();
}
?>


<head>
    <meta charset="UTF-8">
    <title>Apply Now</title>
    <link rel="stylesheet" href="apply_form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> 
    <link href='https://cdn.boxicons.com/3.0.3/fonts/basic/boxicons.min.css' rel='stylesheet'> 

</head>

<body>
    <main class="apply-modal-container">
    <header class="modal-header">
        <h1 class="header-title">Apply Now</h1>
        <button class="close-button">CLOSE</button>
    </header>
    <div class="modal-body">
        <section class="job-details">
        <h2 class="job-title">Sales Clerk for 7/11</h2>
        <p class="job-meta">
            <span>7-Eleven Ozamiz • </span>
            <em class="posted-date">Posted on Oct 01, 2025</em>
        </p>
        <div class="salary-info">
            <p class="salary-range">₱11,000 - ₱13,000 / month</p>
            <span class="job-type-tag">Part Time</span>
        </div>
        <div class="about-section">
            <h3 class="section-heading">About Us</h3>
            <p class="description">Jollibee Ozamiz is looking for energetic and hardworking Service Crew Members to join our team. Your role is to provide excellent customer service, assist in food preparation, and maintain cleanliness in the store.</p>
        </div>
        <div class="skills-section">
            <h3 class="section-heading">Skills</h3>
            <div class="skills-tags">
            <span class="skill-tag">Sales Clerk</span>
            <span class="skill-tag">Merchandiser</span>
            </div>
        </div>
        </section>
        <aside class="application-form-section">
        <form class="application-form">
            <div class="form-group">
            <label for="full-name">Full Name</label>
            <input type="text" id="full-name" name="full-name">
            </div>
            <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
            </div>
            <div class="form-group">
            <label for="contact-number">Contact Number</label>
            <input type="tel" id="contact-number" name="contact-number">
            </div>
            <div class="form-group">
            <label for="resume">Resume</label>
            <div class="file-input-wrapper">
                <input type="text" id="resume" name="resume" readonly>
                <button type="button" class="choose-file-btn">Choose File</button>
                <input type="file" class="visually-hidden" aria-label="Upload Resume">
            </div>
            </div>
            <div class="form-group">
            <label for="cover-letter">Cover Letter</label>
            <textarea id="cover-letter" name="cover-letter" rows="4"></textarea>
            </div>
            
            <div class="form-group checkbox-group">
                <input type="checkbox" id="agreement" name="agreement" required>
                <label for="agreement" class="agreement-label">
                    I agree to share my application with the employer.
                </label>
            </div>
            <button type="submit" class="submit-button">SUBMIT APPLICATION</button>
        </form>
        </aside>
    </div>
    </main>
</body>
</html>


