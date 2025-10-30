<?php


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// if (session_status() !== PHP_SESSION_ACTIVE) {
//     session_start();
// }



// include_once  '../admin/controllers/index.php';
// include_once  '../emails/otp_email.php';


// if (!isset($_COOKIE['device_id'])) {
//     $device_id = bin2hex(random_bytes(16)); // Generate a random device ID
//     setcookie('device_id', $device_id, time() + (10 * 365 * 24 * 60 * 60), "/"); // Set cookie for 10 years
// } else {
//     $device_id = $_COOKIE['device_id'];
// }



// $data = array();
// array_push($data, $device_id);
// array_push($data, $_POST['email']);

// $result = $auth->user_login($data);
// $user = $result['user'];



// if ($result['code'] == 200) {
//     $user = $result['user'];
//     echo json_encode(['success' => 1, 'message' => 'Email verified']);
// } else if ($result['code'] == 300) {
//     $response = send_otp($_POST['email']);
//     if ($response['success'] == true) {
//         echo json_encode(['success' => 2, 'message' => 'OTP Send']);
//     } else {
//         echo json_encode(['success' => 0, 'message' => $response['errors']]);
//     }
// } else if ($result['code'] == 400) {
//     $response = send_otp($_POST['email']);

//     if ($response['success'] == true) {
//         echo json_encode(['success' => 3, 'message' => 'OTP Send']);
//     } else {
//         echo json_encode(['success' => 0, 'message' => $response['errors']]);
//     }

// } else {
//     $_SESSION = array();
// }
