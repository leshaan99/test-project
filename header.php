<?php
include_once  './inc/sys.php';
include_once  './inc/functions.php';
include_once './inc/session.php';
include_once  './controllers/index.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $setting->getSettings('f1') ?></title>
    <link rel="icon" href="<?= $setting->getSettings('img1')?>" type="image/png">

    <link rel="stylesheet" href="./assets/css/main.css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Splide CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">

    <!-- Splide JS -->

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            padding: 0;
        }
    </style>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


    <script type="text/javascript" src="assets/js/sweetalert.min.js" id="contact-form-7-js"></script>
    <script type="text/javascript" src="assets/js/main.js" id="contact-form-7-js"></script>


</head>

<body class="bg-gray-50   min-h-screen relative ">


    <!-- Spinner -->
    <div id="spinner" class="fixed inset-0 flex items-center justify-center bg-white z-50">
        <div class="w-12 h-12 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
    </div>


    <?php

    if(isset($_SESSION['update']) && $_SESSION['update'] == true)
    {
       
     
        echo '<script>  update_message("'.$_SESSION['message'].'");</script>';
        unset($_SESSION['update']);
        unset($_SESSION['message']);
    }

    if(isset($_SESSION['error']) && $_SESSION['error'] == true)
    {
       
     
        echo '<script>  error_message("'.$_SESSION['error_message'].'");</script>';
        unset($_SESSION['error']);
        unset($_SESSION['error_message']);
    }

  

    ?>