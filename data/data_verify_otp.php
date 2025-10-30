<?php
// include_once '../inc/session.php';

// // Debug: Check if OTP exists in the session
// if (!isset($_SESSION['otp'])) {
//     echo json_encode(['success' => 0, 'message' => 'No OTP set in session.']);
//     exit;
// }

// $entered_otp = trim($_POST['otp'] ?? '');

// // Debug: Log the OTP values for comparison
// if ($_SESSION['otp'] != $entered_otp) {
//     echo json_encode([
//         'success' => 0,
//         'message' => 'Invalid OTP, Entered: ' . $entered_otp
//     ]);
//     exit;
// }

// // OTP is valid, proceed with registration logic here
// echo json_encode(['success' => 1, 'message' => 'OTP verified successfully. Registration can proceed.']);

// // Optionally clear the OTP after successful verification
// unset($_SESSION['otp']);