<?php
session_start();
require 'config.php';  // Database connection

// Check if the user is logged in and has the appropriate role
if (!isset($_SESSION['userid']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'counselor')) {
    header("Location: noaccess.php");
    exit;
}

// Fetching users from profiles table for the select option
$sql = "SELECT userid, name FROM profiles";
$stmt = $conn->prepare($sql);
$stmt->execute();
$profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sadhana Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Sadhana Profile</h1>
        <form action="sadhana_profile_process.php" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="userid" class="form-label">Select User ID</label>
                    <select class="form-select" id="userid" name="userid" required>
                        <option value="" selected disabled>Select UserID</option>
                        <?php
                        // Fetch user profiles from the database
                        require_once 'config.php';
                        $stmt = $conn->prepare("SELECT userid, name FROM profiles");
                        $stmt->execute();
                        $profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($profiles as $profile) {
                            echo '<option value="' . htmlspecialchars($profile['userid']) . '">' . htmlspecialchars($profile['userid']) . ' - ' . htmlspecialchars($profile['name']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">User Name</label>
                    <input type="text" class="form-control" id="name" name="name" readonly>
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
                    <option value="No" selected disabled>Select</option>    
                    <option value="Yes">Yes</option>
                        <option value="No">No</option>
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
                    <option value="No" selected disabled>Select</option>    
                    <option value="Yes">Yes</option>
                        <option value="No">No</option>
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
                    <option value="No" selected disabled>Select</option>    
                    <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3 material-study-fields">
                    <label for="material_study_work_duration" class="form-label">How Much Time You Spend on Material Study/Work Today</label>
                    <input type="text" class="form-control" id="material_study_work_duration" name="material_study_work_duration">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="devotional_services_done" class="form-label">Write Down What Devotional Services Was Done Today</label>
                    <textarea class="form-control" id="devotional_services_done" name="devotional_services_done" rows="3"></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="did_gossip" class="form-label">Did Gossip Today</label>
                    <select class="form-select" id="did_gossip" name="did_gossip" onchange="toggleGossipFields()">
                    <option value="No" selected disabled>Select</option>    
                    <option value="Yes">Yes</option>
                        <option value="No">No</option>
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
                    <option value="No" selected disabled>Select</option>    
                    <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function toggleGranthaFields() {
            const granthaFields = document.querySelectorAll('.grantha-fields');
            const granthaStudy = document.getElementById('grantha_study').value;
            granthaFields.forEach(field => {
                field.style.display = granthaStudy === 'Yes' ? 'block' : 'none';
            });
        }

        function toggleLectureFields() {
            const lectureFields = document.querySelectorAll('.lecture-fields');
            const lectureHearing = document.getElementById('lecture_hearing').value;
            lectureFields.forEach(field => {
                field.style.display = lectureHearing === 'Yes' ? 'block' : 'none';
            });
        }

        function toggleMaterialStudyFields() {
            const materialStudyFields = document.querySelectorAll('.material-study-fields');
            const materialStudy = document.getElementById('material_study_work').value;
            materialStudyFields.forEach(field => {
                field.style.display = materialStudy === 'Yes' ? 'block' : 'none';
            });
        }

        function toggleGossipFields() {
            const gossipFields = document.querySelectorAll('.gossip-fields');
            const didGossip = document.getElementById('did_gossip').value;
            gossipFields.forEach(field => {
                field.style.display = didGossip === 'Yes' ? 'block' : 'none';
            });
        }

        // Set name based on selected UserID
        document.getElementById('userid').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const nameField = document.getElementById('name');
            nameField.value = selectedOption.text.split(' - ')[1];
        });

        // Initial state
        toggleGranthaFields();
        toggleLectureFields();
        toggleMaterialStudyFields();
        toggleGossipFields();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
