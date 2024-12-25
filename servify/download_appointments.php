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
        echo "<script>alert('Appointment deleted successfully!'); window.location.href = 'view_appointments.php';</script>";
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

// Function to generate the PDF
function generate_pdf($appointments) {
    // Set PDF headers
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="appointments.pdf"');

    // Output the PDF version and start the page
    echo "%PDF-1.3\n";
    echo "1 0 obj\n";
    echo "<< /Type /Catalog /Pages 2 0 R >>\n";
    echo "endobj\n";
    echo "2 0 obj\n";
    echo "<< /Type /Pages /Count 1 /Kids [3 0 R] >>\n";
    echo "endobj\n";
    echo "3 0 obj\n";
    echo "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Contents 4 0 R >>\n";
    echo "endobj\n";
    echo "4 0 obj\n";
    echo "<< /Length 5 0 R >>\n";
    echo "stream\n";

    // Content of the PDF
    echo "BT\n/F1 24 Tf\n72 720 Td\n(Appointments for Worker) Tj\n";
    echo "0 -24 Td\n(---------------------------------------------------) Tj\n";
    echo "0 -24 Td\n(User Name | User Email | User Phone | Appointment Date | Appointment Time) Tj\n";
    
    // Loop through appointments and add data to the PDF
    while ($row = $appointments->fetch_assoc()) {
        echo "0 -12 Td\n";
        echo "(" . $row['user_name'] . " | " . $row['user_email'] . " | " . $row['user_phone'] . " | " . $row['appointment_date'] . " | " . $row['appointment_time'] . ") Tj\n";
    }

    echo "endstream\n";
    echo "endobj\n";
    echo "xref\n";
    echo "0 5\n";
    echo "0000000000 65535 f\n";
    echo "0000000010 00000 n\n";
    echo "0000000129 00000 n\n";
    echo "0000000220 00000 n\n";
    echo "0000000320 00000 n\n";
    echo "trailer\n";
    echo "<< /Root 1 0 R /Size 5 >>\n";
    echo "startxref\n";
    echo "400\n";
    echo "%%EOF\n";
}

// If appointments are available, generate PDF
if ($result->num_rows > 0) {
    generate_pdf($result);
} else {
    echo "<p class='text-center'>No appointments found.</p>";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
