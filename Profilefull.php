<?php
session_start();
include 'connection.php';

// Check if userId is set
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['userId'];

// Fetch user data
$userQuery = "SELECT * FROM User WHERE userId = ?";
$stmt = $conn->prepare($userQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$userResult = $stmt->get_result()->fetch_assoc();

// Fetch payment data
$paymentQuery = "SELECT * FROM Payment WHERE userId = ?";
$stmt = $conn->prepare($paymentQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$paymentResult = $stmt->get_result()->fetch_assoc();

// Fetch property data
$propertyQuery = "SELECT * FROM PropertyDetails WHERE userId = ?";
$stmt = $conn->prepare($propertyQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$propertyResults = $stmt->get_result();

// Fetch educational data
$educationQuery = "SELECT * FROM EducationalInformation WHERE userId = ?";
$stmt = $conn->prepare($educationQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$educationResult = $stmt->get_result()->fetch_assoc();

// Fetch family data
$familyQuery = "SELECT * FROM FamilyDetails WHERE userId = ?";
$stmt = $conn->prepare($familyQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$familyResult = $stmt->get_result()->fetch_assoc();

// Fetch job data
$jobQuery = "SELECT * FROM JobDetails WHERE userId = ?";
$stmt = $conn->prepare($jobQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$jobResult = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('redbg.jpg');
            background-size: cover;
            background-position: center;
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
        .content {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #ff4e50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img.profile-image {
            width: 140px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
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
    <h1>Welcome, <?php echo htmlspecialchars($userResult['name']); ?></h1>
    <p>Email: <?php echo htmlspecialchars($userResult['email']); ?></p>
    <p>Username: <?php echo htmlspecialchars($userResult['username']); ?></p>
    <p>Religion: <?php echo htmlspecialchars($userResult['religion']); ?></p>
    <p>Caste: <?php echo htmlspecialchars($userResult['caste']); ?></p>
    <p>Height: <?php echo htmlspecialchars($userResult['height']); ?></p>
    <p>Address: <?php echo htmlspecialchars($userResult['address']); ?></p>
    <p>Age: <?php echo htmlspecialchars($userResult['age']); ?></p>
    <p>Gender: <?php echo htmlspecialchars($userResult['gender']); ?></p>
    <p>Phone Number: <?php echo htmlspecialchars($userResult['phoneNumber']); ?></p>
    <p>Marital Status: <?php echo htmlspecialchars($userResult['maritalStatus']); ?></p>
    <p>Profile Status: <?php echo htmlspecialchars($userResult['profileStatus']); ?></p>
    <p>Sect: <?php echo htmlspecialchars($userResult['sect']); ?></p>
    <p>Mother's Name: <?php echo htmlspecialchars($userResult['mothername']); ?></p>
    <p>Father's Name: <?php echo htmlspecialchars($userResult['fathername']); ?></p>

    <h2>Payments</h2>
    <p>Amount: <?php echo htmlspecialchars($paymentResult['amount']); ?></p>
    <p>Status: <?php echo htmlspecialchars($paymentResult['status']); ?></p>
    <p>Date: <?php echo htmlspecialchars($paymentResult['date']); ?></p>

    <h2>Properties</h2>
    <?php while ($property = $propertyResults->fetch_assoc()): ?>
        <p>Property Name: <?php echo htmlspecialchars($property['propertyName']); ?></p>
        <p>Size: <?php echo htmlspecialchars($property['propertySize']); ?> sq. ft.</p>
        <p>Prize: <?php echo htmlspecialchars($property['prize']); ?></p>
        <p>Location: <?php echo htmlspecialchars($property['location']); ?></p>
    <?php endwhile; ?>

    <h2>Education</h2>
    <p>Qualification: <?php echo htmlspecialchars($educationResult['qualification']); ?></p>
    <p>Achievements: <?php echo htmlspecialchars($educationResult['studyAchievements']); ?></p>

    <h2>Family</h2>
    <p>No. of Siblings: <?php echo htmlspecialchars($familyResult['noOfSiblings']); ?></p>
    <p>No. of Married Persons: <?php echo htmlspecialchars($familyResult['noOfMarriedPerson']); ?></p>
    <p>Father's Occupation: <?php echo htmlspecialchars($familyResult['fatherOccupation']); ?></p>
    <p>Mother's Occupation: <?php echo htmlspecialchars($familyResult['motherOccupation']); ?></p>

    <h2>Job</h2>
    <p>Job Title: <?php echo htmlspecialchars($jobResult['jobTitle']); ?></p>
    <p>Income: <?php echo htmlspecialchars($jobResult['income']); ?></p>
    <p>Designation: <?php echo htmlspecialchars($jobResult['designation']); ?></p>
</body>
</html>
