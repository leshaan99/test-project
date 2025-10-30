<?php
include_once './header.php';
$form_config = [
    'heading' => 'Student List',
    'title' => 'list',
    'new' => 'user',
    'table' => ['th' => ['Student Name', 'Email', 'Date of Birth', 'Contact Number', 'Action']],
    'db_table' => 'users',
    'redirect' => 'user_list',
];
$list = $user->get_all_with_delete()['error'] === null ? $user->get_all_with_delete()['data'] : null;

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
                                <button type="button" class="btn btn-app" onclick="location.href ='user.php?level=<?= base64_encode($level) ?>'">
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
                                            <td><a href="<?= $form_config['new'] ?>?id=<?= base64_encode($row['id']); ?>"><?= $row['f6'] ?></a></td>
                                            <td><?= $row['f1'] ?></td>
                                            <td><?= $row['f14'] ?></td>
                                            <td><?= $row['f3'] ?></td>
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