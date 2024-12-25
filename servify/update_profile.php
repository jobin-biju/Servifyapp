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

// Fetch user details
$stmt = $conn->prepare("SELECT * FROM user_registration WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Check if user data was found
if (!$user) {
    echo "<script>alert('User not found!');location.href='profile.php'</script>";
    exit();
}

$stmt->close();

// Update user details if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $district = $_POST['district'];
    $place = $_POST['place'];
    $gender = $_POST['gender'];

    // Prepare and execute the update query
    $stmt = $conn->prepare("UPDATE user_registration SET name = ?, phonenumber = ?, address = ?, pincode = ?, district = ?, place = ?, gender = ? WHERE email = ?");
    $stmt->bind_param("ssssssss", $name, $phonenumber, $address, $pincode, $district, $place, $gender, $email);
    $stmt->execute();
    $stmt->close();

    // Redirect to profile page with success message
    echo "<script>alert('Profile updated successfully!');location.href='profile_view.php'</script>";
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .profile-container {
            width: 50%;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            position: relative;
        }
        .profile-container h2 {
            text-align: center;
            color: #2575fc;
        }
        .profile-details {
            margin-top: 20px;
        }
        .profile-details label {
            font-weight: bold;
            display: inline-block;
            width: 150px;
            margin-bottom: 10px;
        }
        .profile-details input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .update-button {
            width: 48%;
            padding: 12px;
            text-align: center;
            background: #ff6347;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .update-button:hover {
            background: #ff4500;
            transform: scale(1.05);
        }

        .back-button {
            width: 48%;
            padding: 12px;
            text-align: center;
            background: #2575fc;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background: #1e56a0;
        }

        /* Make sure both buttons are visible and properly placed */
        .button-container {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-top: 20px;
        }

        /* Ensuring visibility and positioning of buttons */
        .update-button, .back-button {
            display: block !important;
            position: relative;
            z-index: 10;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .profile-container {
                width: 100%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<div class="profile-container">
    <h2>Update Profile</h2>
    <form method="POST" action="">
        <div class="profile-details">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            
            <label for="phonenumber">Phone Number:</label>
            <input type="text" id="phonenumber" name="phonenumber" value="<?php echo htmlspecialchars($user['phonenumber']); ?>" required>
            
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>
            
            <label for="pincode">Pincode:</label>
            <input type="text" id="pincode" name="pincode" value="<?php echo htmlspecialchars($user['pincode']); ?>" required>
            
            <label for="district">District:</label>
            <input type="text" id="district" name="district" value="<?php echo htmlspecialchars($user['district']); ?>" required>
            
            <label for="place">Place:</label>
            <input type="text" id="place" name="place" value="<?php echo htmlspecialchars($user['place']); ?>" required>
            
            <label for="gender">Gender:</label>
            <input type="text" id="gender" name="gender" value="<?php echo htmlspecialchars($user['gender']); ?>" required>
        </div>

        <!-- Buttons container -->
        <div class="button-container">
            <!-- Back button -->
            <button type="button" class="back-button" onclick="window.location.href='profile_view.php'">Back</button>
                
            <!-- Update button -->
            <input type="submit" class="update-button" value="Update Profile">
        </div>
    </form>
</div>

</body>
</html>
