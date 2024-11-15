<?php
include 'db_connect.php';
session_start();

if ($_SESSION['role'] != 'student') {
    header("Location: login_student.php");
    exit();
}

$student_id = $_SESSION['user_id'];

// Fetch current student profile details
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        h2 {
            color: #1D3A89;
            margin-bottom: 20px;
        }

        .profile-container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #1D3A89;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #D7A9A4;
            border-radius: 8px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #1D3A89;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #D7A9A4;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>Edit Profile</h2>
        <form action="update_profile_action.php" method="POST">
            <label for="full_name">Full Name:</label>
            <input type="text" name="full_name" value="<?php echo htmlspecialchars($student['full_name']); ?>" required>

            <label for="phone">Phone:</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($student['phone']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>

            <label for="gender">Gender:</label>
            <select name="gender" required>
                <option value="male" <?php if ($student['gender'] == 'male') echo 'selected'; ?>>Male</option>
                <option value="female" <?php if ($student['gender'] == 'female') echo 'selected'; ?>>Female</option>
            </select>

            <label for="gpa">GPA:</label>
            <input type="number" step="0.1" name="gpa" value="<?php echo htmlspecialchars($student['gpa']); ?>" required>

            <label for="degree">Degree:</label>
            <select name="degree" required>
                <option value="B.Tech" <?php if ($student['degree'] == 'B.Tech') echo 'selected'; ?>>B.Tech</option>
                <option value="M.Tech" <?php if ($student['degree'] == 'M.Tech') echo 'selected'; ?>>M.Tech</option>
                <option value="Dual Degree" <?php if ($student['degree'] == 'Dual Degree') echo 'selected'; ?>>Dual Degree</option>
            </select>

            <label for="specialization">Specialization:</label>
            <select name="specialization" required>
                <option value="CSE" <?php if ($student['specialization'] == 'CSE') echo 'selected'; ?>>CSE</option>
                <option value="ECE" <?php if ($student['specialization'] == 'ECE') echo 'selected'; ?>>ECE</option>
                <option value="EEE" <?php if ($student['specialization'] == 'EEE') echo 'selected'; ?>>EEE</option>
            </select>

            <label for="backlogs">Backlogs:</label>
            <select name="backlogs" required>
                <option value="yes" <?php if ($student['backlogs'] == 'yes') echo 'selected'; ?>>Yes</option>
                <option value="no" <?php if ($student['backlogs'] == 'no') echo 'selected'; ?>>No</option>
            </select>

            <label for="resume_link">Resume Link:</label>
            <input type="text" name="resume_link" value="<?php echo htmlspecialchars($student['resume_link']); ?>" required>

            <input type="submit" value="Update Profile">
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
