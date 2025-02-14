<?php
include 'db.php';


if (isset($_POST['appointment_id'])) {
   
    $appointmentId =$_POST['appointment_id'];

   
    $sql = "UPDATE appointments SET action='Cancelled by patient' WHERE id='$appointmentId'";
    $run = $conn->query($sql);

    if ($run) {
        header("Location: patient dashboard.php?show=history");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
   
    echo "No appointment ID provided.";
}
?>
