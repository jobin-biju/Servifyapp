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
$stmt = $conn->prepare("SELECT * FROM worker_registration1 WHERE email = ?");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
            color: #495057;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            width: 100%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 20px;
            margin: 20px;
        }

        .card-header {
            text-align: center;
            font-size: 1.5rem;
            color: #007bff;
            margin-bottom: 20px;
        }

        .profile-details p {
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        .profile-details strong {
            color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .profile-details p {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }

        .profile-details p:not(:last-child) {
            margin-bottom: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Worker Profile</h2>
        </div>
        <div class="card-body">
            <?php if ($user): ?>
                <div class="profile-details">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['phonenumber']); ?></p>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
                    <p><strong>Pincode:</strong> <?php echo htmlspecialchars($user['pincode']); ?></p>
                    <p><strong>District:</strong> <?php echo htmlspecialchars($user['district']); ?></p>
                    <p><strong>Place:</strong> <?php echo htmlspecialchars($user['place']); ?></p>
                    <p><strong>Gender:</strong> <?php echo htmlspecialchars($user['gender']); ?></p>
                    <p><strong>Worker Type:</strong> <?php echo htmlspecialchars($user['workertype']); ?></p>
                    <p><strong>Specific Worker:</strong> <?php echo htmlspecialchars($user['specificworker']); ?></p>
                    <p><strong>Id Proof:</strong> <?php echo htmlspecialchars($user['idproof']); ?></p>
                    <p><strong>Id Number:</strong> <?php echo htmlspecialchars($user['idnumber']); ?></p>
                </div>
                <a href="update_profile.php" class="btn btn-primary mt-3">Update Profile</a>
            <?php else: ?>
                <p>No profile found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
