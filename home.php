<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matchmaking</title>
    <style type="text/css">
        html {
            scroll-behavior: smooth;
        }
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #000;
        }

        header {
            background-color: #fff;
            padding: 10px 0;
        }

        header nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        header nav ul li {
            display: inline;
        }

        header nav ul li a {
            text-decoration: none;
            color: #000;
            padding: 10px 20px;
            display: block;
        }

        header nav ul li a.login-btn,
        header nav ul li a.signup-btn {
            border: 1px solid #ff4e50;
            border-radius: 5px;
            padding: 5px 15px;
            color: #ff4e50;
        }

        header nav ul li a.signup-btn {
            background-color: #ff4e50;
            color: #fff;
        }

        .hero {
            position: relative;
            text-align: center;
            background-image: url('pic1.jpg');
            background-size: cover;
            background-position: center;
            padding: 50px 20px;
        }

        .overlay {
            position: relative;
            z-index: 1;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
            backdrop-filter: blur(10px);
        }

        .overlay h1 {
            font-size: 3em;
            margin-bottom: 20px;
            color: #ff4e50;
        }

        .overlay p {
            font-size: 1.2em;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
            color: #000;
        }

        .video-box {
            background: #ff4e50;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            display: inline-block;
            margin-top: 20px;
            text-align: center;
        }

        .video-box h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .video-box button {
            background: #fff;
            color: #ff4e50;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
        }

        .video-box button:hover {
            background: #e43e3e;
            color: #fff;
        }

        .why-simple-rishta {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px 20px;
            background-color: #fff;
            color: #000;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url(redbg.jpg);
        }

        .why-simple-rishta .container {
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .why-simple-rishta img {
            width: 50%;
            border-radius: 8px;
            margin-right: 20px;
        }

        .why-simple-rishta .content {
            width: 50%;
        }

        .why-simple-rishta .content h2 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #ff4e50;
        }

        .why-simple-rishta .content p {
            font-size: 1.2em;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .why-simple-rishta .content ul {
            list-style: none;
            padding: 0;
        }

        .why-simple-rishta .content ul li {
            font-size: 1.2em;
            margin-bottom: 10px;
            color: #000;
            position: relative;
            padding-left: 20px;
        }

        .why-simple-rishta .content ul li::before {
            content: '•';
            position: absolute;
            left: 0;
            color: #ff4e50;
            font-size: 1.5em;
            line-height: 1.2;
        }

        .responsibilities {
            text-align: center;
            padding: 50px 20px;
            background-color: #f4f4f4;
            color: #000;
        }

        .responsibilities h2 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #ff4e50;
        }

        .responsibilities .container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
        }

        .responsibility {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            margin: 10px;
            flex: 1;
            max-width: 250px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Custom background colors for responsibilities */
        .responsibility:nth-child(1) {
            background-color: #ff66a3;
        }

        .responsibility:nth-child(2) {
            background-color: #ff8c1a;
        }

        .responsibility:nth-child(3) {
            background-color: #ff66a3;
        }

        .responsibility:nth-child(4) {
            background-color: #ff8c1a;
        }

        .responsibility img {
            width: 50px;
            height: 50px;
            margin-bottom: 20px;
        }

        .responsibility h3 {
            font-size: 1.2em;
            margin-bottom: 10px;
            color: #ff4e50;
        }

        .responsibility p {
            font-size: 1em;
            color: #000;
        }

        .getting-started {
            text-align: center;
            padding: 50px 20px;
            background-color: #fff;
            color: #000;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url(redbg.jpg);
        }

        .getting-started h2 {
            font-size: 2em;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .getting-started p {
            font-size: 1.2em;
            line-height: 1.6;
            margin: 0 auto;
            max-width: 700px;
        }

        .registration-container {
            display: flex;
            align-items: flex-start;
            padding: 50px 20px;
            background-color: #fff;
            color: #000;
            justify-content: space-between;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url(redbg.jpg);
        }

        .registration-text {
            flex: 1;
            max-width: 50%;
            margin-right: 20px;
            font-size: 0.9em;
        }

        .registration-text h2 {
            font-size: 1.5em; 
            margin-bottom: 20px;
            color: #ff4e50;
        }

        .registration-text p, 
        .registration-text ul {
            font-size: 1em; 
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .registration-text ul {
            list-style: none;
            padding: 0;
        }

        .registration-text ul li {
            font-size: 1em; 
            margin-bottom: 10px;
            color: #000;
            position: relative;
            padding-left: 20px; 
        }

        .registration-text ul li::before {
            content: '→'; 
            position: absolute;
            left: 0;
            color: #ff4e50;
            font-size: 1.2em;
            line-height: 1.2;
        }

        .image-section {
            flex: 1;
            max-width: 50%;
        }

        .image-section img {
            max-width: 100%;
            height: auto;
            display: block;
        }
      .subscribe {
    text-align: center;
}

.subscribe-logo {
    width: 150px;
    height: auto;
    margin-bottom: 10px;
}

.subscribe button {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
}

.subscribe-button-logo {
    width: 150px;
    height: auto;
}footer {
    background-color: #ffe4e1;
    padding: 40px 20px;
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

.social-icons a {
    text-decoration: none;
    color: #ff69b4;
    font-size: 1.5em;
    margin: 0 5px;
    transition: color 0.3s ease;
}

.social-icons a:hover {
    color: #ff1493;
}

.social-icons a .fa-facebook-f { content: url('https://path-to-your/facebook-icon.png'); }
.social-icons a .fa-twitter { content: url('https://path-to-your/twitter-icon.png'); }
.social-icons a .fa-instagram { content: url('https://path-to-your/instagram-icon.png'); }
.social-icons a .fa-youtube { content: url('https://path-to-your/youtube-icon.png'); }
.social-icons a .fa-linkedin { content: url('https://path-to-your/linkedin-icon.png'); }
.social-icons a .fa-pinterest { content: url('https://path-to-your/pinterest-icon.png'); }

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
    <header style="background-image: url(redbg.jpg);">
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="About.html">About</a></li>
                <li><a href="Contact.html">Contact Us</a></li>
                <li><a href="login.php" class="login-btn">Login</a></li>
                <li><a href="signup.php" class="signup-btn">Sign up</a></li>
                <li><a href="admin-login.php" class="login-btn">Admin login</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="overlay">
            <h1>Welcome to Giftians Rishta</h1>
            <p>Your trusted matchmaking service in Pakistan. Connecting hearts worldwide with authenticity and care.</p>
            <div class="video-box">
                <h2>How to find a match?</h2>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/33VbPFBsCX0?si=QILfBOq8ALxQ0kvH" 
                title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media;
                 gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                 Click here to know</iframe>
            </div>
        </div>
    </section>

    <section class="why-simple-rishta">
        <div class="container">
            <div class="content">
                <h2>Why Giftians Rishta</h2>
                <p>Experience a modern approach to matchmaking with Simple Rishta, one of the leading matrimonial sites in Pakistan. Traditional methods like referrals, classified ads for ‘zaroorat -e- rishta,’ and marriage bureaus have proven effective in the past, they often present limited options. Simple Rishta provides a seamless experience whether you’re searching locally or internationally. Our extensive network connects families not just in Pakistan, but across the globe. Your ideal match could be just a click away, with profiles spanning from Pakistan to the Middle East, the UK, the USA, Canada, Australia, Europe, and beyond. Trust Simple Rishta matrimonial site to help you find the connection you’ve been searching for.</p>
                <ul>
                    <li>✔ Our registration process is simple and easy.</li>
                    <li>✔ We prioritize data security and respect candidate privacy.</li>
                    <li>✔ Utilizes the latest technology for efficient matchmaking.</li>
                    <li>✔ We don’t disclose information of candidates without their permission.</li>
                    <li>✔ Saves users time by narrowing down their search.</li>
                    <li>✔ Cost-effective services.</li>
                </ul>
            </div>
            <img src="pic2.webp" alt="Why Simple Rishta">
        </div>
    </section>

    <section class="responsibilities">
        <h2>Our Responsibilities</h2>
        <div class="container">
            <div class="responsibility">
                <img src="ficon.webp" alt="Profile">
                <h3>Create Profile</h3>
                <p>Register and create your profile by filling out your information.</p>
            </div>
            <div class="responsibility">
                <img src="sicon.webp" alt="Search">
                <h3>Search</h3>
                <p>Search for compatible profiles using our advanced search filters.</p>
            </div>
            <div class="responsibility">
                <img src="ticon.webp" alt="Contact">
                <h3>Contact</h3>
                <p>Contact profiles that interest you through our secure messaging system.</p>
            </div>
            <div class="responsibility">
                <img src="fricon.webp" alt="Match">
                <h3>Match</h3>
                <p>Find your perfect match and start your journey together.</p>
            </div>
        </div>
    </section>

    <section class="getting-started">
        <h2>Getting Started</h2>
        <p>Welcome to Simple Rishta, the premier matrimonial site designed to help you find your ideal partner. Our platform is user-friendly and secure, ensuring that your journey to find a match is smooth and efficient. Whether you're searching for a partner locally or internationally, Simple Rishta offers a range of features to help you connect with potential matches.</p>
    </section>

    <section class="registration-container">
        <div class="registration-text">
            <h2><b>Registration & Verification:</b></h2>
            <p>Directly login using your Google or Facebook account or follow the simple steps to get yourself registered with us:</p>
            <ul>
                <li>Click the register button.</li>
                <li>Enter your email and select your preferred password.</li>
                <li>Agree to the terms & conditions.</li>
                <li>Click on the “Register” button to proceed.</li>
                <li>Verify yourself by the provided email verification link to your email inbox.</li>
            </ul>
            <h2>Profile Creation:</h2>
            <p>After completing the verification process, you will be redirected to the Simple Rishta Dashboard.</p>
            <ul>
                <li>Add personal details, preferences, employment, education, accommodation, and family info.</li>
                <li>Upload your latest photograph.</li>
                <li>You can provide extra information in the “Tell us more about you” section.</li>
                <li>Fill all pages and hit the “Complete” button.</li>
            </ul>
            <p>The more comprehensively you add your information on Simple Rishta, the easier it becomes for others to contact you.</p>
        </div>
        <div class="image-section">
            <img src="01.png" alt="Registration & Profile Creation Steps">
        </div>
    </section>

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
            <p>MaidaButt@gmail.com</p>
            <p>cheema8044@gmail.com</p>
            <div class="social-icons">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                <a href="#" aria-label="Pinterest"><i class="fab fa-pinterest"></i></a>
            </div>
        </div>
    </div>
    <div class="copyright">
        <p>© 2024 Matchmaking. All Rights Reserved | Developed by <a href="#">Maida Butt</a>, <a href="#">Noman Cheema</a></p>
    </div>
</footer>

</footer>


</body>
</html>
