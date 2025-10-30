<?php
// include_once '../inc/session.php'; // Ensure session is started properly
// include_once '../controllers/index.php'; // Include the Database class
// include_once '../emails/otp_email.php'; // Function for sending OTP emails


// header('Content-Type: application/json'); // Set JSON response header

// $email = $_POST['email'] ?? ''; // Get email from POST request
// // Validate email format
// if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     echo json_encode(['success' => 0, 'message' => 'Invalid email format']);
//     exit;
// }
// // Generate a random 4-digit OTP
// $otp = rand(1000, 9999);
// $_SESSION['otp'] = $otp; // Store OTP in session
// $_SESSION['otp_email'] = $email; // Store email in session
// if ($user->is_email_registerd($email)) {
//     echo json_encode(['success' => 0, 'message' => 'Email Already register. Please proceed to login']);
//     exit;
// } else {
//     // Send OTP email
//     $sendOtpResponse = send_otp($email, $otp);
//     if ($sendOtpResponse['success']) {
//         echo json_encode(['success' => 1, 'message' => 'OTP sent successfully.']);
//     } else {
//         echo json_encode(['success' => 0, 'message' => 'Failed to send OTP. Please try again.']);
//     }
//     exit;
// }
