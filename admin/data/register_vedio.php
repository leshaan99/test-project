<?php
include_once '../session.php';
include_once './../../controllers/index.php';
include_once '../../inc/functions.php';

// Define keys to process
$wanted_keys = ['id', 'f1', 'f2', 'f3', 'f4', 'f5', 'created_by', 'updated_by', 'created_date', 'updated_date','status'];
$target_dir = "../../uploads/projects/";
$targ_front = "./uploads/projects/";
$page= 'project';


// Initialize data array and set ID
$data = [
    'id' => isset($_POST['id']) ? (int)$_POST['id'] : 0,
    'status'=>1
];

// Process input keys
foreach ($wanted_keys as $key) {
    if (!empty($_POST[$key])) {
        $data[$key] = in_array($key, ['created_by', 'updated_by']) ? (int)$_POST[$key] : $_POST[$key];
    }
}

// Handle image upload

// uploadMedia('img_file', 'uploads/videos/', ['mp4', 'avi', 'mov', 'mkv']);

if ($uploaded_file = uploadMedia('img_file', $targ_front, ['mp4', 'avi', 'mov', 'mkv','jpg', 'jpeg', 'png', 'gif'])) {
    $data['f3'] = $targ_front . $uploaded_file;
}



// Determine operation (Update or Register)
$is_update = $data['id'] > 0;
$timestamp = date("Y-m-d H:i:s");
$user = $_SESSION['login'];

if ($is_update) {
    $data['updated_by'] = $user;
    $data['updated_date'] = $timestamp;
    $result = $project->update($data);
} else {
    $data['created_by'] = $user;
    $data['created_date'] = $timestamp;
    $result = $project->register($data);
}

$redirect_url = redirect_page($is_update, $result, $data['id'], $page);

header("Location: $redirect_url");
 