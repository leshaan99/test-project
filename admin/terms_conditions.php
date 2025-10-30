<?php
include_once './header.php';
$type = isset($_GET['type']) ? $_GET['type'] : '';


if ($type === 'terms') {
    $heading = 'Terms & Conditions';
    $id = 1; // or use directly 'terms' in DB
} elseif ($type === 'privacy') {
    $heading = 'Privacy Policy';
    $id = 2;
} else {
    $heading = 'Document';
    $id = 0;
}

$form_config = [
    'heading' => $heading,
    'form_action' => 'data/register_policies.php',
    'inputs' => [
        'id' => ['type' => 'hidden', 'value' => $id],
        'f1' => ['label' => 'Text', 'type' => 'textarea', 'class' => 'form-control summernote', 'div_class' => 'col-lg-12 col-md-12 form-group'],
    ],
];

$row = $policies->get_by_id($id)['data'] ?? [];

include_once './navbar.php';
include_once './sidebar.php';
?>
<!-- Content Wrapper -->
<div class="content-wrapper">
    <?php
    $page_title = $id > 0 ? "Update $heading" : "New $heading";
    include_once './page_header.php';
    ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= htmlspecialchars($form_config['form_action']) ?>" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <?php renderInputs($form_config, $row); ?>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 form-group">
                                        <button type="submit" class="btn btn-block btn-outline-<?= $id > 0 ? 'success' : 'secondary' ?>">
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