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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data from the modal
    $user_name = $conn->real_escape_string($_POST['user_name']);
    $user_email = $conn->real_escape_string($_POST['user_email']);
    $user_phone = $conn->real_escape_string($_POST['user_phone']);
    $worker_email = $conn->real_escape_string($_POST['worker_email']);
    $worker_name = $conn->real_escape_string($_POST['worker_name']);
    $appointment_date = $conn->real_escape_string($_POST['appointment_date']);
    $appointment_time = $conn->real_escape_string($_POST['appointment_time']);

    // Insert data into appointments table
    $sql = "INSERT INTO appointments (user_name, user_email, user_phone, worker_email, worker_name, appointment_date, appointment_time) 
            VALUES ('$user_name', '$user_email', '$user_phone', '$worker_email', '$worker_name', '$appointment_date', '$appointment_time')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Appointment booked successfully!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>

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
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 12px 12px 0 0;
        }

        .card-body {
            background-color: #ffffff;
            padding: 20px;
        }

        .card-body p {
            font-size: 16px;
            margin-bottom: 8px;
        }

        .btn-appointment {
            background-color: #28a745;
            color: white;
            font-size: 16px;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-appointment:hover {
            background-color: #218838;
            cursor: pointer;
        }

        .container {
            max-width: 900px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Book Appointment</h2>
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

        // Fetch data using email as the link
        $sql = "
        SELECT 
            jr.name, 
            jr.email, 
            jr.phone, 
            jr.wages, 
            jr.education, 
            jr.experience, 
            jr.working_time_from, 
            jr.working_time_to, 
            jr.off_time_from, 
            jr.off_time_to, 
            jr.working_days, 
            jr.last_service, 
            wr.workertype, 
            wr.specificworker
        FROM 
            job_registration jr
        LEFT JOIN 
            worker_registration1 wr 
        ON 
            jr.email = wr.email";

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
                        <p><strong>Worker Type:</strong> " . $row['workertype'] . "</p>
                        <p><strong>Specific Worker:</strong> " . $row['specificworker'] . "</p>
                        <button class='btn-appointment' data-bs-toggle='modal' data-bs-target='#appointmentModal' data-worker-name='" . $row['name'] . "' data-worker-email='" . $row['email'] . "'>Book Appointment</button>
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="appointmentModalLabel">Book Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">

                        <div class="mb-3">
                            <label for="user_name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="user_email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="user_email" name="user_email" required>
                        </div>

                        <div class="mb-3">
                            <label for="user_phone" class="form-label">Your Phone</label>
                            <input type="text" class="form-control" id="user_phone" name="user_phone" required>
                        </div>

                        <div class="mb-3">
                            <label for="worker_name" class="form-label">Worker Name</label>
                            <input type="text" class="form-control" id="worker_name" name="worker_name" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="worker_email" class="form-label">Worker Email</label>
                            <input type="email" class="form-control" id="worker_email" name="worker_email" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="appointment_date" class="form-label">Appointment Date</label>
                            <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
                        </div>

                        <div class="mb-3">
                            <label for="appointment_time" class="form-label">Appointment Time</label>
                            <input type="time" class="form-control" id="appointment_time" name="appointment_time" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        var appointmentModal = document.getElementById('appointmentModal');
        appointmentModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; 
            var workerName = button.getAttribute('data-worker-name');
            var workerEmail = button.getAttribute('data-worker-email');

            var modalWorkerName = appointmentModal.querySelector('#worker_name');
            var modalWorkerEmail = appointmentModal.querySelector('#worker_email');

            modalWorkerName.value = workerName;
            modalWorkerEmail.value = workerEmail;
        });
    </script>
</body>
</html>
