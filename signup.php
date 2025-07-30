<?php
// Start session to store user data
session_start();

// Database connection
$connection = new mysqli('localhost:3306', 'root', '', 'matchmaking');
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $connection->real_escape_string($_POST['email']);
    $password = $connection->real_escape_string($_POST['password']);
    $confirm_password = $connection->real_escape_string($_POST['confirm_password']);

    // Check if passwords match
    if ($password === $confirm_password) {
        // Prepare and bind the SQL statement to avoid SQL injection
        $stmt = $connection->prepare("INSERT INTO users (username, email, password, profile_status, is_premium) VALUES (?, ?, ?, 'inactive', FALSE)");
        $stmt->bind_param("sss", $default_username, $email, $password);

        if ($stmt->execute()) {
            // Store the user id in the session to use in accountCreationInfo.php
            $_SESSION['uid'] = $connection->insert_id;
            $_SESSION['email'] = $email;

            // Redirect to account creation info page
            echo "<script>
                    alert('Signup successful!');
                    window.location.href='accountCreationInfo.php';
                  </script>";
            exit;
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
    }
}

$connection->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <style>
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: sans-serif;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url('redbg.jpg');
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        #logo {
            display: block;
            margin: 0 auto 20px;
            height: 100px;
            width: auto;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 100vh;
        }

        .forms {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .form {
            max-width: 430px;
            width: 100%;
            padding: 30px;
            border-radius: 6px;
            background: #FFF;
            transition: opacity 0.3s ease, pointer-events 0.3s ease;
        }

        header {
            font-size: 28px;
            font-weight: 600;
            color: #232836;
            text-align: center;
        }

        .field {
            position: relative;
            height: 50px;
            width: 100%;
            margin-top: 20px;
            border-radius: 6px;
        }

        .field input,
        .field button {
            height: 100%;
            width: 100%;
            border: none;
            font-size: 16px;
            font-weight: 400;
            border-radius: 6px;
        }

        .field input {
            outline: none;
            padding: 0 15px;
            border: 1px solid #CACACA;
            width: 92%;
        }

        .eye-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            font-size: 18px;
            color: #8b8b8b;
            cursor: pointer;
        }

        .field button {
            color: #fff;
            background-color: #850e03;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .field button:hover {
            background-color: #850f09;
        }

        .form-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .form-link span,
        .form-link a {
            font-size: 14px;
            font-weight: 400;
            color: #232836;
        }

        .form a {
            color: #7d1406;
            text-decoration: none;
        }

        .form a:hover {
            text-decoration: underline;
        }

        .line {
            position: relative;
            height: 1px;
            width: 100%;
            margin: 36px 0;
            background-color: #d4d4d4;
        }

        .line::before {
            content: 'Or';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #FFF;
            color: #8b8b8b;
            padding: 0 15px;
        }

        .media-options a {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        img.google-img {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            height: 20px;
            width: 20px;
            object-fit: cover;
        }

        a.google {
            border: 1px solid #CACACA;
        }

        a.google span {
            font-weight: 500;
            opacity: 0.6;
            color: #232836;
        }

        .popup {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 80%;
            max-width: 500px;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .popup-content img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        .popup-content h2 {
            font-size: 24px;
            margin: 10px 0;
        }

        .popup-content p {
            font-size: 16px;
            margin: 10px 0;
        }

        .ok-button, .redirect-button {
            background-color: #980404;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            text-decoration: none;
        }

        .ok-button:hover, .redirect-button:hover {
            background-color: #a21000;
        }

        .redirect-button {
            margin-left: 10px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
        <img id="logo" src="logo.png" alt="Logo">
        <div class="forms">
            <!-- Signup Form -->
            <div class="form signup">
            <header>Sign up</header>
                <div class="form-content">
                    <form id="signup-form" method="post" action="">
                        <div class="field input-field">
                            <input type="email" name="email" placeholder="Email" class="input" required>
                        </div>
                        <div class="field input-field">
                            <input type="password" name="password" placeholder="Create password" class="password" required>
                        </div>
                        <div class="field input-field">
                            <input type="password" name="confirm_password" placeholder="Confirm password" class="password" required>
                        </div>
                        <div class="field button-field">
                            <button type="submit">Signup</button>
                        </div>
                    </form>
                    <div class="form-link">
                        <span>Already have an account? <a href="login.php" class="link login-link">Login</a></span>
                    </div>
                </div>
                <div class="line"></div>
                <div class="media-options">
                    <a href="google.html" class="field google">
                        <img src="google.png" alt="" class="google-img">
                        <span>Signup with Google</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <img src="check.png" alt="Success Icon">
            <h2>Signup Successful!</h2>
            <p>Your account has been created successfully.</p>
            <a href="accountCreationInfo.php" class="redirect-button">Go to Profile</a>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.querySelectorAll('.eye-icon').forEach(icon => {
            icon.addEventListener('click', function () {
                const passwordField = this.previousElementSibling;
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                this.classList.toggle('bx-hide');
                this.classList.toggle('bx-show');
            });
        });

        // Function to close the popup
        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }
    </script>
</body>
</html>