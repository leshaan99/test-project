<?php
include_once '../session.php';
include_once '../../controllers/index.php';
include_once '../../inc/functions.php';

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($id === 2) {
    $page = 'terms_conditions?type=privacy';
} else {
    $page = 'terms_conditions?type=terms';
}

// Dynamically define keys to process from $_POST
$wanted_keys = array_keys($_POST);

$data = [
    'id' => $id,
    'status' => 1,
];

foreach ($wanted_keys as $key) {
    if (!empty($_POST[$key])) {
        $data[$key] = in_array($key, ['created_by', 'updated_by']) ? (int)$_POST[$key] : $_POST[$key];
    }
}

$is_update = $policies->get_by_id($id)['data'] ?? [] > 0;
$timestamp = date('Y-m-d H:i:s');


if ($is_update) {
    $data['updated_date'] = $timestamp;
    $result = $policies->update($data);


} else {

    $data['created_date'] = $timestamp;
    $result = $policies->register($data);
}

if ($imageUploadError) {
    $result['error'] = "Not Support Image";
}

$redirect_url = redirect_page_single($is_update, $result, $id, $page);
header("Location: $redirect_url");
exit;
