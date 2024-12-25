<?php
// Start session to get logged-in user details
session_start();
if (!isset($_SESSION['email'])) {
    die("Access denied! Please log in first.");
}

$user_email = $_SESSION['email']; // Fetch the user's email from session

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "servify";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM appointments WHERE id = ? AND user_email = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("is", $delete_id, $user_email);  // Use user_email to ensure only the user's appointments can be deleted
    if ($delete_stmt->execute()) {
        echo "<script>alert('Appointment deleted successfully!'); window.location.href = 'view_appointment.php';</script>";
    } else {
        echo "<script>alert('Error deleting appointment.');</script>";
    }
}

// Fetch appointments for the logged-in user
$sql = "SELECT id, worker_email, worker_name, appointment_date, appointment_time 
        FROM appointments 
        WHERE user_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Appointments - Servify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding-top: 20px;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            max-width: 900px;
        }
        h2 {
            text-align: center;
            color: #007bff;
            font-size: 2rem;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            margin-bottom: 30px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-danger:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .empty-message {
            text-align: center;
            font-size: 1.2rem;
            color: #777;
        }
        .actions {
            text-align: center;
        }
        .actions a {
            margin: 0 5px;
            padding: 8px 15px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Appointments</h2>
        <?php if ($result->num_rows > 0): ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Worker Name</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['worker_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['appointment_time']); ?></td>
                    <td class="actions">
                        <a href="view_appointments.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p class="empty-message">You have no appointments yet. Book one today!</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
