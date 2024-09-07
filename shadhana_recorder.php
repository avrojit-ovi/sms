<?php
session_start();
require 'config.php';  // Database connection with $conn

// Check if the user is logged in and has the 'user' role
if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'user') {
    header("Location: noaccess.php");
    exit;
}

// Fetch the user's name from the profiles table based on the logged-in userid
$userid = $_SESSION['userid'];
$stmt = $conn->prepare("SELECT name FROM profiles WHERE userid = :userid"); // Changed $pdo to $conn
$stmt->bindParam(':userid', $userid);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the user data is available
if (!$user) {
    echo "Error: User not found in the profiles table.";
    exit;
}

$user_name = $user['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shadhana Recorder</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Sadhana Recorder</h1>
        <form action="shadhana_recorder_process.php" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="userid" class="form-label">User ID</label>
                    <input type="text" class="form-control" id="userid" name="userid" value="<?= htmlspecialchars($userid) ?>" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="user_name" class="form-label">User Name</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" value="<?= htmlspecialchars($user_name) ?>" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="morning_wake_up_time" class="form-label">Morning Wake-up Time</label>
                    <input type="time" class="form-control" id="morning_wake_up_time" name="morning_wake_up_time">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="mangalaarti_time" class="form-label">Mangalaarti Time</label>
                    <input type="time" class="form-control" id="mangalaarti_time" name="mangalaarti_time">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tulsi_parikrama" class="form-label">Tulsi Parikrama</label>
                    <select class="form-select" id="tulsi_parikrama" name="tulsi_parikrama">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="chanting_rounds" class="form-label">Chanting Rounds</label>
                    <input type="number" class="form-control" id="chanting_rounds" name="chanting_rounds" min="0">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="chanting_finished_time" class="form-label">Chanting Finished Time</label>
                    <input type="time" class="form-control" id="chanting_finished_time" name="chanting_finished_time">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="grantha_study" class="form-label">Grantha Study</label>
                    <select class="form-select" id="grantha_study" name="grantha_study" onchange="toggleGranthaFields()">
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3 grantha-fields">
                    <label for="which_grantha" class="form-label">Which Grantha</label>
                    <input type="text" class="form-control" id="which_grantha" name="which_grantha">
                </div>

                <div class="col-md-6 mb-3 grantha-fields">
                    <label for="grantha_reading_duration" class="form-label">How Long You Read Grantha</label>
                    <input type="text" class="form-control" id="grantha_reading_duration" name="grantha_reading_duration">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="lecture_hearing" class="form-label">Lecture Hearing</label>
                    <select class="form-select" id="lecture_hearing" name="lecture_hearing" onchange="toggleLectureFields()">
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3 lecture-fields">
                    <label for="which_lecture" class="form-label">Which Lecture</label>
                    <input type="text" class="form-control" id="which_lecture" name="which_lecture">
                </div>

                <div class="col-md-6 mb-3 lecture-fields">
                    <label for="lecture_hearing_duration" class="form-label">How Long You Hear Lecture</label>
                    <input type="text" class="form-control" id="lecture_hearing_duration" name="lecture_hearing_duration">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="material_study_work" class="form-label">Material Study/Work</label>
                    <select class="form-select" id="material_study_work" name="material_study_work" onchange="toggleMaterialStudyFields()">
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3 material-study-fields">
                    <label for="material_study_work_duration" class="form-label">How Much Time You Spend on Material Study/Work Today</label>
                    <input type="text" class="form-control" id="material_study_work_duration" name="material_study_work_duration">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="devotional_services_done" class="form-label">Write Down What Devotional Services Were Done Today</label>
                    <textarea class="form-control" id="devotional_services_done" name="devotional_services_done" rows="3"></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="did_gossip" class="form-label">Did Gossip Today</label>
                    <select class="form-select" id="did_gossip" name="did_gossip" onchange="toggleGossipFields()">
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3 gossip-fields">
                    <label for="gossip_duration" class="form-label">How Much Time You Spend on Gossip Today</label>
                    <input type="text" class="form-control" id="gossip_duration" name="gossip_duration">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="phone_usage_duration" class="form-label">How Much Time You Spend on Phone Today</label>
                    <input type="text" class="form-control" id="phone_usage_duration" name="phone_usage_duration">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="slept_listening_kirtan" class="form-label">Have You Slept Listening to Kirtan Tonight?</label>
                    <select class="form-select" id="slept_listening_kirtan" name="slept_listening_kirtan">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
               
               <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Toggle Grantha Study Fields
        function toggleGranthaFields() {
            var granthaStudy = document.getElementById('grantha_study').value;
            var granthaFields = document.querySelectorAll('.grantha-fields');
            if (granthaStudy === 'Yes') {
                granthaFields.forEach(field => field.style.display = 'block');
            } else {
                granthaFields.forEach(field => field.style.display = 'none');
            }
        }

        // Toggle Lecture Hearing Fields
        function toggleLectureFields() {
            var lectureHearing = document.getElementById('lecture_hearing').value;
            var lectureFields = document.querySelectorAll('.lecture-fields');
            if (lectureHearing === 'Yes') {
                lectureFields.forEach(field => field.style.display = 'block');
            } else {
                lectureFields.forEach(field => field.style.display = 'none');
            }
        }

        // Toggle Material Study Fields
        function toggleMaterialStudyFields() {
            var materialStudyWork = document.getElementById('material_study_work').value;
            var materialStudyFields = document.querySelectorAll('.material-study-fields');
            if (materialStudyWork === 'Yes') {
                materialStudyFields.forEach(field => field.style.display = 'block');
            } else {
                materialStudyFields.forEach(field => field.style.display = 'none');
            }
        }

        // Toggle Gossip Fields
        function toggleGossipFields() {
            var didGossip = document.getElementById('did_gossip').value;
            var gossipFields = document.querySelectorAll('.gossip-fields');
            if (didGossip === 'Yes') {
                gossipFields.forEach(field => field.style.display = 'block');
            } else {
                gossipFields.forEach(field => field.style.display = 'none');
            }
        }

        // Initial load for the form
        toggleGranthaFields();
        toggleLectureFields();
        toggleMaterialStudyFields();
        toggleGossipFields();
    </script>
</body>
</html>


