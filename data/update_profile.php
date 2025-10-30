<?php

 


include_once '../inc/session.php';
include_once '../controllers/index.php';
include_once '../inc/functions.php';


// Set target directory and page name
 
$page = 'profile';


// Dynamically define keys to process from $_POST
$wanted_keys = array_keys($_POST);


// Initialize data array and set ID
$data = [
   
    'status' => 1,
];

// Process input keys dynamically
foreach ($wanted_keys as $key) {
    if (!empty($_POST[$key])) {
        $data[$key] = in_array($key, ['created_by', 'updated_by']) ? (int)$_POST[$key] : $_POST[$key];
    }
}



 $result = $user->update($data);

 


 if ($result) {
    // Redirect to profile page with success message
    $_SESSION['profile_update'] = true;
    $_SESSION['profile_msg'] = "Sucess Fully Update";
    header('Location: ../profile');
} else {
    // Redirect to profile page with error message
    $_SESSION['profile_error'] = true;
    $_SESSION['profile_error_message'] = $result['error'];
    header('Location: ../profile');
}
exit;
