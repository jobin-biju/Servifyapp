<?php
// Start session to get logged-in worker details
session_start();
if (!isset($_SESSION['email'])) {
    die("Access denied! Please log in first.");
}

$worker_email = $_SESSION['email']; // Fetch the worker's email from session

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
    $delete_sql = "DELETE FROM appointments WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $delete_id);
    if ($delete_stmt->execute()) {
        echo "<script>alert('Appointment deleted successfully!'); window.location.href = 'view_request.php';</script>";
    } else {
        echo "<script>alert('Error deleting appointment.');</script>";
    }
}

// Fetch appointments for the logged-in worker
$sql = "SELECT id, user_name, user_email, user_phone, appointment_date, appointment_time 
        FROM appointments 
        WHERE worker_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $worker_email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fc;
            padding: 50px 0;
        }
        .container {
            max-width: 900px;
            margin: auto;
        }
        .table {
            background-color: #ffffff;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }
        .table th {
            background-color: #feb47b;
            color: #ffffff;
            font-weight: bold;
        }
        .btn-download {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Appointments for Worker</h2>
        <h5 class="text-center mb-4">Worker Email: <?php echo htmlspecialchars($worker_email); ?></h5>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>User Phone</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['user_email']); ?></td>
                            <td><?php echo htmlspecialchars($row['user_phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['appointment_time']); ?></td>
                            <td>
                                <!-- Delete Button -->
                                <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
                                   onclick="return confirm('Are you sure you want to delete this appointment?');">
                                    Delete
                                </a>
                                <!-- Download Button -->
                                <form method="post" action="download_appointments.php" style="display:inline;">
                                    <input type="hidden" name="row_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-success btn-sm">Download</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center">No appointments found.</p>
        <?php endif; ?>

        <?php
        // Close statement and connection
        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
