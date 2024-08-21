<?php
session_start();

require_once 'config.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'admin') {
    header("Location: noaccess.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    // Get the form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dikksha_name = $_POST['dikksha_name'];
    $phone_no = $_POST['phone_no'];
    $father_name = $_POST['father_name'];
    $gurudev_name = $_POST['gurudev_name'];
    $counselor_name = $_POST['counselor_name'];
    $counselor_phone_no = $_POST['counselor_phone_no'];
    $date_of_birth = $_POST['date_of_birth'];
    $educational_qualifications = $_POST['educational_qualifications'];
    $study_occupation_organization = $_POST['study_occupation_organization'];
    $present_address = $_POST['present_address'];
    $permanent_address = $_POST['permanent_address'];
    $iskcon_connection_days = $_POST['iskcon_connection_days'];
    $daily_chant_rounds = $_POST['daily_chant_rounds'];
    $regular_chant_days = $_POST['regular_chant_days'];
    $granthas_read = $_POST['granthas_read'];
    $mangal_aarti_regularly = $_POST['mangal_aarti_regularly'];
    $nearest_iskcon_temple = $_POST['nearest_iskcon_temple'];

    // Update the profile in the database
    $sql = "UPDATE profiles SET name = :name, dikksha_name = :dikksha_name, phone_no = :phone_no, father_name = :father_name, gurudev_name = :gurudev_name, counselor_name = :counselor_name, counselor_phone_no = :counselor_phone_no, date_of_birth = :date_of_birth, educational_qualifications = :educational_qualifications, study_occupation_organization = :study_occupation_organization, present_address = :present_address, permanent_address = :permanent_address, iskcon_connection_days = :iskcon_connection_days, daily_chant_rounds = :daily_chant_rounds, regular_chant_days = :regular_chant_days, granthas_read = :granthas_read, mangal_aarti_regularly = :mangal_aarti_regularly, nearest_iskcon_temple = :nearest_iskcon_temple WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':dikksha_name', $dikksha_name);
    $stmt->bindParam(':phone_no', $phone_no);
    $stmt->bindParam(':father_name', $father_name);
    $stmt->bindParam(':gurudev_name', $gurudev_name);
    $stmt->bindParam(':counselor_name', $counselor_name);
    $stmt->bindParam(':counselor_phone_no', $counselor_phone_no);
    $stmt->bindParam(':date_of_birth', $date_of_birth);
    $stmt->bindParam(':educational_qualifications', $educational_qualifications);
    $stmt->bindParam(':study_occupation_organization', $study_occupation_organization);
    $stmt->bindParam(':present_address', $present_address);
    $stmt->bindParam(':permanent_address', $permanent_address);
    $stmt->bindParam(':iskcon_connection_days', $iskcon_connection_days);
    $stmt->bindParam(':daily_chant_rounds', $daily_chant_rounds);
    $stmt->bindParam(':regular_chant_days', $regular_chant_days);
    $stmt->bindParam(':granthas_read', $granthas_read);
    $stmt->bindParam(':mangal_aarti_regularly', $mangal_aarti_regularly);
    $stmt->bindParam(':nearest_iskcon_temple', $nearest_iskcon_temple);

    if ($stmt->execute()) {
        header("Location: view_profiles.php");  // Redirect to the profiles view page
        exit;
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
} else {
    echo "Invalid request.";
}
?>
