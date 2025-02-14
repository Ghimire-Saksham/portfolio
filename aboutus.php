<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>About Us</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="indexGGMU.css">
  <header>
            <div class="logo">
                <i class="fas fa-hospital"></i>
                <span>GLOBAL HOSPITAL</span>
            </div>
            <nav class="navbar">
                <ul class="navwords">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="aboutus.php" >About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </header>
  <style>
    * {
      box-sizing: border-box;
      margin: 0; 
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }
    body {
      background: #f9f9f9;
      color: #333;
    }
    .container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 40px 20px;
      text-align: center;
    }
    h2 {
      font-size: 1.8rem;
      margin-bottom: 1rem;
      font-weight: 600;
      color: #333;
    }
    .about-text {
      max-width: 700px;
      margin: 1rem auto 40px auto;
      line-height: 1.6;
      font-size: 1rem;
      color: #555;
    }
    .team-heading {
      margin-top: 60px;
      margin-bottom: 20px;
      font-size: 1.6rem;
      font-weight: 600;
      color: #333;
    }
    .team-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 30px;
      justify-items: center;
      margin-top: 20px;
    }
    .team-container:hover{
      cursor: pointer;
    }
    .team-member {
      background: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.05);
      transition: transform 0.3s, box-shadow 0.3s;
      max-width: 250px;
    }
    .team-member:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    .team-member img {
      width: 100px;
      height: 100px;
      object-fit:fill;
      
      margin-bottom: 15px;
    }
    .team-member h3 {
      font-size: 1rem;
      margin-bottom: 5px;
      color: #333;
      font-weight: 600;
    }
    .team-member p {
      font-size: 0.9rem;
      color: #555;
      line-height: 1.4;
    }
    footer {
      background-color: #007bff;
      color: #fff;
      padding: 40px 0;
      text-align: center;
      margin-top: 40px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>About Us</h2>
  <p class="about-text">
    Inspired by the need to transform the hospital system from the card-file technique which is not only slow 
    but often leads to loss of medical records, we came up with this web application to fix that problem. 
    Our goal is to help local and underfunded hospitals around the world properly 
    manage patient records and information, ensuring efficient healthcare delivery.
  </p>

  <h2 class="team-heading">Meet the Team</h2>
  <div class="team-container">
    <div class="team-member">
      <img src="saksham.jpeg" alt="Onu Onyedikachi">
      <h3>Saksham Ghimire</h3>
      <p>Software Engineer - DevOps Expert</p>
    </div>
    <div class="team-member">
      <img src="aayush.jpg" alt="Dawoud Blessing">
      <h3>Aayush Khatiwada</h3>
      <p>Software Engineer - Frontend Expert</p>
    </div>
    <div class="team-member">
      <img src="hema.jpg" alt="Kusimo Yussuf">
      <h3>Hema Rana Magar</h3>
      <p>Software Engineer - Backend Expert</p>
    </div>
    <div class="team-member">
      <img src="rojina.jpg" alt="Jane Doe">
      <h3>Rojina Rana Magar</h3>
      <p>Full-Stack Developer - UI/UX Specialist</p>
    </div>
  </div>
</div>
<footer>
  &copy; 2025 Global Hospital. All Rights Reserved.
</footer>
</body>
</html>
