<?php
include_once './header.php';

$form_config = [
    'heading' => 'System Configuration',
    'form_action' => 'data/register_settings.php',
    'inputs' => [
        'id' => ['type' => 'hidden', 'value' => ''],
        'f1' => ['label' => 'App Name', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group'],
        'f2' => ['label' => 'App Short Name', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group'],
        'f3' => ['label' => 'App Backend Name', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group'],
        'f4' => ['label' => 'Phone Number', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group'],
        'f5' => ['label' => 'Email', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group'],
        'f6' => ['label' => 'App url', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group'],
        'f7' => ['label' => 'Location', 'type' => 'textarea', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group'],
        'f8' => ['label' => 'About', 'type' => 'textarea', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group'],
        'f9' => ['label' => 'Nav Lables', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group'],
        'f10' => ['label' => 'facebook', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group'],
        'f11' => ['label' => 'Twitter', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group'],
        'f12' => ['label' => 'LinkedIn', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group'],


        'img1' => ['label' => 'Favicon', 'type' => 'file', 'accept' => 'image/*', 'preview' => true, 'div_class' => 'col-lg-4 col-md-4 form-group'],
        'img2' => ['label' => 'header logo', 'type' => 'file', 'accept' => 'image/*', 'preview' => true, 'div_class' => 'col-lg-4 col-md-4 form-group'],
        'img3' => ['label' => 'Footer logo', 'type' => 'file', 'accept' => 'image/*', 'preview' => true, 'div_class' => 'col-lg-4 col-md-4 form-group'],
        'img4' => ['label' => 'Backend Logo', 'type' => 'file', 'accept' => 'image/*', 'preview' => true, 'div_class' => 'col-lg-4 col-md-4 form-group'],
        'img5' => ['label' => 'Backend Nav Logo', 'type' => 'file', 'accept' => 'image/*', 'preview' => true, 'div_class' => 'col-lg-4 col-md-4 form-group'],
         
    ],
];

// Fetch work data if an ID is provided
$id = 1;
$row = ($id > 0 && isset($setting)) ? $setting->get_by_id($id)['data'] : null;



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
                                <div class="row">
                                    <?php renderInputs($form_config, $row); ?>
                                </div>

                                

                                <hr>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 form-group">
                                        <button type="submit"
                                            class="btn btn-block btn-outline-<?= $id >0 ? 'success' : 'secondary' ?>">
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