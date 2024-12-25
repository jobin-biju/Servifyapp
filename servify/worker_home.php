<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Dashboard | Local Service Finder</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f4f8;
            color: #333;
        }
        nav {
            background-color: #4CAF50;
            padding: 10px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 40px;
        }
        nav ul li {
            display: inline;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 700;
            font-size: 18px;
            padding: 10px 20px;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }
        nav ul li a:hover {
            background-color: #ffcc00;
            color: #333;
        }
        header {
            text-align: center;
            padding: 80px 20px;
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }
        header h1 {
            font-size: 60px;
            margin-bottom: 10px;
            animation: fadeInUp 1.5s ease-out;
        }
        header p {
            font-size: 22px;
            font-weight: 400;
            animation: fadeInUp 2s ease-out;
        }
        section {
            padding: 40px 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            justify-items: center;
        }
        .card {
            background: #fff;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
            border-radius: 15px;
            width: 300px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        .card h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 700;
            transition: color 0.3s ease;
        }
        .card p {
            font-size: 16px;
            color: #777;
            margin-bottom: 20px;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 25px;
            text-transform: uppercase;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .button:hover {
            background-color: #45a049;
            transform: translateY(-3px);
        }
        footer {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 60px;
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(50px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="job_registration.php">Job Registration</a></li>
            <li><a href="view_request.php">View Request</a></li>
            <li><a href="worker_logout.php">Logout</a></li>
        </ul>
    </nav>

    <!-- Header Section -->
    <header>
        <h1>Welcome to Worker Dashboard</h1>
        <p>Your gateway to manage your services and requests efficiently</p>
    </header>

    <!-- Main Content -->
    <section>
        <!-- Manage Tasks Card -->
        <div class="card">
            <h2>Manage Tasks</h2>
            <p>View and manage your ongoing and upcoming tasks. Stay organized!</p>
            <button class="button" onclick="window.location.href='#'">Manage Now</button>
        </div>

        <!-- Service History Card -->
        <div class="card">
            <h2>Service History</h2>
            <p>Review your past services and gain insights into your performance.</p>
            <button class="button" onclick="window.location.href='#'">View History</button>
        </div>

        <!-- Notifications Card -->
        <div class="card">
            <h2>Notifications</h2>
            <p>Stay updated with the latest requests and task assignments.</p>
            <button class="button" onclick="window.location.href='#'">Check Notifications</button>
        </div>

        <!-- Ratings & Reviews Card -->
        <div class="card">
            <h2>Ratings & Reviews</h2>
            <p>See your ratings and feedback from customers. Improve your services!</p>
            <button class="button" onclick="window.location.href='workerfeeback'">View Feedback</button>
        </div>

        <!-- Profile Card -->
        <div class="card">
            <h2>Your Profile</h2>
            <p>Update your profile, services offered, and personal information.</p>
            <button class="button" onclick="window.location.href='workerprofile.php'">View Profile</button>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Local Service Finder. All rights reserved.</p>
    </footer>

    <!-- JavaScript for Animations -->
    <script>
        // Add JavaScript for interactive functionality
        document.querySelectorAll('.button').forEach(button => {
            button.addEventListener('click', () => {
                alert('Redirecting to the relevant page!');
            });
        });
    </script>

</body>
</html>
