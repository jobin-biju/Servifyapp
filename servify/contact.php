<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact - Local Services Finder</title>

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

    /* Contact Page Styles */
    .contact-section {
      padding: 50px 20px;
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin: 30px auto;
      max-width: 900px;
    }
    .contact-section h2 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
      font-weight: bold;
      animation: fadeIn 1s ease-out;
    }
    .contact-info {
      text-align: center;
      color: #555;
      font-size: 1.2rem;
    }
    .contact-info h3 {
      color: #ff7e5f;
      font-size: 1.5rem;
      margin-bottom: 20px;
    }
    .contact-info p {
      margin: 10px 0;
    }
    .social-icons {
      display: flex;
      justify-content: center;
      margin-top: 30px;
    }
    .social-icons a {
      font-size: 2rem;
      margin: 0 15px;
      color: #ff7e5f;
      transition: color 0.3s ease;
    }
    .social-icons a:hover {
      color: #e36d50;
    }

    /* Footer */
    footer {
      background-color: #333;
      color: white;
      text-align: center;
      padding: 20px;
      font-size: 14px;
      letter-spacing: 1px;
      margin-top: 50px;
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
  </style>
</head>
<body>
  <!-- Contact Section -->
  <div class="contact-section">
    <h2>Contact Me</h2>
    <div class="contact-info">
      <h3>Jobin Biju</h3>
      <p><strong>Phone:</strong> +91 8921254255</p>
      <p><strong>Email:</strong> jobinbiju691@gmail.com</p>
      <p><strong>Address:</strong> SNIT Kollam, Kerala</p>
    </div>

    <!-- Social Media Icons -->
    <div class="social-icons">
      <a href="https://www.instagram.com/yourprofile" target="_blank" class="fa fa-instagram"></a>
      <a href="https://www.threads.net/@yourprofile" target="_blank" class="fa fa-facebook"></a>
      <a href="https://www.linkedin.com/in/yourprofile" target="_blank" class="fa fa-linkedin"></a>
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
