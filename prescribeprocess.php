<?php

session_start();
include('db.php');

$patient_id = $_POST['patient_id'];
$doctor_id = $_POST['doctor_id'];
$appointment_id = $_POST['appointment_id'];
$disease = $_POST['disease'];
$allergies = $_POST['allergies'];
$prescription = $_POST['prescription'];
    $sql = "INSERT INTO prescriptions (patient_id, doctor_id, appointment_id, disease, allergies, prescription, status) 
            VALUES ('$patient_id', '$doctor_id', '$appointment_id', '$disease', '$allergies', '$prescription', 'Completed')";
                    

    if ($run1=$conn->query($sql)) {
        // Update appointment status
        $updateQuery = "UPDATE appointments SET action = 'Completed' WHERE id = $appointment_id";
        if ($run=$conn->query($updateQuery)) {
            echo "<script>alert('Prescription saved successfully!'); window.location.href='doctor dashboard.php?show=appointment';</script>";
        } else {
            echo "Error updating appointment: " . $conn->error;
        }
    } else {
        echo "Error saving prescription: " . $conn->error;
    }
    exit();

?>