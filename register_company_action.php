<?php
include 'db_connect.php';

$company_name = $_POST['company_name'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO companies (company_name, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $company_name, $password);

if ($stmt->execute()) {
    echo "Registration successful! Waiting for admin approval.";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
<!-- 1 -->