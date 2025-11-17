<?php
// Include your database configuration
include '../config.php';
session_start();

// ✅ Make sure database connection exists
  $mysqli = new mysqli("localhost", "root", "", "peso");
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        $mysqli->select_db("peso");

// ✅ When the user submits the upload form
if (isset($_POST['upload'])) {
    // Use your logged-in applicant ID; using 21 for testing
    $appl_id = $_SESSION['applicant_id'] ?? 21;

    // ✅ Correct folder path (based on your structure)
    $targetDir = "../upload/";

    // ✅ Create folder if it doesn't exist
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // ✅ Prepare file path
    $fileName = basename($_FILES["verification"]["name"]);
    $targetFilePath = $targetDir . uniqid("ver_") . "_" . $fileName;

    // ✅ Move uploaded file
    if (move_uploaded_file($_FILES["verification"]["tmp_name"], $targetFilePath)) {
        // ✅ Prepare SQL using your exact table/column names
        $sql = "UPDATE applicant_profile SET verification = ? WHERE appl_id = ?";
        $stmt = $mysqli->prepare($sql);

        if (!$stmt) {
            die("❌ SQL prepare failed: " . $mysqli->error);
        }

        $stmt->bind_param("si", $targetFilePath, $appl_id);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>✅ Verification image uploaded successfully!</p>";

            // ✅ Show uploaded image preview
            echo "<div style='margin-top:20px;'>
                    <h3>Preview:</h3>
                    <img src='$targetFilePath' alt='Uploaded Verification ID' 
                         style='width:300px;height:auto;border:2px solid #ccc;border-radius:8px;
                                box-shadow:0 2px 6px rgba(0,0,0,0.2);margin-top:10px;'>
                  </div>";
        } else {
            echo "<p style='color:red;'>❌ Database error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p style='color:red;'>❌ Upload failed. Check folder permissions or path.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Government ID Verification</title>
</head>
<body>
    <h2>Government ID Verification</h2>

    <form action="" method="POST" enctype="multipart/form-data">
        <label>Select your Government ID image:</label><br><br>
        <input type="file" name="verification" accept="image/*" required><br><br>
        <button type="submit" name="upload">Upload</button>
    </form>
</body>
</html>
