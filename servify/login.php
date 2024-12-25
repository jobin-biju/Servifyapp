<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Login</title>
    <style>
        body {
            background-size: cover;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('https://images.pexels.com/photos/305821/pexels-photo-305821.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
            background-blend-mode: multiply,multiply;     
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: black;
            font-weight: bold;
            letter-spacing: 1px;
        }
        label {
            font-weight: 500;
            color: #555;
        }
        .btn-primary {
            width: 30%;
            background-color:00BFFF; 
        }
        .btn-primary:hover {
            background-color: #45a049;
        }
        .create-account {
            margin-top: 15px;
            display: block;
            text-align: center; /* Center the link */
            font-size: 14px; /* Adjust font size */
            color: #007BFF; /* Link color */
            text-decoration: none; /* Remove underline */
        }

        .create-account:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>LOGIN</h1>
        <form action="login.php" method="post"  autocomplete="off">
            <table class="table table-borderless">
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="email" id="email" name="email" class="form-control" placeholder="Enter Email" required></td>
                </tr>
                <tr>
                    <td><label for="password">Password</label></td>
                    <td><input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required></td>
                </tr>
                <tr>
                    <td></td><td colspan="2">
                        <button type="submit" name="submit" class="btn btn-primary mt-3">LOGIN</button>
                    </td>
                </tr>
            </table>
            <a href="user_registration.php" class="create-account">Create Account</a>
            <a href="worker_registration1.php" class="create-account">worker Account</a>
            <a href="update_password.php" class="create-account">forgot Password?</a>
        </form>
    </div>
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
        echo "<script>location.href=''</script>";
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
                echo "<script>location.href=''</script>";
                break;
            case 'user':
                echo "<script>location.href='user_home.php'</script>";
                break;
            case 'worker':
                echo "<script>location.href='worker_home.php'</script>";
                break;
            default:
                echo "<script>location.href=''</script>";
        }
    } else {
        // No user found
        echo "<script>location.href=''</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
