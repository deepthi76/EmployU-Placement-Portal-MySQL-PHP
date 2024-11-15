<?php
include 'db_connect.php';
session_start();

if ($_SESSION['role'] != 'company') {
    header("Location: login_company.php");
    exit();
}

$company_id = $_SESSION['user_id'];
$job_role = $_POST['job_role'];
$job_description = $_POST['job_description'];
$gpa_requirement = $_POST['gpa_requirement'];
$job_location = $_POST['job_location'];
$job_salary = $_POST['job_salary'];

$sql = "INSERT INTO jobs (company_id, job_role, job_description, gpa_requirement, job_location, job_salary) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issdsi", $company_id, $job_role, $job_description, $gpa_requirement, $job_location, $job_salary);

if ($stmt->execute()) {
    echo "Job posted successfully. <a href='company_dashboard.php'>Go back to Dashboard</a>";
} else {
    echo "Error posting job: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
<!-- 1 -->