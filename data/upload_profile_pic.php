<?php
include_once  '../controllers/index.php';
include_once '../inc/functions.php';
include_once '../inc/session.php';




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
        $table = isset($_POST['target']) ? $_POST['target'] : '';
        $data['id'] = $id;

        $main_folder = 'user';

        $file_name = basename($_FILES['profile_image']['name']);

        $user_id = $id; // Assuming $user is the same as $id. Adjust this if needed.
        $target_dir = "../uploads/" . $main_folder . "/profile/" . $user_id . "/";

        $tmp = uploadPic('profile_image', $target_dir);




        if ($tmp != '') {
            $data['img1'] = $target_dir . $tmp;

      

            $result = $user->update($data);

            $profile_image = null;

            $profile_image = str_replace("../", "./",   $data['img1']);
            $_SESSION['profile_image'] = $profile_image;


            $response = array('status' => 'success', 'img_path'  => $profile_image);
        } else {
            $response = array('status' => 'error', 'message' => 'There was an error moving the uploaded file.');
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Error in file upload.');
    }
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request method.');
}
header('Content-Type: application/json');
echo json_encode($response);
exit;
