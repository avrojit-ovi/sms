<?php
session_start();
require_once 'config.php';

// Check if the user is logged in and has the 'user' role
if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'user') {
    header("Location: noaccess.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_SESSION['userid'];
    $user_name = $_SESSION['name'];
    $morning_wake_up_time = $_POST['morning_wake_up_time'];
    $mangalaarti_time = $_POST['mangalaarti_time'];
    $tulsi_parikrama = $_POST['tulsi_parikrama'];
    $chanting_rounds = $_POST['chanting_rounds'];
    $chanting_finished_time = $_POST['chanting_finished_time'];
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

    // Check if the user has already submitted data today
    $date_today = date('Y-m-d');
    $checkQuery = "SELECT COUNT(*) FROM shadhana_record WHERE userid = :userid AND DATE(date_time) = :date_today";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bindParam(':userid', $userid);
    $checkStmt->bindParam(':date_today', $date_today);
    $checkStmt->execute();
    $count = $checkStmt->fetchColumn();

    if ($count > 0) {
        echo "<script>alert('You have already submitted data for today.'); window.location.href = 'shadhana_recorder.php';</script>";
        exit;
    }

    // Prepare the SQL query to insert the data
    $stmt = $conn->prepare("
        INSERT INTO shadhana_record (
            userid, user_name, morning_wake_up_time, mangalaarti_time, tulsi_parikrama, chanting_rounds, chanting_finished_time, 
            grantha_study, which_grantha, grantha_reading_duration, lecture_hearing, which_lecture, lecture_hearing_duration, 
            material_study_work, material_study_work_duration, devotional_services_done, did_gossip, gossip_duration, 
            phone_usage_duration, slept_listening_kirtan, date_time
        ) VALUES (
            :userid, :user_name, :morning_wake_up_time, :mangalaarti_time, :tulsi_parikrama, :chanting_rounds, :chanting_finished_time,
            :grantha_study, :which_grantha, :grantha_reading_duration, :lecture_hearing, :which_lecture, :lecture_hearing_duration, 
            :material_study_work, :material_study_work_duration, :devotional_services_done, :did_gossip, :gossip_duration, 
            :phone_usage_duration, :slept_listening_kirtan, :date_time
        )
    ");

    // Bind the form data to the query
    $stmt->bindParam(':userid', $userid);
    $stmt->bindParam(':user_name', $user_name);
    $stmt->bindParam(':morning_wake_up_time', $morning_wake_up_time);
    $stmt->bindParam(':mangalaarti_time', $mangalaarti_time);
    $stmt->bindParam(':tulsi_parikrama', $tulsi_parikrama);
    $stmt->bindParam(':chanting_rounds', $chanting_rounds);
    $stmt->bindParam(':chanting_finished_time', $chanting_finished_time);
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
    $stmt->bindValue(':date_time', date('Y-m-d H:i:s'));

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>alert('Sadhana data recorded successfully!'); window.location.href = 'shadhana_recorder.php';</script>";
    } else {
        echo "<script>alert('There was an error recording the data.'); window.location.href = 'shadhana_recorder.php';</script>";
    }
}
?>
