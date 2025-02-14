<?php 
$patient_id = $_POST['patient_id'];
$doctor_id = $_POST['doctor_id'];
$appointment_id = $_POST['appointment_id'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescribe</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="patient.css">
    <link rel="stylesheet" href="prescribe.css">
</head>
<body>
    <header>
        <div class="logo">
            <i class="fas fa-hospital"></i>
            <span>GLOBAL HOSPITAL</span>
        </div>
        <nav class="navbar">
            <a href="logout.php"><button class="logout-button">Logout</button></a>
        </nav>
    </header>
    <div>
      
    <form class="prescribe-form" action="prescribeprocess.php" method="POST">
    <input type='hidden' name='patient_id' value='<?php echo $patient_id; ?>'>
    <input type='hidden' name='appointment_id' value='<?php echo $appointment_id; ?>'>
    <input type='hidden' name='doctor_id' value='<?php echo $doctor_id ?>'>
   
    
    <div class="form-group">
        <label for="disease">Disease:</label>
        <textarea id="disease" name="disease"></textarea>
    </div>
    <div class="form-group">
        <label for="allergies">Allergies:</label>
        <textarea id="allergies" name="allergies"></textarea>
    </div>
    <div class="form-group">
        <label for="prescription">Prescription:</label>
        <textarea name="prescription"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" name="submit" class="prescribe-button">Prescribe</button>
    </div>
</form>

    </div>

</body>
</html>


