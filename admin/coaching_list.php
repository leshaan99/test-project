<?php
// Add this at the top of your PHP script.
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once './header.php';
include_once '../controllers/index.php';

$form_config = [
    'heading' => 'Coaching Request List',
    'title' => 'list',
    'new' => 'coaching',
    'table' => ['th' => ['Name', 'Email', 'Course Name', 'Mobile', 'Country']],
    'db_table' => 'Coaches',
    'redirect' => 'Coaching_list',
];

$list = $coach->get_all_with_delete()['error'] === null ? $coach->get_all_with_delete()['data'] : null;


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
                                            <td><?= $row['f3'] ?></td>
                                            <td> <?= htmlspecialchars($course->get_course_name($row['course'])) ?></td>
                                            <td><?= $row['f4'] . ' ' . $row['f2'] ?></td>
                                            <td><?= $country->getCountryNameById($row['country'])['name']; ?></td>

                                        </tr>
                                <?php }
                                } ?>
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