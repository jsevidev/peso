<!DOCTYPE html>
<html lang="en">
    <?php
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }
        include '../config.php';
        include '../header/header.php';
    ?>

<head>
    <meta charset="UTF-8">
    <title>Job Listing</title>
    <link rel="stylesheet" href="joblisting.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href='https://cdn.boxicons.com/3.0.3/fonts/basic/boxicons.min.css' rel='stylesheet'> <!--new link -->
</head>

<body>
    
    <section id="job-listing" class="job-listing-section">
    <div class="listing-container">
        <form method="GET" action="joblisting.php" class="job-filter-form">
        <aside class="filters-sidebar">
            <p class="results-count">Displaying 6 out of 969+ jobs</p>
            <h2 class="filter-title">Filter by skills:</h2>

            <div class="filter-group">
            <label for="skill-search" class="filter-subtitle">SELECT YOUR SKILLS</label>
            <div class="search-input-wrapper">
                <i class="fa-solid fa-magnifying-glass search-icon" style="color: #000000;"></i>
                <input type="text" id="skill-search" name="skills" placeholder="Search for skills" value="<?php echo htmlspecialchars($_GET['skills'] ?? ''); ?>">
            </div>
            </div>

            <hr class="filter-divider">
            <div class="filter-group">
            <h3 class="filter-subtitle">EMPLOYMENT TYPE</h3>

            <div class="checkbox-group">
                <label class="checkbox-item">
                <input type="checkbox" name="employment_type[]" value="Full Time" <?php if(isset($_GET['employment_type']) && in_array('Full Time', $_GET['employment_type'])) echo 'checked'; ?>>
                <span class="custom-checkbox"></span> FULL-TIME
                </label>

                <label class="checkbox-item">
                <input type="checkbox" name="employment_type[]" value="Part Time" <?php if(isset($_GET['employment_type']) && in_array('Part Time', $_GET['employment_type'])) echo 'checked'; ?>>
                <span class="custom-checkbox"></span> PART-TIME
                </label>

                <label class="checkbox-item">
                <input type="checkbox" name="employment_type[]" value="Gig" <?php if(isset($_GET['employment_type']) && in_array('Gig', $_GET['employment_type'])) echo 'checked'; ?>>
                <span class="custom-checkbox"></span> GIG
                </label>
            </div>
            </div>

            <button type="submit" class="search-results-btn">SEARCH RESULTS</button>
        </aside>

        <main class="job-listings">
            <div class="main-search-form">
            <input type="search" name="q" placeholder="Search Something...." class="main-search-input" value="<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>">
            <button type="submit" class="main-search-btn">Search</button>
            </div>

            <div class="job-cards-container">
      <!-- PHP job results here -->


             <?php
                // --- FETCH JOB LISTINGS DYNAMICALLY ---
                $mysqli = new mysqli("localhost", "root", "", "peso");

                if ($mysqli->connect_error) {
                    die("Connection failed: " . $mysqli->connect_error);
                }

                // --- BASE QUERY ---
                $sql = "SELECT 
                            jp.job_id,
                            jp.job_title,
                            jp.employment_type,
                            jp.posted_date,
                            jp.salary_max,
                            jp.skills,
                            jp.moderation,
                            jp.visibility,
                            jp.featured,
                            jp.caption,
                            e.company_name
                        FROM job_posting jp
                        INNER JOIN employers e ON jp.employer_id = e.employer_id
                        WHERE jp.visibility = 'Published' 
                        AND jp.moderation = 'Approved'";

                // --- Search by keyword (main search bar) ---
                if (!empty($_GET['q'])) {
                    $search = "%" . $mysqli->real_escape_string($_GET['q']) . "%";
                    $sql .= " AND (jp.job_title LIKE '$search' 
                            OR e.company_name LIKE '$search' 
                            OR jp.caption LIKE '$search')";
                }

                // --- Filter by skills ---
                if (!empty($_GET['skills'])) {
                    $skills = "%" . $mysqli->real_escape_string($_GET['skills']) . "%";
                    $sql .= " AND jp.skills LIKE '$skills'";
                }

                // --- Filter by employment type (checkboxes) ---
                if (!empty($_GET['employment_type'])) {
                    $types = array_map(function($t) use ($mysqli) {
                        return "'" . $mysqli->real_escape_string($t) . "'";
                    }, $_GET['employment_type']);
                    $sql .= " AND jp.employment_type IN (" . implode(",", $types) . ")";
                }

                // --- ORDER ---
                $sql .= " ORDER BY jp.posted_date DESC";

                // --- EXECUTE QUERY ---
                $result = $mysqli->query($sql);

                // --- DISPLAY RESULTS ---
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $job_title = htmlspecialchars($row['job_title']);
                        $company_name = htmlspecialchars($row['company_name']);
                        $employment_type = htmlspecialchars($row['employment_type']);
                        $posted_date = date("M d, Y", strtotime($row['posted_date']));
                        $salary_max = htmlspecialchars($row['salary_max']);
                        $skills = htmlspecialchars($row['skills']);
                        $caption = htmlspecialchars($row['caption']);

                        // Convert "Full Time" → "full-time"
                        $employment_class = strtolower(str_replace(' ', '-', $employment_type)); // Convert "Full Time" to "full-time" for the class
                        $employment_tag_class = ($employment_type == 'Full Time') ? 'full-time' : 'part-time'; // Assign the class dynamically

                        echo "
                        <article class='job-card' onclick='openApplyModal({$row['job_id']})'>
                            <header class='job-card-header'>
                                <h4 class='job-title'>{$job_title}</h4>
                                <span class='employment-tag {$employment_tag_class}'>{$employment_type}</span>
                            </header>
                            <p class='job-meta'> 
                                <span class='company-name'>{$company_name} • </span>
                                <i class='post-date'>Posted on {$posted_date}</i>
                            </p>
                            <p class='job-salary'>{$salary_max}</p>
                            <div class='job-details'>
                                <h5>Details</h5>
                                <p>{$caption}</p>
                            </div>
                            <div class='job-skills'>
                                <h5>Skills</h5>
                                <div class='skill-tags'>
                                    <span class='skill-tag'>{$skills}</span>
                                </div>
                            </div>
                        </article>
                        ";
                        
                    }
                } else {
                    echo "<p>No job listings found.</p>";
                }

                // Fetch logged-in applicant details
                        $applicant_data = null;
                        if (isset($_SESSION['applicant_id'])) {
                            $appl_id = $_SESSION['applicant_id'];

                            $sql = "SELECT appl_profile_id, full_name, email, contact_no, resume FROM applicant_profile WHERE appl_id = ?";
                            $stmt = $mysqli->prepare($sql);
                            $stmt->bind_param("i", $appl_id);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $applicant_data = $result->fetch_assoc();
                            }
                        }


                // --- CLOSE CONNECTION ---
                $mysqli->close();
                ?>
        </div>
        </main>
        </form>
    </div>
    </section>

    <!-- MODAL FOR APPLYING FOR A JOB -->
    <div id="apply-modal" class="joblisting-apply-modal" aria-hidden="true">
        <div class="apply-modal-container" role="dialog" aria-modal="true">
            <header class="modal-header">
                <h1 class="header-title">Apply Now</h1>
                <button type="button" class="close-button" onclick="closeModal()">CLOSE</button>
            </header>
            <div class="modal-body">
                <section class="job-details">
                    <h2 class="job-title" id="modal-job-title">Job Title</h2>
                    <p class="job-meta" id="modal-job-meta">
                        <span id="modal-company-name"></span>
                        <em class="posted-date" id="modal-posted-date"></em>
                    </p>
                    <div class="salary-info">
                        <p class="salary-range" id="modal-salary-range"></p>
                        <span class="job-type-tag" id="modal-job-type"></span>
                    </div>
                    <div class="about-section">
                        <h3 class="section-heading">About Us</h3>
                        <p class="description" id="modal-description"></p>
                    </div>
                    <div class="skills-section">
                        <h3 class="section-heading">Skills</h3>
                        <div class="skills-tags" id="modal-skills"></div>
                    </div>
                </section>
                <aside class="application-form-section">
                    <form class="application-form" id="application-form" method="POST" action="modal/submit_application.php" enctype="multipart/form-data">
                        <input type="hidden" name="job_id" id="application-job-id">
                        <input type="hidden" name="appl_profile_id" id="application-appl-profile-id">
                        <div class="form-group">
                            <label for="full-name">Full Name</label>
                            <input type="text" id="full-name" name="full-name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-number">Contact Number</label>
                            <input type="tel" id="contact-number" name="contact-number" required>
                        </div>
                        <div class="form-group">
                            <label for="resume">Resume</label>
                            <div class="file-input-wrapper">
                                <input type="text" id="resume-display" name="resume-display" readonly>
                                <button type="button" class="choose-file-btn" onclick="document.getElementById('resume-file').click()">Choose File</button>
                                <input type="file" id="resume-file" name="resume" class="visually-hidden" aria-label="Upload Resume" accept=".pdf,.doc,.docx" onchange="document.getElementById('resume-display').value = this.files[0]?.name || ''">
                            </div>
                            <input type="hidden" id="existing-resume" name="existing-resume">
                        </div>
                        <div class="form-group">
                            <label for="cover-letter">Cover Letter</label>
                            <textarea id="cover-letter" name="cover-letter" rows="4"></textarea>
                        </div>
                        <div class="form-group agreement-section">
                            <div class="agreement-wrapper">
                                <input type="checkbox" id="agreement" name="agreement" required>
                                <label for="agreement" class="agreement-label">
                                    I agree to share my application with the employer.
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="submit-button">SUBMIT APPLICATION</button>
                    </form>
                </aside>
            </div>
        </div>
    </div>

    <!-- Consent Popup -->
    <div id="consent-popup" class="consent-popup" style="display: none;">
        <div class="consent-popup-content">
            <div class="consent-icon">
                <i class="fa-solid fa-exclamation-circle"></i>
            </div>
            <h3>Consent Required</h3>
            <p>Please agree to share your application with the employer before submitting.</p>
            <button onclick="closeConsentPopup()" class="consent-ok-btn">OK</button>
        </div>
    </div>

    <script>
        // Pass applicant data to JavaScript
        const applicantData = <?php echo json_encode($applicant_data); ?>;
    </script>
    <script src="modal/modal.js"></script>

</body>
</html>