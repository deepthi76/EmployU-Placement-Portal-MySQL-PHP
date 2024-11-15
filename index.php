<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Placement Portal</title>
</head>
<body>
    <h2>Welcome to the Placement Portal</h2>
    <ul>
        <li><a href="register_student.php">Register as Student</a></li>
        <li><a href="register_company.php">Register as Company</a></li>
        <li><a href="login_student.php">Student Login</a></li>
        <li><a href="login_company.php">Company Login</a></li>
        <li><a href="login_admin.php">Admin Login</a></li>
    </ul>
</body>
</html> -->
<!-- 1 -->

<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placement Portal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #F8F3EA;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .container {
            text-align: center;
            padding: 40px;
            background: #0B1957;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            font-size: 24px;
            color: #F8F3EA;
            margin-bottom: 10px;
        }

        .tagline {
            font-size: 16px;
            color: #F8F3EA;
            margin-bottom: 30px;
        }

        .navigation {
            list-style-type: none;
            padding: 0;
        }

        .navigation li {
            margin: 15px 0;
        }

        .navigation a {
            text-decoration: none;
            color: #0B1957;
            background-color: #F8F3EA;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.3s;
            display: inline-block;
        }

        .navigation a:hover {
            background-color: #9ECCFA;
            color: #666;
        }

        /* Flexbox styling for student buttons on the same line */
        .student-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        @media (max-width: 500px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 20px;
            }

            .tagline {
                font-size: 14px;
            }

            /* Make student buttons stack vertically on small screens */
            .student-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to the Placement Portal</h2>
        <p class="tagline">Connecting Students and Employers for a Brighter Future</p>
        <ul class="navigation">
            <li class="student-buttons">
                <a href="register_student.php">Register as Student</a>
                <a href="login_student.php">Student Login</a>
            </li>
            <li class="student-buttons">
                <a href="register_company.php">Register as Company</a>
                <a href="login_company.php">Company Login</a>
            </li>
            <li><a href="login_admin.php">Admin Login</a></li>
        </ul>
    </div>
</body>
</html>

-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placement Portal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Full screen styling */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                url('index_image2.webp') no-repeat center center/cover;
        }

        /* Container styling */
        .container {
    text-align: center;
    padding: 40px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for shadow and translation */
}

/* Hover effect for container */
.container:hover {
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2); /* Stronger shadow on hover */
    transform: translateY(-5px); /* Moves the container up slightly */
}


        .container {
            text-align: center;
            padding: 40px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
        }

        h4 {
            align-self: center;
        }

        h2 {
            font-size: 28px;
            color: #0B1957;
            margin-bottom: 20px;
        }

        /* Typewriter effect for tagline */
        .tagline {
            font-size: 16px;
            color: #444;
            margin-bottom: 30px;
            white-space: nowrap;
            overflow: hidden;
            border-right: 3px solid #0B1957;
            animation: typing 3.5s steps(30, end), blink-caret 0.5s step-end infinite;
        }

        /* Typing and caret animation */
        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }

        @keyframes blink-caret {
            from, to { border-color: transparent; }
            50% { border-color: #0B1957; }
        }

        /* Navigation styling */
        .navigation {
            list-style-type: none;
            padding: 0;
        }

        .navigation li {
            margin: 15px 0;
        }

        .navigation a {
            text-decoration: none;
            color: #fff;
            background-color: #1D3A89;
            padding: 12px 24px;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: inline-block;
            font-size: 16px;
        }

        /* Hover effects */
        .navigation a:hover {
            background-color: #9ECCFA;
            color: #0B1957;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        

        /* Flexbox styling for student buttons */
        .student-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            
        }

        /* Responsive styling */
        @media (max-width: 500px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 24px;
            }

            .tagline {
                font-size: 16px;
            }

            .student-buttons {
                flex-direction: column;
                
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to EmployU</h2>
        <p class="tagline">Connecting Students and Employers for a Brighter Future!</p>
        <ul class="navigation">
            <li class="student-buttons">
                <h4>Student: </h4>
                <a href="register_student.php">Register</a>
                <a href="login_student.php">Login</a>
            </li>
            <li class="student-buttons">
                <h4>Company: </h4>
                <a href="register_company.php">Register</a>
                <a href="login_company.php">Login</a>
            </li>
            <li><a href="login_admin.php">Admin Login</a></li>
        </ul>
    </div>
</body>
</html>
