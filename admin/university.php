<?php
// Add this at the top of your PHP script.
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once './header.php';



$country = $country->get_all()['error'] === null ? $country->get_all()['data'] : null;

$country_items = [];
if ($country) {
    foreach ($country as $cn) {
        $country_items[] = [
            'value' => $cn['id'], // Assuming 'id' is the field for the university ID
            'label' => $cn['f1'], // Assuming 'name' is the field for the university name
        ];
    }
}


// Form Configuration
$form_config = [
    'heading' => 'University',
    'form_action' => 'data/register_university.php',
    'inputs' => [
        'id' => ['type' => 'hidden', 'value' => ''],
        'f1' => ['label' => 'University Name', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-12 col-md-12 form-group','required' => true],
        'f3' => ['label' => 'Email', 'type' => 'email', 'class' => 'form-control', 'div_class' => 'col-lg-12 col-md-12 form-group'],
        'f4' => ['label' => 'Url', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-12 col-md-12 form-group'],
        'f5' => ['label' => 'Establish Year', 'type' => 'date', 'class' => 'form-control', 'div_class' => 'col-lg-12 col-md-12 form-group'],
        'f6' => ['label' => 'Location', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-12 col-md-12 form-group'],
        'img1' => ['label' => 'University Logo', 'type' => 'file', 'accept' => 'image/*', 'preview' => true, 'div_class' => 'col-lg-4 col-md-4 form-group'],
        'country' => ['label' => 'Country','type' => 'combobox','class' => 'form-control','div_class' => 'col-lg-12 col-md-12 form-group','placeholder' => 'Select Country','items' => $country_items,'required' => true],




    ],
];

// Fetch  data if an ID is provided
$id = isset($_GET['id']) ? intval(base64_decode($_GET['id'])) : 0;
$row = ($id > 0 && isset($university)) ? $university->get_by_id($id)['data'] : null;

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