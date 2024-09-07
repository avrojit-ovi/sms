<?php
require 'config.php';  // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $userid = $_POST['userid'];
    $name = $_POST['name'];
    $morning_wakeup_time = $_POST['morning_wakeup_time'];
    $mangalaarti_time = $_POST['mangalaarti_time'];
    $tulshi_parikrama = $_POST['tulshi_parikrama'];
    $chanting_rounds = $_POST['chanting_rounds'];
    $chanting_finished_time = $_POST['chanting_finished_time'];
    $grantha_study = $_POST['grantha_study'];
    $grantha_name = $_POST['grantha_name'];
    $grantha_reading_duration = $_POST['grantha_reading_duration'];
    $lecture_hearing = $_POST['lecture_hearing'];
    $lecture_name = $_POST['lecture_name'];
    $lecture_hearing_duration = $_POST['lecture_hearing_duration'];
    $material_study_work = $_POST['material_study_work'];
    $material_study_work_duration = $_POST['material_study_work_duration'];
    $devotional_services = $_POST['devotional_services'];
    $did_gossip = $_POST['did_gossip'];
    $gossip_duration = $_POST['gossip_duration'];
    $phone_usage_duration = $_POST['phone_usage_duration'];
    $slept_with_kirtan = $_POST['slept_with_kirtan'];

    // SQL query to insert data
    $sql = "INSERT INTO shadhana_profiles (
                userid, name, morning_wakeup_time, mangalaarti_time, tulshi_parikrama,
                chanting_rounds, chanting_finished_time, grantha_study, grantha_name, grantha_reading_duration,
                lecture_hearing, lecture_name, lecture_hearing_duration, material_study_work, material_study_work_duration,
                devotional_services, did_gossip, gossip_duration, phone_usage_duration, slept_with_kirtan
            ) VALUES (
                :userid, :name, :morning_wakeup_time, :mangalaarti_time, :tulshi_parikrama,
                :chanting_rounds, :chanting_finished_time, :grantha_study, :grantha_name, :grantha_reading_duration,
                :lecture_hearing, :lecture_name, :lecture_hearing_duration, :material_study_work, :material_study_work_duration,
                :devotional_services, :did_gossip, :gossip_duration, :phone_usage_duration, :slept_with_kirtan
            )";

    $stmt = $conn->prepare($sql);

    // Bind parameters and execute
    $stmt->execute([
        ':userid' => $userid,
        ':name' => $name,
        ':morning_wakeup_time' => $morning_wakeup_time,
        ':mangalaarti_time' => $mangalaarti_time,
        ':tulshi_parikrama' => $tulshi_parikrama,
        ':chanting_rounds' => $chanting_rounds,
        ':chanting_finished_time' => $chanting_finished_time,
        ':grantha_study' => $grantha_study,
        ':grantha_name' => $grantha_name,
        ':grantha_reading_duration' => $grantha_reading_duration,
        ':lecture_hearing' => $lecture_hearing,
        ':lecture_name' => $lecture_name,
        ':lecture_hearing_duration' => $lecture_hearing_duration,
        ':material_study_work' => $material_study_work,
        ':material_study_work_duration' => $material_study_work_duration,
        ':devotional_services' => $devotional_services,
        ':did_gossip' => $did_gossip,
        ':gossip_duration' => $gossip_duration,
        ':phone_usage_duration' => $phone_usage_duration,
        ':slept_with_kirtan' => $slept_with_kirtan
    ]);

    echo "Shadhana profile submitted successfully!";
}
?>
