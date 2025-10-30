<?php 
include_once '../../controllers/index.php';
include_once '../../inc/functions.php';

// Set target directory and page name
$page = 'document_type';

// Dynamically define keys to process from $_POST
$wanted_keys = array_keys($_POST);

// Initialize data array and set ID
$data = [
    'id' => isset($_POST['id']) ? (int)$_POST['id'] : 0,
    'status' => 1,
];

// Process input keys dynamically
foreach ($wanted_keys as $key) {
    if (!empty($_POST[$key])) {
        $data[$key] = in_array($key, ['created_by', 'updated_by']) ? (int)$_POST[$key] : $_POST[$key];
    }
}



// Determine operation (Update or Register)
$is_update = $data['id'] > 0;
$timestamp = date('Y-m-d H:i:s');


if ($is_update) {

    $data['updated_date'] = $timestamp;
    $result = $documentTypes->update($data);
} else {

    $data['created_date'] = $timestamp;
    $result = $documentTypes->register($data);
}

// Redirect to appropriate page based on the operation and result
$redirect_url = redirect_page($is_update, $result, $data['id'], $page);

header("Location: $redirect_url");
