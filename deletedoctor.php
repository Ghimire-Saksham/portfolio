<?php
include('db.php');
$email = $_POST['email'];
$sql1 = "SELECT * FROM doctors WHERE email = '$email'";
$run1 = $conn->query($sql1);

if ($run1->num_rows > 0) {
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $sql = "DELETE FROM doctors WHERE email = '$email'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Doctor deleted successfully');
                    window.location.href = 'receptionist dashboard.php?tab=doctmanage';
                  </script>";
        } else {
            echo "<script>
                    alert('Error deleting doctor');
                    window.location.href = 'receptionist dashboard.php?tab=doctmanage';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Please enter an Email Id');
                window.location.href = 'index.php?tab=deletedoctor';
              </script>";
    }
} else {
    echo "<script>
            alert('No doctor found');
            window.location.href = 'receptionist dashboard.php?tab=deletedoctor';
          </script>";
}
?>
