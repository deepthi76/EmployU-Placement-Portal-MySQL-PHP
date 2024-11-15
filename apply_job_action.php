<?php
include 'db_connect.php';
session_start();

if ($_SESSION['role'] != 'student') {
    header("Location: login_student.php");
    exit();
}

$job_id = $_POST['job_id'];
$student_id = $_SESSION['user_id'];

try {
    $sql = "INSERT INTO applications (job_id, student_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $job_id, $student_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Applied successfully!'); window.location.href = 'student_dashboard.php';</script>";
    }
} catch (mysqli_sql_exception $e) {
    // Check for specific error messages from triggers
    if (strpos($e->getMessage(), 'Student has backlogs and cannot apply to jobs.') !== false) {
        $message = "Student has backlogs and cannot apply to jobs.";
    } elseif (strpos($e->getMessage(), 'Student GPA does not meet the job requirement') !== false) {
        $message = "Student GPA does not meet the job requirement";
    } else {
        // Generic error message for other SQL errors
        $message = "Error: " . $e->getMessage();
    }
    
    // Display the error message as an alert and stay on the same page
    echo "<script>alert('$message'); window.history.back();</script>";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>