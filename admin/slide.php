<?php
include_once './header.php';

$form_config = [
    'heading' => 'Slider',
    'form_action' => 'data/register_slide.php',
    'inputs' => [
        'id' => ['type' => 'hidden', 'value' => ''],
        'f1' => ['label' => 'Title', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-12 col-md-12 form-group'],
        'img1' => ['label' => 'Slider Image', 'type' => 'file', 'accept' => 'image/*', 'preview' => true, 'div_class' => 'col-lg-4 col-md-4 form-group'],

    ],
];


if (isset($_GET['id'])) {
    $id = base64_decode($_GET['id']);
    $row = $slide->get_by_id($id)['data'];
} else {
    $id = 0;
    $row = null;
}

?>

<?php include_once './navbar.php'; ?>
<?php include_once './sidebar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php
        $heading = $form_config['heading'];
        $page_title = $id > 0 ? "Update $heading" : "New $heading";
        include_once './page_header.php';
    ?>
    <!-- /.content-header -->

    <!-- Main content -->
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
                                <div class="row form-group">
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
                                </div>
                            </form>
                        </div>
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