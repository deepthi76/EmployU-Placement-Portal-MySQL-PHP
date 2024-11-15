






<?php
include 'db_connect.php';
session_start();

if ($_SESSION['role'] != 'student') {
    header("Location: login_student.php");
    exit();
}

$student_id = $_SESSION['user_id'];


// Fetch the student's name
$sql_name = "SELECT full_name FROM students WHERE id = ?";
$stmt_name = $conn->prepare($sql_name);
$stmt_name->bind_param("i", $student_id);
$stmt_name->execute();
$stmt_name->bind_result($student_name);
$stmt_name->fetch();
$stmt_name->close();


// Fetch jobs and the student's application status for each job
$sql = "SELECT jobs.id, companies.company_name, jobs.job_role, jobs.job_description, jobs.gpa_requirement, jobs.job_location, jobs.job_salary,
        applications.status AS application_status
        FROM jobs
        JOIN companies ON jobs.company_id = companies.id
        LEFT JOIN applications ON jobs.id = applications.job_id AND applications.student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            position: relative;
        }
        h2 {
            color: #1D3A89;
            text-align: center;
        }
        /* Edit Profile and Logout Buttons */
        .top-buttons {
            position: absolute;
            top: 0px;
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
        /* Job List Styling */
        .job-list {
            list-style-type: none;
            padding: 0;
        }
        .job-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
            border: 1px solid #D7A9A4;
            border-radius: 8px;
        }
        /* Job Details Grid */
        .job-details {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
            width: 80%;
        }
        /* Headings styling */
        .job-details div {
            font-weight: bold;
            color: #1D3A89;
            text-align: center;
        }
        /* Values styling */
        .job-details p {
            margin: 5px 0;
            text-align: center;
            font-weight: normal;
        }
        /* Apply Button / Status styling */
        .action-section {
            text-align: right;
            width: 20%;
        }
        .apply-btn, .status {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            color: white;
            border-radius: 8px;
        }
        .apply-btn {
            background-color: #1D3A89;
            border: none;
            cursor: pointer;
        }
        .apply-btn:hover {
            background-color: #D7A9A4;
        }
        .status.processing {
            background-color: #FFA500;
        }
        .status.selected {
            background-color: green;
        }
        .status.rejected {
            background-color: #FF6347;
        }
    </style>
</head>
<body>
    <!-- Edit Profile and Log Out Buttons with User ID -->
    <div class="top-buttons">
        <span class="user-id"> <?php echo htmlspecialchars($student_name); ?></span>
        <a href="edit_student_profile.php">Edit Profile</a>
        <a href="index.php">Log Out</a>
        
    </div>

    <h2>Student Dashboard</h2>
    <br>
    <h3>Available Jobs</h3>
    <ul class="job-list">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <li class="job-item">
                <!-- Job Details Grid -->
                <div class="job-details">
                    <!-- First Row: Headings -->
                    <div>Company</div>
                    <div>Job Role</div>
                    <div>Description</div>
                    <div>GPA Requirement</div>
                    <div>Location</div>
                    <div>Salary</div>

                    <!-- Second Row: Values -->
                    <p><?php echo htmlspecialchars($row['company_name']); ?></p>
                    <p><?php echo htmlspecialchars($row['job_role']); ?></p>
                    <p><?php echo htmlspecialchars($row['job_description']); ?></p>
                    <p><?php echo htmlspecialchars($row['gpa_requirement']); ?></p>
                    <p><?php echo htmlspecialchars($row['job_location']); ?></p>
                    <p><?php echo htmlspecialchars($row['job_salary']); ?></p>
                </div>

                <!-- Apply Button / Status on Right -->
                <div class="action-section">
                    <?php if ($row['application_status']) { ?>
                        <span class="status <?php echo strtolower($row['application_status']); ?>">
                            <?php echo ucfirst($row['application_status']); ?>
                        </span>
                        <span class="apply-btn" style="background-color: #888; cursor: default;">Applied</span>
                    <?php } else { ?>
                        <form action="apply_job_action.php" method="POST">
                            <input type="hidden" name="job_id" value="<?php echo $row['id']; ?>">
                            <input type="submit" value="Apply" class="apply-btn">
                        </form>
                    <?php } ?>
                </div>
            </li>
        <?php } ?>
    </ul>
</body>
</html>

<?php $conn->close(); ?>
