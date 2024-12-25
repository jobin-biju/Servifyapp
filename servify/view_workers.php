<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Registrations - Local Service Finder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fc;
            color: #333;
            padding: 50px 0;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            font-size: 18px;
            font-weight: bold;
        }

        .card-body {
            background-color: #ffffff;
        }

        .card-body p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .container {
            max-width: 900px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Job Registration Details</h2>
        <?php
        // PHP code to fetch and display data from the database (from the PHP block above)
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php
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

// Fetch data from the job_registration table
$sql = "SELECT * FROM job_registration";
$result = $conn->query($sql);

// Check if there are records to display
if ($result->num_rows > 0) {
    echo "<div class='container mt-4'>";
    // Loop through the records and display each one in a card
    while ($row = $result->fetch_assoc()) {
        echo "
        <div class='card mb-4'>
            <div class='card-header'>
                <h5>" . $row['name'] . "</h5>
            </div>
            <div class='card-body'>
                <p><strong>Email:</strong> " . $row['email'] . "</p>
                <p><strong>Phone:</strong> " . $row['phone'] . "</p>
                <p><strong>Wages:</strong> ₹" . $row['wages'] . " per hour</p>
                <p><strong>Education:</strong> " . $row['education'] . "</p>
                <p><strong>Experience:</strong> " . $row['experience'] . " years</p>
                <p><strong>Working Time:</strong> " . $row['working_time_from'] . " to " . $row['working_time_to'] . "</p>
                <p><strong>Off Time:</strong> " . $row['off_time_from'] . " to " . $row['off_time_to'] . "</p>
                <p><strong>Working Days:</strong> " . $row['working_days'] . " days</p>
                <p><strong>Last Service Date:</strong> " . $row['last_service'] . "</p>
            </div>
        </div>";
    }
    echo "</div>";
} else {
    echo "<p>No records found.</p>";
}

// Close the connection
$conn->close();
?>
