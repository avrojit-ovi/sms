<?php
session_start();
require_once 'config.php';

// Check if the user is logged in and has the appropriate role
if (!isset($_SESSION['userid']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'counselor')) {
    header("Location: noaccess.php");
    exit;
}

// Fetch user details from the database
$userid = $_SESSION['userid'];

$query = "SELECT u.userid, p.name 
          FROM users u
          LEFT JOIN profiles p ON u.userid = p.userid 
          WHERE u.userid = :userid";

$stmt = $conn->prepare($query);
$stmt->bindParam(':userid', $userid);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// If name is available in the profiles table, use it; otherwise fallback to the userid
$userName = $user ? ($user['name'] ?: 'Name not found') : 'Unknown User';


// Fetch all users for the dropdown
$user_sql = "SELECT DISTINCT userid, user_name FROM shadhana_record ORDER BY user_name ASC";
$user_stmt = $conn->prepare($user_sql);
$user_stmt->execute();
$users = $user_stmt->fetchAll(PDO::FETCH_ASSOC);

// If a user is selected, fetch their Shadhana records
$selected_userid = isset($_POST['selected_userid']) ? $_POST['selected_userid'] : '';

if ($selected_userid) {
    $sql = "SELECT * FROM shadhana_record WHERE userid = :userid";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userid', $selected_userid);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Fetch all records if no user is selected
    $sql = "SELECT * FROM shadhana_record";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<?php include 'dheader.php' ?>

        <!-- User Selection Form -->
        <form method="POST" action="view_shadhana_records.php" class="mb-4">
            <div class="row">
                <div class="col-md-6">
                    <select name="selected_userid" class="form-select" onchange="this.form.submit()">
                        <option value="">Select a User</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo htmlspecialchars($user['userid']); ?>" 
                                <?php if ($selected_userid === $user['userid']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($user['user_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </form>

        <table id="shadhanaTable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>UserID</th>
                    <th>User Name</th>
                    <th>Date & Time</th>
                    <th>Mangalaarti Time</th>
                    <th>Chanting Rounds</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($records)): ?>
                    <tr>
                        <td colspan="6" class="text-center">No records found for the selected user.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($records as $record): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($record['userid']); ?></td>
                        <td><?php echo htmlspecialchars($record['user_name']); ?></td>
                        <td>
                            <?php 
                            // Format the date and time
                            $date = new DateTime($record['date_time']);
                            echo $date->format('d-M-Y') . ' || ' . $date->format('h:i A'); 
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($record['mangalaarti_time']); ?></td>
                        <td><?php echo htmlspecialchars($record['chanting_rounds']); ?></td>
                        <td>
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailsModal-<?php echo $record['userid']; ?>">Detailed List</button>
                            <?php if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'counselor'): ?>
                            <a href="edit_shadhana_record.php?id=<?php echo htmlspecialchars($record['id']); ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="delete_shadhana_record.php?id=<?php echo htmlspecialchars($record['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <!-- Detailed List Modal -->
                    <div class="modal fade" id="detailsModal-<?php echo $record['userid']; ?>" tabindex="-1" aria-labelledby="detailsModalLabel-<?php echo $record['userid']; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailsModalLabel-<?php echo $record['userid']; ?>">Detailed Record for <?php echo htmlspecialchars($record['user_name']); ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>UserID:</strong> <?php echo htmlspecialchars($record['userid']); ?></p>
                                            <p><strong>User Name:</strong> <?php echo htmlspecialchars($record['user_name']); ?></p>
                                            <p><strong>Date & Time:</strong> <?php 
                                            // Format the date and time
                                            $date = new DateTime($record['date_time']);
                                            echo $date->format('d-M-Y') . ' || ' . $date->format('h:i A'); 
                                            ?></p>
                                            <p><strong>Mangalaarti Time:</strong> <?php echo htmlspecialchars($record['mangalaarti_time']); ?></p>
                                            <p><strong>Chanting Rounds:</strong> <?php echo htmlspecialchars($record['chanting_rounds']); ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Grantha Study:</strong> <?php echo htmlspecialchars($record['grantha_study']); ?></p>
                                            <p><strong>Which Grantha:</strong> <?php echo htmlspecialchars($record['which_grantha']); ?></p>
                                            <p><strong>Grantha Reading Duration:</strong> <?php echo htmlspecialchars($record['grantha_reading_duration']); ?></p>
                                            <p><strong>Lecture Hearing:</strong> <?php echo htmlspecialchars($record['lecture_hearing']); ?></p>
                                            <p><strong>Which Lecture:</strong> <?php echo htmlspecialchars($record['which_lecture']); ?></p>
                                            <p><strong>Lecture Hearing Duration:</strong> <?php echo htmlspecialchars($record['lecture_hearing_duration']); ?></p>
                                            <p><strong>Material Study Work:</strong> <?php echo htmlspecialchars($record['material_study_work']); ?></p>
                                            <p><strong>Material Study Work Duration:</strong> <?php echo htmlspecialchars($record['material_study_work_duration']); ?></p>
                                            <p><strong>Devotional Services Done:</strong> <?php echo htmlspecialchars($record['devotional_services_done']); ?></p>
                                            <p><strong>Did Gossip:</strong> <?php echo htmlspecialchars($record['did_gossip']); ?></p>
                                            <p><strong>Gossip Duration:</strong> <?php echo htmlspecialchars($record['gossip_duration']); ?></p>
                                            <p><strong>Phone Usage Duration:</strong> <?php echo htmlspecialchars($record['phone_usage_duration']); ?></p>
                                            <p><strong>Slept Listening Kirtan:</strong> <?php echo htmlspecialchars($record['slept_listening_kirtan']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
       <?php include 'dfooter.php' ?>