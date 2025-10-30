<?php



include_once  '../inc/session.php';
include_once  '../inc/functions.php';
include_once   '../inc/sys.php';
include_once   '../inc/env.php';
include_once  '../controllers/index.php';

if (isset($_SESSION['login'])) {
    header('Location: dashboard');
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $setting->getSettings('f3') ?></title>


    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/show-password-toggle.css">

</head>



<?php

if (isset($_GET['error'])) {
    $error = $_GET['error'];
} else {

    $error = '';

    unset($_SESSION['error']);;
}



?>

<body class="bg">
    <section class="h-100">
        <div class="container h-100">

            <div class="row justify-content-sm-center h-100">

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9  ">


                    <div class="card  bg-card shadow-lg  my-5  " style="background: #222222;">
                        
                        <div class=" text-center  my-5 container-sm">
                            <img src="../<?= $setting->getSettings('img4') ?>" alt="logo" class="img-fluid">
                        </div>



                        <div class="card-body p-5  ">
                            <div class="mb-3">

                                <?php if ($error != '') { ?>

                                    <div class=" text-center text-danger">
                                        <?php
                                        if ($_SESSION['error'] != null) { ?>


                                            <?= ($_SESSION['error']) ?>


                                        <?php

                                        }

                                        ?>

                                    </div>

                                <?php } ?>


                            </div>


                            <form method="POST" action="data/data_login.php" class="needs-validation" novalidate="" autocomplete="off">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" name="a_username" aria-describedby="basic-addon1">
                                </div>


                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-key"></i></span>
                                    <input type="password" id="password" placeholder="password" name="a_password" class="form-control rounded-right" required>
                                    <button id="toggle-password" type="button" class="d-none" aria-label="Show password as plain text. Warning: this will display your password on the screen.">
                                    </button>
                                </div>




                                <div class="d-flex align-items-center">
                                    <div class="form-check">
                                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                        <label for="remember" class="form-check-label">Remember Me</label>
                                    </div>
                                    <button type="submit" class="btn   btn-primary  ms-auto">
                                        Login
                                    </button>
                                </div>
                            </form>



                        </div>

                        <div class="card-footer py-3 border-0">
                            <div class="text-center">
                                <strong>Copyright &copy; <?= date("Y") ?> <a href="<?= $setting->getSettings('f6') ?>"><?= $setting->getSettings('f1') ?></a>.</strong> All rights reserved.
                                <div class="float-right d-none d-sm-inline-block"> <b>Version</b> 3.0.2 </div>
                            </div>
                        </div>

                    </div>


                </div>

            </div>

        </div>

    </section>

    <script src="assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="assets/js/show-password-toggle.js" type="text/javascript"></script>
</body>

</html>