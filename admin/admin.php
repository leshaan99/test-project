<?php 
include_once './header.php';
include_once '../controllers/index.php';

// Initialize variables
$profile_image = null;
$id = isset($_GET['id']) ? base64_decode($_GET['id']) : 0;
$role = isset($_GET['role']) ? base64_decode($_GET['role']) : 0;
$row = null;
$user_list = null;
$user_act = isset($_SESSION['login']) ? $_SESSION['login'] : 0;
$user_role = isset($_SESSION['role']) ? $_SESSION['role'] : 0;

// Form configuration
$form_config = [
    'heading' => 'Admin', 
    'form_action' => 'data/register_admin.php',
    'inputs' => [
        'f1' => ['type' => 'h', 'skip' => true],
        'f2' => ['label' => 'User Name*', 'type' => 'text', 'required' => true, 'class' => 'form-control'],
        'f3' => ['label' => 'Password*', 'type' => 'password', 'required' => true, 'class' => 'form-control'],
        'f4' => ['label' => 'Staff Id*', 'type' => 'text', 'class' => 'form-control'],
        'f5' => ['label' => 'Pin*', 'type' => 'number', 'minlength' => '4', 'class' => 'form-control'],
        'f6' => ['label' => 'Name*', 'type' => 'text', 'class' => 'form-control'],
        'f8' => ['label' => 'Mobile Number', 'type' => 'text', 'class' => 'form-control'],
        'f9' => ['label' => 'e-mail', 'type' => 'email', 'class' => 'form-control'],
        'f10' => ['label' => 'Address', 'type' => 'textarea', 'class' => 'form-control'],
        'f11' => ['label' => 'National Insurance number', 'type' => 'text', 'class' => 'form-control'],
        'pwd' => ['label' => 'Password*', 'type' => 'password', 'class' => 'form-control'],
        'pwd_conf' => ['label' => 'Confirm Password*', 'type' => 'password', 'class' => 'form-control'],
        'user' => ['type' => 'combobox', 'class' => 'form-control select2bs4', 'dropdown-color' => 'success', 'items' => [['value' => '', 'label' => '---SELECT ---']]]
    ],
    'tab1' => 'Profile',
    'tab2' => 'Reset Password',
    'tab3' => 'My Students',
];

// Fetch admin data if ID exists
if ($id > 0) {
    $row = $admin->getAdminById($id)['admin'];
    $role = $row['f1'];

    if (!empty($row['img1']) && file_exists($row['img1'])) {
        $profile_image = $row['img1'];
    }
}

// Include other required files
include_once './navbar.php';
include_once './sidebar.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <?php
    $heading = $form_config['heading'];
    $page_title = $id > 0 ? "Update $heading" : "New $heading";
    include_once './page_header.php';
    ?>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <?php if ($id > 0) : ?>
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <?php if ($profile_image) : ?>
                                        <input type="file" class="filepond d-none" name="filepond" accept="image/png, image/jpeg, image/gif" />
                                        <div id="profile-image-container" class="filepond--image-preview-wrapper">
                                            <img id="profile-image-filepond" class="filepond--image-preview" src="<?php echo $profile_image; ?>" alt="Profile Image">
                                            <button id="remove-profile-image" class="filepond--action-button filepond--action-button-remove-item" type="button">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" class="svg-inline--fa fa-times fa-w-11" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
                                                    <path fill="currentColor" d="M242.72 256L349.72 149.72C356.36 143.07 356.36 132.93 349.72 126.28L325.72 102.28C319.07 95.64 308.93 95.64 302.28 102.28L195.72 208.72L89.72 102.28C83.07 95.64 72.93 95.64 66.28 102.28L42.28 126.28C35.64 132.93 35.64 143.07 42.28 149.72L149.72 256L42.28 362.28C35.64 368.93 35.64 379.07 42.28 385.72L66.28 409.72C72.93 416.36 83.07 416.36 89.72 409.72L195.72 303.28L302.28 409.72C308.93 416.36 319.07 416.36 325.72 409.72L349.72 385.72C356.36 379.07 356.36 368.93 349.72 362.28L242.72 256z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    <?php else : ?>
                                        <input type="file" class="filepond" name="filepond" accept="image/png, image/jpeg, image/gif" />
                                    <?php endif; ?>
                                </div>

                                <h3 class="profile-username text-center"><?= ($row != null) ? $row['f6'] : ""; ?></h3>
                                <p class="text-muted text-center"><?= ($row != null) ? $row['f9'] : ""; ?></p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <?php if ($role < 3) : ?>
                                        <li class="list-group-item">
                                            <b>My Team</b> <a class="float-right">10</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>My Clients</b> <a class="float-right">20</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Registered</b> <a class="float-right">20</a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($role == 3) : ?>
                                        <li class="list-group-item">
                                            <b>Staff Id</b> <a class="float-right"><?= ($row != null) ? $row['f4'] : ""; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>My Pin</b> <a class="float-right"><?= ($row != null) ? $row['f5'] : ""; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>My clients</b> <a class="float-right">80</a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if (isset($row['id']) && $row['id'] != $_SESSION['login']) : ?>
                                        <button onclick="changeAdmin('<?= base64_encode($row['id']); ?>','<?= base64_encode($row['f1']); ?>')" class="btn btn-primary btn-block">Login</button>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="<?= $id > 0 ? 'col-md-9' : 'col-md-12' ?>">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <?php if ($id == 0) : ?>
                                    <li class="nav-item"><a class="nav-link active" href="#tab-1" data-toggle="tab"><?= $form_config['tab1'] ?></a></li>
                                <?php elseif (($user_act == $row['id'] && $user_role == 2) || $user_act == 1 || ($user_role == 2 && $role == 3)) : ?>
                                    <li class="nav-item"><a class="nav-link active" href="#tab-1" data-toggle="tab"><?= $form_config['tab1'] ?></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab-2" data-toggle="tab"><?= $role == 3 ? "Reset Pin" : "Reset Password" ?></a></li>
                                    <?php if ($role > 1) : ?>
                                        <li class="nav-item"><a class="nav-link" href="#tab-3" data-toggle="tab"><?= $form_config['tab3'] ?></a></li>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <li class="nav-item"><a class="nav-link active" href="#tab-1" data-toggle="tab"><?= $form_config['tab1'] ?></a></li>
                                <?php endif; ?>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="tab-1">
                                    <form action="<?= $form_config['form_action'] ?>" class="form-horizontal" method="post" enctype="multipart/form-data" name="update_members">
                                        <input type="hidden" name="register_by" value="<?= $user_act ?>">
                                        <input type="hidden" name="f1" value="<?= $role ?>">
                                        <?php if ($id == 0) : ?>
                                            <input type="hidden" name="action" value="register">
                                        <?php else : ?>
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="id" value="<?= $id ?>">
                                        <?php endif; ?>

                                        <?php if ($id > 0) : ?>
                                            <div class="row">
                                                <?php
                                                echo input('f6');
                                                echo input('f8');
                                                echo input('f9');
                                                if ($role != 1) {
                                                    echo input('f10');
                                                    echo input('f11');
                                                }
                                                ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="row">
                                            <?php if ($role == 2 && $id == 0) : ?>
                                                <?php
                                                echo input('f6');
                                                echo input('f2');
                                                echo input('f3');
                                                ?>
                                            <?php endif; ?>

                                            <?php if ($role == 3 && $id == 0) : ?>
                                                <?php
                                                echo input('f6');
                                                echo input('f4');
                                                echo input('f5');
                                                ?>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-lg-12 col-md-12 form-group">
                                            <div class="row">
                                                <?php if ($id == 0) : ?>
                                                    <div class="col-lg-3 col-md-3 form-group">
                                                        <button type="submit" name="add_new_Submit" class="btn btn-block btn-danger">Add New</button>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="col-lg-3 col-md-3 form-group">
                                                        <button type="submit" class="btn btn-block btn-success">Update Now</button>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="col-lg-3 col-md-3 form-group">
                                                    <button type="reset" class="btn btn-block btn-warning">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="tab-2">
                                    <form action="<?= $form_config['form_action'] ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="update_by" value="<?= $user_act ?>">
                                        <input type="hidden" name="f1" value="<?= $role ?>">
                                        <input type="hidden" name="action" value="reset_pwd">
                                        <input type="hidden" name="id" value="<?= $id ?>">

                                        <?php if (($role == 1 || $role == 2) && $id > 0) : ?>
                                            <?php
                                            echo input('pwd');
                                            echo input('pwd_conf');
                                            ?>
                                        <?php endif; ?>

                                        <?php if ($role == 3 && $id > 0) : ?>
                                            <?php
                                            $form_config['inputs']['pwd']['label'] = "Pin";
                                            $form_config['inputs']['pwd']['type'] = "number";
                                            $form_config['inputs']['pwd_conf']['label'] = "Confirm Pin";
                                            $form_config['inputs']['pwd_conf']['type'] = "number";
                                            
                                            echo input('pwd');
                                            echo input('pwd_conf');
                                            ?>
                                        <?php endif; ?>

                                        <div class="col-lg-12 col-md-12 form-group">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 form-group">
                                                    <button type="submit" class="btn btn-block btn-success">Reset</button>
                                                </div>
                                                <div class="col-lg-3 col-md-3 form-group">
                                                    <button type="reset" class="btn btn-block btn-warning">Clear</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="tab-3">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <form action="data/asign_clients.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="register_credit">
                                                    <input type="hidden" name="admin" value="<?= $id ?>">
                                                    <input type="hidden" name="role" value="<?= $role ?>">
                                                    <input type="hidden" name="register_by" value="<?= $user_act ?>">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <span>Select Client</span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <?php echo input('user'); ?>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-block btn-outline-secondary">
                                                                    <i class="fas fa-share"></i> Assign
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="card-body">
                                                <table id="dataT1" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Added By</th>
                                                            <th>Date</th>
                                                            <th style="width:3%; text-align: center;">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if ($user_list != null) : ?>
                                                            <?php $i = 1; foreach ($user_list as $client) : ?>
                                                                <tr>
                                                                    <td><?= $i++; ?></td>
                                                                    <td><?= htmlspecialchars($client['client']) ?></td>
                                                                    <td><?= $admin->get_name_by_id($client['register_by']) ?></td>
                                                                    <td><?= printDate($client['register_date']) ?></td>
                                                                    <td>
                                                                        <?php if ($client['status'] == '1') : ?>
                                                                            <button type="button" class="btn btn-block btn-outline-danger btn-flat" onclick="delete_record('<?= $client['id'] ?>', 'myclients', 'id', 'admin','id=<?= base64_encode($id) ?>');">
                                                                                <i class="fa fa-times"></i>
                                                                            </button>
                                                                        <?php else : ?>
                                                                            <button type="button" class="btn btn-block btn-outline-success btn-flat" onclick="activate_record('<?= $client['id'] ?>', 'myclients', 'id', 'admin','id=<?= base64_encode($id) ?>');">
                                                                                <i class="fa fa-check"></i>
                                                                            </button>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    // FilePond initialization
    document.addEventListener('DOMContentLoaded', function() {
        const imagePath = '<?= $profile_image ?>';
        const userId = '<?= $id ?>';
        const hasImage = Boolean('<?= $profile_image ? 'true' : 'false' ?>');

        // Register plugins
        FilePond.registerPlugin(
            FilePondPluginFileValidateType,
            FilePondPluginImagePreview,
            FilePondPluginImageCrop,
            FilePondPluginImageResize
        );

        // Create FilePond instance
        const pond = FilePond.create(document.querySelector('.filepond'), {
            allowImagePreview: true,
            imagePreviewHeight: 170,
            imageCropAspectRatio: '1:1',
            imageResizeTargetWidth: 200,
            imageResizeTargetHeight: 200,
            stylePanelLayout: 'compact circle',
            server: {
                process: {
                    url: './data/upload_profile_pic.php',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '<?= $_SESSION['csrf_token'] ?? '' ?>'
                    },
                    ondata: (formData) => {
                        formData.append('id', userId);
                        formData.append('target', 'admins');
                        return formData;
                    }
                }
            }
        });

        // Handle remove profile image button
        if (document.getElementById('remove-profile-image')) {
            document.getElementById('remove-profile-image').addEventListener('click', function() {
                document.querySelector('.filepond').classList.remove('d-none');
                document.getElementById('profile-image-container').style.display = 'none';
            });
        }

        // Password toggle functionality
        $(document).on('click', '.toggle-password', function() {
            const target = $(this).data('target');
            const icon = $(this).find('i');
            
            if ($(target).attr('type') === 'password') {
                $(target).attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                $(target).attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });

    function changeAdmin(id, role) {
        if (confirm('Are you sure you want to login as this user?')) {
            window.location.href = 'data/change_admin.php?id=' + id + '&role=' + role;
        }
    }
</script>

<?php include_once './footer.php'; ?>
</body>
</html>