<?php
include 'db_connect.php';

$company_name = $_POST['company_name'];
$plain_password = $_POST['password'];
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

// Insert the company details into the 'companies' table
$sql = "INSERT INTO companies (company_name, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $company_name, $hashed_password);

if ($stmt->execute()) {
    // Create a MySQL user for the company
    $create_user_sql = "CREATE USER '$company_name'@'localhost' IDENTIFIED BY '$plain_password'";
    if ($conn->query($create_user_sql) === TRUE) {
        // Grant the 'Company' role to the new MySQL user
        $grant_role_sql = "GRANT 'Company' TO '$company_name'@'localhost'";
        if ($conn->query($grant_role_sql) === TRUE) {
            // Set the 'Company' role as the default active role for the user
            $set_default_role_sql = "SET DEFAULT ROLE ALL TO '$company_name'@'localhost'";
            if ($conn->query($set_default_role_sql) === TRUE) {
                echo "Registration successful! Waiting for admin approval.";
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
