<?php

include_once '../inc/session.php';
include_once '../controllers/index.php';
include_once '../inc/functions.php';
include_once '../emails/thank_email.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'course' => $_POST['course'],
        'country' => $_POST['country'],
        'f1' => $_POST['name'],
        'f2' => $_POST['phone'],
        'f3' => $_POST['email'],
        'f4' => $_POST['country_code']
    ];

    $result = $coach->register($data);
    $sendOtpResponse = send_thank($_POST['email']);


    if ($result) {
        echo json_encode([
            'success' => true,
            'message' => 'Message sent successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to send message'
        ]);
    }
    exit;
}
