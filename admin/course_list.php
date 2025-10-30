<?php
include_once './header.php';
include_once '../controllers/index.php';

$form_config = [
    'heading' => 'Course List',
    'title' => 'list',
    'new' => 'course',
    'table' => ['th' => ['Course Name', 'University', 'Start Date', 'Category', 'Fee ($)', 'Study Level', 'Action']],
    'db_table' => 'courses',
    'redirect' => 'course_list',
];

if (isset($_GET['category'])) {
    $categoryId = base64_decode($_GET['category']);
    $list = $course->get_by_foreignKey('category', $categoryId)['error'] === null ? $course->get_by_foreignKey('category', $categoryId)['data'] : null;
} else {
    $list = $course->get_all_with_delete()['error'] === null ? $course->get_all_with_delete()['data'] : null;
}

?>

<?php include_once './navbar.php'; ?>
<?php include_once './sidebar.php'; ?>

<div class="content-wrapper">
    <?php
    $heading = $form_config['heading'];
    $page_title = $form_config['title'];
    include_once './page_header.php';
    ?>
    <section class="content">
        <div class="row">
            <div class="col-12">
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
                                            <td><a href="<?= $form_config['new'] ?>?id=<?= base64_encode($row['id']); ?>"><?= $row['f2'] ?></a></td>
                                            <td>
                                                <?php
                                                $id = $row['university'];
                                                $university_name = $university->getUniversityCountryIdNameImageById($id);
                                                echo $university_name['error'] === null ? $university_name['name'] : 'Not Found';
                                                ?>
                                            </td>
                                            <td><?= $row['f6'] ?></td>
                                            <td><?php
                                                $catName = $category->getCategoryNameById($row['category']);
                                                echo $catName['name'];
                                                ?></td>
                                            <td><?= $row['f5'] ?></td>
                                            <td><?= $row['f4'] ?></td>
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