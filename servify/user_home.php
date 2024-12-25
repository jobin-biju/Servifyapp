<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Home - Local Services Finder</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <style>
    /* Basic Styles */
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f6f9;
    }

    /* Navbar */
    .navbar {
      background: linear-gradient(135deg, #ff7e5f, #feb47b);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      transition: background-color 0.3s;
    }
    .navbar a, .navbar .navbar-brand {
      color: white !important;
      font-weight: bold;
      transition: color 0.3s ease;
    }
    .navbar a:hover, .navbar .navbar-brand:hover {
      color: #ffe7d1 !important;
    }
    .dropdown-menu {
      background: linear-gradient(135deg, #ff7e5f, #feb47b);
      border: none;
    }
    .dropdown-item {
      color: white !important;
      font-weight: bold;
      transition: color 0.3s ease;
    }
    .dropdown-item:hover {
      color: #ffe7d1 !important;
      background: transparent;
    }

    /* Background Video Section */
    .video-section {
      position: relative;
      height: 100vh;
      overflow: hidden;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }
    .video-section video {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transform: translate(-50%, -50%);
      opacity: 0.7;
    }
    .video-overlay {
      position: relative;
      z-index: 2;
      color: #fff;
      text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }
    .video-overlay h1 {
      font-size: 3rem;
      animation: fadeInDown 1s ease;
    }
    .video-overlay p {
      font-size: 1.2rem;
      margin-top: 20px;
      max-width: 600px;
      animation: fadeInUp 1.5s ease;
    }

    /* Search bar with dropdown */
    .search-bar {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }
    .search-bar input[type="text"] {
      width: 60%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 30px 0 0 30px;
      font-size: 16px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
    .search-bar button {
      background: #ff7e5f;
      border: none;
      border-radius: 0 30px 30px 0;
      color: white;
      padding: 12px 25px;
      cursor: pointer;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
    .search-bar button:hover {
      background-color: #e36d50;
    }

    /* Services section */
    .services-section {
      padding: 50px 20px;
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin: 30px auto;
      width: 90%;
      max-width: 1200px;
    }
    .services-section h2 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
      font-weight: bold;
      animation: fadeIn 1s ease-out;
    }
    .service-card {
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 20px;
      margin: 10px;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      animation: zoomIn 0.5s ease-out;
    }
    .service-card:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    .service-card h3 {
      color: #ff7e5f;
      font-size: 1.4rem;
      transition: color 0.3s ease;
    }
    .service-card p {
      color: #555;
      font-size: 0.95rem;
    }
    .service-card button {
      background-color: #ff7e5f;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .service-card button:hover {
      background-color: #e36d50;
      transform: scale(1.05);
    }

    /* Footer */
    footer {
      background-color: #333;
      color: white;
      text-align: center;
      padding: 20px;
      font-size: 14px;
      letter-spacing: 1px;
    }

    /* Animations */
    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes zoomIn {
      from { opacity: 0; transform: scale(0.9); }
      to { opacity: 1; transform: scale(1); }
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#">Servify</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="https://www.google.com/maps?q=SNIT+Kollam" target="_blank">Location</a></li>
        <li class="nav-item dropdown">
        <li class="nav-item"><a class="nav-link" href="view_workers.php">View Workers</a></li>
        <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="appointmentDropdown" role="button" data-toggle="dropdown">Appointment</a> <div class="dropdown-menu"> <a class="dropdown-item" href="book_appointment.php">Book Appointment</a> <a class="dropdown-item" href="view_appointment.php">View Appointment</a> </div> </li>
        </li>
        <li class="nav-item"><a class="nav-link" href="feedback.php">Feedback</a></li>
        <li class="nav-item"><a class="nav-link" href="profile_view.php">Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </nav>

  <!-- Background Video Section -->
  <div class="video-section">
    <video autoplay muted loop>
      <source src="https://videos.pexels.com/video-files/5091624/5091624-hd_1920_1080_24fps.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
    <div class="video-overlay">
      <h1>Find the Best Local Services Near You</h1>
      <p>Explore top-rated service providers in your area with just a few clicks.</p>
    </div>
  </div>

  <!-- Search bar with aligned button -->
  <div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search for local services...">
    <button onclick="alert('Search initiated')">Search</button>
  </div>

  <!-- Services Section -->
  <div class="services-section">
    <h2>Our Services</h2>
    <div class="row">
      <div class="col-md-4">
        <div class="service-card">
          <h3>Plumbing</h3>
          <p>Professional plumbing services for your home and office needs.</p>
          <button>Learn More</button>
        </div>
      </div>
      <div class="col-md-4">
        <div class="service-card">
          <h3>Electrical</h3>
          <p>Expert electricians available for all types of electrical repairs.</p>
          <button>Learn More</button>
        </div>
      </div>
      <div class="col-md-4">
        <div class="service-card">
          <h3>Cleaning</h3>
          <p>Reliable cleaning services to keep your space spotless and hygienic.</p>
          <button>Learn More</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    &copy; 2024 Servify. All Rights Reserved.
  </footer>

  <!-- jQuery and Bootstrap scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
