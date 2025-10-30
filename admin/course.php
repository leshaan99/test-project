<?php
include_once './header.php';
// Add this at the top of your PHP script.
error_reporting(E_ALL);
ini_set('display_errors', 1);

$university = $university->get_all()['error'] === null ? $university->get_all()['data'] : null;

$university_items = [];
if ($university) {
    foreach ($university as $uni) {
        $university_items[] = [
            'value' => $uni['id'], 
            'label' => $uni['f1'], 
        ];
    }
}
$category = $category->get_all()['error'] === null ? $category->get_all()['data'] : null;

$category_items = [];
if ($category) {
    foreach ($category as $cat) {
        $category_items[] = [
            'value' => $cat['id'],
            'label' => $cat['f1'], 
        ];
    }
}

// Form Configuration
$form_config = [
    'heading' => 'Courses',
    'form_action' => 'data/register_course.php',
    'inputs' => [
        'id' => ['type' => 'hidden', 'value' => ''],
        'f2' => ['label' => 'Course Name', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-12 col-md-12 form-group','required' => true],
        'f3' => ['label' => 'Course Overview', 'type' => 'textarea', 'class' => 'form-control summernote','placeholder' => 'Description','div_class' => 'col-lg-12 col-md-12 form-group'],
        'f1' => ['label' => 'Requirements', 'type' => 'textarea', 'class' => 'form-control summernote','div_class' => 'col-lg-12 col-md-12 form-group'],
        'f4' => ['label' => 'Study Level', 'type' => 'combobox', 'class' => 'form-control','div_class' => 'col-lg-12 col-md-12 form-group','required' => true,'placeholder' => 'select study level','items' => [['value' => 'Bachelor', 'label' => 'Bachelor'],['value' => 'Master', 'label' => 'Master'],['value' => 'phD', 'label' => 'phD']]],
        'f5' => ['label' => 'Fee', 'type' => 'number', 'class' => 'form-control','div_class' => 'col-lg-12 col-md-12 form-group','required' => true],
        'f6' => ['label' => 'Start Date', 'type' => 'date', 'class' => 'form-control', 'div_class' => 'col-lg-12 col-md-12 form-group','required' => true],
        'category' => ['label' => 'Category', 'type' => 'combobox', 'class' => 'form-control', 'div_class' => 'col-lg-12 col-md-12 form-group','required' => true,'placeholder' => 'Select Category','items' => $category_items,'required' => true],
        'university' => ['label' => 'University','type' => 'combobox','class' => 'form-control','div_class' => 'col-lg-12 col-md-12 form-group','placeholder' => 'Select University','items' => $university_items,'required' => true],

        // 'f7' => ['label' => 'Content 3', 'type' => 'textarea', 'class' => 'form-control summernote', 'div_class' => 'col-lg-12 col-md-12 form-group'],
        // 'img1' => ['label' => 'Upload Image 1', 'type' => 'file', 'accept' => 'image/*', 'preview' => true, 'div_class' => 'col-lg-4 col-md-4 form-group'],
        // 'img2' => ['label' => 'Upload Image 2', 'type' => 'file', 'accept' => 'image/*', 'preview' => true, 'div_class' => 'col-lg-4 col-md-4 form-group'],
        // 'img3' => ['label' => 'Upload Image 3', 'type' => 'file', 'accept' => 'image/*', 'preview' => true, 'div_class' => 'col-lg-4 col-md-4 form-group'],
    ],
];

// Fetch product data if an ID is provided
$id = isset($_GET['id']) ? intval(base64_decode($_GET['id'])) : 0;
$row = ($id > 0 && isset($course)) ? $course->get_by_id($id)['data'] : null;

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