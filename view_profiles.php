<?php
session_start();

require_once 'config.php';

// Check if the user is logged in and has the appropriate role
if (!isset($_SESSION['userid']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'counselor')) {
    header("Location: noaccess.php");
    exit;
}

// Fetch profiles from the database
$sql = "SELECT * FROM profiles";
$stmt = $conn->prepare($sql);
$stmt->execute();
$profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profiles - Svadharmam Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Profiles</h1>
        <div class="row">
            <?php foreach ($profiles as $profile): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($profile['name']); ?></h5>
                        <p class="card-text">Dikksha Name: <?php echo htmlspecialchars($profile['dikksha_name']); ?></p>
                        <p class="card-text">Gurudev's Name: <?php echo htmlspecialchars($profile['gurudev_name']); ?></p>
                        <p class="card-text">Counselor's Name: <?php echo htmlspecialchars($profile['counselor_name']); ?></p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $profile['id']; ?>">Show More</button>
                    </div>
                </div>
            </div>

            <!-- Modal -->
           <!-- Modal -->
<div class="modal fade" id="modal-<?php echo $profile['id']; ?>" tabindex="-1" aria-labelledby="modalLabel-<?php echo $profile['id']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel-<?php echo $profile['id']; ?>">Profile Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>UserID:</strong> <?php echo htmlspecialchars($profile['userid']); ?></p>
                        <p><strong>Name:</strong> <?php echo htmlspecialchars($profile['name']); ?></p>
                        <p><strong>Dikksha Name:</strong> <?php echo htmlspecialchars($profile['dikksha_name']); ?></p>
                        <p><strong>Phone:</strong> <?php echo htmlspecialchars($profile['phone_no']); ?></p>
                        <p><strong>Father Name:</strong> <?php echo htmlspecialchars($profile['father_name']); ?></p>
                        <p><strong>Gurudev's Name:</strong> <?php echo htmlspecialchars($profile['gurudev_name']); ?></p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Counselor Name:</strong> <?php echo htmlspecialchars($profile['counselor_name']); ?></p>
                        <p><strong>Counselor Phone:</strong> <?php echo htmlspecialchars($profile['counselor_phone_no']); ?></p>
                        <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($profile['date_of_birth']); ?></p>
                        <p><strong>Education:</strong> <?php echo htmlspecialchars($profile['educational_qualifications']); ?></p>
                        <p><strong>Occupation:</strong> <?php echo htmlspecialchars($profile['study_occupation_organization']); ?></p>
                        <p><strong>Doing Mangal Aarti Regularly:</strong> <?php echo htmlspecialchars($profile['mangal_aarti_regularly']); ?></p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Connected Days:</strong> <?php echo htmlspecialchars($profile['iskcon_connection_days']); ?></p>
                        <p><strong>Daily Rounds:</strong> <?php echo htmlspecialchars($profile['daily_chant_rounds']); ?></p>
                        <p><strong>Regular Chant Days:</strong> <?php echo htmlspecialchars($profile['regular_chant_days']); ?></p>
                        <p><strong>Granthas Read:</strong> <?php echo htmlspecialchars($profile['granthas_read']); ?></p>
                        <p><strong>Nearest ISKCON Temple:</strong> <?php echo htmlspecialchars($profile['nearest_iskcon_temple']); ?></p>
                        <p><strong>Created Date:</strong> <?php echo htmlspecialchars($profile['created_date']); ?></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="edit_profile.php?id=<?php echo htmlspecialchars($profile['id']); ?>" class="btn btn-primary">Edit</a>
                <a href="delete_profile.php?id=<?php echo htmlspecialchars($profile['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this profile?');">Delete</a>

                <?php
                // Check if the profile already has login access
                $userCheckSql = "SELECT * FROM users WHERE userid = :userid";
                $userCheckStmt = $conn->prepare($userCheckSql);
                $userCheckStmt->bindParam(':userid', $profile['userid']);
                $userCheckStmt->execute();
                $existingUser = $userCheckStmt->fetch(PDO::FETCH_ASSOC);

                if ($existingUser) {
                    // If login access already exists, display a message
                    echo "<span class='btn btn-success disabled '>Already has login access</span>";
                } else {
                    // If no login access exists, show the button
                    if ($_SESSION['role'] === 'admin') {
                        echo "<form action='give_login_access.php' method='POST' class='d-inline'>
                                <input type='hidden' name='profile_id' value='" . htmlspecialchars($profile['id']) . "'>
                                <button type='submit' class='btn btn-success'>Give Login Access</button>
                              </form>";
                    }
                }
                ?>

                <!-- New Button to View Shadhana Records -->
                <a href="view_shadhana_records.php?userid=<?php echo htmlspecialchars($profile['userid']); ?>" class="btn btn-info">View Shadhana Records</a>
            </div>
        </div>
    </div>
</div>

            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
