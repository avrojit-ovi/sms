<?php
session_start();
require_once 'config.php';

// Check if the user is logged in and has the appropriate role
if (!isset($_SESSION['userid']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'counselor')) {
    header("Location: noaccess.php");
    exit;
}

// Fetch Shadhana records from the database
$sql = "SELECT * FROM shadhana_record";
$stmt = $conn->prepare($sql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Shadhana Records - Svadharmam Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Shadhana Records</h1>
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
                                        <p><strong>Date & Time:</strong>  <?php 
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
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#shadhanaTable').DataTable();
        });
    </script>
</body>
</html>
