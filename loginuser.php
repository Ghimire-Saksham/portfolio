<?php
session_start();

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login - Global Hospitals</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
</head>
<body>
   
    <header>
        <div class="logo">
            <i class="fas fa-hospital"></i>
            <span>GLOBAL HOSPITAL</span>
        </div>
        <nav class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

  
    <main class="content">
        <div class="welcome-section">
            <i class="fas fa-ambulance"></i>
            <h1>Welcome</h1>
            <p>Your health is our first priority.</p>
        </div>
        <div class="login-form">
            <h2>Patient Login</h2>
            <form action="login-patient.php" method="post">
                <div class="form-group">
                    <input type="email" placeholder="Email-ID *" name="email" value="<?php    
                    if(isset($_SESSION['email'])) {
                        echo $_SESSION['email'];
                        unset($_SESSION['email']);
                    }?>" required>
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password *" name="password" value="<?php 
                    if(isset($_SESSION['password'])) {
                        echo $_SESSION['password'];
                        unset($_SESSION['password']);
                    }
                    ?>" required>
                </div>
               
                <button type="submit" class="login-btn">Login</button>
                <p class="signup-link">Don’t have an account? <a href="index.php">Register</a></p>
                <?php
if (isset($_SESSION['Error'])) {

    echo "<p style='color: red;' >" . $_SESSION['Error'] . "</p>";
    unset($_SESSION['Error']);
} 
?>

            </form>
        </div>
    </main>
    <script src="login.js"></script>
</body>
</html>