<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Page</title>
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e0f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 90%;
            max-width: 500px;
            text-align: center;
            animation: fadeIn 1.5s ease-out;
        }

        h1 {
            color: #00695c;
            font-size: 28px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            text-align: left;
            font-weight: bold;
            color: #00695c;
            margin-bottom: 5px;
        }

        input[type="email"], textarea {
            padding: 15px;
            border: 1px solid #b2dfdb;
            border-radius: 8px;
            font-size: 16px;
            width: 100%;
            transition: border-color 0.3s ease;
        }

        input[type="email"]:focus, textarea:focus {
            border-color: #004d40;
        }

        textarea {
            resize: vertical;
            height: 150px;
        }

        input[type="submit"] {
            background-color: #00796b;
            color: white;
            border: none;
            padding: 15px 20px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        input[type="submit"]:hover {
            background-color: #004d40;
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .success-message, .error-message {
            margin-top: 20px;
            font-size: 18px;
            display: none;
            opacity: 0;
            animation: fadeInMessage 0.5s ease forwards;
        }

        .success-message {
            color: #388e3c;
        }

        .error-message {
            color: #d32f2f;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInMessage {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Submit Your Feedback</h1>
        <form action="#" method="POST">
            <label for="worker_email">Worker's Email:</label>
            <input type="email" id="worker_email" name="worker_email" required placeholder="Enter worker's email">

            <label for="feedback">Feedback:</label>
            <textarea id="feedback" name="feedback" required placeholder="Write your feedback here..."></textarea>

            <input type="submit" value="Submit Feedback" onclick="window.location.href='workerfeedback.php'">
        </form>

        <!-- Placeholder for feedback submission status -->
        <div class="feedback-status">
            <?php
            // Assume you have a database connection file
            include('dbconnect.php');

            // Check if form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $worker_email = $_POST['worker_email'];
                $feedback = $_POST['feedback'];
                $email = $_SESSION['email']; // Fetch the logged-in user's email

                // Insert feedback into the feedback table (adjust table and field names as needed)
                $sql = "INSERT INTO feedback (user_email, worker_email, feedback) VALUES (?, ?, ?)";
                
                if ($stmt = $conn->prepare($sql)) {
                    // Bind parameters and execute
                    $stmt->bind_param("sss", $user_email, $worker_email, $feedback);
                    if ($stmt->execute()) {
                        echo '<div class="success-message" style="display:block; animation: fadeInMessage 0.5s ease forwards;">Feedback submitted successfully!</div>';
                    } else {
                        echo '<div class="error-message" style="display:block; animation: fadeInMessage 0.5s ease forwards;">Error submitting feedback. Please try again.</div>';
                    }
                    $stmt->close();
                } else {
                    echo '<div class="error-message" style="display:block; animation: fadeInMessage 0.5s ease forwards;">Error: ' . $conn->error . '</div>';
                }

                // Close the database connection
                $conn->close();
            }
            ?>
        </div>
    </div>
</body>
</html>
