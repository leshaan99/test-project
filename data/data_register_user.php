<?php
// // Enable error reporting for debugging
// include_once '../inc/session.php';
// include_once '../controllers/index.php';
// // Dynamically define keys to process from $_POST
// $wanted_keys = array_keys($_POST);
// if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
//     echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
//     exit;
// }

// $excluded_keys = ['password'];
// // Loop through each wanted key
// foreach ($wanted_keys as $key) {
//     if (in_array($key, $excluded_keys)) {
//         continue; // skip these keys
//     }

//     if (isset($_POST[$key]) && !empty($_POST[$key])) {
//         $data[$key] = $_POST[$key];
//     }
// }

// $result = $user->user_register($data);


// if ($result['error'] == null) {
//    echo json_encode(['success' => true, 'message' => 'Registration successful!']);
// }else
// {
//     echo json_encode(['success' => false, 'message' => $result['error']]);
// }
?>