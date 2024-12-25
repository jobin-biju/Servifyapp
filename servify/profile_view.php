<?php
// Start the session
session_start();

// Include the database connection file
include('dbconnect.php');

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to login page if not logged in
    echo "<script>location.href='login.php'</script>";
    exit();
}

// Retrieve the email of the logged-in user from the session
$email = $_SESSION['email'];

// Prepare and execute the query to fetch user details
$stmt = $conn->prepare("SELECT * FROM user_registration WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Fetch user data
$user = $result->fetch_assoc();

// Close the statement
$stmt->close();

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    
    <!-- External Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            transition: background 0.3s ease;
        }

        /* Profile Container */
        .profile-container {
            width: 90%;
            max-width: 800px;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(-20px);
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        h2 {
            text-align: center;
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .profile-details {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .profile-details label {
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
        }

        .profile-details p {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 10px;
            transition: color 0.3s ease;
        }

        .profile-details p:hover {
            color: #2575fc;
        }

        .update-button {
            display: inline-block;
            width: 48%;
            padding: 12px;
            margin: 10px 1%;
            text-align: center;
            background: #ff6347;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .update-button:hover {
            background: #ff4500;
            transform: scale(1.05);
        }

        .update-button:focus {
            outline: none;
        }

        .back-button {
            background: #2575fc;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .profile-container {
                width: 100%;
                padding: 15px;
            }
        }

        /* Footer */
        footer {
            text-align: center;
            font-size: 0.9rem;
            color: #888;
            padding: 10px;
            background: #fff;
            border-top: 1px solid #eee;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="profile-container">
    <h2>User Profile</h2>
    <?php if ($user): ?>
        <div class="profile-details">
            <p><label>Name:</label> <?php echo htmlspecialchars($user['name']); ?></p>
            <p><label>Email:</label> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><label>Phone Number:</label> <?php echo htmlspecialchars($user['phonenumber']); ?></p>
            <p><label>Address:</label> <?php echo htmlspecialchars($user['address']); ?></p>
            <p><label>Pincode:</label> <?php echo htmlspecialchars($user['pincode']); ?></p>
            <p><label>District:</label> <?php echo htmlspecialchars($user['district']); ?></p>
            <p><label>Place:</label> <?php echo htmlspecialchars($user['place']); ?></p>
            <p><label>Gender:</label> <?php echo htmlspecialchars($user['gender']); ?></p>
        </div>

        <div class="buttons" style="display: flex; justify-content: space-between;">
            <a href="update_profile.php" class="update-button">Update</a>
            <a href="user_home.php" class="update-button back-button">Back</a>
        </div>
    <?php else: ?>
        <p>User details not found.</p>
    <?php endif; ?>
</div>

<footer>
    &copy; 2024 Local Service Finder. All Rights Reserved.
</footer>

</body>
</html>
