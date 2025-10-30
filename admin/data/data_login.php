<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../session.php';

include_once  '../../controllers/index.php';


$result = $auth->admin_login($_POST['a_username'], $_POST['a_password']);

if (empty($_POST['a_username'])) {
  if (empty($_POST['a_password'])) {
    $_SESSION['error'] = 'Both username and password are required.';
  } else {
    $_SESSION['error'] = 'Username is required.';
  }
  header('Location: ../index.php?error=true');
  exit();
}

if (empty($_POST['a_password'])) {
  $_SESSION['error'] = 'Password is required.';
  header('Location: ../index.php?error=true');
  exit();
}

if ($result['error'] == null) {
  generateSessionKey($_POST['a_username']);
  $admin = $result['data'];

  $_SESSION['login'] = $admin['id'];
  $_SESSION['role'] = $admin['f1'];
  $_SESSION['email'] = $_POST['a_username'];

  if ($admin['f1'] < 3) {
    $_SESSION['login_name'] = $admin['f6'];
  } else {

    $_SESSION['login_name'] = $admin['f4'];
  }
  header('Location: ../dashboard');
  $result['error'] = null;
  $_SESSION['error'] = $result['error'];

  exit();
} else {

  if ($result['error'] == 'user not found') {

    header('Location: ../index?error=1');
  } elseif ($result['error'] == 'wrong password') {
    header('Location: ../index?error=1');
  }

  $_SESSION['error'] = $result['error'];
}




function generateSessionKey($email)
{
  // Ensure the session is started
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  $csrf = generateCSRFToken();
  $sessionId = session_id(); // Get the current session ID
  $s_key = $csrf . $email .  $sessionId; // Concatenate timestamp, email, password, and session ID 
  $key = base64_encode($s_key); // Generate the session key using HMAC with the app key  
  $_SESSION['session_key'] = $key; // Store the session key in the session



  return $key;
}


function generateCSRFToken()
{
  if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generate a 32-byte random token and convert it to a hexadecimal string
  }
  return $_SESSION['csrf_token'];
}
