<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
</head>
<body>
    <h2>Student Registration</h2>
    <form action="register_student_action.php" method="POST">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        Full Name: <input type="text" name="full_name" required><br>
        Phone: <input type="text" name="phone"><br>
        Email: <input type="email" name="email" required><br>
        Gender: 
        <select name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select><br>
        GPA: <input type="number" step="0.01" min="1" max="10" name="gpa" required><br>
        Degree: 
        <select name="degree">
            <option value="B.Tech">B.Tech</option>
            <option value="M.Tech">M.Tech</option>
            <option value="Dual Degree">Dual Degree</option>
        </select><br>
        Specialization:
        <select name="specialization">
            <option value="CSE">CSE</option>
            <option value="ECE">ECE</option>
            <option value="EEE">EEE</option>
        </select><br>
        Backlogs: 
        <select name="backlogs">
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select><br>
        Resume Link: <input type="text" name="resume_link"><br>
        <input type="submit" value="Register">
    </form>
</body>
</html> -->
<!-- 1 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                url('registration.jpeg') no-repeat center center/cover;
        }

        .registration-container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h2 {
            font-size: 24px;
            color: #1D3A89;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }

        .form-group-inline {
            display: flex;
            gap: 15px;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            color: #1D3A89;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="number"],
        select {
            padding: 10px;
            border: 1px solid #D7A9A4;
            border-radius: 8px;
            width: 100%;
            font-size: 16px;
            color: #333;
            background-color: #fefefe;
            margin-top: 5px;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #1D3A89;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 15px;
        }

        input[type="submit"]:hover {
            background-color: #D7A9A4;
        }

        .form-group-inline .form-group {
            flex: 1;
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <h2>Student Registration</h2>
        <form action="register_student_action.php" method="POST">
            <div class="form-group-inline">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
            </div>

            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group-inline">
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="gpa">GPA:</label>
                    <input type="number" id="gpa" name="gpa" step="0.01" min="1" max="10" required>
                </div>
            </div>

            <div class="form-group-inline">
                <div class="form-group">
                    <label for="degree">Degree:</label>
                    <select id="degree" name="degree">
                        <option value="B.Tech">B.Tech</option>
                        <option value="M.Tech">M.Tech</option>
                        <option value="Dual Degree">Dual Degree</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="specialization">Specialization:</label>
                    <select id="specialization" name="specialization">
                        <option value="CSE">CSE</option>
                        <option value="ECE">ECE</option>
                        <option value="EEE">EEE</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="backlogs">Backlogs:</label>
                    <select id="backlogs" name="backlogs">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="resume_link">Resume Link:</label>
                <input type="text" id="resume_link" name="resume_link">
            </div>

            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>

