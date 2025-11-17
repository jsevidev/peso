<!doctype html>
<html lang="en"> 
    <?php
        include '../config.php';
        include '../header/header.php';
         if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
    ?>

<head>
    <meta charset="UTF-8">
    <title>Account verification</title>
    <link rel="stylesheet" href="verification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> 
    <link href='https://cdn.boxicons.com/3.0.3/fonts/basic/boxicons.min.css' rel='stylesheet'> 
</head>

<body>
    

    <main id="verification" class="verification-main">
    <div class="verification-container">
        <h1 class="verification-title">Verify your Identity in 2 Easy Steps</h1>
        <p class="verification-subtitle">Verifying who you say you are is very important for employers. It establishes<br>trust and gives more employers confidence in hiring Filipino workers.</p>
        <div class="verification-cards">
        
        <a href="../upload/upload_id.php" class="id-card-btn">
            <div class="card">
                <h2 class="card-title">Government ID <br>Verification <br><strong>(Optional)</strong></h2>
                <p class="card-description">Upload your ID<br> number and we'll send <br>you a verification code</p>
            </div>
        </a>


        <button class="id-card-btn">
        <div class="card">
            <h2 class="card-title">Mobile Number <br>Verification <br><strong>(Optional)</strong></h2>
            <p class="card-description">Enter your mobile<br> number and we'll send <br>you a verification code</p>
        </div>
        </button>
        </div>
        <a href="appl_profile.php" class="back-to-profile-btn">Back to Profile</a>
    </div>
    </main>
</body>
</html>


