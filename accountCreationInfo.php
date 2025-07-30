<?php
include 'connection.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Retrieve or set user_id
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("Location: accountCreationInfo.php");
    exit();
}

// Check current step
$step = isset($_POST['step']) ? (int)$_POST['step'] : 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($step == 1) {
      echo 'hulllo';
        $_SESSION['personal_info'] = [
            'name' => $_POST['name'],
            'age' => $_POST['age'],
            'gender' => $_POST['gender'],
            'height' => $_POST['height'],
            'caste' => $_POST['caste'],
            'religion' => $_POST['religion'],
            'dob' => $_POST['dob'],
            'address' => $_POST['address'],
            'email' => $_POST['email'],
            'contact' => isset($_POST['contact']) ? implode(',', $_POST['contact']) : ''
        ];
    } elseif ($step == 2) {
        $_SESSION['job_details'] = [
            'income' => $_POST['income'],
            'job_title' => $_POST['job-title'],
            'designation' => $_POST['designation'],
            'earning' => $_POST['earning']
        ];
    } elseif ($step == 3) {
        $_SESSION['property_details'] = [
            'siblings' => $_POST['siblings'],
            'married_persons' => $_POST['married_persons'],
            'father_occupation' => $_POST['father_occupation'],
            'mother_occupation' => $_POST['mother_occupation']
        ];
    } elseif ($step == 4) {
        $_SESSION['family_information'] = [
            'education_degree' => $_POST['education_degree'],
            'education_institute' => $_POST['education_institute'],
            'education_year' => $_POST['education_year']
        ];
    } elseif ($step == 5) {
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $_SESSION['image'] = $_FILES['image']['name'];
        }
    }

    // Move to the next step
    $next_step = $step + 1;
    echo "<a href='form.php?step=$next_step'>Go to Step $next_step</a>";

    // Check if the last step is completed
    if ($step == 5) {
        // Save all session data to the database
        $personal_info = $_SESSION['personal_info'];
        $job_details = $_SESSION['job_details'];
        $property_details = $_SESSION['property_details'];
        $family_information = $_SESSION['family_information'];
        $image = isset($_SESSION['image']) ? $_SESSION['image'] : '';

        // Insert or update user information in the database
        $sql = "INSERT INTO users (user_id, name, age, gender, height, caste, religion, dob, address, email, contact)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE name = VALUES(name), age = VALUES(age), gender = VALUES(gender), height = VALUES(height), caste = VALUES(caste), religion = VALUES(religion), dob = VALUES(dob), address = VALUES(address), contact = VALUES(contact)";

        $stmt = $connection->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sissssssss", 
                $user_id,
                $personal_info['name'],
                $personal_info['age'],
                $personal_info['gender'],
                $personal_info['height'],
                $personal_info['caste'],
                $personal_info['religion'],
                $personal_info['dob'],
                $personal_info['address'],
                $personal_info['email'],
                $personal_info['contact']
            );
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Error preparing user insert statement.";
        }

        // Save job details
        $sql = "INSERT INTO job_details (user_id, income, job_title, designation, earning)
                VALUES (?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE income = VALUES(income), job_title = VALUES(job_title), designation = VALUES(designation), earning = VALUES(earning)";

        $stmt = $connection->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sssss", 
                $user_id,
                $job_details['income'],
                $job_details['job_title'],
                $job_details['designation'],
                $job_details['earning']
            );
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Error preparing job details insert statement.";
        }

        // Save property details
        $sql = "INSERT INTO property_details (user_id, siblings, married_persons, father_occupation, mother_occupation)
                VALUES (?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE siblings = VALUES(siblings), married_persons = VALUES(married_persons), father_occupation = VALUES(father_occupation), mother_occupation = VALUES(mother_occupation)";

        $stmt = $connection->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("iisss", 
                $user_id,
                $property_details['siblings'],
                $property_details['married_persons'],
                $property_details['father_occupation'],
                $property_details['mother_occupation']
            );
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Error preparing property details insert statement.";
        }

        // Save family information
        $sql = "INSERT INTO family_information (user_id, education_degree, education_institute, education_year)
                VALUES (?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE education_degree = VALUES(education_degree), education_institute = VALUES(education_institute), education_year = VALUES(education_year)";

        $stmt = $connection->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ssss", 
                $user_id,
                $family_information['education_degree'],
                $family_information['education_institute'],
                $family_information['education_year']
            );
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Error preparing family information insert statement.";
        }

        // Handle file upload
        if ($image) {
            $upload_dir = 'uploads/';
            $upload_file = $upload_dir . basename($image);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
                $sql = "UPDATE users SET image = ? WHERE user_id = ?";
                $stmt = $connection->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param("ss", $image, $user_id);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "Error preparing image update statement.";
                }
            } else {
                echo "Error moving uploaded file.";
            }
        }

        // Clear session data
        session_unset();
        session_destroy();

        echo "Data saved successfully. Thank you!";
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
    <title>Personal Information</title>
    <style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-image: url(redbg.jpg);
}

#logo {
    display: block;
    margin: 20px auto;
    max-width:  25%;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

.progress-bar {
    position: relative;
    height: 20px;
    background-color: #e0e0e0;
    border-radius: 10px;
    margin: 20px 0;
}

.progress-bar-fill {
    height: 100%;
    background-color: #811504;
    border-radius: 10px;
    transition: width 0.3s;
}

input[type="file"] {
    display: none;
}

.custom-file-upload {
    display: inline-block;
    padding: 10px 20px;
    background-color: #8c0505;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-right: 10px;
    margin-left: 10px; 
}

.custom-file-upload:hover {
    background-color: #c75817;
}

#file-name {
    margin-left: 10px;
    font-size: 14px;
    color: #333;
}

.steps {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.step {
    width: 20%;
    text-align: center;
    line-height: 40px;
    background-color: #e0e0e0;
    border-radius: 50%;
    color: #333;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s;
}

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

input[type="file"] {
    display: none;
}

.custom-file-upload {
    display: inline-block;
    padding: 10px 20px;
    background-color: #721e04f2;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-right: 10px;
    margin-left: 10px;
}

.custom-file-upload:hover {
    background-color: #db602f;
}

#file-name {
    margin-left: 10px;
    font-size: 14px;
    color: #333;
}
.property-item {
    margin-bottom: 10px;
}

.property-item input {
    display: block;
    margin: 5px 0;
    padding: 8px;
    width: 100%;
    box-sizing: border-box;
}

.property-item button {
    padding: 8px;
    background-color: #f44336;
    color: white;
    border: none;
    cursor: pointer;
}

.property-item button:hover {
    background-color: #d32f2f;
}

.add-property-button {
    padding: 10px;
    background-color: #8a5004;
    color: white;
    border: none;
    cursor: pointer;
    display: block;
    margin-top: 10px;
}

.add-property-button:hover {
    background-color: #a06f45;
}

.button-group {
    margin-top: 20px;
}

.button-group button {
    padding: 10px;
    background-color: #008CBA;
    color: white;
    border: none;
    cursor: pointer;
    margin-right: 10px;
}

.button-group button:hover {
    background-color: #844204;
}

.step.active {
    background-color:  #811504;
    color: #fff;
}

/* Step Content */
.step-content {
    display: none;
}

.step-content.active {
    display: block;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

.button-group {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.button-group button {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    background-color:  #811504;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s;
}

.button-group button:hover {
    background-color:  #811504;
}
.education-group {
  margin-bottom: 20px;
}

.education-group input[type="text"] {
  width: 100%;
  height: 20px;
  margin-bottom: 10px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 8px;
}

.achievement-group {
  margin-bottom: 20px;
}

.achievement-group input[type="text"] {
  width: 100%;
  height: 40px;
  margin-bottom: 10px;
  padding: 10px;
  border: 1px solid #ccc;
}

.remove-education, .remove-achievement {
  background-color: #f44336;
  color: #fff;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}

.remove-education:hover, .remove-achievement:hover {
  background-color: #e91e63;
}

/* Additional Styles for Dynamic Fields */
.contact-group,
.family-group,
.property-item,
.education-group,
.achievement-group {
    display: flex;
    align-items: center;
    gap: 10px;
}

.contact-group button,
.family-group button,
.property-item button,
.education-group button,
.achievement-group button {
    padding: 5px;
    border: none;
    border-radius: 4px;
    background-color:  #9c4032;
    color: #fff;
    cursor: pointer;
}

.contact-group button:hover,
.family-group button:hover,
.property-item button:hover,
.education-group button:hover,
.achievement-group button:hover {
    background-color:  #811504;;
}

.horizontal-group {
    display: flex;
    align-items: center;
}

.horizontal-group input {
    margin-right: 10px;
}

.horizontal-group button {
    margin-left: 10px;
}
#add-property {
  background-color: #670a06; 
  color: #ffffff; 
  border: none; 
  padding: 10px 20px; 
  font-size: 16px; 
  cursor: pointer; 
}

#add-property:hover {
  background-color: #cb6211; 
}

#add-property:active {
  background-color: #942009; 
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

#properties-container,
#education-container,
#achievements-container {
    margin-bottom: 20px;
}
#add-education, #add-achievement {
  background-color: #862406;
  color: #fff;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
  margin-top: 20px;
}

#add-education:hover, #add-achievement:hover {
  background-color: #6d0f06;
}

#add-education:focus, #add-achievement:focus {
  outline: none;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.property-group,
.education-group,
.achievement-group {
    margin-bottom: 10px;
}

.property-item,
.education-group,
.achievement-group {
    display: flex;
    align-items: center;
    gap: 10px;
}

    </style>
</head>
<body>
   
            <img id="logo" src="logo.png" alt="Logo">
            <div class="container">
                <h1>CANDIDATE Information</h1>
        
                <div class="progress-bar">
                    <div class="progress-bar-fill" style="width: 0%;"></div>
                </div>
        
                <div class="steps">
                    <div class="step active" data-step="1">1</div>
                    <div class="step" data-step="2">2</div>
                    <div class="step" data-step="3">3</div>
                    <div class="step" data-step="4">4</div>
                    <div class="step" data-step="5">5</div>
                </div>
        
                <div class="content">
                    <!-- Step 1: Personal Information -->
                    <div class="step-content" data-step-content="1">
                        <h2>Personal Information</h2>
                        <form id="personal-info-form">
                            <!-- Existing personal info fields -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" id="age" name="age" required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select id="gender" name="gender" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="height">Height</label>
                                <input type="text" id="height" name="height" required>
                            </div>
                            <div class="form-group">
                                <label for="caste">Caste</label>
                                <input type="text" id="caste" name="caste" required>
                            </div>
                            <div class="form-group">
                                <label for="religion">Religion</label>
                                <input type="text" id="religion" name="religion" required>
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" id="dob" name="dob" required>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact No</label>
                                <div id="contact-container">
                                    <div class="contact-group">
                                        <input type="text" id="contact" name="contact[]" required>
                                        <button type="button" onclick="addContactField()">+</button>
                                    </div>
                                </div>
                            </div>
                            <div id="additional-fields">
                                <div class="horizontal-group form-group">
                                    <label for="address">Address</label><br>
                                    <input type="text" id="address" name="address" required>
                                </div>
                                <div class="horizontal-group form-group">
                                    <label for="email">Email ID</label><br>
                                    <input type="email" id="email" name="email" required>
                                </div>
                                <div class="horizontal-group form-group">
                                    <label for="image">Image</label><br><br>
                                    <label class="custom-file-upload">
                                        <input type="file" id="image" name="image">
                                        Upload Image
                                    </label>
                                    <span id="file-name"></span>
                                </div>
                            </div>
                            <div class="button-group">
                                <button type="button"  onclick="window.location.href='firstpage.html'">Previous</button>
                                <button type="button" onclick="next()">Next</button>
                            </div>
                        </form>
                    </div>
        
                    <!-- Step 2: Job Details -->
                    <div class="step-content" data-step-content="2">
                        <h2>Job Details</h2>
                        <form id="job-details-form">
                            <div class="form-group">
                                <label for="income">Income</label>
                                <input type="number" id="income" name="income" required>
                            </div>
                            <div class="form-group">
                                <label for="job-title">Job Title</label>
                                <input type="text" id="job-title" name="job-title" required>
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input type="text" id="designation" name="designation" required>
                            </div>
                            <div class="form-group">
                                <label for="earning">Earning</label>
                                <input type="number" id="earning" name="earning" required>
                            </div>
                            <div class="button-group">
                                <button type="button" onclick="previous()">Previous</button>
                                <button type="button" onclick="next()">Next</button>
                            </div>
                        </form>
                    </div>
        
                    <!-- Step 3: Property Details -->
                    <div class="step-content" data-step-content="3">
                        <h2>Property Details</h2>
                        <form id="property-details-form">
                          <div id="properties-container">
                            <!-- Property group template -->
                            <div class="property-group">
                              <label>Properties</label>
                              <div class="property-item">
                                <input type="text" class="property-name" placeholder="Property Name">
                                <input type="number" class="property-price" placeholder="Price">
                                <input type="text" class="property-location" placeholder="Location">
                                <input type="text" class="property-size" placeholder="Size">
                                <button type="button" class="remove-property">Remove</button>
                              </div>
                            </div>
                            <button type="button" id="add-property">Add Property</button>
                          </div>
                          <div class="button-group">
                            <button type="button" id="previous">Previous</button>
                            <button type="button" id="next">Next</button>
                          </div>
                        </form>
                      </div>
                    <!-- Step 4: Family Information -->
                    <div class="step-content" data-step-content="4">
                        <h2>Family Information</h2>
                        <form id="family-info-form">
                            <div class="form-group">
                                <label for="siblings">Number of Siblings</label>
                                <div id="siblings-container">
                                    <div class="family-group">
                                        <input type="number" id="siblings" name="siblings" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="married-persons">Married Persons in House</label>
                                <input type="number" id="married-persons" name="married-persons" required>
                            </div>
                            <div class="form-group">
                                <label for="father-occupation">Father's Occupation</label>
                                <input type="text" id="father-occupation" name="father-occupation" required>
                            </div>
                            <div class="form-group">
                                <label for="mother-occupation">Mother's Occupation</label>
                                <input type="text" id="mother-occupation" name="mother-occupation" required>
                            </div>
                            <div class="button-group">
                                <button type="button" onclick="previous()">Previous</button>
                                <button type="button" onclick="next()">Next</button>
                            </div>
                        </form>
                    </div>
        
                    <!-- Step 5: Educational Details -->
                    <div class="step-content" data-step-content="5">
                        <h2>Educational Details</h2>
                        <form id="educational-details-form" action="profile.html">
                          <div id="education-container">
                            <!-- Education group template -->
                            <div class="education-group">
                              <label>Educational Qualification</label>
                              <input type="text" class="education-degree" placeholder="Degree">
                              <input type="text" class="education-institute" placeholder="Institute">
                              <input type="text" class="education-year" placeholder="Year">
                              <button type="button" class="remove-education">Remove</button>
                            </div>
                          </div>
                          <button type="button" id="add-education">Add Qualification</button><br><br>
                          <div class="form-group">
                            <label for="achievements">Achievements</label>
                            <div id="achievements-container">
                              <div class="achievement-group">
                                <input type="text" name="achievements[]" placeholder="Achievement">
                                <button type="button" class="remove-achievement">Remove</button>
                              </div>
                            </div>
                            <button type="button" id="add-achievement">Add Achievement</button>
                          </div>
                          <div class="button-group">
                            <button type="button" id="previous" onclick="previous()">Previous</button>
                            <button type="submit">Submit</button>
                          </div>
                        </form>
                      </div>
    
    <script>
      document.getElementById('image').addEventListener('change', function() {
  const fileName = this.files[0]? this.files[0].name : 'No file chosen';
  document.getElementById('file-name').textContent = fileName;
});

document.addEventListener('DOMContentLoaded', function() {
  let currentStep = 1;
  const totalSteps = 6; 

  function updateForm() {
 
    const progress = (currentStep / totalSteps) * 100;
    document.querySelector('.progress-bar-fill').style.width = `${progress}%`;

    document.querySelectorAll('.step-content').forEach((step) => {
      step.classList.toggle('active', step.getAttribute('data-step-content') == currentStep);
    });

    document.querySelectorAll('.step').forEach((step) => {
      step.classList.toggle('active', step.getAttribute('data-step') == currentStep);
    });
  }

  function next() {
    if (currentStep < totalSteps) {
      currentStep++;
      updateForm();
    }
  }

  function previous() {
    if (currentStep > 1) {
      currentStep--;
      updateForm();
    }
  }

  function addContactField() {
    const contactContainer = document.getElementById('contact-container');
    const contactGroup = document.createElement('div');
    contactGroup.className = 'contact-group';
    contactGroup.innerHTML = `
      <input type="text" name="contact[]" required>
      <button type="button" onclick="this.parentElement.remove()">Remove</button>
    `;
    contactContainer.appendChild(contactGroup);
  }

  function addProperty() {
    const propertiesContainer = document.getElementById('properties-container');
    const propertyGroup = document.createElement('div');
    propertyGroup.className = 'property-group';
    propertyGroup.innerHTML = `
      <label>Properties</label>
      <div class="property-item">
        <input type="text" class="property-name" placeholder="Property Name">
        <input type="number" class="property-price" placeholder="Price">
        <input type="text" class="property-location" placeholder="Location">
        <input type="text" class="property-size" placeholder="Size">
        <button type="button" class="remove-property">Remove</button>
      </div>
    `;
    propertiesContainer.appendChild(propertyGroup);
  }

  function removeProperty(e) {
    if (e.target.classList.contains('remove-property')) {
      e.target.parentNode.parentNode.remove();
    }
  }

  const educationContainer = document.getElementById('education-container');
  const addEducationButton = document.getElementById('add-education');
  const achievementsContainer = document.getElementById('achievements-container');
  const addAchievementButton = document.getElementById('add-achievement');
  const previousButton = document.getElementById('previous');
  const propertiesContainer = document.getElementById('properties-container');
  const addPropertyButton = document.getElementById('add-property');

  addEducationButton.addEventListener('click', addEducation);
  addAchievementButton.addEventListener('click', addAchievement);
  previousButton.addEventListener('click', previous);
  addPropertyButton.addEventListener('click', addProperty);

  function addEducation() {
    const educationGroup = document.createElement('div');
    educationGroup.classList.add('education-group');
    educationGroup.innerHTML = `
      <label>Educational Qualification</label>
      <input type="text" class="education-degree" placeholder="Degree">
      <input type="text" class="education-institute" placeholder="Institute">
      <input type="text" class="education-year" placeholder="Year">
      <button type="button" class="remove-education">Remove</button>
    `;
    educationContainer.appendChild(educationGroup);
  }

  function addAchievement() {
    const achievementGroup = document.createElement('div');
    achievementGroup.classList.add('achievement-group');
    achievementGroup.innerHTML = `
      <input type="text" name="achievements[]" placeholder="Achievement">
      <button type="button" class="remove-achievement">Remove</button>
    `;
    achievementsContainer.appendChild(achievementGroup);
  }

  educationContainer.addEventListener('click', (e) => {
    if (e.target.classList.contains('remove-education')) {
      e.target.parentNode.remove();
    }
  });

  achievementsContainer.addEventListener('click', (e) => {
    if (e.target.classList.contains('remove-achievement')) {
      e.target.parentNode.remove();
    }
  });

  propertiesContainer.addEventListener('click', (e) => {
    if (e.target.classList.contains('remove-property')) {
      e.target.parentNode.parentNode.remove();
    }
  });

  document.querySelectorAll('.button-group button').forEach(button => {
    button.addEventListener('click', function() {
      if (this.textContent === 'Next') {
        next();
      } else if (this.textContent === 'Previous') {
        previous();
      }
    });
  });

  updateForm();

  window.addContactField = addContactField;
  window.addAddressField = addAddressField;
  window.addEmailField = addEmailField;
  window.removeImage = removeImage;
  window.addProperty = addProperty;
  window.removeProperty = removeProperty;
  window.addSiblingField = addSiblingField;
  window.addEducation = addEducation;
  window.removeEducation = removeEducation;
  window.addAchievement = addAchievement;
  window.removeAchievement = removeAchievement;
});

    </script>
</body>
</html>
