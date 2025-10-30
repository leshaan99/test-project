<?php 
include_once '../../controllers/index.php';
include_once '../../inc/functions.php';

// Set target directory and page name
$target_dir = "../../uploads/blogs/";
$targ_front = "./uploads/blogs/";
$page = 'blog';

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

// Dynamically get image keys from $_FILES
$image_keys = array_filter(array_keys($_FILES), function ($key) {
    return preg_match('/^img\d+$/', $key); // Match keys like 'img1', 'img2', 'img3', etc.
});

// Handle image uploads dynamically
foreach ($image_keys as $key) {
    if ($uploaded_file = uploadPic($key, $target_dir)) {
        // Save the file path in the corresponding data key
        $data[$key] = $targ_front . $uploaded_file;
    }
}

// Determine operation (Update or Register)
$is_update = $data['id'] > 0;
$timestamp = date('Y-m-d H:i:s');


if ($is_update) {

    $data['updated_date'] = $timestamp;
    $result = $blog->update($data);
} else {

    $data['created_date'] = $timestamp;
    $result = $blog->register($data);
}

// Redirect to appropriate page based on the operation and result
$redirect_url = redirect_page($is_update, $result, $data['id'], $page);

header("Location: $redirect_url");

