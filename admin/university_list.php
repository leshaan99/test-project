<?php
include_once './header.php'; 
include_once '../controllers/index.php';


if (!isset($country)) {
    $country = new Country();
}

$form_config = [
    'heading' => 'University List',
    'title' => 'list',
    'new' => 'university',
    'table' => ['th' => ['University Name', 'Country', 'Email', 'URL', 'Establish Year', 'Action']],
    'db_table' => 'universities',
    'redirect' => 'university_list',
];

if (isset($_GET['country'])) {
    $country_id = base64_decode($_GET['country']);
    $list = $university->get_all_by_country($country_id)['error'] === null ? $university->get_all_by_country($country_id)['data'] : null;
} else {
    $list = $university->get_all_with_delete()['error'] === null ? $university->get_all_with_delete()['data'] : null;
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
                                            <td><a href="<?= $form_config['new'] ?>?id=<?= base64_encode($row['id']); ?>"><?= $row['f1'] ?></a></td>
                                            <td>
                                                <?php
                                                $country_id = $row['country'];
                                                $country_name = $country->getCountryNameById($country_id);
                                                echo $country_name['error'] === null ? $country_name['name'] : 'Not Found';
                                                ?>
                                            </td>
                                            <td><?= $row['f3'] ?></td>
                                            <td><?= $row['f4'] ?></td>
                                            <td><?= $row['f5'] ?></td>
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
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once './footer.php'; ?>
</body>
</html>
