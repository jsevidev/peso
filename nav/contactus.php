<!doctype html>
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
    <title>Contact Us</title>
        <link rel="stylesheet" href="contactus.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <script src="script.js"></script>  
</head>

<body>
    <main>
    <section id="contact-us" class="contact-section">
        <div class="container">
        <div class="section-title-wrapper">
            <hr class="title-line">
            <h2 class="section-title">CONTACT US</h2>
            <hr class="title-line">
        </div>
        <p class="section-subtitle">For more information, You may contact us with the following details:</p>
        <div class="contact-grid">
            <div class="contact-card">
            <div class="card-header">
                <!-- <img src="locationicon" alt="Location Icon" class="card-icon"> -->
                <i class="fa-solid fa-map-location-dot fa-2xl" style="color: #000000;"></i>
                <h3 class="card-title">ADDRESS</h3>
            </div>
            <p class="card-content">Don Anselmo Bernad Avenue, Ozamiz City, <br>7200 Misamis Occidental, Philippines</p>
            </div>
            <div class="contact-card">
            <div class="card-header">
                <!-- <img src="phoneicon" alt="Phone Icon" class="card-icon"> -->
                <i class="fa-solid fa-phone fa-2xl" style="color: #000000;"></i>
                <h3 class="card-title">CONTACT NUMBER</h3>
            </div>
            <p class="card-content">+63(44) 764-1268</p>
            </div>
            <div class="contact-card">
            <div class="card-header">
                <!-- <img src="emailicon" alt="Email Icon" class="card-icon"> -->
                <i class="fa-solid fa-envelope fa-2xl" style="color: #000000;"></i>
                <h3 class="card-title">EMAIL ADDRESS</h3>
            </div>
            <p class="card-content">pesoozamiz.gmail.com<br>pesocityhall@ozamiz.gov.ph</p>
            </div>
            <div class="contact-card">
            <div class="card-header">
                <!-- <img src="facebookicon" alt="Facebook Icon" class="card-icon"> -->
                <i class="fa-brands fa-facebook fa-2xl" style="color: #000000;"></i>
                <h3 class="card-title">FACEBOOK PAGE</h3>
            </div>
            <p class="card-content">@pesoozamiz</p>
            </div>
        </div>
        </div>
    </section>
    </main>

</body>

</html>


