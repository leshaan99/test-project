<?php
include_once '../../controllers/index.php';

if (isset($_GET['a_id'])) {
    $a_id = base64_decode($_GET['a_id']);
    $type = base64_decode($_GET['type']);
    
    $adminData = $admin->getAdminById($a_id);
    
    // Check if admin data exists and is not null
    if (!isset($adminData['admin']) || $adminData['admin'] === null) {
        header('Location: ../dashboard?error=admin_not_found');
        exit();
    }
    
    $admin = $adminData['admin']; // This is where the actual admin data is
    
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    
    // Clear existing session
    unset($_SESSION['login']);
    unset($_SESSION['login_name']);
    unset($_SESSION['role']);
    
    // Set new session
    $_SESSION['login'] = $a_id;
    $_SESSION['role'] = $type;
  
    
    header('Location: ../dashboard');
    exit();
} else {
    // Handle error case
    header('Location: ../dashboard?error=invalid_request');
    exit();
}