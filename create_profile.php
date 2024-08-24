<?php
session_start();  // Start the session

if (!isset($_SESSION['userid'])) {
    // If the user is not logged in, redirect to login page
    header("Location: login.php");
    exit;
}

require_once 'config.php';  // Include the database configuration file

function generateUserId($conn) {
    do {
        $unique_number = rand(1000, 9999);
        $userid = "SMSU" . $unique_number;

        // Check if the generated userid is unique
        $stmt = $conn->prepare("SELECT COUNT(*) FROM profiles WHERE userid = :userid");
        $stmt->execute(['userid' => $userid]);
        $count = $stmt->fetchColumn();
    } while ($count > 0);

    return $userid;
}

$generated_userid = generateUserId($conn);  // Generate the userid
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Svadharmam - Sadhana Recorder Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Svadharmam - Sadhana Recorder Profile</h2>
        <form method="POST" action="insert_profile.php">
            <div class="row mb-3">
            <div class="col-md-6">
                <label for="userid" class="form-label">User ID</label>
                <input type="text" class="form-control" id="userid" name="userid" value="<?php echo $generated_userid; ?>" readonly>
                </div>
                <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-md-6">
                    <label for="dikksha_name" class="form-label">Dikksha Name</label>
                    <input type="text" class="form-control" id="dikksha_name" name="dikksha_name" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="phone_no" class="form-label">Phone No (Own)</label>
                    <input type="text" class="form-control" id="phone_no" name="phone_no" required>
                </div>
                <div class="col-md-6">
                    <label for="father_name" class="form-label">Father's Name</label>
                    <input type="text" class="form-control" id="father_name" name="father_name" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="gurudev_name" class="form-label">Gurudev's Name</label>
                    <input type="text" class="form-control" id="gurudev_name" name="gurudev_name" required>
                </div>
                <div class="col-md-6">
                    <label for="counselor_name" class="form-label">Counselor's Name</label>
                    <input type="text" class="form-control" id="counselor_name" name="counselor_name" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="counselor_phone_no" class="form-label">Counselor's Phone Number</label>
                    <input type="text" class="form-control" id="counselor_phone_no" name="counselor_phone_no" required>
                </div>
                <div class="col-md-6">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="educational_qualifications" class="form-label">Educational Qualifications</label>
                    <textarea class="form-control" id="educational_qualifications" name="educational_qualifications"></textarea>
                </div>
                <div class="col-md-6">
                    <label for="study_occupation_organization" class="form-label">Study/Occupation and Organization</label>
                    <textarea class="form-control" id="study_occupation_organization" name="study_occupation_organization"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="present_address" class="form-label">Present Address</label>
                    <textarea class="form-control" id="present_address" name="present_address" required></textarea>
                </div>
                <div class="col-md-6">
                    <label for="permanent_address" class="form-label">Permanent Address</label>
                    <textarea class="form-control" id="permanent_address" name="permanent_address" required></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="iskcon_connection_days" class="form-label">How Many Days are You Connected to ISKCON?</label>
                    <input type="number" class="form-control" id="iskcon_connection_days" name="iskcon_connection_days" required>
                </div>
                <div class="col-md-6">
                    <label for="daily_chant_rounds" class="form-label">How Many Rounds You Daily Chant?</label>
                    <input type="number" class="form-control" id="daily_chant_rounds" name="daily_chant_rounds" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="regular_chant_days" class="form-label">How Many Days You Chant Regularly?</label>
                    <input type="number" class="form-control" id="regular_chant_days" name="regular_chant_days" required>
                </div>
                <div class="col-md-6">
                    <label for="granthas_read" class="form-label">Which Granthas Have You Read?</label>
                    <textarea class="form-control" id="granthas_read" name="granthas_read"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="mangal_aarti_regularly" class="form-label">Attend Mangal Aarti Regularly?</label>
                    <select class="form-control" id="mangal_aarti_regularly" name="mangal_aarti_regularly" required>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="nearest_iskcon_temple" class="form-label">Nearest ISKCON Temple</label>
                    <input type="text" class="form-control" id="nearest_iskcon_temple" name="nearest_iskcon_temple" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Create Profile</button>
        </form>
        <br><br>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
