<?php
// Add this at the top of your PHP script.
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once './header.php';
include_once '../controllers/index.php';

// Form Configuration
$form_config = [
    'heading' => 'Request'
];

// Fetch  data if an ID is provided
$id = isset($_GET['id']) ? base64_decode($_GET['id']) : 0;
$row = $id > 0 ? $coach->get_by_id($id)['data'] : null;

include_once './navbar.php';
include_once './sidebar.php';
?>
<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Page Header -->
    <?php
    $heading = $form_config['heading'];
    $page_title = $id > 0 ? "Update $heading" : "New $heading";
    include_once './page_header.php';
    ?>
    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body">
                                <div class="card message-card">
                                    <div class="card-header message-header">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="mb-0"><?= $row['f1'] ?></h5>
                                            <small class="text-muted"> <?= $row['created_date'] ?></small>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <p class="mb-1"><strong>Email:</strong> <?= $row['f3'] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="mb-1"><strong>Phone:</strong> <?= $row['f4'] . ' ' . $row['f2'] ?></p>
                                            </div>
                                        </div>
                                        <div>
                                            <strong>Course:</strong>
                                            <?= $course->get_course_name($row['course']) ?>
                                        </div>
                                        <div class="mt-3">
                                            <strong>Country:</strong>
                                            <?= $country->getCountryNameById($row['country'])['name'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
<?php include_once './footer.php'; ?>

</body>

</html>