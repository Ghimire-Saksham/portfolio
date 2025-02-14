<?php
include('db.php');
$specialization = $_POST['specialization'];

$doctor=$_POST['doctorName'];
$email=$_POST['email'];
$fee=$_POST['fees'];
$password=$_POST['password'];
$sql = "INSERT INTO doctors (Username,email,specialization,fees,password) VALUES ('$doctor','$email','$specialization','$fee','$password')";
$run=$conn->query($sql);
if($run){
  echo "<script>
  alert('Doctor added successfully');
  window.location.href = 'receptionist dashboard.php?tab=doctmanage';
  </script>";
  }
else{
  echo "<script>
  alert('Data couldn't be inserted');
  window.location.href = 'receptionist dashboard.php';
  </script>";
}
?>