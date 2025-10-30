<?php
// Enable error reporting for debugging
include_once '../inc/session.php';
include_once '../controllers/index.php';
// Dynamically define keys to process from $_POST
$wanted_keys = array_keys($_POST);
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}


// Loop through each wanted key
foreach ($wanted_keys as $key) {
    if (isset($_POST[$key]) && !empty($_POST[$key])) {
        $data[$key] = $_POST[$key];
    }
}


 $result = $application->register_applications($data); 





if ($result['error'] == null) {
    echo json_encode(['success' => 1, 'message' => 'egistration successful!']);
 
}else
{
    echo json_encode(['success' => 0, 'message' => $result['error']]);
}
?>