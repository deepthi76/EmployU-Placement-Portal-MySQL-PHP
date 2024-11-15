<?php
include 'db_connect.php';
session_start();

if ($_SESSION['role'] != 'company') {
    header("Location: login_company.php");
    exit();
}

$application_id = $_POST['application_id'];
$status = $_POST['status'];

$sql = "UPDATE applications SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $application_id);

if ($stmt->execute()) {
    echo "Application status updated successfully. <a href='company_dashboard.php'>Go back to Dashboard</a>";
} else {
    echo "Error updating status: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
<!-- 1 -->