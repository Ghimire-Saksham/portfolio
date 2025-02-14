<?php
$servername = "sql12.freesqldatabase.com";  
$username = "sql12762746";       
$password = "ttmZCiuyGV";           
$dbname = "	sql12762746";    


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    //echo "Connected successfully";
}
?>
