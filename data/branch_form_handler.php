<?php

include_once '../inc/session.php';
include_once '../controllers/index.php';
include_once '../inc/functions.php';
include_once '../emails/thank_email.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'branch' => $_POST['branch_id'],
        'f1' => $_POST['name'],
        'f2' => $_POST['email'],
        'f3' => $_POST['message']
    ];

    $result = $branchForm->register($data);
    $sendOtpResponse = send_thank($_POST['email']);

    if ($result) {
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message_type'] = "error";
    }

    header("Location: ../contactus");
    exit();
}
