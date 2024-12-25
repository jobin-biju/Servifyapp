<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
</head>
<body>
    <h2>Update Password</h2>
    <form action="send_otp.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Send OTP</button>
    </form>

    <form action="update_password.php" method="POST">
        <label for="otp">Enter OTP:</label>
        <input type="text" id="otp" name="otp" required>
        <br><br>

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>
        <br><br>

        <button type="submit">Update Password</button>
    </form>
</body>
</html>
<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "servify");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['otp_email'];
    $entered_otp = $_POST['otp'];
    $new_password = $_POST['new_password'];

    // Check if OTP matches
    if ($entered_otp == $_SESSION['otp']) {
        // OTP is correct; proceed with password update
        
        // Update password in user_registration table based on email
        $update_user_sql = "UPDATE user_registration SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($update_user_sql);
        $stmt->bind_param("ss", $new_password, $email);

        if ($stmt->execute()) {
            // Update password in login table based on email
            $update_login_sql = "UPDATE login SET password = ? WHERE email = ?";
            $stmt_login = $conn->prepare($update_login_sql);
            $stmt_login->bind_param("ss", $new_password, $email);

            if ($stmt_login->execute()) {
                echo "Password updated successfully in both tables.";
            } else {
                echo "Error updating password in login table: " . $stmt_login->error;
            }

            $stmt_login->close();
        } else {
            echo "Error updating password in user_registration table: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Incorrect OTP
        echo "Invalid OTP. Please try again.";
    }

    // Close connection and clear OTP session data
    unset($_SESSION['otp']);
    unset($_SESSION['otp_email']);
    $conn->close();
}
?>
