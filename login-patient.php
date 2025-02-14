<?php

session_start();


include('db.php'); 


        $email = $_POST['email'];
        $password = $_POST['password'];
$_SESSION['email'] = $email;
$_SESSION['password'] = $password;  
 
        $sql = "SELECT * FROM patients WHERE email = '$email'";
      
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc(); 

            
            if ($password==$user['password']) {
                
            
                $_SESSION['fname'] = $user['firstname'];
$_SESSION['lname'] = $user['lastname'];
$_SESSION['ID'] = $user['p_id'];
               
                header("Location: patient dashboard.php"); 
                exit(); 
            } else {
                $_SESSION["Error"]= "Invalid password!";
            }
        } else {
            $_SESSION["Error"]="No user found with that email address.";
        }

  
        header("Location: loginuser.php");
   
 exit();



?>
