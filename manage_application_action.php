<?php
include 'db_connect.php';
session_start();

// Check user role and session
if ($_SESSION['role'] != 'company') {
    header("Location: login_company.php");
    exit();
}

// Retrieve job_id and company_id
$job_id = $_POST['job_id'];
$company_id = $_SESSION['user_id'];

// Fetch applicants grouped by application status
$sql = "SELECT students.*, applications.status, applications.id as application_id
        FROM applications
        JOIN students ON applications.student_id = students.id
        WHERE applications.job_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $job_id);
$stmt->execute();
$applications_result = $stmt->get_result();

// Separate applicants by status
$applicants = [
    'processing' => [],
    'selected' => [],
    'rejected' => []
];
while ($applicant = $applications_result->fetch_assoc()) {
    $status = strtolower($applicant['status']);
    $applicants[$status][] = $applicant;
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Applications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2, h3 {
            color: #1D3A89;
        }
        .applicant-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #D7A9A4;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .applicant-details {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            width: 80%;
        }
        .applicant-details div {
            font-weight: bold;
            color: #1D3A89;
            text-align: center;
        }
        .applicant-details p {
            margin: 5px 0;
            text-align: center;
        }
        .status.processing {
            color: #FFA500;
        }
        .status.selected {
            color: #4CAF50;
        }
        .status.rejected {
            color: #FF6347;
        }
        .action-buttons {
            text-align: right;
            width: 20%;
        }
        .action-buttons button {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #1D3A89;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .action-buttons button:hover {
            background-color: #D7A9A4;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateStatus(applicationId, newStatus) {
            $.ajax({
                url: 'update_application_status.php',
                type: 'POST',
                data: {
                    application_id: applicationId,
                    status: newStatus
                },
                success: function(response) {
                    // Ensure response is as expected
                    console.log("Server response:", response);
                    const applicantDiv = document.getElementById('applicant-' + applicationId);
                    const statusContainer = document.getElementById(newStatus + '-applications');
                    if (applicantDiv && statusContainer) {
                        applicantDiv.querySelector('.status').textContent = "Status: " + newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
                        statusContainer.appendChild(applicantDiv);
                        applicantDiv.querySelector('.action-buttons').style.display = 'none';
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error updating status:", error);
                }
            });
        }
    </script>
</head>
<body>
    <h2>Manage Applications for Job ID: <?php echo htmlspecialchars($job_id); ?></h2>

    <!-- Processing Applications -->
    <h3>Processing Applications</h3>
    <div id="processing-applications">
        <?php if (count($applicants['processing']) > 0): ?>
            <?php foreach ($applicants['processing'] as $applicant): ?>
                <div class="applicant-container" id="applicant-<?php echo $applicant['application_id']; ?>">
                    <!-- Applicant Details Grid -->
                    <div class="applicant-details">
                        <div>Name</div>
                        <div>Email</div>
                        <div>GPA</div>
                        <div>Resume</div>
                        <p><?php echo htmlspecialchars($applicant['full_name']); ?></p>
                        <p><?php echo htmlspecialchars($applicant['email']); ?></p>
                        <p><?php echo htmlspecialchars($applicant['gpa']); ?></p>
                        <p><a href="<?php echo htmlspecialchars($applicant['resume_link']); ?>" target="_blank">View Resume</a></p>
                    </div>
                    <div class="action-buttons">
                        <span class="status processing">Status: Processing</span><br>
                        <button onclick="updateStatus(<?php echo $applicant['application_id']; ?>, 'selected')">Accept</button>
                        <button onclick="updateStatus(<?php echo $applicant['application_id']; ?>, 'rejected')">Reject</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No applications currently in processing.</p>
        <?php endif; ?>
    </div>

    <!-- selected Applications -->
    <h3>Selected Applications</h3>
    <div id="selected-applications">
        <?php if (count($applicants['selected']) > 0): ?>
            <?php foreach ($applicants['selected'] as $applicant): ?>
                <div class="applicant-container" id="applicant-<?php echo $applicant['application_id']; ?>">
                    <div class="applicant-details">
                        <div>Name</div>
                        <div>Email</div>
                        <div>GPA</div>
                        <div>Resume</div>
                        <p><?php echo htmlspecialchars($applicant['full_name']); ?></p>
                        <p><?php echo htmlspecialchars($applicant['email']); ?></p>
                        <p><?php echo htmlspecialchars($applicant['gpa']); ?></p>
                        <p><a href="<?php echo htmlspecialchars($applicant['resume_link']); ?>" target="_blank">View Resume</a></p>
                    </div>
                    <span class="status selected">Status: Selected</span>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No selected applications.</p>
        <?php endif; ?>
    </div>

    <!-- Rejected Applications -->
    <h3>Rejected Applications</h3>
    <div id="rejected-applications">
        <?php if (count($applicants['rejected']) > 0): ?>
            <?php foreach ($applicants['rejected'] as $applicant): ?>
                <div class="applicant-container" id="applicant-<?php echo $applicant['application_id']; ?>">
                    <div class="applicant-details">
                        <div>Name</div>
                        <div>Email</div>
                        <div>GPA</div>
                        <div>Resume</div>
                        <p><?php echo htmlspecialchars($applicant['full_name']); ?></p>
                        <p><?php echo htmlspecialchars($applicant['email']); ?></p>
                        <p><?php echo htmlspecialchars($applicant['gpa']); ?></p>
                        <p><a href="<?php echo htmlspecialchars($applicant['resume_link']); ?>" target="_blank">View Resume</a></p>
                    </div>
                    <span class="status rejected">Status: Rejected</span>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No rejected applications.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php $conn->close(); ?>
