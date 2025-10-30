<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

header('Content-Type: application/json');
ob_clean(); // Clear any previous output before sending JSON
ob_start(); // Start output buffering

$response = ['success' => 0, 'message' => 'Invalid request.'];

if (!isset($_POST['search']) && !isset($_POST['study_level']) && !isset($_POST['country_id']) && !isset($_POST['category'])) {
    echo json_encode(['success' => 0, 'message' => 'Missing search parameters.']);
    exit;
}

$search = trim($_POST['search'] ?? '');
$study_level = trim($_POST['study_level'] ?? '');
$country_id = trim($_POST['country_id'] ?? '');
$category = trim($_POST['category'] ?? '');

if (empty($search) && empty($study_level) && empty($country_id) && empty($category)) {
    echo json_encode(['success' => 0, 'message' => 'Please provide at least one search parameter.']);
    exit;
}

$_SESSION['study_level'] = $study_level;
$_SESSION['country_id'] = $country_id;
$_SESSION['study_subject'] = $category;


$response = ['success' => 1, 'message' => 'Filters applied successfully.'];

ob_end_clean(); // Clear output buffer before JSON response
echo json_encode($response);
exit;
?>