<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['receiptUpload']) && $_FILES['receiptUpload']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['receiptUpload']['tmp_name'];
        $fileName = $_FILES['receiptUpload']['name'];
        $fileSize = $_FILES['receiptUpload']['size'];
        $fileType = $_FILES['receiptUpload']['type'];
        $uploadDir = 'uploads/';

        // Create upload directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $destPath = $uploadDir . $fileName;

        if(move_uploaded_file($fileTmpPath, $destPath)) {
            echo "File is successfully uploaded.";
        } else {
            echo "There was an error moving the uploaded file.";
        }
    } else {
        echo "No file uploaded or error occurred.";
    }
}
?>
