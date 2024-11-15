<?php
include 'db_connect.php';
session_start();

if ($_SESSION['role'] != 'student') {
    header("Location: login_student.php");
    exit();
}

$student_id = $_SESSION['user_id'];
$full_name = $_POST['full_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$gpa = $_POST['gpa'];
$degree = $_POST['degree'];
$specialization = $_POST['specialization'];
$backlogs = $_POST['backlogs'];
$resume_link = $_POST['resume_link'];

// Update student profile in the database
$sql = "UPDATE students SET full_name = ?, phone = ?, email = ?, gender = ?, gpa = ?, degree = ?, specialization = ?, backlogs = ?, resume_link = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssissssi", $full_name, $phone, $email, $gender, $gpa, $degree, $specialization, $backlogs, $resume_link, $student_id);

if ($stmt->execute()) {
    echo "Profile updated successfully!";
    header("Location: student_dashboard.php");
} else {
    echo "Error updating profile: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
