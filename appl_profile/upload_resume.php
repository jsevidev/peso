<!doctype html>
<html lang="en">

<?php
include '../config.php';
include '../header/header.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$mysqli = new mysqli("localhost", "root", "", "peso");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$appl_id = $_SESSION['applicant_id'] ?? null;
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['resume'])) {
    $uploadDir = '../upload/resumes/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = time() . '_' . basename($_FILES['resume']['name']);
    $targetPath = $uploadDir . $fileName;
    $resumePath = '/PESO/upload/resumes/' . $fileName; // ✅ correct base path


    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowed = ['pdf', 'doc', 'docx'];

    if (in_array($fileType, $allowed)) {
        if (move_uploaded_file($_FILES['resume']['tmp_name'], $targetPath)) {
            // Save path to DB
            $stmt = $mysqli->prepare("UPDATE applicant_profile SET resume = ? WHERE appl_id = ?");
            $stmt->bind_param("si", $resumePath, $appl_id);
            $stmt->execute();
            $message = "Resume uploaded successfully!";
        } else {
            $message = "Error uploading file.";
        }
    } else {
        $message = "Invalid file type. Only PDF, DOC, and DOCX allowed.";
    }
}

// Fetch existing resume
$resume = '';
if ($appl_id) {
    $stmt = $mysqli->prepare("SELECT resume FROM applicant_profile WHERE appl_id = ?");
    $stmt->bind_param("i", $appl_id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $resume = $row['resume'];
    }
}
?>

<head>
    <meta charset="UTF-8">
    <title>Resume Upload</title>
    <link rel="stylesheet" href="upload_resume.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href='https://cdn.boxicons.com/3.0.3/fonts/basic/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <main id="resume-upload" class="page-wrapper">
        <div class="resume-upload-content">
            <div class="upload-card">
                <h1 class="upload-title">RESUME UPLOAD</h1>
                <p class="upload-subtitle">Provide your resume or CV to give employers a better idea of your qualifications.</p>

                <?php if (!empty($message)): ?>
                    <div class="upload-message"><?= htmlspecialchars($message) ?></div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="drop-zone">
                        <i class="fa-solid fa-arrow-up-from-bracket fa-2xl"></i>
                        <p class="drop-zone-text">Upload your resume here</p>
                        <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" hidden onchange="this.form.submit();">
                        <label for="resume" class="choose-file-btn">CHOOSE FILE</label>
                    </div>
                </form>

                <?php if (!empty($resume)): ?>
                    <p class="current-resume">
                        Current file: 
                        <a href="<?= htmlspecialchars($resume) ?>" target="_blank">View Resume</a>
                    </p>
                <?php endif; ?>
            </div>

            <div class="back-button-container">
                <a href="../appl_profile/appl_profile.php" class="back-to-profile-btn">Back to Profile</a>
            </div>
        </div>
    </main>
</body>

</html>
