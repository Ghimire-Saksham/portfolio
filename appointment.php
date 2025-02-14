<?php
session_start();


include 'db.php';
if (!isset($_SESSION['ID'], $_SESSION['fname'], $_SESSION['lname'])) {

  die("Session not set properly, please log in again.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_SESSION['ID'];
    $first_name = $_SESSION['fname'];
    $last_name = $_SESSION['lname'];
    $specialization = $_POST['specialization'];
    $doctor = $_POST['doctor'];
    $fee = $_POST['fee'];
    $appointment_date = $_POST['date'];
    $appointment_time = $_POST['time'];
    $action="Active";
    $sql1 = "SELECT * FROM doctors WHERE Username='$doctor'";
$run1=$conn->query($sql1);
if($run1->num_rows>0){
$row1=$run1->fetch_assoc();
$doctor_id=$row1['d_id'];
}
    $sql = "INSERT INTO appointments (patient_id, first_name, last_name, specialization, doctor, fee,date,time,action,d_id)
            VALUES ('$patient_id', '$first_name', '$last_name', '$specialization', '$doctor', '$fee', '$appointment_date', '$appointment_time','$action','$doctor_id')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION["status"]= "New appointment created successfully";
    } else {
        $SESSION['status']= "Error: " . $sql . "<br>" . $conn->error;
    }
   
    $conn->close();
    header("Location: patient dashboard.php?show=status");
    exit();
}
?>
