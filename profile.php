<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Connect to the database
$connection = new mysqli('localhost:3307', 'root', '', 'matchmaking');
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch user details
$sql = "SELECT * FROM users WHERE uid = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$userResult = $stmt->get_result();

if ($userResult->num_rows > 0) {
    $user = $userResult->fetch_assoc();
} else {
    echo "No user found.";
    exit();
}

// Fetch user profile details
$sql = "SELECT * FROM profiles WHERE user_id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$profileResult = $stmt->get_result();

if ($profileResult->num_rows > 0) {
    $profile = $profileResult->fetch_assoc();
} else {
    echo "No profile found.";
    exit();
}

// Fetch matches (all other users except the logged-in user)
$sql = "SELECT u.*, p.* FROM users u
        JOIN profiles p ON u.uid = p.user_id
        WHERE u.uid != ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$matchesResult = $stmt->get_result();

$matches = [];
while ($row = $matchesResult->fetch_assoc()) {
    $matches[] = $row;
}

$stmt->close();
$connection->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="">
    <style>
     body, html {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #f8f8f8;
        color: #333;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-image: url(redbg.jpg);
      }
header {
    background-color: #fff;
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
}

.nav-links a {
    margin: 0 15px;
    text-decoration: none;
    color: #ff4e50;
    font-weight: bold;
}

.nav-links a.upgrade {
        display: none; 
      }

      .nav-links a.premium {
        background-color: #28a745;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        text-decoration: none;
      }

      .nav-links a.premium:hover {
        background-color: #218838;
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
    border: 2px solid transparent;
}

.container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.profile-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.profile-header img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid transparent;
}

.active-profile {
    border-color: #ff4e50; 
}

.inactive-profile {
    border-color: transparent;
}

.limit-overview-container {
    margin: 20px 0;
    background-color: #f4f4f4;
    padding: 20px;
    border-radius: 10px;
}

.limit-overview {
    display: flex;
    justify-content: space-around;
}

.limit-overview div {
    text-align: center;
    flex: 1;
}

.limit-overview h3 {
    margin: 0;
    color: #ff4e50;
}

.matches-section {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}

.matches-section .match-card {
    background-color: #fff;
    color: #333;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    margin: 5px;
    width: 30%;
}

.profile-card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 5px;
}

.match-card h3 {
    margin: 10px 0 5px;
    font-size: 1.2em;
}

.match-card p {
    margin: 5px 0;
    color: #666;
}

.match-card a {
    text-decoration: none;
    color: #ff4e50;
    font-weight: bold;
    cursor: pointer;
}

footer {
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

.nav-links a.upgrade {
    display: inline-block;
    background-color:  #c6390a; 
    color: #fff; 
    padding: 5px 10px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
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

.popup-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
}

.popup-content {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.popup-content h2 {
    margin: 0 0 10px;
}

.popup-content p {
    margin: 0 0 20px;
}

.popup-content .close-popup {
    background: #ff4e50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.popup-content .close-popup:hover {
    background: #d63a3c;
}

    </style>
</head>

<header style="background-image: url('redbg.jpg');">
<div class="logo">
        <img src="logo.png" alt="Logo">
    </div>
    <div class="nav-links">
        <a href="#">Dashboard</a>
        <?php if (!$user['is_premium']) : ?>
            <a href="paymentplans.html" class="upgrade">Upgrade Plan</a>
        <?php endif; ?>
        <?php if ($user['is_premium']) : ?>
            <a href="#" class="premium">Premium User</a>
        <?php endif; ?>
    </div>
    <div class="nav-icons">
        <i class="fas fa-bell"></i>
        <i class="fas fa-envelope"></i>
        <img src="<?php echo htmlspecialchars($profile['profile_picture']); ?>" alt="Profile Picture" class="profile-pic">
    </div>
</header>

<div class="container">
    <div class="profile-header">
        <div>
            <img src="<?php echo htmlspecialchars($profile['profile_picture']); ?>" alt="Profile Picture" id="profile-picture">
            <h2><?php echo htmlspecialchars($profile['name']); ?></h2>
            <p>Matrimony ID: <?php echo htmlspecialchars($userId); ?></p>
            <p id="profile-status"><?php echo $user['is_premium'] ? 'Active Profile' : 'Inactive Profile'; ?></p>
        </div>
    </div>

    <div class="limit-overview-container">
        <h3>Limit Overview</h3>
        <div class="limit-overview">
            <div>
                <h3 id="contact-views">0/3</h3>
                <p>Contact Views</p>
            </div>
            <div>
                <h3 id="photo-views">0/3</h3>
                <p>Photo Views</p>
            </div>
            <div>
                <h3 id="chat-limit">0/15</h3>
                <p>Chat Limit</p>
            </div>
        </div>
    </div>

    <div class="matches-section">
        <?php
        foreach ($matches as $match) {
            echo '<div class="match-card">';
            echo '<div class="profile-card">';
            echo '<img src="' . htmlspecialchars($match['profile_picture']) . '" alt="Profile Picture">';
            echo '<h3>' . htmlspecialchars($match['name']) . '</h3>';
            echo '<p>Single | ' . htmlspecialchars($match['age']) . ' Years</p>';
            echo '<p>' . htmlspecialchars($match['location']) . '</p>';
            echo '<p>' . htmlspecialchars($match['religion']) . ' | ' . htmlspecialchars($match['profession']) . '</p>';
            echo '<p>' . htmlspecialchars($match['education']) . '</p>';
            echo '<a href="' . htmlspecialchars($match['profile_url']) . '" class="contact-btn" data-profile="' . htmlspecialchars($match['profile_url']) . '">Full Profile</a>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<footer>
    <div class="footer-content">
        <div class="quick-links">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="firstpage.html">Home</a></li>
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

<!-- Payment plans popup -->
<div class="popup-overlay" id="paymentPlansPopup">
    <div class="popup-content">
        <h2>Upgrade Required</h2>
        <p>To view and contact other users, please upgrade your plan.</p>
        <button class="close-popup" onclick="closePopup()">Close</button>
    </div>
</div> 

<!-- Premium User Profile Popup -->
<div class="popup-overlay" id="premiumProfilePopup">
    <div class="popup-content">
        <h2>View Profile</h2>
        <p>As a premium user, you can view this profile.</p>
        <button class="close-popup" onclick="closePopup()">Close</button>
    </div>
</div>

<script>
    function closePopup() {
        document.querySelectorAll('.popup-overlay').forEach(function(popup) {
            popup.style.display = 'none';
        });
    }

    document.querySelectorAll('.contact-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            if (document.querySelector('#profile-status').textContent === 'Active Profile') {
                window.location.href = btn.getAttribute('data-profile');
            } else {
                document.getElementById('paymentPlansPopup').style.display = 'flex';
            }
        });
    });
</script>
</body>
</html>