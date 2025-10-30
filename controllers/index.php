<?php
// Class AutoLoader implements
declare(strict_types=1);

use Dom\DocumentType;

spl_autoload_register(function ($class) {
    include_once  __DIR__ . "/$class.php";
});
require_once "config.php";
// Db instant
$database = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
// Controllers intialized
$auth = new AuthController($database);
$user = new UserController($database);
$admin = new AdminController($database);
$course = new CourseController($database);
$application = new ApplicationController($database);
$slide = new SlideController($database);
$university = new UniversityController($database);
$country = new CountryController($database);
$setting = new SettingController($database);
$branch = new BranchController($database);
$my_clients = new MyUsersController($database);
$testimonial = new TestimonialController($database);
$blog = new BlogController($database);
$document = new DocumentController($database);
$event = new EventController($database);
$about = new AboutController($database);
$applicationStatus = new ApplicationStatusController($database);
$faq = new FaqController($database);
$branchForm = new FormController($database);
$category = new CategoryController($database);
$coach = new CoachController($database);
$documentTypes = new DocumentTypeController($database);
$requestDocument = new RequestDocumentController($database);
$notification = new NotificationController($database);
$policies = new PolicyController($database);

// Db controller 
$db = new DbController($database);



function dd($res){
var_dump($res);
exit;
}