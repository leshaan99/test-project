<?php
include_once './header.php';
include_once '../controllers/index.php';

$form_config = [
    'heading' => 'Application List',
    'title' => 'list',
    'new' => 'application',
    'table' => ['th' => ['Applicant Name', 'Course Name', 'Action']],
    'db_table' => 'applications',
    'redirect' => 'application_list',

];

$list = $application->get_all_with_delete()['error'] === null ? $application->get_all_with_delete()['data'] : null;
?>

<?php include_once './navbar.php'; ?>
<?php include_once './sidebar.php'; ?>

<div class="content-wrapper">
    <?php
    $heading = $form_config['heading'];
    $page_title = $form_config['title'];
    include_once './page_header.php'; ?>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
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
                                            <td>
                                                <a href="<?= $form_config['new'] ?>?id=<?= base64_encode($row['id']); ?>&user=<?= base64_encode($row['user']); ?>&course=<?= base64_encode($row['course']); ?>">
                                                    <?= $user->get_name_by_id($row['user']); ?>
                                                </a>
                                            </td>
                                            <td><?= $course->get_course_name($row['course']) ?></td>




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
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once './footer.php'; ?>
</body>

</html>