<?php
include 'db_connect.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM students WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = 'student';
        header("Location: student_dashboard.php");
        exit();
    } else {
        echo "Invalid password!";
    }
} else {
    echo "No user found with that username!";
}

$stmt->close();
$conn->close();
?>
<!-- 1 -->