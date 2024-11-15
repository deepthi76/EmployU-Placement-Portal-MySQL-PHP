<?php
include 'db_connect.php';
session_start();

if ($_SESSION['role'] != 'admin') {
    echo "Access denied.";
    exit();
}

$job_role = $_POST['job_role'];

// Prepare the SQL query to call the function and get the application count
$sql = "SELECT total_applications_for_role(?) AS application_count";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $job_role);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $application_count = $row['application_count'];
    echo "<strong>Total Applications for '$job_role':</strong> $application_count";
} else {
    echo "<strong>No applications found for the job role '$job_role'.</strong>";
}

$stmt->close();
$conn->close();
?>