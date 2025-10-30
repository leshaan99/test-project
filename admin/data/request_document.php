<?php
include_once '../../controllers/index.php';
include_once '../../inc/functions.php';
include_once '../../inc/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'user' => $_POST['user_id'],
        'document_type' => $_POST['document_type'],
        'application' => $_POST['application_id'],
        'f2' => $_POST['document_description'],
        'status' => 1
    ];

    $docName = $documentTypes->get_doc_type_name($_POST['document_type']);
    $courseName = $course->get_course_name($_POST['course_id']);

    $notifidata = [
        'user' => $_POST['user_id'],
        'f1' => 'You need to upload' . ' ' . $docName . ' for ' . $courseName,
        'f2' => 'Due by: ' . date('M j, Y', strtotime('+5 days')),
        'status' => 1
    ];

    $result = $requestDocument->register($data);
    $notification->register($notifidata);

    if (!$result['error']) {
        echo json_encode([
            'success' => true,
            'message' => 'Document request registered successfully.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to register request.',
            'error' => $result['error']
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
}
