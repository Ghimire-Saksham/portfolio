<?php
session_start();
include('db.php');  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $email     = $_POST['email'];
    $number    = $_POST['phone'];
    $password  = $_POST['password'];  
    $gender    = $_POST['gender'];

       $_SESSION["FIRSTNAME"] = $firstname;
    $_SESSION["LASTNAME"]  = $lastname;
    $_SESSION["EMAIL"]     = $email;
    $_SESSION["PHONE"]     = $number;
    $_SESSION["PASS"]      = $password;
    $_SESSION["gender"]    = $gender;

   
    $_SESSION['fname'] = $firstname;
    $_SESSION['lname'] = $lastname;

   
    $sql = "SELECT * FROM patients WHERE email='$email'";
    $result = $conn->query($sql);
$sql1 = "SELECT * FROM patients WHERE phone_no='$number'";
$result1=$conn->query($sql1);
if ($result1->num_rows > 0) {
    $_SESSION["ERROR"] = "Number already exists!";
    header("Location: index.php");
    exit();}
    if ($result->num_rows > 0) {
        $_SESSION["ERROR"] = "Email already exists!";
        header("Location: index.php");
        exit();
    } else {
          $sql = "INSERT INTO patients (firstname, lastname, email, phone_no, password, gender, created_at) 
        VALUES ('$firstname', '$lastname', '$email', '$number', '$password', '$gender', NOW())";

        $result = $conn->query($sql);
        if ($result)  {
            header("Location: loginuser.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}
?>
