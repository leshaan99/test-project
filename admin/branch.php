<?php
// Add this at the top of your PHP script.
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once './header.php';
include_once '../controllers/index.php';

// Form Configuration
$form_config = [
    'heading' => 'Branch',
    'form_action' => 'data/register_branch.php',
    'inputs' => [
        'id' => ['type' => 'hidden', 'value' => ''],
        'f1' => ['label' => 'Branch Name', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-12 col-md-12 form-group','required' => true],
        'f2' => ['label' => 'Country', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-12 col-md-12 form-group','required' => true],
        'f3' => ['label' => 'Address', 'type' => 'textarea', 'class' => 'form-control', 'div_class' => 'col-lg-12 col-md-12 form-group'],
        'f4' => ['label' => 'Contact Number', 'type' => 'mobile', 'class' => 'form-control', 'div_class' => 'col-lg-12 col-md-12 form-group','required' => true],
        'f5' => ['label' => 'E mail', 'type' => 'email', 'class' => 'form-control', 'div_class' => 'col-lg-12 col-md-12 form-group','required' => true],
        'img1' => ['label' => 'Image', 'type' => 'file', 'accept' => 'image/*', 'preview' => true, 'div_class' => 'col-lg-4 col-md-4 form-group'],

    ],
];

// Fetch  data if an ID is provided
$id = isset($_GET['id']) ? base64_decode($_GET['id']) : 0;
$row = $id > 0 ? $branch->get_by_id($id)['data'] : null;

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
                            <form action="<?= htmlspecialchars($form_config['form_action']) ?>" method="post"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <?php renderImageInputs($form_config, $row); ?>
                                </div>

                                <?php renderInputs($form_config, $row); ?>

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

<script>
    const formConfig = <?= json_encode($form_config); ?>;
    previewImage(formConfig);
</script>


</body>

</html>