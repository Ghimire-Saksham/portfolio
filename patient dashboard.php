<?php

// Start session
session_start();

$id=$_SESSION['ID'];
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
    <title>Patient Dashboard</title>
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
            <a href="logout.php"><button class="logout-button">Logout</button></a>
        </nav>
    </header>
    <div class="side-navbar">
      <ul>
          <li><a href="#" class="active" id="dashboard"   onclick="dashboard()">Dashboard</a></li>
          <li><a href="#" class="book" id="appointment" onclick="appointment()">Book Appointment</a></li>
          <li><a href="#" id="history" onclick="history()">Appointment History</a></li>
          <li><a href="#"class="last" id="prescribe" onclick="prescribe()">Prescription List</a></li>
          
      </ul>
  </div>
    <main>
        <h1>Welcome, <?php echo $_SESSION['fname']." ".$_SESSION['lname'];?>!</h1>
        <div class="dashboard-container" id="dashboard-container" >
            <div class="dashboard-card">
                <i class="fas fa-calendar-check"></i>
                <h2>Book My Appointment</h2>
                <a href="#" onclick="appointment()">Book Appointment</a>
            </div>
            <div class="dashboard-card">
                <i class="fas fa-calendar-alt"></i>
                <h2>My Appointments</h2>
                <a href="#" onclick="history()">Appointment History</a>
                
            </div>
            <div class="dashboard-card" >
                <i class="fas fa-capsules"></i>
                <h2>Prescriptions</h2>
                <a href="#" onclick="prescribe()">Prescription List</a>
                
            </div>
            
        </div>
        <div class="form-container" id="form-container" style="display: none;">
  <h2>Create an Appointment</h2>
  <form class="appointment-form" action="appointment.php" method="POST" id="appointmentForm">
    <div class="form-section"> 
      
      <div class="form-group">
        <label>Consultancy Type</label>
        <select class="form-input" id="specializationDropdown" name="specialization">
        <option>Select</option>  
        <option>General</option>
          <option>Pediatrician</option>
          <option>Cardiologist</option>
          <option>Neurologist</option>
        </select>
      </div> 
      <div class="form-group">
        <label>Doctor</label>
        <select class="form-input" id="doctorsDropdown" name="doctor">
         
        </select>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Fee</label>
          <input type="text" class="form-input" id="consultancyFee" name="fee" readonly>
        </div>
        <div class="form-group">
          <label>Date</label>
          <input type="date" class="form-input"  id="Date" value="" name="date">
        </div>
        <div class="form-group">
          <label>Time</label>
          <input type="time" class="form-input" id="time" name="time"> 
        </div>
      </div>
    </div>
 

                <button type="submit" class="create-button" onclick="validateAppointmentForm(event)">
                    Create New Entry <i class="fas fa-plus-circle"></i>
                </button>
                
            </form>
            <?php
                    if (isset($_SESSION['status'])) {
                        echo "<p>".$_SESSION['status']."</p>";
                        unset($_SESSION['status']);
                    }
                ?>
        </div>
        
        <div style="display: none;" id="doctors">
        <table >
            <tr>
                <th>Doctor Name</th>
                <th>Consultancy Fees</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Current Status</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "SELECT * FROM appointments WHERE patient_id='$id'";
            include('db.php');
   $result = $conn->query($sql);       
   if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $appointmentId = $row['id'];
        echo "<tr>";
        echo "<td>" . $row['doctor'] . "</td>";
        echo "<td>" . $row['fee'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['time'] . "</td>";
        
        if($row['action'] == "Active") {  
            echo "<td><p style='color:green'>" . $row['action'] . "</p></td>";
            echo "<td>
                    <form action='cancel.php' method='POST'>
                        <input type='hidden' name='appointment_id' value='" . $appointmentId . "'>
                        <button onclick='cancelappointment(event)'   type='submit' id='cancel'name='cancel'>Cancel</button>
                    </form>
                  </td>";
        } else {
           if($row['action']==='Completed') {echo "<td><p style='color:black;'>" . "Prescribed" . "</p></td>";}
else{echo "<td><p style='color:red;'>" . $row['action'] . "</p></td>";}            
           echo "<td class='cancel'><p style='color:black;
font-weight: 300;'>-<p></td>";
        }
        echo "</tr>";
    }
} else {
    echo "0 results";
}    
            ?>               
        </table>



</div>
    
    <div style="display: none;"  id="prescription"> 
        <table >
            <tr>
                <th>Doctor Name</th>
                <th>appointment ID</th>
                <th>Appointment Date</th>
                <th>Diseases</th>
                <th>Allergies</th>
                <th>Prescription</th>
            </tr>
            <?php
            
            $sql = "SELECT * FROM prescriptions WHERE patient_id='$id'";
            include('db.php');
   $result = $conn->query($sql);       
   if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $sql1 = "SELECT * FROM appointments WHERE d_id=" . $row['doctor_id'];
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
        $doctorName = $row1['doctor'];
        $appointmentId = $row['appointment_id'];
        echo "<tr>";
        echo "<td>" .$doctorName. "</td>";
        echo "<td>" . $appointmentId . "</td>";
   echo "<td>" . $row1['date'] . "</td>"; 
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
            function dashboard() {
                document.getElementById('dashboard-container').style.display = 'flex';
                document.getElementById('form-container').style.display = 'none';
                document.getElementById('prescription').style.display = 'none';
                document.getElementById('doctors').style.display = 'none';
                document.getElementById('dashboard').classList.add('active');
                document.getElementById('appointment').classList.remove('active');
                document.getElementById('history').classList.remove('active');
                document.getElementById('prescribe').classList.remove('active');
            }

            function appointment() {
                document.getElementById('dashboard-container').style.display = 'none';
                document.getElementById('doctors').style.display = 'none';
                document.getElementById('prescription').style.display = 'none';
                document.getElementById('form-container').style.display = 'block';
                document.getElementById('dashboard').classList.remove('active');
                document.getElementById('appointment').classList.add('active');
                document.getElementById('history').classList.remove('active');
                document.getElementById('prescribe').classList.remove('active');
            }

            function history() {
                document.getElementById('dashboard-container').style.display = 'none';
                document.getElementById('doctors').style.display = 'block';
                document.getElementById('prescription').style.display = 'none';
                document.getElementById('form-container').style.display = 'none';
                document.getElementById('dashboard').classList.remove('active');
                document.getElementById('appointment').classList.remove('active');
                document.getElementById('history').classList.add('active');
                document.getElementById('prescribe').classList.remove('active');
            }
            function prescribe() {
                document.getElementById('dashboard-container').style.display = 'none';
                document.getElementById('doctors').style.display = 'none';
                document.getElementById('prescription').style.display = 'block';
                document.getElementById('form-container').style.display = 'none';
                document.getElementById('dashboard').classList.remove('active');
                document.getElementById('appointment').classList.remove('active');
                document.getElementById('history').classList.remove('active');
                document.getElementById('prescribe').classList.add('active');
            }

            // Handle specialization change to fetch doctors and fees
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('specializationDropdown').addEventListener('change', handleSpecializationChange);
                document.getElementById('doctorsDropdown').addEventListener('change', handleDoctorChange);
            });

            function handleSpecializationChange() {
                const specialization = document.getElementById('specializationDropdown').value;
                const doctorsDropdown = document.getElementById('doctorsDropdown');
                const consultancyFee = document.getElementById('consultancyFee');

                doctorsDropdown.innerHTML = '<option value="">Loading...</option>'; // Temporary loading message

                let formData = new FormData();
                formData.append('specialization', specialization);

                fetch('fetch_doctors.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Fetched Doctors:", data); // Debugging

                    doctorsDropdown.innerHTML = '<option value="">Select a Doctor</option>'; // Reset dropdown

                    if (data.length === 0) {
                        doctorsDropdown.innerHTML = '<option value="">No doctors available</option>';
                        consultancyFee.value = ''; 
                        return;
                    }

                    data.forEach(doctor => {
                        let option = document.createElement('option');
                        option.value = doctor.Username;  
                        option.textContent = doctor.Username;
                        option.setAttribute('data-fee', doctor.fees);
                        doctorsDropdown.appendChild(option);
                    });

                    consultancyFee.value = ''; 
                })
                .catch(error => console.error('Error fetching doctors:', error));
            }

            function handleDoctorChange() {
                const selectedDoctor = document.getElementById('doctorsDropdown');
                const consultancyFee = document.getElementById('consultancyFee');

                const selectedOption = selectedDoctor.options[selectedDoctor.selectedIndex];
                consultancyFee.value = selectedOption.getAttribute('data-fee') || 'N/A';
            }

            // Form validation function
            function validateAppointmentForm(event) {
                
                const specialization = document.getElementById('specializationDropdown').value;
                const doctor = document.getElementById('doctorsDropdown').value;
                const fee = document.getElementById('consultancyFee').value;
                const appointmentDate = document.getElementById('Date').value;
                const appointmentTime = document.getElementById('time').value;

                let isValid = true;
                let errorMessage = '';

                if (specialization === '') {
                    errorMessage.innerText = 'Please select a specialization.';
                    isValid = false;
                } else if (doctor === '') {
                    errorMessage = 'Please select a doctor.';
                    isValid = false;
                } else if (fee === '') {
                    errorMessage = 'Fee is required.';
                    isValid = false;
                } else if (appointmentDate === '') {
                    errorMessage = 'Please select a date.';
                    isValid = false;
                } else {
                    const today = new Date();
                    const selectedDate = new Date(appointmentDate);
                    if (selectedDate < today) {
                        errorMessage = 'Appointment date must be in the future.';
                        isValid = false;
                    }
                }

                if (appointmentTime === '') {
                    errorMessage = 'Please select a time.';
                    isValid = false;
                }

                if (!isValid) {
                    alert(errorMessage);
                    event.preventDefault(); 
                }

                return isValid;
            }
            function status(){
                document.getElementById('dashboard-container').style.display = 'none';
                document.getElementById('appointmentForm').style.display = 'none';
                document.getElementById('status').style.display = 'block';


            }

            
        function cancelappointment(event) {
    event.preventDefault(); 
    if (confirm("Are you sure you want to cancel this appointment?")) {
      
      event.target.closest('form').submit();
    }
}    
        </script>
        <script>
            
        const showForm = '<?php echo $show_form; ?>';
    if (showForm === 'status') {
        appointment();
    } 
    else if (showForm === 'history') {
        history();
    }
    
    else {
        dashboard();
    }
    
        </script>
<div>

    </main>
</body>
</html>
