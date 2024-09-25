<?php
// Include database config file
require 'config.php';

// Generate a unique user ID (smsuXXXX)
function generateUserId() {
    return 'SMSU' . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture data from the profile form
    $generated_userid = generateUserId();
    $email = $_POST['email'];
    $name = $_POST['name'];
    $dikksha_name = $_POST['dikksha_name'];
    $phone_no = $_POST['phone_no'];
    $father_name = $_POST['father_name'];
    $gurudev_name = $_POST['gurudev_name'];
    $counselor_name = $_POST['counselor_name'];
    $counselor_phone_no = $_POST['counselor_phone_no'];
    $date_of_birth = $_POST['date_of_birth'];
    $educational_qualifications = $_POST['educational_qualifications'];
    $study_occupation_organization = $_POST['study_occupation_organization'];
    $present_address = $_POST['present_address'];
    $permanent_address = $_POST['permanent_address'];
    $iskcon_connection_days = $_POST['iskcon_connection_days'];
    $daily_chant_rounds = $_POST['daily_chant_rounds'];
    $regular_chant_days = $_POST['regular_chant_days'];
    $granthas_read = $_POST['granthas_read'];
    $mangal_aarti_regularly = $_POST['mangal_aarti_regularly'];
    $nearest_iskcon_temple = $_POST['nearest_iskcon_temple'];

    // Store the profile data into the database
    $query = "INSERT INTO profiles (userid, email, name, dikksha_name, phone_no, father_name, gurudev_name, counselor_name, counselor_phone_no, date_of_birth, educational_qualifications, study_occupation_organization, present_address, permanent_address, iskcon_connection_days, daily_chant_rounds, regular_chant_days, granthas_read, mangal_aarti_regularly, nearest_iskcon_temple) 
              VALUES (:userid, :email, :name, :dikksha_name, :phone_no, :father_name, :gurudev_name, :counselor_name, :counselor_phone_no, :date_of_birth, :educational_qualifications, :study_occupation_organization, :present_address, :permanent_address, :iskcon_connection_days, :daily_chant_rounds, :regular_chant_days, :granthas_read, :mangal_aarti_regularly, :nearest_iskcon_temple)";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':userid', $generated_userid);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':dikksha_name', $dikksha_name);
    $stmt->bindParam(':phone_no', $phone_no);
    $stmt->bindParam(':father_name', $father_name);
    $stmt->bindParam(':gurudev_name', $gurudev_name);
    $stmt->bindParam(':counselor_name', $counselor_name);
    $stmt->bindParam(':counselor_phone_no', $counselor_phone_no);
    $stmt->bindParam(':date_of_birth', $date_of_birth);
    $stmt->bindParam(':educational_qualifications', $educational_qualifications);
    $stmt->bindParam(':study_occupation_organization', $study_occupation_organization);
    $stmt->bindParam(':present_address', $present_address);
    $stmt->bindParam(':permanent_address', $permanent_address);
    $stmt->bindParam(':iskcon_connection_days', $iskcon_connection_days);
    $stmt->bindParam(':daily_chant_rounds', $daily_chant_rounds);
    $stmt->bindParam(':regular_chant_days', $regular_chant_days);
    $stmt->bindParam(':granthas_read', $granthas_read);
    $stmt->bindParam(':mangal_aarti_regularly', $mangal_aarti_regularly);
    $stmt->bindParam(':nearest_iskcon_temple', $nearest_iskcon_temple);
    
    if ($stmt->execute()) {
        // Store user ID in the session
        session_start();
        $_SESSION['userid'] = $generated_userid; // Store the generated user ID
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        $_SESSION['phone'] = $phone_no;
        header('Location: setup_password.php');
        exit();
    } else {
        echo "<div class='alert alert-danger'>Failed to create profile. Please try again.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">User Signup Form</h2>
    <form method="POST" action="signup.php">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-md-6">
                <label for="dikksha_name" class="form-label">Dikksha Name</label>
                <input type="text" class="form-control" id="dikksha_name" name="dikksha_name">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="phone_no" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_no" name="phone_no" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="father_name" class="form-label">Father's Name</label>
                <input type="text" class="form-control" id="father_name" name="father_name">
            </div>
            <div class="col-md-6">
                <label for="gurudev_name" class="form-label">Gurudev's Name</label>
                <input type="text" class="form-control" id="gurudev_name" name="gurudev_name">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="counselor_name" class="form-label">Counselor's Name</label>
                <input type="text" class="form-control" id="counselor_name" name="counselor_name">
            </div>
            <div class="col-md-6">
                <label for="counselor_phone_no" class="form-label">Counselor's Phone Number</label>
                <input type="text" class="form-control" id="counselor_phone_no" name="counselor_phone_no">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="date_of_birth" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
            </div>
            <div class="col-md-6">
                <label for="educational_qualifications" class="form-label">Educational Qualifications</label>
                <input type="text" class="form-control" id="educational_qualifications" name="educational_qualifications">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="study_occupation_organization" class="form-label">Study/Occupation/Organization</label>
                <input type="text" class="form-control" id="study_occupation_organization" name="study_occupation_organization">
            </div>
            <div class="col-md-6">
                <label for="present_address" class="form-label">Present Address</label>
                <input type="text" class="form-control" id="present_address" name="present_address">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="permanent_address" class="form-label">Permanent Address</label>
                <input type="text" class="form-control" id="permanent_address" name="permanent_address">
            </div>
            <div class="col-md-6">
                <label for="iskcon_connection_days" class="form-label">Days in ISKCON Connection</label>
                <input type="number" class="form-control" id="iskcon_connection_days" name="iskcon_connection_days">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="daily_chant_rounds" class="form-label">Daily Chant Rounds</label>
                <input type="number" class="form-control" id="daily_chant_rounds" name="daily_chant_rounds">
            </div>
            <div class="col-md-6">
                <label for="regular_chant_days" class="form-label">Days Chanting Regularly</label>
                <input type="number" class="form-control" id="regular_chant_days" name="regular_chant_days">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="granthas_read" class="form-label">Granthas Read</label>
                <input type="text" class="form-control" id="granthas_read" name="granthas_read">
            </div>
            <div class="col-md-6">
                <label for="mangal_aarti_regularly" class="form-label">Attending Mangal Aarti Regularly?</label>
                <input type="text" class="form-control" id="mangal_aarti_regularly" name="mangal_aarti_regularly">
            </div>
        </div>

        <div class="mb-3">
            <label for="nearest_iskcon_temple" class="form-label">Nearest ISKCON Temple</label>
            <input type="text" class="form-control" id="nearest_iskcon_temple" name="nearest_iskcon_temple">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
