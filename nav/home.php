<!doctype html>
<html lang="en">

    <?php
    include '../config.php';
    include '../header/header.php';
    session_start();
    ?>

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> 
    <link href='https://cdn.boxicons.com/3.0.3/fonts/basic/boxicons.min.css' rel='stylesheet'> 

</head>

<body>
    <section id="hero-section" class="hero-section">
    <div class="hero-background">
        <img src="../background.png" alt="Ozamiz City Hall background">
    </div>
    <div class="container hero-content">
        <h2 class="hero-title">Find Jobs in <br>Ozamiz City</h2>
        <p class="hero-subtitle">Browse job opportunities in various industries.</p>
        <form class="search-form">
        <div class="search-wrapper">
            <input type="text" placeholder="Search Something...." class="search-input">
            <button type="submit" class="search-button">Search</button>
        </div>
        </form>
    </div>
    </section>

    <section id="featured-jobs" class="featured-jobs-section">
    <div class="container">
        <h2 class="section-title">Featured Jobs</h2>
        <div class="jobs-grid">
        <div class="job-card">
            <img src="../711.png" alt="7-Eleven logo">
        </div>
        <div class="job-card">
            <img src="../jobi.png" alt="Jollibee logo">
        </div>
        <div class="job-card">
            <img src="../mcdo.png" alt="McDonald's logo" class="rotated-img">
        </div>
        <div class="job-card">
            <img src="../diy.png" alt="MR.D.I.Y. logo">
        </div>
        </div>
    </div>
    </section>

    <section id="how-it-works" class="how-it-works-section">
    <div class="container">
        <p class="pre-title">How it Works</p>
        <h2 class="section-title">Easy Steps To Get Your Dream Job <br>With Our Platform</h2>
        <div class="steps-grid">
            <div class="step-card">
                <i class="fa-solid fa-user fa-xl" alt="Create account icon"></i>
                <h3 class="step-title">Create Account</h3>
                <p class="step-description">Sign up for free and set up your profile in just a few minutes.</p>
            </div>

            <div class="step-card">
                <i class="fa-solid fa-magnifying-glass fa-xl" alt="Search job icon" class="step-icon"></i>
                <h3 class="step-title">Search Job</h3>
                <p class="step-description">Add your CV and showcase your skills so employers can find you.</p>
            </div>

            <div class="step-card">
                <i class="fa-solid fa-arrow-up-from-bracket fa-xl" alt="Upload resume icon" class="step-icon"></i>
                <h3 class="step-title">Upload Your Resume</h3>
                <p class="step-description">Browse thousands of opportunities by category, location, or company.</p>
            </div>

            <div class="step-card">
                <i class="fa-solid fa-person fa-xl" alt="Apply for job icon" class="step-icon"></i>
                <h3 class="step-title">Apply Your Dream Job</h3>
                <p class="step-description">Submit your application directly and track your progress online.</p>
            </div>
        </div>
    </div>
    </section>
</body>

</html>


