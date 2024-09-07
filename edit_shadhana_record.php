<?php
session_start();
require_once 'config.php';

// Check if the user is logged in and has the appropriate role
if (!isset($_SESSION['userid']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'counselor')) {
    header("Location: noaccess.php");
    exit;
}

// Get the record ID from the query string
$record_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the record from the database
$sql = "SELECT * FROM shadhana_record WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $record_id, PDO::PARAM_INT);
$stmt->execute();
$record = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$record) {
    echo "Record not found.";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mangalaarti_time = $_POST['mangalaarti_time'];
    $chanting_rounds = $_POST['chanting_rounds'];
    $grantha_study = $_POST['grantha_study'];
    $which_grantha = $_POST['which_grantha'];
    $grantha_reading_duration = $_POST['grantha_reading_duration'];
    $lecture_hearing = $_POST['lecture_hearing'];
    $which_lecture = $_POST['which_lecture'];
    $lecture_hearing_duration = $_POST['lecture_hearing_duration'];
    $material_study_work = $_POST['material_study_work'];
    $material_study_work_duration = $_POST['material_study_work_duration'];
    $devotional_services_done = $_POST['devotional_services_done'];
    $did_gossip = $_POST['did_gossip'];
    $gossip_duration = $_POST['gossip_duration'];
    $phone_usage_duration = $_POST['phone_usage_duration'];
    $slept_listening_kirtan = $_POST['slept_listening_kirtan'];

    // Update the record
    $sql = "UPDATE shadhana_record 
            SET mangalaarti_time = :mangalaarti_time, 
                chanting_rounds = :chanting_rounds, 
                grantha_study = :grantha_study, 
                which_grantha = :which_grantha, 
                grantha_reading_duration = :grantha_reading_duration, 
                lecture_hearing = :lecture_hearing, 
                which_lecture = :which_lecture, 
                lecture_hearing_duration = :lecture_hearing_duration, 
                material_study_work = :material_study_work, 
                material_study_work_duration = :material_study_work_duration, 
                devotional_services_done = :devotional_services_done, 
                did_gossip = :did_gossip, 
                gossip_duration = :gossip_duration, 
                phone_usage_duration = :phone_usage_duration, 
                slept_listening_kirtan = :slept_listening_kirtan 
            WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':mangalaarti_time', $mangalaarti_time);
    $stmt->bindParam(':chanting_rounds', $chanting_rounds);
    $stmt->bindParam(':grantha_study', $grantha_study);
    $stmt->bindParam(':which_grantha', $which_grantha);
    $stmt->bindParam(':grantha_reading_duration', $grantha_reading_duration);
    $stmt->bindParam(':lecture_hearing', $lecture_hearing);
    $stmt->bindParam(':which_lecture', $which_lecture);
    $stmt->bindParam(':lecture_hearing_duration', $lecture_hearing_duration);
    $stmt->bindParam(':material_study_work', $material_study_work);
    $stmt->bindParam(':material_study_work_duration', $material_study_work_duration);
    $stmt->bindParam(':devotional_services_done', $devotional_services_done);
    $stmt->bindParam(':did_gossip', $did_gossip);
    $stmt->bindParam(':gossip_duration', $gossip_duration);
    $stmt->bindParam(':phone_usage_duration', $phone_usage_duration);
    $stmt->bindParam(':slept_listening_kirtan', $slept_listening_kirtan);
    $stmt->bindParam(':id', $record_id, PDO::PARAM_INT);
    $stmt->execute();

    // Redirect after update
    header("Location: view_shadhana_records.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Shadhana Record</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Shadhana Record</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="mangalaarti_time" class="form-label">Mangalaarti Time</label>
                <input type="text" class="form-control" id="mangalaarti_time" name="mangalaarti_time" value="<?php echo htmlspecialchars($record['mangalaarti_time']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="chanting_rounds" class="form-label">Chanting Rounds</label>
                <input type="text" class="form-control" id="chanting_rounds" name="chanting_rounds" value="<?php echo htmlspecialchars($record['chanting_rounds']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="grantha_study" class="form-label">Grantha Study</label>
                <input type="text" class="form-control" id="grantha_study" name="grantha_study" value="<?php echo htmlspecialchars($record['grantha_study']); ?>">
            </div>
            <div class="mb-3">
                <label for="which_grantha" class="form-label">Which Grantha</label>
                <input type="text" class="form-control" id="which_grantha" name="which_grantha" value="<?php echo htmlspecialchars($record['which_grantha']); ?>">
            </div>
            <div class="mb-3">
                <label for="grantha_reading_duration" class="form-label">Grantha Reading Duration</label>
                <input type="text" class="form-control" id="grantha_reading_duration" name="grantha_reading_duration" value="<?php echo htmlspecialchars($record['grantha_reading_duration']); ?>">
            </div>
            <div class="mb-3">
                <label for="lecture_hearing" class="form-label">Lecture Hearing</label>
                <input type="text" class="form-control" id="lecture_hearing" name="lecture_hearing" value="<?php echo htmlspecialchars($record['lecture_hearing']); ?>">
            </div>
            <div class="mb-3">
                <label for="which_lecture" class="form-label">Which Lecture</label>
                <input type="text" class="form-control" id="which_lecture" name="which_lecture" value="<?php echo htmlspecialchars($record['which_lecture']); ?>">
            </div>
            <div class="mb-3">
                <label for="lecture_hearing_duration" class="form-label">Lecture Hearing Duration</label>
                <input type="text" class="form-control" id="lecture_hearing_duration" name="lecture_hearing_duration" value="<?php echo htmlspecialchars($record['lecture_hearing_duration']); ?>">
            </div>
            <div class="mb-3">
                <label for="material_study_work" class="form-label">Material Study Work</label>
                <input type="text" class="form-control" id="material_study_work" name="material_study_work" value="<?php echo htmlspecialchars($record['material_study_work']); ?>">
            </div>
            <div class="mb-3">
                <label for="material_study_work_duration" class="form-label">Material Study Work Duration</label>
                <input type="text" class="form-control" id="material_study_work_duration" name="material_study_work_duration" value="<?php echo htmlspecialchars($record['material_study_work_duration']); ?>">
            </div>
            <div class="mb-3">
                <label for="devotional_services_done" class="form-label">Devotional Services Done</label>
                <input type="text" class="form-control" id="devotional_services_done" name="devotional_services_done" value="<?php echo htmlspecialchars($record['devotional_services_done']); ?>">
            </div>
            <div class="mb-3">
                <label for="did_gossip" class="form-label">Did Gossip</label>
                <input type="text" class="form-control" id="did_gossip" name="did_gossip" value="<?php echo htmlspecialchars($record['did_gossip']); ?>">
            </div>
            <div class="mb-3">
                <label for="gossip_duration" class="form-label">Gossip Duration</label>
                <input type="text" class="form-control" id="gossip_duration" name="gossip_duration" value="<?php echo htmlspecialchars($record['gossip_duration']); ?>">
            </div>
            <div class="mb-3">
                <label for="phone_usage_duration" class="form-label">Phone Usage Duration</label>
                <input type="text" class="form-control" id="phone_usage_duration" name="phone_usage_duration" value="<?php echo htmlspecialchars($record['phone_usage_duration']); ?>">
            </div>
            <div class="mb-3">
                <label for="slept_listening_kirtan" class="form-label">Slept Listening Kirtan</label>
                <input type="text" class="form-control" id="slept_listening_kirtan" name="slept_listening_kirtan" value="<?php echo htmlspecialchars($record['slept_listening_kirtan']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Record</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
