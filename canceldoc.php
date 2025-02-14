<?php
include 'db.php';


if (isset($_POST['appointment_id'])) {
   
    $appointmentId =$_POST['appointment_id'];

   
    $sql = "UPDATE appointments SET action='Cancelled by Doctor' WHERE id='$appointmentId'";
    $run = $conn->query($sql);

    if ($run) {
        header("Location: doctor dashboard.php?show=appointment");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
   
    echo "No appointment ID provided.";
}
?>
