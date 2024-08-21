<?php
session_start();

require_once 'config.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'admin') {
    header("Location: noaccess.php");
    exit;
}

// Fetch the profile details
$id = $_GET['id'];
$sql = "SELECT * FROM profiles WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$profile = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$profile) {
    echo "Profile not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Svadharmam Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container mt-5 form-container">
        <h2>Edit Profile</h2>
        <form method="POST" action="edit_profile_process.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($profile['id']); ?>">

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($profile['name']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="dikksha_name" class="form-label">Dikksha Name</label>
                        <input type="text" class="form-control" id="dikksha_name" name="dikksha_name" value="<?php echo htmlspecialchars($profile['dikksha_name']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone_no" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone_no" name="phone_no" value="<?php echo htmlspecialchars($profile['phone_no']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="father_name" class="form-label">Father's Name</label>
                        <input type="text" class="form-control" id="father_name" name="father_name" value="<?php echo htmlspecialchars($profile['father_name']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="gurudev_name" class="form-label">Gurudev's Name</label>
                        <input type="text" class="form-control" id="gurudev_name" name="gurudev_name" value="<?php echo htmlspecialchars($profile['gurudev_name']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?php echo htmlspecialchars($profile['date_of_birth']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="educational_qualifications" class="form-label">Educational Qualifications</label>
                        <input type="text" class="form-control" id="educational_qualifications" name="educational_qualifications" value="<?php echo htmlspecialchars($profile['educational_qualifications']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="counselor_name" class="form-label">Counselor's Name</label>
                        <input type="text" class="form-control" id="counselor_name" name="counselor_name" value="<?php echo htmlspecialchars($profile['counselor_name']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="counselor_phone_no" class="form-label">Counselor's Phone Number</label>
                        <input type="text" class="form-control" id="counselor_phone_no" name="counselor_phone_no" value="<?php echo htmlspecialchars($profile['counselor_phone_no']); ?>" required>
                    </div>
                </div>

                <div class="col-md-6">
                   

                    <div class="mb-3">
                        <label for="study_occupation_organization" class="form-label">Study/Occupation/Organization</label>
                        <input type="text" class="form-control" id="study_occupation_organization" name="study_occupation_organization" value="<?php echo htmlspecialchars($profile['study_occupation_organization']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="present_address" class="form-label">Present Address</label>
                        <input type="text" class="form-control" id="present_address" name="present_address" value="<?php echo htmlspecialchars($profile['present_address']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="permanent_address" class="form-label">Permanent Address</label>
                        <input type="text" class="form-control" id="permanent_address" name="permanent_address" value="<?php echo htmlspecialchars($profile['permanent_address']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="iskcon_connection_days" class="form-label">ISKCON Connection Days</label>
                        <input type="number" class="form-control" id="iskcon_connection_days" name="iskcon_connection_days" value="<?php echo htmlspecialchars($profile['iskcon_connection_days']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="daily_chant_rounds" class="form-label">Daily Chant Rounds</label>
                        <input type="number" class="form-control" id="daily_chant_rounds" name="daily_chant_rounds" value="<?php echo htmlspecialchars($profile['daily_chant_rounds']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="regular_chant_days" class="form-label">Regular Chant Days</label>
                        <input type="number" class="form-control" id="regular_chant_days" name="regular_chant_days" value="<?php echo htmlspecialchars($profile['regular_chant_days']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="granthas_read" class="form-label">Granthas Read</label>
                        <input type="text" class="form-control" id="granthas_read" name="granthas_read" value="<?php echo htmlspecialchars($profile['granthas_read']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="mangal_aarti_regularly" class="form-label">Mangal Aarti Regularly</label>
                        <input type="text" class="form-control" id="mangal_aarti_regularly" name="mangal_aarti_regularly" value="<?php echo htmlspecialchars($profile['mangal_aarti_regularly']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="nearest_iskcon_temple" class="form-label">Nearest ISKCON Temple</label>
                        <input type="text" class="form-control" id="nearest_iskcon_temple" name="nearest_iskcon_temple" value="<?php echo htmlspecialchars($profile['nearest_iskcon_temple']); ?>" required>
                    </div>
                </div>
            </div>


            
            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
            
            
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
