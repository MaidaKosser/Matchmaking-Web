<?php
// admin_login.php

session_start(); // Start the session


include 'connection.php';
// Initialize message
$popup_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check credentials
    $sql = "SELECT * FROM adminlogin WHERE email = ? AND password = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Login successful
        $_SESSION['admin_logged_in'] = true;
        header("Location: Admin_dashboard.php"); // Redirect to the dashboard or admin panel
        exit();
    } else {
        // Login failed
        $popup_message = "Invalid email or password.";
    }

    $stmt->close();
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: sans-serif;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url(redbg.jpg);
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

        .form {
            max-width: 430px;
            width: 100%;
            padding: 30px;
            border-radius: 6px;
            background: #FFF;
        }

        .form-content header {
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
            width: 90%;
        }

        .field input:focus {
            border-bottom-width: 2px;
        }

        .eye-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            font-size: 18px;
            color: #8b8b8b;
            cursor: pointer;
            padding: 5px;
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

        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999;
            display: none; /* Hidden by default */
        }

        .popup-content {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .ok-button {
            background: #850e03;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .ok-button:hover {
            background: #850f09;
        }
    </style>
    <script>
        function showPopup(message) {
            const popup = document.querySelector('.popup');
            popup.querySelector('h2').textContent = message;
            popup.style.display = 'flex';
        }

        function closePopup() {
            document.querySelector('.popup').style.display = 'none';
        }

        // Check if there is a message to show
        window.onload = function() {
            const message = "<?php echo isset($popup_message) ? $popup_message : ''; ?>";
            if (message) {
                showPopup(message);
            }
        };
    </script>
</head>
<body>
    <div class="container">
        <img id="logo" src="logo.png" alt="Logo">
        <div class="form">
            <div class="form-content">
                <header>Admin Login</header>
                <form id="admin-login-form" method="POST" action="">
                    <div class="field input-field">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="field input-field">
                        <input type="password" name="password" placeholder="Password" required>
                        <i class='bx bx-hide eye-icon'></i>
                    </div>
                    <div class="field button-field">
                        <button type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Popup HTML -->
    <div class="popup">
        <div class="popup-content">
            <h2></h2>
            <button class="ok-button" onclick="closePopup()">OK</button>
        </div>
    </div>
</body>
</html>
