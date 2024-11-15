<?php
include 'db_connect.php';
session_start();

$company_name = $_POST['company_name'];
$password = $_POST['password'];

$sql = "SELECT * FROM companies WHERE company_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $company_name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        if ($row['approved'] == 1) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['company_name'] = $row['company_name'];
            $_SESSION['role'] = 'company';
            header("Location: company_dashboard.php");
            exit();
        } else {
            echo "Waiting for approval from admin.";
        }
    } else {
        echo "Invalid password!";
    }
} else {
    echo "No company found with that name!";
}

$stmt->close();
$conn->close();
?>
<!-- 1 -->