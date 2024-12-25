<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servify</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background-color: #e3f2fd;
        }
        header {
            background-color: #ff5722;
            color: white;
            padding: 15px 0;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            padding: 10px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: slideIn 1s ease-in-out;
        }
        nav .logo {
            color: white;
            font-size: 1.5rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        nav .logo:hover {
            color: #ff5722;
        }
        nav .nav-links {
            display: flex;
            list-style: none;
        }
        nav .nav-links li {
            margin-left: 20px;
            position: relative;
        }
        nav .nav-links a {
            color: white;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        nav .nav-links a:hover {
            background-color: #ff5722;
            color: white;
        }
        /* Dropdown */
        .dropdown {
            position: relative;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 120px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            z-index: 1;
        }
        .dropdown-content a {
            color: white;
            padding: 8px 12px;
            display: block;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .dropdown-content a:hover {
            background-color: #ff5722;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        /* Search Bar */
        nav .search-bar {
            display: flex;
            align-items: center;
        }
        nav .search-bar input {
            padding: 5px;
            border: none;
            border-radius: 4px 0 0 4px;
        }
        nav .search-bar button {
            padding: 6px 10px;
            border: none;
            background-color: #ff5722;
            color: white;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        nav .search-bar button:hover {
            background-color: #e64a19;
        }
        .carousel {
            width: 100%;
            height: 60vh;
            overflow: hidden;
            position: relative;
            animation: fadeIn 2s;
        }
        .carousel img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            animation: slideIn 2s;
        }
        .carousel-content {
            position: absolute;
            bottom: 20px;
            left: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }
        .carousel-content h1 {
            font-size: 3rem;
            animation: fadeInDown 2s;
        }
        .carousel-content p {
            font-size: 1.2rem;
            animation: fadeInUp 2s;
        }
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .services {
            padding: 40px 20px;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            animation: fadeIn 2s;
        }
        .service-card {
            background: white;
            padding: 20px;
            margin: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .service-card h3 {
            color: #ff5722;
        }
        .service-card p {
            color: #666;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: relative;
            width: 100%;
        }
        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Servify</h1>
    </header>
    <nav>
        <a href="#" class="logo">Servify</a>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">View Workers</a></li>
            <!-- Dropdown for Sign Up -->
            <li class="dropdown">
                <a href="#">Sign Up</a>
                <div class="dropdown-content">
                    <a href="user_registration.php">User</a>
                    <a href="worker_registration1.php">Worker</a>
                </div>
            </li>
            <li><a href="login.php">Sign In</a></li>
        </ul>
        <div class="search-bar">
            <input type="text" placeholder="Search services...">
            <button type="submit">Search</button>
        </div>
    </nav>
    <section class="carousel">
        <div class="carousel-content">
            <h1>Find Local Services Easily</h1>
            <p>Connecting you with the best local service providers in your area.</p>
        </div>
        <img src="https://images.pexels.com/photos/115755/pexels-photo-115755.jpeg" alt="Service Image">
    </section>
    <section class="services">
        <div class="service-card">
            <h3>Plumbing</h3>
            <p>Reliable plumbing services for all your needs.</p>
        </div>
        <div class="service-card">
            <h3>Electrician</h3>
            <p>Professional electricians available on demand.</p>
        </div>
        <div class="service-card">
            <h3>Home Cleaning</h3>
            <p>Affordable and thorough cleaning services.</p>
        </div>
    </section>
    <footer>
        <p>&copy; 2024 Servify. All rights reserved.</p>
    </footer>
</body>
</html>
