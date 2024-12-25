<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.5.2/ionicons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'poppins', sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-image: url(https://user-images.githubusercontent.com/13468728/233847739-219cb494-c265-4554-820a-bd3424c59065.jpg);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        section {
            position: relative;
            max-width: 400px;
            background-color: transparent;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            backdrop-filter: blur(55px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem 3rem;
        }

        h1 {
            font-size: 2rem;
            color: #fff;
            text-align: center;
        }

        .inputbox {
            position: relative;
            margin: 30px 0;
            max-width: 310px;
            border-bottom: 2px solid #fff;
        }

        .inputbox label {
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            color: #fff;
            font-size: 1rem;
            pointer-events: none;
            transition: all 0.5s ease-in-out;
        }

        input:focus ~ label, 
        input:valid ~ label {
            top: -5px;
        }

        .inputbox input {
            width: 100%;
            height: 60px;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1rem;
            padding: 0 35px 0 5px;
            color: #fff;
        }

        .inputbox ion-icon {
            position: absolute;
            right: 8px;
            color: #fff;
            font-size: 1.2rem;
            top: 20px;
        }

        .forget {
            margin: 35px 0;
            font-size: 0.85rem;
            color: #fff;
            display: flex;
            justify-content: space-between;
        }

        .forget label {
            display: flex;
            align-items: center;
        }

        .forget label input {
            margin-right: 3px;
        }

        .forget a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        .forget a:hover {
            text-decoration: underline;
        }

        button {
            width: 100%;
            height: 40px;
            border-radius: 40px;
            background-color: rgb(255, 255, 255, 1);
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.4s ease;
        }

        button:hover {
            background-color: rgb(255, 255, 255, 0.5);
        }

        .register {
            font-size: 0.9rem;
            color: #fff;
            text-align: center;
            margin: 25px 0 10px;
        }

        .register p a {
            text-decoration: none;
            color: #fff;
            font-weight: 600;
        }

        .register p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <section>
        <form method="POST">
            <h1>Login</h1>
            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="email" name="email" required>
                <label for="">Email</label>
            </div>
            <div class="inputbox">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="password" name="password" required>
                <label for="">Password</label>
            </div>
            <div class="forget">
                <label for=""><input type="checkbox">Remember Me</label>
                <a href="#">Forget Password</a>
            </div>
            <button>Log in</button>
            <div class="register">
                <p>Don't have an account? <a href="#">Register</a></p>
            </div>
        </form>
    </section>
</body>
</html>

<?php
// Start the session at the top of the file
session_start();

// Include the database connection file
include('dbconnect.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize input
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Check for single quotes in input (basic SQL injection check)
    if (strpos($email, "'") !== false || strpos($password, "'") !== false) {
        echo "<script>location.href='login.php';</script>";
        exit();
    }

    // Prepare statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM login WHERE email = ? AND password = ? AND status = '1'");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($row = $result->fetch_assoc()) {
        // User found
        $_SESSION['user'] = $row['type'];
        $_SESSION['email'] = $email;

        // Redirect based on user type
        switch ($row['type']) {
            case 'admin':
                echo "<script>location.href='admin_home.php';</script>";
                break;
            case 'user':
                echo "<script>location.href='user_home.php';</script>";
                break;
            case 'worker':
                echo "<script>location.href='worker_home.php';</script>";
                break;
            default:
                echo "<script>location.href='login.php';</script>";
        }
    } else {
        // No user found
        echo "<script>location.href='login.php';</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
