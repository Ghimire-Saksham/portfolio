<?php
session_start();
include('db.php');
$sql = "SELECT * FROM doctors";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Receptionist Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="loginreception.css">
</head>
<body>
  <header>
    <div class="logo">
      <i class="fas fa-hospital"></i>
      <span>GLOBAL HOSPITAL</span>
    </div>
    <nav class="navbar">
      <a href="logoutdoc.php"><button class="logout-button">Logout</button></a>
    </nav>
  </header>
  <div class="side-navbar">
    <ul>
      <li><a href="#" class="active" id="dash" onclick="dashboard(event)">Dashboard</a></li>
      <li><a href="#" id="dlist" onclick="doctor(event)">Doctor List</a></li>
      <li><a href="#" id="plist" onclick="searchp(event)">Patient List</a></li>
      <li><a href="#" id="prescriptionlist" onclick="prescription(event)">Prescription List</a></li>
      <li><a href="#" id="appointlist" onclick="appointment(event)">Appointment Details</a></li>
      <li><a href="#" id="doctorm" onclick="edit(event)">Manage Doctor</a></li>
      <li><a href="#" class="last" id="queryTab" onclick="queries(event)">Queries</a></li>
    </ul>
  </div>
  <main>
    <h1>Welcome, <?php if(isset($_SESSION["username"])){ echo $_SESSION["username"]; } ?>!</h1>
    <div class="dashboard-container" id="dashboard">
      <div class="dashboard-card">
        <i class="fas fa-stethoscope"></i>
        <h2>Doctor List</h2>
        <a href="#" onclick="doctor(event)">View Doctors</a>
      </div>
      <div class="dashboard-card">
        <i class="fas fa-users"></i>
        <h2>Patient List</h2>
        <a href="#" onclick="searchp(event)">View Patients</a>
      </div>
      <div class="dashboard-card">
        <i class="fas fa-calendar-check"></i>
        <h2>Prescription List</h2>
        <a href="#" onclick="prescription(event)">Prescription</a>
      </div>
      <div class="dashboard-card">
        <i class="fas fa-clock"></i>
        <h2>View Appointments</h2>
        <a href="#" onclick="appointment(event)">Appointments</a>
      </div>
      <div class="dashboard-card" id="doct">
        <i class="fas fa-user-md"></i>
        <h2>Manage Doctors</h2>
        <a href="#" onclick="edit(event)">Edit</a>
      </div>
    </div>
    <div id="doctors" style="display: none;">
      <div class="search">
        <form action="" method="POST">
          <input type="text" name="doctorSearchTerm" placeholder="Enter Doctor Email">
          <button type="submit" name="searchDoctor" class="search-btn">Search</button>
          <?php if (isset($_POST['searchDoctor'])): ?>
            <button type="submit" name="showAllDoctors" class="search-btn">Show All</button>
          <?php endif; ?>
        </form>
      </div>
      <table>
        <tr>
          <th>Doctor ID</th>
          <th>Doctor Name</th>
          <th>Specialization</th>
          <th>Email</th>
          <th>Fees</th>
        </tr>
        <?php
        include('db.php');
        $sql = "SELECT * FROM doctors";
        if (isset($_POST['searchDoctor']) && !empty($_POST['doctorSearchTerm'])) {
          $searchTerm = $_POST['doctorSearchTerm'];
          $sql = "SELECT * FROM doctors WHERE email LIKE '%$searchTerm%'";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["d_id"] . "</td>
                    <td>" . $row["Username"] . "</td>
                    <td>" . $row["specialization"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["fees"] . "</td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='5'>No results found</td></tr>";
        }
        ?>
      </table>
    </div>
    <div id="prescribe" style="display: none;">
      <table>
        <tr>
          <th>Doctor</th>
          <th>Appointment ID</th>
          <th>Patient ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Appointment Date</th>
          <th>Appointment Time</th>
          <th>Disease</th>
          <th>Allergy</th>
          <th>Prescription</th>
        </tr>
        <?php
        $sql = "SELECT * FROM prescriptions";
        include('db.php');
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $sql1 = "SELECT * FROM appointments WHERE id=" . $row['appointment_id'];
            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch_assoc();
            $sql2 = "SELECT * FROM patients WHERE p_id=" . $row['patient_id'];
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            $firstName = $row1['first_name'];
            $lastName = $row1['last_name'];
            $date = $row1['date'];
            $time = $row1['time'];
            $appointmentId = $row1['id'];
            echo "<tr>";
            echo "<td>" . $row1['doctor'] . "</td>";
            echo "<td>" . $appointmentId . "</td>";
            echo "<td>" . $row1['patient_id'] . "</td>";
            echo "<td>" . $firstName . "</td>";
            echo "<td>" . $lastName . "</td>";
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
    <div id="queries" style="display: none;
    margin-left:5rem;">
      <div class="search">
        <form action="" method="POST">

         <div class="fixinput"> <input type="text" name="queriesSearchTerm" placeholder="Enter Contact">
          <button type="submit" name="searchQueries" class="search-btn">Search</button></div>
          <?php if (isset($_POST['searchQueries'])): ?>
            <button type="submit" name="showAllQueries" class="search-btn">Show All</button>
          <?php endif; ?>
        </form>
      </div>
      <table>
        <tr>
          <th>User Name</th>
          <th>Email</th>
          <th>Contact</th>
          <th>Message</th>
        </tr>
        <?php
        include('db.php');
        if (isset($_POST['searchQueries']) && !empty($_POST['queriesSearchTerm'])) {
          $searchTerm = $_POST['queriesSearchTerm'];
          $sql = "SELECT * FROM queries WHERE contact LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%' OR user_name LIKE '%$searchTerm%'";
        } else {
          $sql = "SELECT * FROM queries";
        }
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['user_name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['contact']}</td>
                    <td>{$row['message']}</td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='4'>No queries found</td></tr>";
        }
        ?>
      </table>
    </div>
    <div id="appoint" style="display: none;">
      <div class="search">
        <form action="" method="POST">
          <input type="text" name="appointmentSearchTerm" placeholder="Enter Contact">
          <button type="submit" name="searchAppointment" class="search-btn">Search</button>
          <?php if (isset($_POST['searchAppointment'])): ?>
            <button type="submit" name="showAllAppointments" class="search-btn">Show All</button>
          <?php endif; ?>
        </form>
      </div>
      <table>
        <tr>
          <th>Appointment ID</th>
          <th>Patient ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Gender</th>
          <th>Email</th>
          <th>Contact</th>
          <th>Doctor Name</th>
          <th>Consultancy Fees</th>
          <th>Appointment Date</th>
          <th>Appointment Time</th>
          <th>Appointment Status</th>
        </tr>
        <?php
        include('db.php');
        if (isset($_POST['searchAppointment']) && !empty($_POST['appointmentSearchTerm'])) {
          $searchTerm = $_POST['appointmentSearchTerm'];
          $sql = "SELECT a.*, p.phone_no, p.firstname, p.lastname, p.email, p.gender
                  FROM appointments a
                  JOIN patients p ON a.patient_id = p.p_id
                  WHERE p.phone_no LIKE '%$searchTerm%'";
        } else {
          $sql = "SELECT a.*, p.phone_no, p.firstname, p.lastname, p.email, p.gender
                  FROM appointments a
                  JOIN patients p ON a.patient_id = p.p_id";
        }
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['patient_id'] . "</td>
                    <td>" . $row['firstname'] . "</td>
                    <td>" . $row['lastname'] . "</td>
                    <td>" . $row['gender'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['phone_no'] . "</td>
                    <td>" . $row['doctor'] . "</td>
                    <td>" . $row['fee'] . "</td>
                    <td>" . $row['date'] . "</td>
                    <td>" . $row['time'] . "</td>
                    <td>" . $row['action'] . "</td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='12'>No appointments found</td></tr>";
        }
        ?>
      </table>
    </div>
    <div id="adddoctor" style="display: none;">
      <form id="addDoctorForm" action="adddoctor.php" method="POST">
        <h2>Add Doctor</h2>
        <div class="form-group">
          <label for="doctorName"></label>
          <input type="text" id="doctorName" name="doctorName" placeholder="Enter doctor's name" required>
        </div>
        <div class="form-group">
          <label for="specialization"></label>
          <select id="specialization" name="specialization" placeholder="Enter specialization">
            <option>Select</option>
            <option>General</option>
            <option>Pediatrician</option>
            <option>Cardiologist</option>
            <option>Neurologist</option>
          </select>
        </div>
        <div class="form-group">
          <label for="password"></label>
          <input type="text" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
          <label for="email"></label>
          <input type="email" id="email" name="email" placeholder="Enter email address" required>
        </div>
        <div class="form-group">
          <label for="fees"></label>
          <input type="number" id="fees" name="fees" step="0.01" placeholder="Enter consultation fees" required>
        </div>
        <button type="submit" class="add-doctor-btn">Add Doctor</button>
      </form>
    </div>
    <div id="deletedoctor" style="display: none;">
      <div class="search" id="deldoctor">
        <form action="deletedoctor.php" method="POST">
          <input type="text" id="myInput" name="email" placeholder="Enter Email Id">
          <button onclick="if(confirm('Are you sure you want to delete this doctor?')) { this.form.submit(); } else { event.preventDefault(); }">Delete doctor</button>
        </form>
      </div>
    </div>
    <div id="doctmanage" style="display: none;">
      <button class="managedoc" onclick="add(event)">Add</button>
      <button class="managedoc" onclick="delet(event)">Delete</button>
    </div>
    <div id="patiensearch" style="display: none;" class="patent">
      <form action="" method="POST" class="search">
        <input type="text" name="searchTerm" placeholder="Enter Email Id">
        <button type="submit" name="search" class="search-btn">Search</button>
        <?php if (isset($_POST['search'])): ?>
          <button type="submit" name="showAll" class="search-btn">Show all</button>
        <?php endif; ?>
      </form>
      <table>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Lastname</th>
          <th>Email</th>
          <th>Contact no</th>
          <th>Gender</th>
          <th>Created at</th>
        </tr>
        <?php
        include('db.php');
        if (isset($_POST['search'])) {
          $searchTerm = $_POST['searchTerm'];
          $sql = "SELECT * FROM patients WHERE email LIKE '%$searchTerm%'";
        } else {
          $sql = "SELECT * FROM patients";
        }
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['p_id']}</td>
                    <td>{$row['firstname']}</td>
                    <td>{$row['lastname']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone_no']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['created_at']}</td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='7'>No records found</td></tr>";
        }
        ?>
      </table>
    </div>
  </main>
  <style>
    #deletedoctor {
      display: flex;
      justify-content: flex-start;
      flex-direction: row;
    }
    #deletedoctor {
      margin-top: 5rem;
    }
    #prescribe {
      font-family: Arial, sans-serif;
      margin-top: 5.5rem;
      margin-left: 7.6%;
    }
    #patiensearch,
    #appoint,
    #patien {
      font-family: Arial, sans-serif;
      margin: 20px;
      margin-left: 8%;
    }
    .managedoc {
      background-color: #007bff;
      font-size: 20px;
      color: white;
      padding: 1rem 2rem;
      border: none;
      border-radius: 4px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.1s;
      margin-top: 2.8rem;
      display: inline-block;
      text-align: center;
    }
    .managedoc:hover {
      background-color: #0056b3;
    }
    .managedoc:active {
      transform: scale(0.98);
    }
    #adddoctor {
      margin: 20px 8%;
      font-family: Arial, sans-serif;
    }
    #addDoctorForm {
      background-color: rgba(233, 237, 238, 0.97);
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      max-width: 600px;
      margin: auto;
    }
    #addDoctorForm h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #007bff;
    }
    #addDoctorForm .form-group {
      margin-bottom: 1rem;
    }
    #addDoctorForm label {
      display: block;
      margin-bottom: 0.5rem;
      color: #333;
    }
    #specialization {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 1rem;
      margin-bottom: 1rem;
    }
    #deletedoctor {
      font-family: Arial, sans-serif;
      margin-left: 8%;
    }
    #addDoctorForm input {
      margin-bottom: 1rem;
      width: 95.8%;
      padding: 0.75rem;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 1rem;
    }
    #specialization {
      outline: none;
      border: 1px solid rgb(134, 134, 134);
    }
    #addDoctorForm input:focus {
      outline: none;
      border: 1px solid #007bff;
    }
    .add-doctor-btn {
      display: block;
      width: 100%;
      padding: 0.75rem;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 1.2rem;
      font-weight: bold;
      cursor: pointer;
      margin-top: 1rem;
      transition: background-color 0.3s, transform 0.1s;
    }
    .add-doctor-btn:hover {
      background-color: #0056b3;
    }
    .add-doctor-btn:active {
      transform: scale(0.98);
    }

    /* --- TABLE STYLING FIXES --- */
 .fixinput{
  display: inline-flex;      /* or 'flex' if you prefer a block-level container */
  align-items: center;       /* vertically center items */
  gap: 1rem;  

 }
    #queries table {
      width: 100%;
      margin: 20px 20px 20px 0rem ;
      border-collapse: collapse;
    }
    #queries table th, table td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
    }
  </style>
  <script>
    const tabToNavId = {
  dashboard: 'dash',
  doctors: 'dlist',
  patien: 'plist',
  prescribe: 'prescriptionlist',
  appoint: 'appointlist',
  doctmanage: 'doctorm',
  adddoctor: 'doctorm', // Add this line
  deletedoctor: 'doctorm', // Add this line
  patiensearch: 'plist',
  queries: 'queryTab'
};
    function updateNavActive(tab) {
      document.querySelectorAll('.side-navbar a').forEach(link => {
        link.classList.remove('active');
      });
      const navId = tabToNavId[tab];
      if (navId) {
        document.getElementById(navId).classList.add('active');
      }
    }
    function updateUrl(tab) {
      const url = new URL(window.location);
      url.searchParams.set('tab', tab);
      window.history.replaceState({}, '', url);
    }
    function switchTab(tab) {
  const tabContents = [
    'dashboard', 'doctors', 'patien', 'prescribe', 'appoint', 'doctmanage',
    'deletedoctor', 'adddoctor', 'patiensearch', 'queries'
  ];
  tabContents.forEach(t => {
    const el = document.getElementById(t);
    if (el) el.style.display = 'none';
  });
  if (tab === 'dashboard') {
    document.getElementById(tab).style.display = 'flex';
  } else {
    document.getElementById(tab).style.display = 'block';
  }
  updateUrl(tab);
  updateNavActive(tab);
}
    function handlePageLoad() {
      const urlParams = new URLSearchParams(window.location.search);
      const activeTab = urlParams.get('tab') || 'dashboard';
      switchTab(activeTab);
    }
    window.onload = handlePageLoad;
    function dashboard(event) { event.preventDefault(); switchTab('dashboard'); }
    function patient(event) { event.preventDefault(); switchTab('patien'); }
    function prescription(event) { event.preventDefault(); switchTab('prescribe'); }
    function doctor(event) { event.preventDefault(); switchTab('doctors'); }
    function appointment(event) { event.preventDefault(); switchTab('appoint'); }
    function edit(event) { event.preventDefault(); switchTab('doctmanage'); }
    function add(event) { event.preventDefault(); switchTab('adddoctor'); }
    function delet(event) { event.preventDefault(); switchTab('deletedoctor'); }
    function searchp(e) { if (e) e.preventDefault(); switchTab('patiensearch'); }
    function del(event) {
      event.preventDefault();
      if (confirm("Are you sure you want to delete this doctor?")) {
        event.target.closest('form').submit();
      }
    }
    function queries(event) { event.preventDefault(); switchTab('queries'); }
  </script>
</body>
</html>
