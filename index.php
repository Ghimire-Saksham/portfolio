<?php
session_start();
if (isset($_GET['show'])) {
    $show_form = $_GET['show'];  
} else {
    $show_form = 'patient';      
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="indexGGMU.css">
</head>
<body>

    <div class="landing-page">
        <header>
            <div class="logo">
                <i class="fas fa-hospital"></i>
                <span>GLOBAL HOSPITAL</span>
            </div>
            <nav class="navbar">
                <ul class="navwords">
                    <li><a href="index.php" >Home</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </header>

   
        <div class="content" id="patient">
            <div class="welcome-section">
                <i class="fas fa-hand-holding-heart"></i>
                <h1>Welcome</h1>
                <p>Your Health is our first priority</p>
            </div>
            <div class="registration-form">
                <h2>Register as</h2>
                <div class="role-tabs">
                    <button class="active" onclick="patient()">Patient</button>
                    <button onclick="doctor()">Doctor</button>
                    <button onclick="receptionist()">Receptionist</button>
                </div>
                <form action="signup.php" method="post">
                    <div class="form-group">
                    <input type="text" placeholder="First Name *" name="firstname" id="firstname" value="<?php if(isset($_SESSION['FIRSTNAME'])) {echo $_SESSION['FIRSTNAME']; unset($_SESSION['FIRSTNAME']);}?>" required>

                        <input type="text" placeholder="Last Name *" name="lastname" id="lastname" value="<?php if(isset($_SESSION['LASTNAME'])) {echo $_SESSION['LASTNAME'];unset($_SESSION['LASTNAME']);}?>" required>
                    
                    
                        <input type="number" placeholder="Phone Number *" name="phone" id="phone" value="<?php if(isset($_SESSION['PHONE'])) {echo $_SESSION['PHONE'];unset($_SESSION['PHONE']);}?>" required>
                        <input type="email" placeholder="Your Email *" name="email" id="email" value="<?php if(isset($_SESSION['EMAIL'])) {echo $_SESSION['EMAIL'];unset($_SESSION['EMAIL']);}?>"required>
                        <input type="password" placeholder="Password *" name="password" id="password"value="<?php if(isset($_SESSION['PASS'])) {echo $_SESSION['PASS'];unset($_SESSION['PASS']);}?>" required>
                    </div>
                    <div class="form-group">
                        <label><input type="radio" name="gender" value="Male" id="gender"<?php if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male') { echo 'checked'; unset($_SESSION['gender']);}?>> Male</label>
                        <label><input type="radio" name="gender" value="Female" id="gender" required <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female') { echo 'checked';unset($_SESSION['gender']); }?>> Female</label>
                    </div>
                    <button type="submit" class="submit-btn" onclick="validatesign(event)">Register</button>
                    <div><p class="login-link">Already have an account? <a href="loginuser.php">Log in</a></p>
                    <?php
if (isset($_SESSION['ERROR'])) {

    echo "<p style='color: red;'>" . $_SESSION['ERROR'] . "</p>";
    unset($_SESSION['ERROR']);
} 
?>
                
                </div>
                  
                   
                </form>
            </div>
        </div>

        
        <div class="content" id="logindoctor" style="display: none;">
            <div class="welcome-section">
                <i class="fas fa-stethoscope"></i>
                <h1>Welcome</h1>
                <p>Your Health is our first priority</p>
            </div>
            <div class="registration-form">
                <h2>Login as Doctor</h2>
                <div class="role-tabs">
                    <button onclick="patient()">Patient</button>
                    <button class="active" onclick="doctor()">Doctor</button>
                    <button onclick="receptionist()">Receptionist</button>
                </div>
                <form action="logindoctor.php" method="post">
                    <div class="form-group">
                        <input type="text" placeholder="User Name *" name="username" value="<?php 
                        if (isset($_SESSION['doctor_username'])) {
                            echo $_SESSION['doctor_username'];
                            unset($_SESSION['doctor_username']);
                        }
                        ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Password *" name="password" value="<?php 
                        if (isset($_SESSION['doctor_password'])) {
                            echo $_SESSION['doctor_password'];
                            unset($_SESSION['doctor_password']);
                        }
                        ?>" required>
                    </div>
                    <button type="submit" class="submit-btn" onclick="validatereception()">Log in</button>
                    <?php
                if (isset($_SESSION['error_message'])) {
                    echo "<p style='color: red;'>" . $_SESSION['error_message'] . "</p>";
                    unset($_SESSION['error_message']); 
                }
                ?>
                </form>
            </div>
        </div>

       
        <div class="content" id="loginreception" style="display: none;">
            <div class="welcome-section">
                <i class="fas fa-headset"></i>
                <h1>Welcome</h1>
                <p>Your Health is our first priority</p>
            </div>
            <div class="registration-form">
                <h2>Login as Receptionist</h2>
                <div class="role-tabs">
                    <button onclick="patient()">Patient</button>
                    <button onclick="doctor()">Doctor</button>
                    <button class="active" onclick="receptionist()">Receptionist</button>
                </div>
                <form action="loginreception.php" method="post">
                    <div class="form-group">
                        <input type="text" name="username" placeholder="User Name *" value="<?php 
                        if (isset($_SESSION['receptionist_username'])) {
                            echo $_SESSION['receptionist_username'];
                            unset($_SESSION['receptionist_username']);
                        }
                        ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="password"  name="password" placeholder="Password *" 
                        value="<?php 
                        if (isset($_SESSION['receptionist_password'])) {
                            echo $_SESSION['receptionist_password'];
                            unset($_SESSION['receptionist_password']);
                        }
                        ?>"
                        required>
                    </div>
                    <button type="submit" class="submit-btn">Log in</button>

                   <?php if (isset($_SESSION['errormessage'])) {
                    echo "<p style='color: red;'>" . $_SESSION['errormessage'] . "</p>";
                    unset($_SESSION['errormessage']); 
                }
                ?>   
                </form>
            </div>
        </div>

    </div>

    
    <script src="script.js"></script>
    <script>
        const showForm = '<?php echo $show_form; ?>';
        if (showForm === 'doctor') {
            doctor();
        } else if (showForm === 'reception') {
            receptionist();
        } else {
            patient();
        }
    </script>

</body>
</html>

