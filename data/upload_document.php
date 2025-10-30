<?php
include_once '../controllers/index.php';
include_once '../inc/functions.php';
include_once '../inc/session.php';
include_once '../emails/upload_doc_email.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['document_file']) && $_FILES['document_file']['error'] === UPLOAD_ERR_OK) {
        $userId = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $documentName = isset($_POST['document_name']) ? htmlspecialchars($_POST['document_name'], ENT_QUOTES, 'UTF-8') : '';
        $requestId = isset($_POST['request_id']) ? (int)$_POST['request_id'] : 0;
        if (empty($userId)) {
            $response = array('status' => 0, 'message' => 'User ID required.');
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }

        $main_folder = 'user';
        $target_dir = "../uploads/user/profile/documents/" . $userId . "/";

        $uploadedFilePath = uploadFile('document_file', $target_dir);
        if ($requestId) {


            if ($requestId > 0) {
                $data = [
                    'f1' => $uploadedFilePath,
                    'user' => $userId,
                    'id' => $requestId,
                    'status' => 1,
                ];

                $result = $requestDocument->update($data);


                if ($result) {
                    $response = array('status' => 1, 'message' => 'Document updated successfully.');
                } else {
                    $response = array('status' => 0, 'message' => 'Failed to update document information.');
                }
            } else {
                $response = array('status' => 0, 'message' => 'Request ID required.');
                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            }
        } else {
            if ($uploadedFilePath !== '') {
                $data = [
                    'f1' => $uploadedFilePath,
                    'f2' => $documentName,
                    'user' => $userId
                ];

                $result = $document->register($data);

                if ($result) {
                    $response = array('status' => 1, 'message' => 'Document uploaded successfully.');
                } else {
                    $response = array('status' => 0, 'message' => 'Failed to save document information.');
                }
            } else {
                $response = array('status' => 0, 'message' => 'There was an error moving the uploaded file.');
            }
        }
        $sendOtpResponse = feedback($_SESSION['user_email']);
    } else {
        $response = array('status' => 0, 'message' => 'No file uploaded or file upload error.');
    }
} else {
    $response = array('status' => 0, 'message' => 'Invalid request method.');
}

header('Content-Type: application/json');
echo json_encode($response);
exit;
