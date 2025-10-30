<?php
// Add this at the top of your PHP script.
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once './header.php';
include_once '../controllers/index.php';
include_once '../inc/sys.php';


$countryItems = array_map(function ($country) {
    return [
        'value' => $country['name'],
        'label' => $country['name'],
    ];
}, $countryCodes);

// Form Configuration
$form_config = [
    'heading' => 'Student',
    'form_action' => 'data/register_user.php',
    'inputs' => [
        'id' => ['type' => 'hidden', 'value' => ''],
        'f6' => ['label' => 'First Name', 'type' => 'text', 'required' => true, 'placeholder' => 'First Name', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group', 'validation' => ['pattern' => '^[A-Za-z ]{2,25}$', 'minlength' => 1, 'maxlength' => 25, 'message' => 'Must be 1-25 letters only']],
        'f4' => ['label' => 'Middle Name', 'type' => 'text', 'required' => false, 'placeholder' => 'Middle Name', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group', 'validation' => ['pattern' => '^[A-Za-z]{1,25}$', 'minlength' => 1, 'maxlength' => 25, 'message' => 'Must be 1-25 letters only']],
        'f5' => ['label' => 'Last Name', 'type' => 'text', 'required' => false, 'placeholder' => 'Last Name', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group',  'validation' => ['minlength' => 2, 'maxlength' => 50]],
        'f3' => ['label' => 'Contact Number', 'type' => 'mobile', 'required' => true, 'placeholder' => 'Contact Number', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group', 'validation' => ['pattern' => '[0-9]{10,15}', 'message' => 'Must be 10-15 digits']],
        'f1' => ['label' => 'Email Address', 'type' => 'email', 'required' => true, 'placeholder' => 'Email Address', 'disabled' => true, 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group', 'validation' => ['pattern' => '[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$', 'message' => 'Invalid email']],
        'f14' => ['label' => 'Date of Birth', 'type' => 'date', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group'],
        'f8' => ['label' => 'Country Citizenship', 'type' => 'text', 'placeholder' => 'Country Citizenship', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group'],
        'f9' => ['label' => 'Passport Number', 'type' => 'text', 'placeholder' => 'Passport Number', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group',  'validation' => ['minlength' => 6, 'maxlength' => 20, 'message' => 'Must be 6-20 chars']],
        'f10' => ['label' => 'Country', 'type' => 'combobox', 'required' => true, 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group', 'placeholder' => 'Select Country', 'items' => $countryItems,],
        'f11' => ['label' => 'State', 'type' => 'text', 'placeholder' => 'State'],
        'f12' => ['label' => 'City', 'type' => 'text', 'placeholder' => 'City'],
        'f13' => ['label' => 'Address', 'type' => 'textarea', 'placeholder' => 'Address', 'validation' => ['minlength' => 10, 'maxlength' => 200]],
        'f7' => ['label' => 'First Language', 'type' => 'combobox', 'required' => true, 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group', 'placeholder' => 'Select Language', 'items' => [['value' => '', 'label' => 'Select Language'], ['value' => 'English', 'label' => 'English'], ['value' => 'Sinhalees', 'label' => 'Sinhalees'], ['value' => 'French', 'label' => 'French'], ['value' => 'German', 'label' => 'German'], ['value' => 'Chinese', 'label' => 'Chinese'], ['value' => 'Hindi', 'label' => 'Hindi'], ['value' => 'Arabic', 'label' => 'Arabic'], ['value' => 'Portuguese', 'label' => 'Portuguese'], ['value' => 'Russian', 'label' => 'Russian'], ['value' => 'Japanese', 'label' => 'Japanese'], ['value' => 'Italian', 'label' => 'Italian'], ['value' => 'Dutch', 'label' => 'Dutch'], ['value' => 'Korean', 'label' => 'Korean'], ['value' => 'Turkish', 'label' => 'Turkish'], ['value' => 'Other', 'label' => 'Other'],]],
        'f15' => ['label' => 'Gender', 'type' => 'combobox', 'required' => true, 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group',  'placeholder' => 'Select Gender', 'items' => [['value' => 'Male', 'label' => 'Male'], ['value' => 'Female', 'label' => 'Female'], ['value' => 'Other', 'label' => 'Other'],],],
        'f16' => ['label' => 'Marital Status', 'type' => 'combobox', 'required' => true, 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group', 'placeholder' => 'Select Marital Status', 'items' => [['value' => 'Married', 'label' => 'Married'], ['value' => 'Unmarried', 'label' => 'Unmarried'], ['value' => 'Other', 'label' => 'Other'],],],
    ],
];


$profile_image = './assets/img/profile.png';
if (isset($_GET['id'])) {
    $id = base64_decode($_GET['id']);
} else {
    $id = 0;
    $row = null;
}
if ($id > 0) {
    $row = $user->get_by_id($id)['data'];
    if ($row['img1']  && $row['img1'] != '') {
        $profile_image = $row['img1'];
        if (!file_exists($profile_image)) {
            $profile_image = './assets/img/profile.png';
        }
    }
}

$_SESSION['user_email'] = $row['f1'] ?? '';
if (isset($_GET['level'])) {
    $level = base64_decode($_GET['level']);
} else {
    $level = 1;
}
$documents =  $document->get_my_documents($id);
$requestDocuments = $requestDocument->get_by_foreignKey('user', $id, 'created_date DESC');

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
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile fs-6">

                            <div class="text-center">
                                <?php if ($profile_image) { ?>
                                    <input type="file" class="filepond d-none" name="filepond" accept="image/png, image/jpeg, image/gif" />

                                    <div id="profile-image-container" class="filepond--image-preview-wrapper">
                                        <img id="profile-image-filepond" class="filepond--image-preview" src="<?php echo $profile_image; ?>" alt="Profile Image">
                                        <?php
                                        if ($id > 0) {
                                            echo '<button id="remove-profile-image" class="filepond--action-button filepond--action-button-remove-item" type="button">';
                                        }
                                        ?>

                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" class="svg-inline--fa fa-times fa-w-11" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
                                            <path fill="currentColor" d="M242.72 256L349.72 149.72C356.36 143.07 356.36 132.93 349.72 126.28L325.72 102.28C319.07 95.64 308.93 95.64 302.28 102.28L195.72 208.72L89.72 102.28C83.07 95.64 72.93 95.64 66.28 102.28L42.28 126.28C35.64 132.93 35.64 143.07 42.28 149.72L149.72 256L42.28 362.28C35.64 368.93 35.64 379.07 42.28 385.72L66.28 409.72C72.93 416.36 83.07 416.36 89.72 409.72L195.72 303.28L302.28 409.72C308.93 416.36 319.07 416.36 325.72 409.72L349.72 385.72C356.36 379.07 356.36 368.93 349.72 362.28L242.72 256z"></path>
                                        </svg>
                                        </button>
                                    </div>
                                <?php  } else { ?>
                                    <input type="file" class="filepond " name="filepond" accept="image/png, image/jpeg, image/gif" />
                                <?php  } ?>
                            </div>

                            <h3 class="profile-username text-center"><?= ($row == null) ? "" : "{$row['f6']} {$row['f5']}"; ?></h3>
                            <p class="text-muted text-center"><?= ($row == null) ? "" : $row['f1']; ?> </p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item"> <b>DOB</b> <a class="float-right"><?= ($row == null) ? "" : $row['f14']; ?></a> </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-9  fs-10">
                    <div class="card">
                        <div class="card-header p-2">
                            <!-- Navigation Tabs -->
                            <ul class="nav nav-pills">
                                <?php if ($id == 0) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#tab-1" data-toggle="tab">Profile</a>
                                    </li>
                                <?php } else { ?>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#tab-1" data-toggle="tab">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab-2" data-toggle="tab">Password</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab-3" data-toggle="tab">Documents</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- Tab Content -->
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Tab 1: Profile -->
                                <div class="tab-pane fade show active" id="tab-1">
                                    <form action="<?= htmlspecialchars($form_config['form_action']) ?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <?php renderInputs($form_config, $row); ?>
                                        </div>
                                        <input type="hidden" name="level" value="<?php echo $level; ?>">
                                        <hr>
                                        <div class="col-lg-12 col-md-12 form-group">
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
                                        </div>
                                    </form>
                                </div>
                                <!-- Tab 2: Password -->
                                <div class="tab-pane fade" id="tab-2">
                                    <form action="" class="form-horizontal" method="post">
                                        <input type="hidden" name="id" value="<?= $id ?>">
                                        <input type="hidden" name="update_by" value="<?= $user_act ?>">
                                        <input type="hidden" name="action" value="update_password">

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 form-group">
                                                <label for="current_password">Current Password</label>
                                                <input type="password" id="current_password" name="current_password"
                                                    class="form-control" placeholder="Enter current password" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 form-group">
                                                <label for="new_password">New Password</label>
                                                <input type="password" id="new_password" name="new_password"
                                                    class="form-control" placeholder="Enter new password"
                                                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                                                    title="Must contain at least 8 characters, one uppercase, one lowercase, one number and one special character" required>
                                                <small class="form-text text-muted">
                                                    Password must be at least 8 characters with uppercase, lowercase, number, and special character
                                                </small>
                                            </div>

                                            <div class="col-lg-6 col-md-6 form-group">
                                                <label for="confirm_password">Confirm New Password</label>
                                                <input type="password" id="confirm_password" name="confirm_password"
                                                    class="form-control" placeholder="Confirm new password" required>
                                                <div class="invalid-feedback" id="password-match-feedback">
                                                    Passwords do not match
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="col-lg-12 col-md-12 form-group">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 form-group">
                                                    <button type="submit" class="btn btn-block btn-success">Update Password</button>
                                                </div>
                                                <div class="col-lg-3 col-md-3 form-group">
                                                    <button type="reset" class="btn btn-block btn-warning">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- Tab 3: Documents -->
                                <div class="tab-pane fade" id="tab-3">
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h3 class="card-title mb-0"><strong>Documents Management</strong></h3>
                                                <button type="button" id="addNewDocument" class="btn btn-primary" onclick="openAddDocumentModal()">
                                                    <i class="fas fa-plus-circle mr-2"></i>
                                                    Add New Document
                                                </button>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th scope="col">Document Name</th>
                                                            <th scope="col">View</th>
                                                            <th scope="col">Download</th>
                                                            <th scope="col">Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (!empty($documents['data'])) {
                                                            foreach ($documents['data'] as $doc) {
                                                                echo '<tr>';
                                                                echo '<td>' . (!empty($doc['f2']) ? htmlspecialchars($doc['f2'], ENT_QUOTES, 'UTF-8') : 'File name not provided') . '</td>';
                                                                echo '<td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#documentViewModal" onclick="open_document(\'' . $doc['f1'] . '\')">View</button></td>';
                                                                echo '<td><button class="btn btn-sm btn-success" onclick="download_document(\'' . $doc['f1'] . '\')">Download</button></td>';
                                                                echo '<td><button class="btn btn-sm btn-danger" onclick="delete_item(' . $doc['id'] . ', \'document\')">Delete</button></td>';
                                                                echo '</tr>';
                                                            }
                                                        } else {
                                                            echo '<tr><td colspan="4" class="text-center">No Document Found</td></tr>';
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Add Document Modal -->
                                    <div class="modal fade" id="addDocumentModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Upload New Document</h5>
                                                    <button type="button" onclick="closeAddDocumentModal()" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="text" id="document_name" name="document_name" placeholder="Document Name (Optional)"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="document_file" name="document_file"
                                                                accept=".pdf,.doc,.docx,.txt" required>
                                                            <label class="custom-file-label" for="document_file">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" id="user_id" name="user_id" value="<?= $id ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" onclick="closeAddDocumentModal()" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="button" onclick="uploadDocument()" class="btn btn-primary">Upload Document</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Request Documents Management -->
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h3 class="card-title mb-0"><strong>Request Documents Management</strong></h3>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th scope="col">Document Name</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">View</th>
                                                            <th scope="col">Download</th>
                                                            <th scope="col">Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (!empty($requestDocuments['data'])) {
                                                            foreach ($requestDocuments['data'] as $reqDoc) {
                                                                echo '<tr>';
                                                                echo '<td>' . $documentTypes->get_doc_type_name($reqDoc['document_type']) . '</td>';

                                                                if (empty($reqDoc['f1'])) {
                                                                    echo '<td class="text-muted">Not Uploaded</td>';
                                                                    echo '<td class="text-center"></td>';
                                                                    echo '<td class="text-center"></td>';
                                                                    echo '<td class="text-center"></td>';
                                                                } else {
                                                                    echo '<td class="text-success">Uploaded</td>';
                                                                    echo '<td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#documentViewModal" onclick="open_document(\'' . $reqDoc['f1'] . '\')">View</button></td>';
                                                                    echo '<td><button class="btn btn-sm btn-success" onclick="download_document(\'' . $reqDoc['f1'] . '\')">Download</button></td>';
                                                                    echo '<td><button class="btn btn-sm btn-danger" onclick="delete_item(' . $reqDoc['id'] . ', \'request\')">Delete</button></td>';
                                                                }

                                                                echo '</tr>';
                                                            }
                                                        } else {
                                                            echo '<tr><td colspan="5" class="text-center">No Document Found</td></tr>';
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Document View Modal -->
                        <div class="modal fade" id="documentViewModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><strong>Document View</strong> </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="height: 70vh;">
                                        <iframe id="fileViewer" class="w-100 h-100 border-0"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- /.row -->
</section>
</div>
<?php include_once './footer.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const imagePath = '<?= $profile_image ?>';
    const userId = '<?= $id  ?>'; // Ensure this is correctly set in PHP
    const hasImage = Boolean(imagePath); // Set hasImage based on whether imagePath is provided

    // Register the FilePond plugins
    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginImageExifOrientation,
        FilePondPluginImagePreview,
        FilePondPluginImageCrop,
        FilePondPluginImageResize,
        FilePondPluginImageTransform
    );

    // Create FilePond instance
    const pond = FilePond.create(
        document.querySelector('.filepond'), {
            imagePreviewHeight: 170,
            imageCropAspectRatio: '1:1',
            imageResizeTargetWidth: 200,
            imageResizeTargetHeight: 200,
            stylePanelLayout: 'compact circle',
            styleLoadIndicatorPosition: 'center bottom',
            styleProgressIndicatorPosition: 'right bottom',
            styleButtonRemoveItemPosition: 'left bottom',
            styleButtonProcessItemPosition: 'right bottom',
            files: hasImage ? [{
                source: imagePath,
                options: {
                    type: 'image'
                }
            }] : []
        }
    );

    // Configure server options dynamically
    const setServerOptions = () => {
        pond.setOptions({
            server: {
                process: {
                    url: './data/upload_profile_pic.php',
                    method: 'POST',
                    withCredentials: false,
                    headers: {},
                    timeout: 7000,
                    onload: (response) => response, // This is where file.serverId is set
                    onerror: (response) => response,
                    ondata: (formData) => {
                        // Append additional data to the formData
                        formData.append('id', userId);
                        formData.append('target', 'admins');
                        return formData;
                    }
                }
            }
        });
    };

    // Catch the response from the server after a file has been processed
    pond.on('processfile', (error, file) => {
        if (error) {
            console.error('Error processing file:', error);
            return;
        }
        const serverResponse = file.serverId;
        try {
            const response = JSON.parse(serverResponse);
            if (response.status === 'success') {
                console.log('File uploaded successfully');
                // You can use response.filePath to do something with the uploaded file path
            } else {
                console.error('File upload error:', response.message);
            }
        } catch (e) {
            console.error('Failed to parse server response:', serverResponse);
        }
    });

    // Handle the addfile event to ensure new files are processed
    pond.on('addfile', (error, file) => {
        if (error) {
            console.error('Error adding file:', error);
            return;
        }

        // If a new file is added, set the server configuration
        setServerOptions();
    });

    // Initialize server options if no initial image is provided
    if (!hasImage) {
        setServerOptions();
    }


    //download Document
    function download_document(filePath) {
        const link = document.createElement('a');
        link.href = filePath;
        link.download = filePath.split('/').pop();
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
    //delete Document
    function delete_item(itemId, itemType) {
        console.log(`Deleting ${itemType} with ID:`, itemId);
        $.ajax({
            url: '../data/delete_item.php',
            type: 'POST',
            data: {
                id: itemId,
                type: itemType
            },
            success(response) {
                console.log('Response:', response);
                try {
                    const res = JSON.parse(response);
                    if (res.success) {
                        update_message(`${itemType.charAt(0).toUpperCase() + itemType.slice(1)} deleted successfully!`);
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        error_message(`Failed to delete ${itemType}. Please try again!`);
                    }
                } catch (error) {
                    console.error('Error parsing response:', error, response);
                    alert('An error occurred while processing the response');
                }
            },
            error(xhr, status, error) {
                console.error('Error:', error);
                console.error('Status:', status);
                console.error('XHR:', xhr);
                alert('An error occurred while deleting the item');
            }
        });
    }

    // add  Document Modal
    function openAddDocumentModal() {
        $('#addDocumentModal').modal('show');
    }

    function closeAddDocumentModal() {
        $('#addDocumentModal').modal('hide');
    }


    window.onclick = function(event) {
        const modal = document.getElementById('addDocumentModal');
        if (event.target === modal) {
            closeAddDocumentModal();
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        // Update file input label on file selection
        document.querySelector('#document_file').addEventListener('change', function(e) {
            var fileName = e.target.files[0] ? e.target.files[0].name : "Choose file";
            e.target.nextElementSibling.innerText = fileName;
        });
    });

    function uploadDocument() {
        const documentName = document.getElementById('document_name').value.trim();
        const documentFile = document.getElementById('document_file').files[0];
        const userId = document.getElementById('user_id').value;

        if (!documentFile) {
            error_message('Please select a file to upload.');
            return;
        }
        const submitButton = document.querySelector('#addDocumentModal button[onclick="uploadDocument()"]');
        submitButton.disabled = true;
        submitButton.textContent = 'Uploading...';

        const formData = new FormData();
        formData.append('document_name', documentName);
        formData.append('document_file', documentFile);
        formData.append('id', userId);

        $.ajax({
            url: '../data/upload_document.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Check if response is already an object
                let res = response;

                // If response is a string, try to parse it
                if (typeof response === 'string') {
                    try {
                        res = JSON.parse(response);
                    } catch (error) {
                        console.error('Error parsing response:', error);
                        error_message('Invalid response format');
                        return;
                    }
                }

                // Process the response
                if (res.status === 1) {
                    update_message("Document Upload Successfully");
                    closeAddDocumentModal();
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    error_message(res.message || 'Upload failed');
                }
            },

        });
    }
</script>
<script>
    // Open document inside modal
    function open_document(filePath) {
        const viewer = document.getElementById('fileViewer');

        if (!filePath) {
            viewer.src = '';
            alert('Invalid document path.');
            return;
        }

        // Sanitize and assign to iframe
        viewer.src = filePath;
    }

    // Live validation messages
    document.querySelectorAll('input, select, textarea').forEach(el => {
        el.addEventListener('input', () => {
            const vMsg = document.querySelector(`.validation-message[data-for="${el.id}"]`);
            if (vMsg) {
                let valid = true;

                // Check pattern mismatch
                if (el.validity.patternMismatch) valid = false;
                // Check length
                if (el.minLength > 0 && el.value.length < el.minLength) valid = false;
                if (el.maxLength > 0 && el.value.length > el.maxLength) valid = false;

                vMsg.classList.toggle('hidden', valid);
            }
        });
    });

    // Allow only digits in phone number
    document.getElementById('f3')?.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
    });

    // Allow only letters in names
    ['f6', 'f4', 'f5'].forEach(id => {
        document.getElementById(id)?.addEventListener('input', function() {
            this.value = this.value.replace(/[^A-Za-z]/g, '');
        });
    });

    // Confirm password match
    document.getElementById('password')?.addEventListener('input', function() {
        const pwd = document.getElementById('f2').value;
        const vMsg = document.querySelector('.validation-message[data-for="password"]');
        if (vMsg) vMsg.classList.toggle('hidden', this.value === pwd);
    });
    // Allow only letters + spaces for State and City
    ['f11', 'f12'].forEach(id => {
        document.getElementById(id)?.addEventListener('input', function() {
            this.value = this.value.replace(/[^A-Za-z ]/g, '');
        });
    });

    // Address: allow letters, numbers, space, comma, dot, dash
    document.getElementById('f13')?.addEventListener('input', function() {
        this.value = this.value.replace(/[^A-Za-z0-9 ,.-]/g, '');
    });
</script>
</body>

</html>