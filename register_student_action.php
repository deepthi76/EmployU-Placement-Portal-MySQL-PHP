<?php
include 'db_connect.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$full_name = $_POST['full_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$gpa = $_POST['gpa'];
$degree = $_POST['degree'];
$specialization = $_POST['specialization'];
$backlogs = $_POST['backlogs'];
$resume_link = $_POST['resume_link'];

$sql = "INSERT INTO students (username, password, full_name, phone, email, gender, gpa, degree, specialization, backlogs, resume_link) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssdssss", $username, $password, $full_name, $phone, $email, $gender, $gpa, $degree, $specialization, $backlogs, $resume_link);

if ($stmt->execute()) {
    echo "Registration successful! <a href='login_student.php'>Login here</a>";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
<!-- 1 -->