<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Company Registration</title>
</head>
<body>
    <h2>Company Registration</h2>
    <form action="register_company_action.php" method="POST">
        Company Name: <input type="text" name="company_name" required><br>
        Password: <input type="password" name="password" required><br>
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
    <title>Company Registration</title>
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
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.8)), 
                url('registration.jpeg') no-repeat center center/cover;
        }

        

        .registration-container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
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

        label {
            font-weight: bold;
            color: #1D3A89;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        input[type="password"] {
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
    </style>
</head>
<body>
    <div class="registration-container">
        <h2>Company Registration</h2>
        <form action="register_company_action.php" method="POST">
            <div class="form-group">
                <label for="company_name">Company Name:</label>
                <input type="text" id="company_name" name="company_name" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
