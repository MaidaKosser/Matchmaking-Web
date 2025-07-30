<?php
session_start();

function showPopup($message) {
    echo "<div class='popup' style='display: flex;'>
            <div class='popup-content'>
                <h2>$message</h2>
                <button class='ok-button' onclick='closePopup()'>OK</button>
            </div>
          </div>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

  

    // Query to check if the user exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if ($password == $user['password']) {  
            // Set session variables
            $_SESSION['user_id'] = $user['uid'];
            $_SESSION['user_email'] = $user['email'];

            // Redirect to user profile
            header('Location: profile.php');
            exit();
        } else {
            showPopup("Incorrect Email or Password");
        }
    } else {
        showPopup("Incorrect Email or Password");
    }

    $stmt->close();
    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        html {
            scroll-behavior: smooth;
        }
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

        .form.signup {
            opacity: 0;
            pointer-events: none;
            position: absolute; 
        }

        .forms.show-signup .form.signup {
            opacity: 1;
            pointer-events: auto;
            position: static; 
        }

        .forms.show-signup .form.login {
            opacity: 0;
            pointer-events: none;
            position: absolute; 
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

        .form-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            margin-left:  10%;
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

        .form-content a:hover {
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

        @media screen and (max-width: 400px) {
            .form {
                padding: 20px 10px;
            }
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
    gap: 10px;
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
    display: inline-block;
}

.ok-button:hover, .redirect-button:hover {
    background-color: #a21000;
}

.redirect-button {
    margin-left: 10px; 
}
    </style>
</head>
<body> 
<div class="container">
        <img id="logo" src="logo.png" alt="Logo"> <!-- Update the logo path as needed -->
        <div class="forms">
            <div class="form login">
                <header>Login</header>
                <form id="login-form" method="POST" action="">
                    <div class="field input-field">
                        <input type="email" name="email" placeholder="Email" class="input" required>
                    </div>
                    <div class="field input-field">
                        <input type="password" name="password" placeholder="Password" class="password" required>
                        <i class='bx bx-hide eye-icon'></i>
                    </div>
                    <div class="form-link">
                        <div>
                            <input type="checkbox" id="login-remember-me" name="remember-me">
                            <label for="login-remember-me">Remember me</label>
                        </div>
                        <a href="verifyemail.php">Forgot password?</a><br><br>
                    </div>
                    <div class="field button-field">
                        <button type="submit">Login</button>
                    </div>
                </form>
                <div class="form-link">
                    <span>Don't have an account? <a href="signup.php" class="link signup-link">Signup</a></span>
                </div>
                <div class="line"></div>
                <div class="media-options">
                    <a href="google.html" class="field google">
                        <img src="google.png" alt="" class="google-img">
                        <span>Login with Google</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
    function closePopup() {
        document.querySelector('.popup').style.display = 'none';
    }
    </script>

</body>
</html>
