<?php
// Start session and connect to database
session_start();
include 'db.php'; // Ensure you have a file to connect to your database

if (isset($_POST['specialization'])) {
    $specialization = $_POST['specialization'];
    
    // Fetch doctors for the selected specialization
    $query = "SELECT Username,fees FROM doctors WHERE specialization ='$specialization'";
    
    $result = $conn->query($query);

    $doctors = [];
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }

    echo json_encode($doctors);
}
?>