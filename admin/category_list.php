<?php
// Add this at the top of your PHP script.
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once './header.php';
include_once '../controllers/index.php';

$form_config = [
    'heading' => 'Category List',
    'title' => 'list',
    'new' => 'category',
    'table' => ['th' => ['Category Name','View Courses','Action']],
    'db_table' => 'categories',
    'redirect' => 'category_list',
];

$list = $category->get_all_with_delete()['error'] === null ? $category->get_all_with_delete()['data'] : null;


?>

<?php include_once './navbar.php'; ?>

<?php include_once './sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <?php
        $heading = $form_config['heading'];
        $page_title = $form_config['title'];
        include_once './page_header.php';
    ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->
                <div class="card">
                    <?php if ($_SESSION['role'] < 3) { ?>
                        <div class="card-header">
                            <h3 class="card-title">
                            <button type="button" class="btn btn-app" onclick="location.href ='<?= $form_config['new'] ?>'">
                                    <i class="fas fa-file"></i>Add New
                                </button>
                            </h3>
                        </div>
                    <?php } ?>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <?php foreach ($form_config['table']['th'] as $header) {
                                        echo $header === 'Action' ? '<th style="width:3%; text-align: center;">' . $header . '</th>' : '<th>' . $header . '</th>';
                                    } ?>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <?php foreach ($form_config['table']['th'] as $header) {
                                        echo $header === 'Action' ? '<th style="width:3%; text-align: center;">' . $header . '</th>' : '<th>' . $header . '</th>';
                                    } ?>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php if ($list) {
                                    $i = 1;
                                    foreach ($list as $row) { ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><a href="<?= $form_config['new'] ?>?id=<?= base64_encode($row['id']); ?>"><?= $row['f1'] ?></a></td>
                                            <td><a href="course_list?category=<?= base64_encode($row['id']); ?>">View</a></td>

                                            <td>
                                                <?php if ($row['status'] == '1') { ?>
                                                    <button type="button" class="btn btn-block btn-outline-danger btn-flat" onclick="delete_record('<?= $row['id']; ?>', '<?= $form_config['db_table']; ?>', 'id', '<?= $form_config['redirect']; ?>');">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                <?php } else { ?>
                                                    <button type="button" class="btn btn-block btn-outline-success btn-flat" onclick="activate_record('<?= $row['id']; ?>', '<?= $form_config['db_table']; ?>', 'id', '<?= $form_config['redirect']; ?>');">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->


</div>
<?php include_once './footer.php'; ?>

</body>

</html>