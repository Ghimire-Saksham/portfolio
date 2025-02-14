<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us | Global Hospital</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
 
  <link rel="stylesheet" href="indexGGMU.css">
</head>
<body>

  <header>
    <div class="logo">
      <i class="fas fa-hospital"></i>
      <span>GLOBAL HOSPITAL</span>
    </div>
    <nav class="navbar">
      <ul class="navwords">
        <li><a href="index.php">Home</a></li>
        <li><a href="aboutus.php">About Us</a></li>
   
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </nav>
  </header>

  
  <div class="landing-page">
   
    <div class="content">
      <div class="welcome-section">
        <i class="fas fa-paper-plane"></i>
        <h1>Drop Us a Message</h1>
        <p>We value your feedback. Let us know how we can help!</p>
      </div>

     
      <div class="registration-form">
        <h2>Contact Us</h2>
        <form action="process_contact.php" method="POST">
          <div class="form-group">
            
            <input 
              type="text" 
              name="user_name" 
              placeholder="Your Name *" 
              required
            >
         
            <input 
              type="email" 
              name="email" 
              placeholder="Your Email *" 
              required
            >
                     <input 
              type="number" 
              name="phone" 
              placeholder="Your Phone Number" 
            >
          </div>

          
          <div class="form-group" style="flex-direction: column; width: 100%;">
            <textarea 
              name="message" 
              rows="4" 
              placeholder="Your Message *" 
              style="width: 92%;"
              required
            ></textarea>
          </div>

       
          <button type="submit" class="submit-btn">Send Message</button>
          <style>
           
textarea {
 
  padding: 0.8rem;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 0.9rem;
  outline: none;
  resize: none; 
}


textarea:focus {
  border-color: #007bff;
}
            </style>
        </form>
      </div>
    </div>
  </div>

</body>
</html>
