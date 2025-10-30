<?php
// Add this at the top of your PHP script.
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once './header.php';
include_once '../controllers/index.php';

// Retrieve and decode the values passed in the URL
$id = isset($_GET['id']) ? base64_decode($_GET['id']) : 0;
$user_id = isset($_GET['user']) ? base64_decode($_GET['user']) : 0;
$course_id = isset($_GET['course']) ? base64_decode($_GET['course']) : 0;
$documents =  $document->get_my_documents($user_id);
$requestDocuments = $requestDocument->get_by_foreignKey('application', $id, 'created_date DESC');
$allDocuments = $requestDocument->get_by_foreignKey('user', $user_id, 'created_date DESC');
$row = $id > 0 ? $application->get_by_id($id)['data'] : null;
$document_items = $documentTypes->get_all()['error'] === null ? $documentTypes->get_all()['data'] : null;
$courseName = $course->get_course_name($row['course']);
$courseDetails = $course->get_by_id($course_id);


$status = $applicationStatus->get_all()['error'] === null ? $applicationStatus->get_all()['data'] : null;
$status_items = [];
if ($status) {
    foreach ($status as $key) {
        $status_items[] = [
            'value' => $key['id'],
            'label' => $key['f1'],
        ];
    }
}


// Form Configuration
$form_config = [
    'heading' => 'Application',
    'form_action' => 'data/register_application.php',
    'inputs' => [
        'id' => ['type' => 'hidden', 'value' => $row['id'] ?? ''],
        'value' => ['label' => 'Applicaion Current Status', 'type' => 'combobox', 'class' => 'form-control', 'div_class' => 'col-lg-4 col-md-4 form-group', 'placeholder' => 'Select Status', 'items' => $status_items, 'required' => true]
    ]
];

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
                            <div class="form-group col-lg-12 col-md-12">
                                <label for="applicant_name">Applicant Name</label>
                                <?php $user_name = $user_id > 0 ? $user->get_name_by_id($user_id) : '';
                                $address = $user->get_address_by_id($user_id); ?>

                                <input type="text" class="form-control" value="<?= htmlspecialchars($user_name); ?>" required disabled>
                            </div>

                            <div class="form-group col-lg-12 col-md-12">
                                <label for="applicant_address">Applicant Address</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($address); ?>" required disabled>
                            </div>

                            <div class="form-group col-lg-12 col-md-12">
                                <label for="university">Course Name</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($courseName ?? ''); ?>" required disabled>
                            </div>

                            <div class="form-group col-lg-12 col-md-12">
                                <label for="university">University</label>
                                <?php $universityName = $university->getUniversityCountryIdNameImageById($courseDetails['data']['university']);
                                $countryname = $country->getCountryNameById($universityName['country']); ?>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($universityName['name'] . ' ' . $countryname['name'] ?? ''); ?>" required disabled>
                            </div>

                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <ul class="nav nav-tabs" id="documentsTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="all-documents-tab" data-bs-toggle="tab" data-bs-target="#all-documents" type="button" role="tab" aria-controls="all-documents" aria-selected="true">All Documents</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="request-documents-tab" data-bs-toggle="tab" data-bs-target="#request-documents" type="button" role="tab" aria-controls="request-documents" aria-selected="false">Request Documents</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="documentsTabContent">
                                        <!-- All Documents Tab -->
                                        <div class="tab-pane fade show active" id="all-documents" role="tabpanel" aria-labelledby="all-documents-tab">
                                            <div class="table-responsive mt-3">
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
                                                            if (!empty($allDocuments['data'])) {
                                                                foreach ($allDocuments['data'] as $all) {
                                                                    if (empty($all['f1'])) {
                                                                        break;
                                                                    } else {
                                                                        echo '<tr>';
                                                                        echo '<td>' . $documentTypes->get_doc_type_name($all['document_type']) . '</td>';
                                                                        echo '<td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#documentViewModal" onclick="open_document(\'' . $all['f1'] . '\')">View</button></td>';
                                                                        echo '<td><button class="btn btn-sm btn-success" onclick="download_document(\'' . $all['f1'] . '\')">Download</button></td>';
                                                                        echo '<td><button class="btn btn-sm btn-danger" onclick="delete_item(' . $all['id'] . ', \'request\')">Delete</button></td>';
                                                                        echo '</tr>';
                                                                    }
                                                                }
                                                            }
                                                        } else {
                                                            if (!empty($allDocuments['data'])) {
                                                                foreach ($allDocuments['data'] as $all) {
                                                                    if (empty($all['f1'])) {
                                                                        break;
                                                                    } else {
                                                                        echo '<tr>';
                                                                        echo '<td>' . $documentTypes->get_doc_type_name($all['document_type']) . '</td>';
                                                                        echo '<td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#documentViewModal" onclick="open_document(\'' . $all['f1'] . '\')">View</button></td>';
                                                                        echo '<td><button class="btn btn-sm btn-success" onclick="download_document(\'' . $all['f1'] . '\')">Download</button></td>';
                                                                        echo '<td><button class="btn btn-sm btn-danger" onclick="delete_item(' . $all['id'] . ', \'request\')">Delete</button></td>';
                                                                        echo '</tr>';
                                                                    }
                                                                }
                                                            } else {
                                                                echo '<tr><td colspan="4" class="text-center">No Document Found</td></tr>';
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Request Documents Tab -->
                                        <div class="tab-pane fade" id="request-documents" role="tabpanel" aria-labelledby="request-documents-tab">
                                            <div class="table-responsive mt-3">
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
                                                                    echo '<td><button class="btn btn-sm btn-danger" onclick="delete_item(' . $reqDoc['id'] . ', \'request\')">Delete</button></td>';
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

                            <form action="<?= htmlspecialchars($form_config['form_action']) ?>" method="post"
                                enctype="multipart/form-data">

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
                                    <div class="col-lg-2 col-md-2 form-group">
                                        <button type="button" class="btn btn-block btn-outline-primary" data-toggle="modal" data-target="#requestDocumentModal">
                                            Request Document
                                        </button>
                                    </div>
                                </div>
                            </form>
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
                        </div><!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include_once './footer.php'; ?>


<input type="hidden" id="current_user_id" value="<?= $user_id ?>">
<input type="hidden" id="current_course_id" value="<?= $course_id ?>">
<input type="hidden" id="current_applicaton_id" value="<?= $id ?>">


<!-- Request Document Modal -->
<div class="modal fade" id="requestDocumentModal" tabindex="-1" role="dialog" aria-labelledby="requestDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestDocumentModalLabel">Request New Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mt-4">
                    <div class="mb-4">
                        <select id="document_type" name="document_type" class="w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>
                            <option value="">Select Document Type</option>
                            <?php if ($document_items): ?>
                                <?php foreach ($document_items as $item): ?>
                                    <option value="<?php echo $item['id'] ?>">
                                        <?php echo htmlspecialchars($item['f1']); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <!-- Placeholder when no documents are available -->
                                <option value="" disabled selected>Please add documents first</option>

                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <textarea id="document_description" name="document_description"
                            class="col-lg-8 col-md-8  px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500"
                            rows="4" placeholder="special requirements, etc" required></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitDocumentRequest()">Request</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Handle Document Request Submission
    function submitDocumentRequest() {
        const documentType = document.getElementById('document_type').value;
        const userId = document.getElementById('current_user_id').value;
        const courseId = document.getElementById('current_course_id').value;
        const applicationId = document.getElementById('current_applicaton_id').value;
        const documentDescription = document.getElementById('document_description').value;




        if (!documentType) {
            error_message('Please select a document type.');
            return;
        }

        const requestButton = document.querySelector('#requestDocumentModal .btn-primary');
        requestButton.disabled = true;
        requestButton.innerText = 'Requesting...';

        $.ajax({
            url: 'data/request_document.php',
            type: 'POST',
            data: {
                document_type: documentType,
                user_id: userId,
                course_id: courseId,
                application_id: applicationId,
                document_description: documentDescription

            },
            success: function(response) {
                try {
                    const res = JSON.parse(response);
                    if (res.success) {
                        update_message('Document request submitted successfully.');
                        $('#requestDocumentModal').modal('hide');
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        alert('Failed: ' + (res.message || 'Unknown error.'));
                    }
                } catch (e) {
                    console.error('Parse Error:', e);
                    alert('Invalid server response.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                alert('Server error occurred.');
            },
            complete: function() {
                requestButton.disabled = false;
                requestButton.innerText = 'Request';
            }
        });
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
</script>

</body>

</html>