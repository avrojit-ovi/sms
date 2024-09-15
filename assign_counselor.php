<?php
session_start();
require 'config.php';

// Check if the user is logged in and has the appropriate role
if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'admin') {
    header("Location: noaccess.php");
    exit;
}

// Fetch counselors
$sql_counselors = "SELECT userid, name FROM users WHERE role IN ('admin', 'counselor')";
$stmt_counselors = $conn->prepare($sql_counselors);
$stmt_counselors->execute();
$counselors = $stmt_counselors->fetchAll(PDO::FETCH_ASSOC);

// Fetch all users who are not assigned yet
$sql_users = "SELECT userid, name FROM users WHERE role = 'user'";
$stmt_users = $conn->prepare($sql_users);
$stmt_users->execute();
$users = $stmt_users->fetchAll(PDO::FETCH_ASSOC);

// Handle selected counselor and assigned users
if (isset($_POST['counselor'])) {
    $selected_counselor = $_POST['counselor'];

    // Fetch already assigned users for the selected counselor
    $sql_assigned_users = "SELECT user_id, name FROM assigned_counselor JOIN users ON assigned_counselor.user_id = users.userid WHERE assigned_counselor.counselor_id = :counselor_id";
    $stmt_assigned_users = $conn->prepare($sql_assigned_users);
    $stmt_assigned_users->bindParam(':counselor_id', $selected_counselor);
    $stmt_assigned_users->execute();
    $assigned_users = $stmt_assigned_users->fetchAll(PDO::FETCH_ASSOC);
    
    // Remove assigned users from the list of all users
    $assigned_user_ids = array_column($assigned_users, 'user_id');
    $users = array_filter($users, function($user) use ($assigned_user_ids) {
        return !in_array($user['userid'], $assigned_user_ids);
    });
}
?>
<?php include 'dheader.php' ?>
        <h1 class="mb-4">Assign Counselor</h1>
        
        <!-- Form to select counselor and display users -->
        <form action="" method="POST">
            <div class="mb-3">
                <label for="counselor" class="form-label">Select Counselor</label>
                <select id="counselor" name="counselor" class="form-select" required>
                    <option value="" disabled selected>Select a counselor</option>
                    <?php foreach ($counselors as $counselor): ?>
                        <option value="<?php echo htmlspecialchars($counselor['userid']); ?>" <?php echo isset($selected_counselor) && $selected_counselor === $counselor['userid'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($counselor['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Load Users</button>
        </form>

        <?php if (isset($selected_counselor)): ?>
            <div class="mt-4">
                <h2>Assign Users to <?php echo htmlspecialchars($selected_counselor); ?></h2>
                <form action="assign_counselor_process.php" method="POST">
                    <input type="hidden" name="counselor" value="<?php echo htmlspecialchars($selected_counselor); ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Available Users</h3>
                            <?php foreach ($users as $user): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="users[]" value="<?php echo htmlspecialchars($user['userid']); ?>">
                                    <label class="form-check-label">
                                        <?php echo htmlspecialchars($user['name']); ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-md-6">
                            <h3>Already Assigned Users</h3>
                            <?php if (empty($assigned_users)): ?>
                                <p>No users assigned.</p>
                            <?php else: ?>
                                <?php foreach ($assigned_users as $assigned_user): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" disabled checked>
                                        <label class="form-check-label">
                                            <?php echo htmlspecialchars($assigned_user['name']); ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Assign Selected Users</button>
                </form>
            </div>
        <?php endif; ?>
        <?php include 'dfooter.php' ?>