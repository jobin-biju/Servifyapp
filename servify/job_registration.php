<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Registration - Local Service Finder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fc;
            color: #333;
            padding: 50px 0;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 650px;
            margin: 0 auto;
            border-top: 4px solid #007bff;
        }

        h2 {
            text-align: center;
            font-size: 28px;
            color: #007bff;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
            color: #555;
        }

        .form-control {
            border-radius: 8px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.3);
        }

        select.form-control {
            background-color: #f8f9fa;
        }

        button {
            background-color: #007bff;
            border: none;
            padding: 15px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            border-radius: 8px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-top: 20px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Job Registration</h2>
        <form action="" method="POST">
            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>

            <!-- Wages -->
            <div class="mb-3">
                <label for="wages" class="form-label">Wages per Hour</label>
                <input type="text" class="form-control" id="wages" name="wages" pattern="^[0-9]+$" required>
            </div>

            <!-- Education -->
            <div class="mb-3">
                <label for="education" class="form-label">Education</label>
                <input type="text" class="form-control" id="education" name="education" required>
            </div>

            <!-- Experience -->
            <div class="mb-3">
                <label for="experience" class="form-label">Experience (Years)</label>
                <input type="number" class="form-control" id="experience" name="experience" pattern="^[0-9]+$" required>
            </div>

            <!-- Working Time -->
            <div class="mb-3">
                <label for="working_time" class="form-label">Working Time (From - To)</label>
                <div class="d-flex">
                    <!-- From Time -->
                    <div class="me-3">
                        <label for="working_time_from" class="form-label">From</label>
                        <input type="time" class="form-control" id="working_time_from" name="working_time_from" required>
                    </div>
                    <!-- To Time -->
                    <div>
                        <label for="working_time_to" class="form-label">To</label>
                        <input type="time" class="form-control" id="working_time_to" name="working_time_to" required>
                    </div>
                </div>
            </div>

            <!-- Off Time -->
            <div class="mb-3">
                <label for="off_time" class="form-label">Off Time (From - To)</label>
                <div class="d-flex">
                    <!-- From Time -->
                    <div class="me-3">
                        <label for="off_time_from" class="form-label">From</label>
                        <input type="time" class="form-control" id="off_time_from" name="off_time_from" required>
                    </div>
                    <!-- To Time -->
                    <div>
                        <label for="off_time_to" class="form-label">To</label>
                        <input type="time" class="form-control" id="off_time_to" name="off_time_to" required>
                    </div>
                </div>
            </div>

            <!-- Working Days -->
            <div class="mb-3">
                <label for="working_days" class="form-label">Working Days</label>
                <select class="form-control" id="working_days" name="working_days" required>
                    <option value="7">7 Days a Week</option>
                    <option value="6">6 Days a Week</option>
                    <option value="5">5 Days a Week</option>
                </select>
            </div>

            <!-- Last Service Date -->
            <div class="mb-3">
                <label for="last_service" class="form-label">Last Service Date</label>
                <input type="date" class="form-control" id="last_service" name="last_service" required>
            </div>

            <!-- Submit Button -->
            <button type="submit">Submit Job Registration</button>
        </form>

        <div class="form-footer">
            <p>&copy; 2024 Servify. All rights reserved.</p>
        </div>
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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $wages = $_POST['wages'];
    $education = $_POST['education'];
    $experience = $_POST['experience'];
    $working_time_from = $_POST['working_time_from'];
    $working_time_to = $_POST['working_time_to'];
    $off_time_from = $_POST['off_time_from'];
    $off_time_to = $_POST['off_time_to'];
    $working_days = $_POST['working_days'];
    $last_service = $_POST['last_service'];

    // Insert data into the job_registration table
    $sql = "INSERT INTO job_registration (name, email, phone, wages, education, experience, working_time_from, working_time_to, off_time_from, off_time_to, working_days, last_service) 
            VALUES ('$name', '$email', '$phone', '$wages', '$education', '$experience', '$working_time_from', '$working_time_to', '$off_time_from', '$off_time_to', '$working_days', '$last_service')";

    if ($conn->query($sql) === TRUE) {
        echo "Job registration submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
