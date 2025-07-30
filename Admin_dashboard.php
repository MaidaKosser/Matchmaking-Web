<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            color: #333;
        }

        header {
    background-color: #fff; /* Changed to white */
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #ddd;
   
}

        .logo img {
            height: 50px;
            width: auto;
        }

        .nav-links {
            display: flex;
            align-items: center;
            flex-grow: 1;
            justify-content: flex-end;
        }

        .nav-links a {
            margin: 0 20px;
            text-decoration: none;
            color: #ff4e50;
            font-weight: 900;
            font-size: 1.2em;
        }

        .nav-icons {
            display: flex;
            align-items: center;
        }

        .nav-icons i {
            margin: 0 10px;
            color: #ff4e50;
        }

        .nav-icons .profile-pic {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ff4e50;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .admin-dashboard {
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
        }

        .admin-dashboard .header {
            width: 100%;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #ff4e50;
            margin-bottom: 20px;
            background-color: #fff;
            border-bottom: 2px solid #ff4e50;
            padding-bottom: 10px;
        }

        .admin-dashboard .form-group {
            margin-bottom: 15px;
        }

        .admin-dashboard .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #ff4e50;
        }

        .admin-dashboard .form-group input {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .admin-dashboard .form-group button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #ff4e50;
            color: #fff;
            cursor: pointer;
        }

        footer {
            background-color: #ffe4e1; /* Same as header background color */
            padding: 20px 20px; /* Adjusted padding to shorten footer length */
            color: #000;
        }

        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        @media (min-width: 768px) {
            .footer-content {
                flex-direction: row;
                justify-content: space-between;
            }
        }

        .quick-links, .subscribe, .keep-in-touch {
            flex: 1;
            margin: 20px;
            text-align: center;
        }

        .quick-links h3, .subscribe h3, .keep-in-touch h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #ff69b4;
        }

        .quick-links ul {
            list-style: none;
            padding: 0;
        }

        .quick-links ul li {
            margin-bottom: 10px;
        }

        .quick-links ul li a {
            text-decoration: none;
            color: #000;
            font-size: 1em;
            transition: color 0.3s ease;
        }

        .quick-links ul li a:hover {
            color: #ff69b4;
        }

        .subscribe {
            text-align: center;
        }

        .subscribe-logo {
            width: 200px;
            height: auto;
            margin: 10px auto;
        }

        .keep-in-touch p {
            margin: 0 0 10px;
        }

        .copyright {
            text-align: center;
            padding: 10px;
            background-color: #ffc0cb;
            margin-top: 20px;
        }

        .copyright p {
            margin: 0;
            font-size: 0.9em;
        }

        .copyright a {
            text-decoration: none;
            color: #000;
            transition: color 0.3s ease;
        }

        .copyright a:hover {
            color: #ff69b4;
        }

    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="Logo">
        </div>
        <nav class="nav-links">
            <a href="home.php">Home</a>
            <a href="Admin_pro.html">Full Profile</a> 
            <a href="Admin_signup.html">Signup</a> 
            <div class="nav-icons">
                <i class="fas fa-bell"></i>
                <i class="fas fa-cog"></i>
                <img src="boy.webp" alt="Admin" class="profile-pic">
            </div>
        </nav>
    </header>

    <div class="admin-dashboard">
        <div class="header">Admin Dashboard</div>
        <div class="form-group">
            <label for="search-candidate">Search Candidate</label>
            <input type="text" id="search-candidate" placeholder="Search by member id">
        </div>
        <div class="form-group">
            <button type="button">Search</button>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="quick-links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="About.html">About</a></li>
                    <li><a href="Contact.html">Contact Us</a></li>
                </ul>
            </div>
            <div class="subscribe">
                <img src="logo.png" alt="Logo" class="subscribe-logo">
            </div>
            <div class="keep-in-touch">
                <h3>Keep in Touch</h3>
                <p>cheema8044@gmail.com</p>
            </div>
        </div>
        <div class="copyright">
        <p>© 2024 Matchmaking. All Rights Reserved | Developed by <a href="#">Maida Butt</a>, <a href="#">Noman Cheema</a></p>
        </div>
    </footer>
</body>
</html>
