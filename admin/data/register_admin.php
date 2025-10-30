<?php

include_once '../session.php';
include_once '../../controllers/index.php';
include_once '../../inc/functions.php';


//Fetching Values from URL
if (isset($_POST['id'])) {
    $id = $_POST['id'];
} else {
    $id = 0;
}

if (isset($_POST['f1'])) {
    $f1 = $_POST['f1'];
} else {
    $f1 = '';
}
if (isset($_POST['f2'])) {
    $f2 = $_POST['f2'];
} else {
    $f2 = '';
}
if (isset($_POST['f3'])) {
    $f3 = $_POST['f3'];
} else {
    $f3 = '';
}
if (isset($_POST['f4'])) {
    $f4 = $_POST['f4'];
} else {
    $f4 = '';
}
if (isset($_POST['f5'])) {
    $f5 = $_POST['f5'];
} else {
    $f5 = '';
}
if (isset($_POST['f6'])) {
    $f6 = $_POST['f6'];
} else {
    $f6 = '';
}
if (isset($_POST['f7'])) {
    $f7 = $_POST['f7'];
} else {
    $f7 = '';
}
if (isset($_POST['f8'])) {
    $f8 = $_POST['f8'];
} else {
    $f8 = '';
}
if (isset($_POST['f9'])) {
    $f9 = $_POST['f9'];
} else {
    $f9 = '';
}

if (isset($_POST['f10'])) {
    $f10 = $_POST['f10'];
} else {
    $f10 = '';
}
if (isset($_POST['f11'])) {
    $f11 = $_POST['f11'];
} else {
    $f11 = '';
}


if (isset($_POST['created_by'])) {
    $created_by = $_POST['created_by'];
} else {
    $created_by = 0;
}
if (isset($_POST['updated_by'])) {
    $updated_by = $_POST['updated_by'];
} else {
    $updated_by = 0;
}
if (isset($_POST['created_date'])) {
    $created_date = $_POST['created_date'];
} else {
    $created_date = '';
}
if (isset($_POST['updated_date'])) {
    $updated_date = $_POST['updated_date'];
} else {
    $updated_date = '';
}

// action 
$action = $_POST['action'];


// image location 
//$target_dir = "../../uploads/admin/profile/";
//$m_img = uploadPic("user_profile_image", $target_dir);
// manage admin levels 




if ($action == 'register') {

 

    if ($f1 == 2) {

        $result = $admin->register($f1, $f2, $f3, $f6);



        if ($result['code'] == 200) {
            header('Location: ../admin_list?role=' . base64_encode($f1) . '&error=' . base64_encode(4));
        } else {
            header('Location: ../admin?role=' . base64_encode($f1) . '&error=' . base64_encode(3));
        }
    } else if ($f1 = 3) {
        $result = $admin->register($f1, $f4, $f5, $f6);

        if ($result['code'] == 200) {
            header('Location: ../admin_list?role=' . base64_encode($f1) . '&error=' . base64_encode(4));
        } else {
            header('Location: ../admin?role=' . base64_encode($f1) . '&error=' . base64_encode(3));
        }
    } else {

        header('Location: ../admin?role=' . base64_encode($f1) . '&error=' . base64_encode(5));
    }
}


if ($action == 'update' && $id > 0) {


    $data = ['id' => $id];

    if ($f1 != '') {
        ($data['f1'] = $f1);
    }
    if ($f4 != '') {
        ($data['f4'] = $f4);
    }
    if ($f5 != '') {
        ($data['f5'] = $f5);
    }
    if ($f6 != '') {
        ($data['f6'] = $f6);
    }
    if ($f7 != '') {
        ($data['f7'] = $f7);
    }
    if ($f8 != '') {
        ($data['f8'] = $f8);
    }
    if ($f9 != '') {
        ($data['f9'] = $f9);
    }

    if ($f10 != '') {
        ($data['f10'] = $f10);
    }
    if ($f11 != '') {
        ($data['f11'] = $f11);
    }

    $result = $admin->update($data);

    if ($result['error'] == null) {
        if ($result['status'] == 1) {
            $info = $result['message'];


            $info = implode(" ", $info);
            header('Location: ../admin.php?id=' . base64_encode($id) . '&error=' . base64_encode(1) . '&info=' . base64_encode($info));
        } else {
            header('Location: ../admin.php?id=' . base64_encode($id) . '&error=' . base64_encode(2) . '&info=' . base64_encode($info));
        }
    } else {

        header('Location: ../admin.php?id=' . base64_encode($id) . '&error=' . base64_encode(1));
    }
}

if ($action == 'reset_pwd' && $id > 0) {

    if ($f1 == 2) {
        // admin_reset_password
        if (isset($_POST['pwd'])) {
            $pwd = $_POST['pwd'];
        } else {
            $pwd = '';
        }
        if (isset($_POST['pwd_conf'])) {
            $pwd_conf = $_POST['pwd_conf'];
        } else {
            $pwd = '';
        }


        if ($pwd == $pwd_conf && $pwd != '') {

            $result = $admin->reset_passeord($f1,$id, $pwd);

            if ($result['status'] == 1) {
                $info = $result['message'];
                $info = implode(" ", $info);
                header('Location: ../admin.php?id=' . base64_encode($id) . '&error=' . base64_encode(1) . '&info=' . base64_encode($info));
            } else {
                header('Location: ../admin.php?id=' . base64_encode($id) . '&error=' . base64_encode(2) . '&info=' . base64_encode($info));
            }
        } else {
            header('Location: ../admin.php?id=' . base64_encode($id) . '&error=' . base64_encode(2));
        }
    } else if ($f1 = 3) {
        //carer pin reset
    

        if (isset($_POST['pwd'])) {
            $pwd = $_POST['pwd'];
        } else {
            $pwd = '';
        }
        if (isset($_POST['pwd_conf'])) {
            $pwd_conf = $_POST['pwd_conf'];
        } else {
            $pwd_conf = '';
        }


        if ($pwd == $pwd_conf && $pwd != '') {

            $result = $admin->reset_passeord($f1,$id, $pwd);

            if ($result['status'] == 1) {
                $info = $result['message'];
                $info = implode(" ", $info);
                header('Location: ../admin.php?id=' . base64_encode($id) . '&error=' . base64_encode(1) . '&info=' . base64_encode($info));
            } else {
                header('Location: ../admin.php?id=' . base64_encode($id) . '&error=' . base64_encode(2) . '&info=' . base64_encode($info));
            }
        } else {
            $error_data = array(
                'id' => 0,
                'message' => 'Pin Miss Match',
                'topic' => 'Please check',
                'type' => 1
            );           
        
            $error_json = json_encode($error_data);       
           
            header('Location: ../admin.php?id=' . base64_encode($id) . '&error_c=' . base64_encode($error_json));
        }



    } else {

        header('Location: ../admin?role=' . base64_encode($f1) . '&error=' . base64_encode(5));
    }



















    /* if($pwd == ')
    array (size=6)
  'update_by' => string '1' (length=1)
  'f1' => string '2' (length=1)
  'action' => string 'reset_pwd' (length=9)
  'id' => string '38' (length=2)
  'pwd' => string '' (length=0)
  'pwd_conf' => string '' (length=0)
 dd($_POST);*/
}
