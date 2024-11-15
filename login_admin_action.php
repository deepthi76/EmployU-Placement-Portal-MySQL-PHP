<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if ($username === 'admin1' && $password === 'admin1p') {
    $_SESSION['role'] = 'admin';
    $_SESSION['username'] = 'admin1';
    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "Invalid admin credentials!";
}
?>
<!-- 1 -->