<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url(redbg.jpg);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        #logo {
            margin-bottom: 20px;
            text-align: center;
        }

        #logo img {
            height: 100px;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            color: #333333;
            margin-bottom: 20px;
        }

        .mailbox-img {
            width: 80px;
            margin-bottom: 20px;
        }

        .email {
            font-size: 16px;
            color: #666666;
            margin-bottom: 20px;
        }

        .code-input {
            margin-bottom: 20px;
        }

        .code-input input {
            width: 50px;
            height: 50px;
            font-size: 24px;
            text-align: center;
            margin: 0 5px;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #832506;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #d14b11;
        }

        .links {
            margin-top: 20px;
            font-size: 14px;
        }

        .links a {
            color: #6d0606;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div id="logo">
        <img src="logo.png" alt="Logo">
    </div>
    <div class="container">
        <h1>VERIFY YOUR EMAIL</h1>
        <img src="email.png" alt="Mailbox" class="mailbox-img"> 
        <p class="email">Please enter the 4-digit code sent to your registered email</p>
        <p class="email" id="email-address">example@example.com</p> 
        <div class="code-input">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
        </div>
        <button onclick="activateAccount()">ACTIVATE ACCOUNT</button>
        <div class="links">
            <a href="verifyemail.html">Send code again!</a>
            <br><br>
            Already verified the email? <a href="login.php">Click here to login</a>
        </div>
    </div>

    <script>
        function activateAccount() {
            window.location.href = 'login.php';
        }
    </script>
</body>
</html>
