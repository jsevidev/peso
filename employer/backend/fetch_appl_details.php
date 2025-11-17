<?php
include '../../config.php';

$mysqli = new mysqli("localhost", "root", "", "peso");

$id = $_GET['id'];

$sql = "SELECT 
            appl_profile_id,
            profile_pic,
            full_name,
            date_of_birth,
            gender,
            contact_no,
            email,
            current_address,
            education,
            skills,
            work_experience
        FROM applicant_profile
        WHERE appl_profile_id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    echo "Applicant not found.";
    exit;
}
?>

<!-- <div style="text-align:center; margin-bottom:15px;">
    <img src="../..<?= $data['profile_pic'] ?>" 
        style="width:120px;height:120px;border-radius:50%;object-fit:cover;border:2px solid #ccc;">
</div> -->


<?php
    $relativePic = ltrim($data['profile_pic'], '/'); // remove leading slash
?>
    <img src="../../<?= $relativePic ?>" 
         style="width:120px;height:120px;border-radius:50%;object-fit:cover;border:2px solid #ccc;">



<p><strong>Full Name:</strong> <?= $data['full_name'] ?></p>
<p><strong>Date of Birth:</strong> <?= $data['date_of_birth'] ?></p>
<p><strong>Gender:</strong> <?= $data['gender'] ?></p>
<p><strong>Contact No:</strong> <?= $data['contact_no'] ?></p>
<p><strong>Email:</strong> <?= $data['email'] ?></p>
<p><strong>Address:</strong> <?= $data['current_address'] ?></p>
<p><strong>Education:</strong> <?= $data['education'] ?></p>
<p><strong>Skills:</strong> <?= $data['skills'] ?></p>
<p><strong>Work Experience:</strong> <?= $data['work_experience'] ?></p>
