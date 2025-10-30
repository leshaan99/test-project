<?php

// // Disable displaying errors to the client
// ini_set('display_errors', 0);
// ini_set('log_errors', 1);

// include_once '../inc/session.php';
// include_once '../controllers/index.php';

// // Check if the required POST fields are set
// if (!isset($_POST['email']) || !isset($_POST['password'])) {
//     echo json_encode(['success' => 0, 'message' => 'Missing email or password.']);
//     exit;
// }

// // Prepare login data
// $data = [
//     'email'    => $_POST['email'],
//     'password' => $_POST['password']
// ];

// $result = $user->login($data);

// switch ($result['code']) {
//     case 404:
//         echo json_encode(['success' => 0, 'message' => 'E-mail not registered']);
//         break;

//     case 403:
//         // Account deactivated
//         $_SESSION['login_success'] = false;
//         $_SESSION['login_error']   = $result['error'];
//         $_SESSION['login_code']    = 403;

//         echo json_encode(['success' => 0, 'message' => 'Account deactivated. Please contact support.']);
//         break;

//     case 200:
//         // Login successful
//         $user_dtls = $result['data'];

//         $_SESSION['u_id']        = $user_dtls['id'];
//         $_SESSION['user_name']   = $user_dtls['f6'];   // first name
//         $_SESSION['user_email']  = $user_dtls['f1'];   // email
//         $_SESSION['login_success'] = true;
//         $_SESSION['login_code']    = 200;

//         // Set profile image if it exists
//         $profile_image = $user_dtls['img1'] ?? null;
//         if ($profile_image && !file_exists($profile_image)) {
//             $profile_image = null;
//         }
//         $_SESSION['profile_image'] = $profile_image ? str_replace("../", "./", $profile_image) : null;

//         echo json_encode(['success' => 1, 'message' => 'Successfully logged in']);
//         break;

//     case 401:
//         // Incorrect password
//         $_SESSION['login_success'] = false;
//         $_SESSION['login_error']   = $result['error'];
//         $_SESSION['login_code']    = 401;

//         echo json_encode(['success' => 0, 'message' => 'Incorrect password.']);
//         break;

//     default:
//         // Handle unexpected errors
//         $_SESSION['login_success'] = false;
//         $_SESSION['login_error']   = $result['error'] ?? 'Unknown error';
//         $_SESSION['login_code']    = $result['code'] ?? 500;

//         echo json_encode(['success' => 0, 'message' => 'An unexpected error occurred. Please try again.']);
//         break;
// }

// exit;
