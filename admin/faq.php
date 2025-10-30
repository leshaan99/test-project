<?php
// Add this at the top of your PHP script.
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once './header.php';
include_once '../controllers/index.php';

// Form Configuration
$form_config = [
    'heading' => 'Message',
    'form_action' => 'data/register_faq.php',
    'inputs' => [
        'id' => ['type' => 'hidden', 'value' => ''],
        'f1' => ['label' => 'Showing Question', 'type' => 'textarea', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group'],
        'f2' => ['label' => 'Showing Answer', 'type' => 'textarea', 'class' => 'form-control summernote', 'div_class' => 'col-lg-8 col-md-8 form-group'],
    ],
];

// Fetch  data if an ID is provided
$id = isset($_GET['id']) ? base64_decode($_GET['id']) : 0;
$row = $id > 0 ? $faq->get_by_id($id)['data'] : null;

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
                                            <h5 class="mb-0"><?= $row['f3'] ?></h5>
                                            <small class="text-muted"> <?= $row['created_date'] ?></small>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <p class="mb-1"><strong>Email:</strong> <?= $row['f4'] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="mb-1"><strong>Phone:</strong> <?= $row['f5'] ?></p>
                                            </div>
                                        </div>
                                        <div class="message-content">
                                            <strong>Subject:</strong>
                                            <p><?= $row['f6'] ?></p>
                                        </div>
                                        <div class="message-content">
                                            <strong>Description:</strong>
                                            <p><?= $row['f7'] ?></p>
                                        </div>
                                    </div>
                                </div>

                                <form action="<?= htmlspecialchars($form_config['form_action']) ?>" method="post"
                                    enctype="multipart/form-data">
                                    <div class="row">
                                        <label for="topic" class="form-label"><h5>If you want to display the homepage as FAQs</h5></label>
                                    </div>
                                    <div class="row">
                                        <?php renderInputs($form_config, $row); ?>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 form-group">
                                            <button type="submit"
                                                class="btn btn-block btn-outline-<?= $id > 0 ? 'success' : 'secondary' ?>">
                                                <?= $id > 0 ? 'Update Now' : 'Add New' ?>
                                            </button>
                                        </div>
                                        <div class="col-lg-2 col-md-2 form-group">
                                            <button type="reset" class="btn btn-block btn-outline-warning">Reset</button>
                                        </div>
                                    </div>
                                </form>
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