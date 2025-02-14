<?php
session_start();
include('db.php');



    $username = $_POST['username'];
    $password = $_POST['password'];
$_SESSION['doctor_username'] = $username;
$_SESSION['doctor_password'] = $password;   

    $sql = "SELECT * FROM doctors WHERE Username = '$username'";
    $result = $conn->query($sql);

    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
      
        if ($password==$user['password']) {
           
            $_SESSION['doctor_id'] = $user['d_id'];
            $_SESSION['doctor_username'] = $user['Username'];
            header("Location: doctor dashboard.php"); 
            exit();
        } else {
            $_SESSION['error_message'] = "Invalid username or password.";
            header("Location: index.php?show=doctor");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "No such user found. Please check your username.";
        header("Location: index.php?show=doctor");
        exit();
    }


    header("Location: index.php?show=doctor");
    exit();
?>
