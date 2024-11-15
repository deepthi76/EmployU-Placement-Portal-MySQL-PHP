<?php
include 'db_connect.php';
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: login_admin.php");
    exit();
}

$company_id = $_POST['company_id'];

$sql = "UPDATE companies SET approved = 1 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $company_id);

if ($stmt->execute()) {
    echo "Company approved successfully. <a href='admin_dashboard.php'>Go back to Admin Dashboard</a>";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
<!-- 1 -->