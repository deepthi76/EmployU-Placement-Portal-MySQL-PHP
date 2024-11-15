<?php
include 'db_connect.php';
session_start();

if ($_SESSION['role'] != 'company') {
    header("Location: login_company.php");
    exit();
}

$company_id = $_SESSION['user_id'];

// Fetch the student's name
$sql_name = "SELECT company_name FROM companies WHERE id = ?";
$stmt_name = $conn->prepare($sql_name);
$stmt_name->bind_param("i", $company_id);
$stmt_name->execute();
$stmt_name->bind_result($company_name);
$stmt_name->fetch();
$stmt_name->close();

// Fetch previously posted jobs
$sql = "SELECT * FROM jobs WHERE company_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $company_id);
$stmt->execute();
$jobs_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Dashboard</title>
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

        .top-buttons {
            position: absolute;
            top: 10px;
            right: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .top-buttons .user-id {
            font-weight: bold;
            color: #1D3A89;
            margin-right: 20px;
        }
        .top-buttons a, .top-buttons form button {
            background-color: #1D3A89;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .top-buttons a:hover, .top-buttons form button:hover {
            background-color: #D7A9A4;
        }

        .dashboard-container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
        }

        .job-section {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 40px;
            border: 1px solid #D7A9A4;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #1D3A89;
        }

        input[type="text"],
        input[type="number"],
        textarea {
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

        .job-listing {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #D7A9A4;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .job-listing strong {
            color: #1D3A89;
        }

        hr {
            margin: 20px 0;
            border: 0;
            border-top: 1px solid #D7A9A4;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
    <div class="top-buttons">
        <span class="user-id"> <?php echo htmlspecialchars($company_name); ?></span>
        
        <a href="index.php">Log Out</a>
        
    </div>
        <h2>Company Dashboard</h2>

        <div class="job-section">
            <h3>Post a New Job</h3>
            <form action="post_job_action.php" method="POST">
                <label for="job_role">Job Role:</label>
                <input type="text" name="job_role" required>

                <label for="job_description">Job Description:</label>
                <textarea name="job_description" required></textarea>

                <label for="gpa_requirement">GPA Requirement:</label>
                <input type="number" name="gpa_requirement" min="0" max="10" step="0.1" required>

                <label for="job_location">Job Location:</label>
                <input type="text" name="job_location" required>

                <label for="job_salary">Job Salary:</label>
                <input type="number" name="job_salary" required>

                <input type="submit" value="Post Job">
            </form>
        </div>

        <div class="job-section">
            <h3>Posted Jobs</h3>
            <?php while ($job = $jobs_result->fetch_assoc()) { ?>
                <div class="job-listing">
                    <strong>Job ID:</strong> <?php echo $job['id']; ?><br>
                    <strong>Role:</strong> <?php echo $job['job_role']; ?><br>
                    <strong>Description:</strong> <?php echo $job['job_description']; ?><br>
                    <strong>GPA Requirement:</strong> <?php echo $job['gpa_requirement']; ?><br>
                    <strong>Location:</strong> <?php echo $job['job_location']; ?><br>
                    <strong>Salary:</strong> <?php echo $job['job_salary']; ?><br>

                    <form action="manage_application_action.php" method="POST">
                        <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                        <input type="submit" value="Manage Applications">
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
