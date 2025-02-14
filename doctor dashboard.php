<?php
include('db.php');

session_start();

$id = $_SESSION['doctor_id'];

if (isset($_GET['show'])) {
    $show_form = $_GET['show'];
    unset($_GET['show']);
} else {
    $show_form = 'dashboard'; 
    unset($_GET['show']);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="patient.css">
</head>
<body>
    <header>
        <div class="logo">
            <i class="fas fa-hospital"></i>
            <span>GLOBAL HOSPITAL</span>
        </div>
        <nav class="navbar">
            <a href="index.php"><button class="logout-button">Logout</button></a>
        </nav>
    </header>
    <div class="side-navbar">
      <ul>
          <li><a href="#" class="active" id="dashboard" onclick="dashboard(event)">Dashboard</a></li>
          <li><a href="#" onclick="appointments(event)" id="appoint">Appointments</a></li>
          <li><a href="#"class="last" onclick="prescriptions(event)" id="prescribe">Prescription List</a></li>
          
      </ul>
  </div>
    <main>
        <h1>Welcome, <?php echo $_SESSION['doctor_username'] ?>!</h1>
        <div class="dashboard-container" id="dashboard-container" >
            <div class="dashboard-card">
                <i class="fas fa-calendar-check"></i>
                <h2>View Appointments</h2>
                <a href="#" onclick="appointments(event)">Appointments</a>

            </div>
        
        
            <div class="dashboard-card">
                <i class="fas fa-capsules"></i>
                <h2>Prescriptions</h2>
                <a href="#" onclick="prescriptions(event)">Prescription List</a>
            
        </div>
        </div>
       
     <div style="display: none;"  id="appointments">
     <table >
            <tr>
                <th>Patient ID</th>
                <th>Appiontment ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>contact</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Current Status</th>
                <th>Action</th>
                <th>Prescribe</th>
            </tr>
            
           <?php $sql = "SELECT * FROM appointments WHERE d_id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $appointmentId = $row['id'];
        $doctorId = $row['d_id'];
        $patientId = $row['patient_id'];
       
$_SESSION['patient_id']=$patientId;
$_SESSION['doctor_id']=$doctorId;
$_SESSION['appointment_id']=$appointmentId;



        $sql1 = "SELECT * FROM patients WHERE p_id=" . $row['patient_id'];
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();

        echo "<tr>";
        echo "<td>" . $row['patient_id'] . "</td>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $row1['gender'] . "</td>";  
        echo "<td>" . $row1['email'] . "</td>";
        echo "<td>" . $row1['phone_no'] . "</td>"; 
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['time'] . "</td>";
        echo "<td>" . $row['action'] . "</td>";

        if ($row['action'] == "Active") {  
            echo "<td>
                     <form action='canceldoc.php' method='POST'>
                         <input type='hidden' name='appointment_id' value='$appointmentId'>
                         
                         <button onclick='cancelappointment(event)' type='submit' id='cancel' name='cancel' >Cancel</button>
                     </form>
                  </td>";
            echo "<td>
                     <form action='prescribe.php' method='POST'>
                     <input type='hidden' name='patient_id' value='$patientId'>  
                     <input type='hidden' name='doctor_id' value='$doctorId'>      
                     <input type='hidden' name='appointment_id' value='$appointmentId'>
                         <button type='submit' id='prescribebt' name='prescribe'>Prescribe</button>
                     </form>
                  </td>";
        } else {
            if($row['action']=="Completed"){
                echo "<td><p style='color:green;'>" . "Prescribed". "</p></td>";    
            }
           else{echo "<td><p style='color:red;'>" . "Cancelled". "</p></td>";}
            echo "<td>-</td>";
        }
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='12'>No appointments found</td></tr>";
}
?>
     </table>
        
        </div>
        <div style="display: none;"  id="prescriptions">
        <table >
            <tr>
                <th>Patient ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Appointment ID</th>
                <th>appointment Date</th>
                <th>Appointment Time</th>
                <th>Diseases</th>
                <th>Allergy</th>
                <th>Prescription</th>
            </tr>
            <?php
            
            $sql = "SELECT * FROM prescriptions WHERE doctor_id=$id";
            include('db.php');
   $result = $conn->query($sql);       
   if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $sql1 = "SELECT * FROM appointments WHERE patient_id=" . $row['patient_id'];
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
        $firstName = $row1['first_name'];
        $lastName = $row1['last_name'];
        $date=$row1['date'];
        $time=$row1['time'];
        $appointmentId = $row['appointment_id'];
        echo "<tr>";
        echo "<td>" .$row['patient_id']. "</td>";
        echo "<td>" . $firstName . "</td>";
   echo "<td>" . $lastName . "</td>"; 
        echo "<td>" . $appointmentId. "</td>";
        echo "<td>" . $date . "</td>";
        echo "<td>" . $time . "</td>";
         echo "<td>" . $row['disease'] . "</td>";
         echo "<td>" . $row['allergies'] . "</td>";
         echo "<td>" . $row['prescription'] . "</td>";
         echo "</tr>";
    }
}     
            ?>               
        </table>

        </div>
    </main>
    <script>
 function dashboard(event) {
    document.getElementById('dashboard-container').style.display = 'flex';
    document.getElementById('prescriptions').style.display = 'none';
    document.getElementById('appointments').style.display = 'none';
    document.getElementById('dashboard').classList.add('active');
    document.getElementById('prescribe').classList.remove('active');
    document.getElementById('appoint').classList.remove('active');
}

function appointments(event) {
    document.getElementById('dashboard-container').style.display = 'none';
    document.getElementById('prescriptions').style.display = 'none';
    document.getElementById('appointments').style.display = 'block';
    document.getElementById('dashboard').classList.remove('active');
    document.getElementById('prescribe').classList.remove('active');
    document.getElementById('appoint').classList.add('active');
}

function prescriptions(event) {
    document.getElementById('dashboard-container').style.display = 'none';
    document.getElementById('prescriptions').style.display = 'block';
    document.getElementById('appointments').style.display = 'none';
    document.getElementById('dashboard').classList.remove('active');
    document.getElementById('prescribe').classList.add('active'); 
    document.getElementById('appoint').classList.remove('active');
}


const showForm = '<?php echo $show_form; ?>';
        if (showForm === 'appointment') {
            appointments();
        } 
        else if (showForm === 'prescription') {
            prescriptions();
        }
        
        else {
            dashboard();
        }
    
        function cancelappointment(event) {
    event.preventDefault(); 
    if (confirm("Are you sure you want to cancel this appointment?")) {
      
      event.target.closest('form').submit();
    }
  }
       
</script>
           
          
</body>
</html>
