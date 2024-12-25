<form action="send_otp.php" method="POST">
    <label for="phonenumber">Phone Number:</label>
    <input type="text" id="phonenumber" name="phonenumber" required>
    <button type="submit">Send OTP</button>
</form>
<?php
session_start();

// Check if the 'phonenumber' field is set in the POST data
if (isset($_POST['phonenumber'])) {
    // Your TextLocal API key (replace 'YOUR_API_KEY' with your actual API key)
    $apiKey = 'YOUR_API_KEY';  // Replace this with your actual TextLocal API key
    
    // User's phone number (in international format, e.g., '919876543210' for India)
    $userPhone = $_POST['phonenumber'];
    
    // Generate a 6-digit OTP
    $otp = rand(100000, 999999);
    
    // Save OTP and phone number in session for later verification
    $_SESSION['otp'] = $otp;
    $_SESSION['otp_phone'] = $userPhone;
    
    // Message content
    $message = "Your OTP for password update is: $otp";
    
    // TextLocal API URL
    $url = 'https://api.textlocal.in/send/';
    
    // Data for the POST request
    $data = array(
        'apikey' => $apiKey,
        'numbers' => $userPhone,
        'sender' => 'TXTLCL',  // Sender name or use your registered sender ID
        'message' => $message
    );
    
    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);  // Set the URL
    curl_setopt($ch, CURLOPT_POST, true); // Set HTTP method as POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Send the data as query string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Receive response
    
    // Execute the request and capture the response
    $response = curl_exec($ch);
    
    // Close the cURL session
    curl_close($ch);
    
    // Decode the JSON response
    $responseData = json_decode($response, true);
    
    // Check if OTP was sent successfully
    if ($responseData && isset($responseData['status']) && $responseData['status'] == 'success') {
        echo "OTP sent to your phone.";
    } else {
        echo "Error sending OTP: " . (isset($responseData['errors'][0]['message']) ? $responseData['errors'][0]['message'] : 'Please try again.');
    }
} else {
    echo "Phone number is missing. Please provide a phone number.";
    exit;
}
?>
