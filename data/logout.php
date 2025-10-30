<?php


session_start();


unset($_SESSION['u_id']);
unset($_SESSION['user_name']);
unset($_SESSION['user_email']);
unset($_SESSION['login_sucess']);
unset($_SESSION['user_name']);
unset($_SESSION['device']);
unset($_SESSION['profile_image']);

session_destroy();
header('Location: ../index');
exit();

