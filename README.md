# 💕 Matchmaking-Web

A full-stack **Matchmaking Web Application** that helps users discover compatible life partners based on detailed personal profiles, preferences, and filters. The system offers two plans — Free and Premium — each with different access levels for viewing and connecting with other users.

---

## 🎯 Objective

The main objective of this project is to create an intuitive, secure, and responsive matchmaking platform where users can:

- Sign up and manage detailed personal profiles.
- View other users’ profiles based on plan (free/premium).
- Upgrade to premium for advanced features.
- Use filters to find compatible matches.
- Ensure privacy and structured data handling.

---

## 💡 Key Features

- 📝 Multi-step Registration (Personal, Family, Job, Education, Property Info)
- 👤 Free & Premium Plans (Upgrade System)
- 🔒 Secure Login / Signup
- 📸 Profile Picture Uploads with Active Status Border
- 🔍 Match Filtering (Age, City, Profession, etc.)
- 🚫 Restricted Profile View for Free Users (Popup shown)
- 🧾 Admin Panel to Manage User Plans and Status

---

## 🛠️ Technologies Used

### 🔹 Frontend:
- HTML5, CSS3, JavaScript

### 🔹 Backend:
- PHP (Core PHP)
- MySQL

---

## 🚀 How to Run

### Step-by-Step Setup Instructions:

1. **Clone the Repository**  
   Open your terminal and run:
   ```bash
   git clone https://github.com/yourusername/Matchmaking-Web.git
Create the MySQL Database

Open phpMyAdmin

Create a new database (e.g., matchmaking_db)

Import the provided SQL file:

pgsql
Copy
Edit
/database/matchmaking_db.sql
Update Database Connection
Open the file db.php (or your database config file) and update with your local credentials:

php
Copy
Edit
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'matchmaking_db';
Start XAMPP Services

Open XAMPP

Start Apache and MySQL

Run the Project

Open your browser

Navigate to:
http://localhost/Matchmaking/index.php
##📁 Folder Structure
Matchmaking-Web/
├── assets/
├── css/
├── js/
├── php/
│   ├── login.php
│   ├── signup.php
│   ├── upgradePlan.php
│   └── profile.php
├── accountCreationInfo/
├── dashboard/
├── profileofcandidate.html
├── database/
│   └── matchmaking_db.sql
└── README.md
📌 Notes
Free users can only see limited profile details. A popup is triggered for full access.

Premium users can view full profiles and status.

Profile borders are color-coded to indicate active users.

##👑 Admin Access
A basic admin panel is included to manage:

User plan upgrades

Profile approval/status

General backend user data

##🔐 Security
Passwords are hashed before storing.

Sessions are used for login security.

Profile access is controlled based on subscription level.

##💬 Support
For issues or customization requests, feel free to open an issue in the repo or drop a message.
