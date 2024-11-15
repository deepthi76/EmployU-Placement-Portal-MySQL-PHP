<?php
include 'db_connect.php';
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: login_admin.php");
    exit();
}

// Fetch companies awaiting approval
$sql = "SELECT * FROM companies WHERE approved = 0";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* Global Styles */
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

        .dashboard-container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            margin-bottom: 20px;
        }

        h3 {
            color: #D7A9A4;
            margin-bottom: 20px;
        }

        /* Company Approval List */
        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #D7A9A4;
        }

        form {
            display: inline;
        }

        input[type="submit"] {
            padding: 10px 15px;
            background-color: #1D3A89;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 14px;
        }

        input[type="submit"]:hover {
            background-color: #D7A9A4;
        }

        /* Job Role Form */
        .job-role-form {
            margin-top: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            border: 1px solid #D7A9A4;
            width: 100%;
            max-width: 400px;
        }

        .job-role-form input[type="text"],
        .job-role-form input[type="submit"] {
            padding: 10px;
            margin-top: 10px;
            font-size: 14px;
            border-radius: 8px;
            border: 1px solid #D7A9A4;
        }

        .job-role-form input[type="submit"] {
            background-color: #1D3A89;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .job-role-form input[type="submit"]:hover {
            background-color: #D7A9A4;
        }

        /* Style for the result display area */
        #applicationCountResult {
            margin-top: 15px;
            font-size: 16px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Admin Dashboard</h2>

        <!-- Section for Company Approval -->
        <h3>Companies Awaiting Approval</h3>
        <ul>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <li>
                    <span><?php echo $row['company_name']; ?></span>
                    <form action="approve_company_action.php" method="POST">
                        <input type="hidden" name="company_id" value="<?php echo $row['id']; ?>">
                        <input type="submit" value="Approve">
                    </form>
                </li>
            <?php } ?>
        </ul>
    </div>

    <div class="dashboard-container">
        <!-- Form to check application count for a job role -->
        <h3>Check Total Applications for a Job Role</h3>
        <form class="job-role-form" id="jobRoleForm" onsubmit="return fetchApplicationCount(event)">
            <label for="job_role">Enter Job Role:</label>
            <input type="text" id="job_role" name="job_role" required>
            <input type="submit" value="Get Application Count">
        </form>
        <!-- Div to display the result just under the form -->
        <div id="applicationCountResult"></div>
    </div>

    <script>
        // JavaScript function to handle AJAX request
        function fetchApplicationCount(event) {
            event.preventDefault();  // Prevent the form from submitting in the traditional way

            const jobRole = document.getElementById('job_role').value;
            const formData = new FormData();
            formData.append('job_role', jobRole);

            fetch('get_application_count.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Display the response data in the applicationCountResult div
                document.getElementById('applicationCountResult').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>

<?php $conn->close(); ?>