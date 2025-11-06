<!doctype html>
<html lang="en">
<?php
    include '../config.php';
    include '../header/header.php';
    session_start();
?>

<head>
    <meta charset="UTF-8">
    <title>About Us</title>
        <link rel="stylesheet" href="aboutus.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <script src="script.js"></script>  
</head>

<body>
    <section id="hero" class="hero-section">
    <div class="hero-background">
        <img src="../background.png" alt="Ozamiz City Hall background">
    </div>  
    <div class="hero-content">
        <h1 class="hero-title">About us</h1>
        <p class="hero-subtitle">PESO Ozamiz City – Misamis Occidental</p>
    </div>
    </section>

    <section id="intro" class="intro-section">
    <div class="container intro-container">
        <p>The Public Employment Service Office (PESO) of Ozamiz City serves as a vital partner of the Department of Labor and Employment (DOLE) in connecting jobseekers with employers. Through the PESO Employment Information System (PEIS), we provide a reliable database that matches local talent with available opportunities.</p>
        <p>Our office plays a key role in the National Skills Registration Program (NSRP), a nationwide initiative aimed at maintaining a continuous record of Filipino workers’ skills and qualifications. By keeping this registry updated, PESO ensures that both applicants and employers benefit from a well-organized, transparent, and accessible employment system.</p>
    </div>
    </section>

    <section id="what-we-do" class="what-we-do-section">
    <div class="container what-we-do-container">
        <div class="what-we-do-text">
        <h2 class="section-title">What We Do</h2>
        <ul>
            <li>Maintain and update the PEIS database containing profiles of jobseekers and employers.</li>
            <li>Provide information on skills, qualifications, and local job vacancies.</li>
            <li>Assist residents of Ozamiz City and Misamis Occidental in finding suitable employment opportunities.</li>
            <li>Support DOLE programs that enhance employment facilitation and labor market efficiency.</li>
        </ul>
        </div>
        <div class="what-we-do-image">
        <img src="${ASSET_PATH}/59d35d1ee2979b641a477d343d465b1dc66bf13e.png" alt="A classroom training session">
        </div>
    </div>
    </section>

    <section id="commitment" class="commitment-section">
    <div class="container commitment-container">
        <h2 class="section-title">Our Commitment</h2>
        <p class="commitment-intro">At PESO Ozamiz City, we are committed to:</p>
        <ul>
        <li>Helping every jobseeker present their skills to potential employers.</li>
        <li>Supporting businesses in finding the right people for their workforce.</li>
        <li>Promoting local economic growth by bridging opportunities between workers and employers.</li>
        </ul>
    </div>
    </section>

    <section id="partnership" class="partnership-section">
    <div class="container partnership-container">
        <h2 class="section-title">In Partnership with DOLE – Bureau of Local Employment</h2>
        <p class="partnership-intro">The PEIS Web Portal is maintained by the Bureau of Local Employment (BLE) under DOLE. Guided by its mission to improve labor and employment conditions in the country, BLE works toward:</p>
        <ul>
        <li>Facilitating local employment through PESOs and online platforms like PhilJobNet.</li>
        <li>Delivering fast, effective, and reliable employment services.</li>
        <li>Providing timely labor market information for policy makers and planners.</li>
        </ul>
        <p class="partnership-outro">Together with DOLE and BLE, PESO Ozamiz City envisions becoming a trusted center of employment services, ensuring that local workers and employers can connect with confidence and ease.</p>
    </div>
    </section>
</body>

</html>


