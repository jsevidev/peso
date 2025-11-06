<!DOCTYPE html>
<html lang="en">
    <?php
        include '../config.php';
        include '../header/header.php';
        session_start();
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
                        $employment_class = strtolower(str_replace(' ', '-', $employment_type));

                        echo "
                        <article class='job-card'>
                            <header class='job-card-header'>
                                <h4 class='job-title'>{$job_title}</h4>
                                <span class='employment-tag {$employment_class}'>{$employment_type}</span>
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

                // --- CLOSE CONNECTION ---
                $mysqli->close();
                ?>



            <!-- <article class="job-card">
            //     <header class="job-card-header">
            //         <h4 class="job-title">Service Crew for Jollibee</h4>
            //         <span class="employment-tag full-time">Full Time</span>
            //     </header>
            //         <p class="job-meta">
            //             <span class="company-name">Jollibee Ozamiz • </span>
            //             <i class="post-date">Posted on Oct 01, 2025</i>
            //         </p>

            //         <p class="job-salary">₱12,000 - ₱15,000 / month</p>

            // <div class="job-details">
            //     <h5>About Us</h5>
            //         <p>Jollibee Ozamiz is looking for energetic and hardworking Service Crew Members to join our team. Your role is to provide excellent customer service, assist in food preparation, and maintain cleanliness in the store.</p>
            // </div>

            // <div class="job-skills">
            //     <h5>Skills</h5>
            //         <div class="skill-tags">
            //             <span class="skill-tag">Service Crew</span>
            //             <span class="skill-tag">Cashier</span>
            //         </div>
            // </div>
            // </article> -->

        </div>
        </main>
    </div>
    </section>
</body>
</html>