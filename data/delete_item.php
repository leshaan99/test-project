<?php
session_start();
include_once '../inc/session.php';
include_once '../controllers/index.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request method.';
    echo json_encode($response);
    exit;
}

$id = $_POST['id'] ?? null;
$type = $_POST['type'] ?? null;

if (!$id && !$type) {
    $response['message'] = 'Invalid ID or type.';
    echo json_encode($response);
    exit;
}

if ($type === 'document') {
    $result = $document->delete_by_id($id);
} elseif ($type === 'application') {
    $result = $application->delete_by_id($id);
} elseif ($type === 'request') {
    $result = $requestDocument->delete_by_id($id);
} elseif ($type === 'clear') {
    $result = $notification->delete(['user' => $_SESSION['u_id']]);
} else {
    $response['message'] = 'Invalid type.';
    echo json_encode($response);
    exit;
}

if ($result['status'] > 0) {
    $response['success'] = 1;
    $response['message'] = ucfirst($type) . ' deleted successfully.';
} else {
    $response['message'] = $result['error'] ?? 'Failed to delete ' . $type . '.';
}

echo json_encode($response);
exit;
