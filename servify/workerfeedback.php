<?php
session_start();
if (!isset($_SESSION['email'])) {
    die("Access denied! Please log in first.");
}

$worker_email = $_SESSION['email']; // Fetch the logged-in worker's email

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

// Fetch feedback for the logged-in worker
$sql = "SELECT user_email, feedback, created_at FROM feedback WHERE worker_email = ?";
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
    <title>View Feedback - Servify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f8e9;
            padding: 40px;
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 800px;
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #00796b;
        }
        table {
            width: 100%;
            margin-top: 20px;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
        }
        table th {
            background-color: #00796b;
            color: white;
        }
        .feedback-entry {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Feedback for You</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User Email</th>
                    <th>Feedback</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['user_email']); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($row['feedback'])); ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
