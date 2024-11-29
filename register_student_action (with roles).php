<?php
include 'db_connect.php';

$username = $_POST['username'];
$password_plain = $_POST['password'];
$hashed_password = password_hash($password_plain, PASSWORD_DEFAULT);
$full_name = $_POST['full_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$gpa = $_POST['gpa'];
$degree = $_POST['degree'];
$specialization = $_POST['specialization'];
$backlogs = $_POST['backlogs'];
$resume_link = $_POST['resume_link'];

// Insert the student details into the 'students' table
$sql = "INSERT INTO students (username, password, full_name, phone, email, gender, gpa, degree, specialization, backlogs, resume_link) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssdssss", $username, $hashed_password, $full_name, $phone, $email, $gender, $gpa, $degree, $specialization, $backlogs, $resume_link);

if ($stmt->execute()) {
    // Create a MySQL user for the student
    $create_user_sql = "CREATE USER '$username'@'localhost' IDENTIFIED BY '$password_plain'";
    if ($conn->query($create_user_sql) === TRUE) {
        // Grant the 'Student' role to the new MySQL user
        $grant_role_sql = "GRANT 'Student' TO '$username'@'localhost'";
        if ($conn->query($grant_role_sql) === TRUE) {
            // Set the 'Student' role as the default active role for the user
            $set_default_role_sql = "SET DEFAULT ROLE 'Student' TO '$username'@'localhost'";
            if ($conn->query($set_default_role_sql) === TRUE) {
                echo "Registration successful, user created, and role assigned! <a href='login_student.php'>Login here</a>";
            } else {
                echo "Error setting default role: " . $conn->error;
            }
        } else {
            echo "Error assigning role: " . $conn->error;
        }
    } else {
        echo "Error creating user: " . $conn->error;
    }
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
