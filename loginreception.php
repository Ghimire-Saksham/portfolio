<?php 
include('db.php');
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM receptionist WHERE Username='$username'";

$run=$conn->query($sql);
$_SESSION['receptionist_username'] = $username;
$_SESSION['receptionist_password'] = $password;

if ($run->num_rows > 0) {
    $row = $run->fetch_assoc();
    if ($password == $row['Password'] ){
        
        $_SESSION['username'] = $username;
       
        header("Location: receptionist dashboard.php");
    } else {
        
        $_SESSION['errormessage'] = "Invalid password!";
        header("Location: index.php?show=reception");
        
    }
} else {
   
    $_SESSION['errormessage'] = "User not found!";
    header("Location: index.php?show=reception");
}
 
    exit();
?>