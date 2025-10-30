<?php
include 'header.php';

$profile_image = null;

$form_config = [
    'tabs' => [
        'profile' => [
            'heading' => 'Profile Information',
            'form_action' => 'data/update_profile.php',
            'icon' => 'user',
            'inputs' => [
                'f1' => ['label' => 'Email Address', 'type' => 'email', 'required' => true, 'placeholder' => 'Email Address', 'disabled' => true, 'validation' => ['pattern' => '[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$', 'message' => 'Invalid email']],
                'f6' => ['label' => 'First Name', 'type' => 'text', 'required' => true, 'placeholder' => 'First Name', 'validation' => ['minlength' => 2, 'maxlength' => 50, 'message' => 'Must be 2-50 chars']],
                'f4' => ['label' => 'Middle Name', 'type' => 'text', 'required' => false, 'placeholder' => 'Middle Name', 'validation' => ['minlength' => 2, 'maxlength' => 50]],
                'f5' => ['label' => 'Last Name', 'type' => 'tel', 'required' => false, 'placeholder' => 'Last Name'],
                'f3' => ['label' => 'Contact Number', 'type' => 'phone', 'placeholder' => 'Contact Number', 'validation' => ['pattern' => '[0-9]{10,15}', 'message' => 'Must be 10-15 digits']],
                'f7' => ['label' => 'First Language', 'type' => 'select', 'required' => true, 'options' => ['select language', 'English', 'Sinhalees', 'French', 'German', 'Chinese', 'Hindi', 'Arabic', 'Portuguese', 'Russian', 'Japanese', 'Italian', 'Dutch', 'Korean', 'Turkish', 'Other']],
                'f8' => ['label' => 'Country Citizenship', 'type' => 'text', 'placeholder' => 'Country Citizenship'],
                'f9' => ['label' => 'Passport Number', 'type' => 'text', 'placeholder' => 'Passport Number', 'validation' => ['minlength' => 6, 'maxlength' => 20, 'message' => 'Must be 6-20 chars']],
                'f10' => ['label' => 'Country', 'type' => 'select', 'required' => true, 'placeholder' => 'Country', 'options' => ['select country', ...array_map(function($country) { return $country['name']; }, $countryCodes)]],
                'f11' => ['label' => 'State', 'type' => 'text', 'placeholder' => 'State'],
                'f12' => ['label' => 'City', 'type' => 'text', 'placeholder' => 'City'],
                'f13' => ['label' => 'Address', 'type' => 'textarea', 'placeholder' => 'Address', 'validation' => ['minlength' => 10, 'maxlength' => 200]],
                'f14' => ['label' => 'Date of Birth', 'type' => 'date'],
                'f15' => ['label' => 'Gender', 'type' => 'select', 'options' => ['Male', 'Female', 'Other']],
                'f16' => ['label' => 'Marital Status', 'type' => 'select', 'options' => ['Married', 'Unmarried', 'Other']],
            ],
            'profile_completion_fields' => [
                'f1' => ['label' => 'Email Address', 'tooltip' => 'Your primary email address'],
                'f6' => ['label' => 'First Name', 'tooltip' => 'Your legal first name'],
                'f5' => ['label' => 'Last Name', 'tooltip' => 'Your family/last name'],
                'f3' => ['label' => 'Contact Number', 'tooltip' => 'Phone number where we can reach you'],
                'f7' => ['label' => 'First Language', 'tooltip' => 'Your native language'],
                'f10' => ['label' => 'Country', 'tooltip' => 'Your country of residence'],
                'f13' => ['label' => 'Address', 'tooltip' => 'Your complete residential address'],
                'f14' => ['label' => 'Date of Birth', 'tooltip' => 'Your birth date in YYYY-MM-DD format'],
                'f15' => ['label' => 'Gender', 'tooltip' => 'Your gender identity'],
                'img1' => ['label' => 'Profile Picture', 'tooltip' => 'A clear photo of yourself']
            ],
            'profile_image' => [
                'default' => 'assets/images/userProfile.jpg',
                'background' => 'assets/images/profile_bg.png',
                'upload_endpoint' => 'data/upload_profile_pic.php'
            ]
        ],

        'applications' => [
            'heading' => 'My Applications',
            'form_action' => '',
            'icon' => 'file-alt',
            'inputs' => [],
            'application_status' => [
                'modal_title' => 'Application Status Timeline'
            ]
        ],

        'my_documents' => [
            'heading' => 'My Documents',
            'form_action' => '',
            'icon' => 'file-upload',
            'inputs' => [],
            'documents' => [
                'upload_endpoint' => 'data/upload_document.php',
                'allowed_types' => '.pdf,.doc,.docx,.txt',
                'delete_endpoint' => 'data/delete_item.php'
            ]
        ],

        'request_documents' => [
            'heading' => 'Request Documents',
            'form_action' => '',
            'icon' => 'file-download',
            'inputs' => []
        ],

        'suggestions' => [
            'heading' => 'Suggestions',
            'form_action' => 'data/submit_suggestion.php',
            'icon' => 'lightbulb',
            'inputs' => [
                'course_name' => ['label' => 'Course Name', 'type' => 'text', 'required' => true, 'placeholder' => 'Enter course name'],
                'course_description' => ['label' => 'Description', 'type' => 'textarea', 'required' => true, 'placeholder' => 'Describe the course'],
                'course_reason' => ['label' => 'Why suggest this?', 'type' => 'textarea', 'required' => true, 'placeholder' => 'Explain why this course would be valuable']
            ]
        ]
    ]
];

if (isset($_SESSION['login_success']) && $_SESSION['login_success'] == true && $_SESSION['u_id'] > 0) {
    $row_ = $user->getUserById($_SESSION['u_id']);
    if ($row_['error'] == null) {
        $row = $row_['user'];
    } else {
        $row = null;
    }

    if ($row['img1'] && $row['img1'] != '') {
        $profile_image = str_replace("../", "./", $row['img1']);
        if (!file_exists($profile_image)) {
            $profile_image = null;
        }
    }
} else {
    session_destroy();
    header("Location: /");
    exit();
}

$my_applications = $application->get_my_applications($user->get_id());
$documents = $document->get_my_documents($user->get_id());
$status = $applicationStatus->get_all()['error'] === null ? $applicationStatus->get_all()['data'] : [];
$requestDocuments = $requestDocument->get_by_foreignKey('user', $_SESSION['u_id'], 'created_date DESC');
?>

<link rel="stylesheet" href="assets/css/profile_progress.css">

<?php
function calculate_profile_completion($user_data, $fields_config)
{
    $completed = 0;
    $total = count($fields_config);

    foreach ($fields_config as $field => $data) {
        if (!empty($user_data[$field])) {
            $completed++;
        }
    }

    $percentage = round(($completed / $total) * 100);

    return [
        'percentage' => $percentage,
        'completed' => $completed,
        'total' => $total,
        'fields' => $fields_config
    ];
}

$profile_completion = calculate_profile_completion($row, $form_config['tabs']['profile']['profile_completion_fields']);
?>

<div id="content" class="hidden">
    <?php include "nav.php" ?>

    <section class="py-8 px-3 md:px-16 flex justify-center pb-12">
        <div class="w-full md:w-3/4">
            <div class="bg-white p-2 md:p-8 shadow-lg rounded-xl">
                <h1 class="text-4xl font-bold mb-6"><?= htmlspecialchars(($row['f6'] ?? '') . ' ' . ($row['f5'] ?? '')) ?: 'User Profile' ?></h1>

                <div class="relative bg-white rounded-lg shadow-xl overflow-hidden mb-10">
                    <img src="<?= $form_config['tabs']['profile']['profile_image']['background'] ?>" class="absolute inset-0 w-full h-full lg:h-[125%] object-cover lg:object-fill" alt="Profile Background" />

                    <div class="relative p-6 flex flex-col sm:flex-row items-center sm:items-start justify-between gap-6">
                        <div class="flex flex-col items-center">
                            <div class="relative">
                                <img id="profilePreview" src="<?= $profile_image ?: $form_config['tabs']['profile']['profile_image']['default'] ?>" alt="Profile Picture" class="w-36 h-36 rounded-full border-4 border-gray-300 object-cover shadow-md transition-all duration-300 hover:border-blue-500">

                                <label for="profileInput" class="absolute bottom-2 right-2 bg-blue-600 text-white p-2 rounded-full shadow-md cursor-pointer hover:bg-blue-700 transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-4.036a2.5 2.5 0 113.536 3.536L7 21H3v-4L16.732 5.732z" />
                                    </svg>
                                </label>

                                <button id="removeImage" class="absolute bottom-2 right-12 bg-red-600 text-white p-2 rounded-full shadow-md cursor-pointer hover:bg-red-700 transition-all duration-300 hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <input type="file" id="profileInput" name="profile_image" accept="image/*" class="hidden" onchange="uploadProfileImage(event)">
                        </div>

                        <div class="mt-20">
                            <h2 class="text-2xl text-white font-bold lg:float-left"><?= htmlspecialchars($row['f1'] ?? '') ?></h2>
                        </div>
                    </div>
                </div>

                <div class="profile-completion-container">
                    <div class="profile-completion-header">
                        <h3 class="profile-completion-title">Profile Completion</h3>
                        <div class="profile-completion-percent"><?= $profile_completion['percentage'] ?>%</div>
                    </div>

                    <div class="progress-container">
                        <div class="progress-bar" style="width: <?= $profile_completion['percentage'] ?>%"></div>
                    </div>

                    <div class="progress-text">
                        <?= $profile_completion['completed'] ?> of <?= $profile_completion['total'] ?> required fields completed
                    </div>

                    <div class="progress-checklist">
                        <h4 class="progress-checklist-title">Required Information</h4>
                        <div class="progress-checklist-grid">
                            <?php foreach ($profile_completion['fields'] as $field => $data): ?>
                                <div class="progress-checklist-item <?= !empty($row[$field]) ? 'completed' : 'pending' ?>">
                                    <span class="progress-checklist-icon">
                                        <?php if (!empty($row[$field])): ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                        <?php else: ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                            </svg>
                                        <?php endif; ?>
                                    </span>
                                    <span class="progress-checklist-label tooltip">
                                        <?= htmlspecialchars($data['label']) ?>
                                        <span class="tooltiptext"><?= htmlspecialchars($data['tooltip']) ?></span>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php if ($profile_completion['percentage'] < 100): ?>
                        <div class="profile-completion-actions">
                            <button class="complete-profile-btn" onclick="document.getElementById('profile-tab').click()">
                                Complete Your Profile
                            </button>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="ml-5">
                    <?php
                    if (isset($_SESSION['profile_update'])) {
                        echo "<script> update_message('" . addslashes($_SESSION['profile_msg']) . "'); </script>";
                        unset($_SESSION['profile_update'], $_SESSION['profile_msg']);
                    } else if (isset($_SESSION['profile_error'])) {
                        echo "<script> error_message('" . addslashes($_SESSION['profile_error_msg']) . "'); </script>";
                        unset($_SESSION['profile_error'], $_SESSION['profile_error_msg']);
                    }
                    ?>
                </div>

                <div class="mb-4 border-b border-gray-200">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                        <?php foreach ($form_config['tabs'] as $tabId => $tabConfig): ?>
                            <li class="me-2" role="presentation">
                                <button class="inline-flex items-center p-4 border-b-2 rounded-t-lg hover:text-blue-600 hover:border-blue-600"
                                    id="<?= $tabId ?>-tab" data-tabs-target="#<?= $tabId ?>" type="button" role="tab"
                                    aria-controls="<?= $tabId ?>" aria-selected="false">
                                    <i class="fas fa-<?= $tabConfig['icon'] ?> mr-2"></i>
                                    <?= $tabConfig['heading'] ?>
                                </button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div id="default-tab-content">
                    <!-- Profile Tab -->
                    <div class="hidden p-4 rounded-lg bg-gray-50" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="<?= $form_config['tabs']['profile']['form_action'] ?>" method="POST" enctype="multipart/form-data">
                            <div class="grid md:grid-cols-2 gap-4">
                                <input type="hidden" name="id" value="<?= $_SESSION['u_id'] ?>">
                                <?= generate_form_inputs($form_config['tabs']['profile'], $row); ?>
                            </div>
                            <div class="text-center mt-10">
                                <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 transition">Update Details</button>
                            </div>
                        </form>
                    </div>

                    <!-- Applications Tab -->
                    <div class="hidden p-4 rounded-lg bg-white" id="applications" role="tabpanel" aria-labelledby="applications-tab">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-600">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">University</th>
                                        <th scope="col" class="px-6 py-3">Country</th>
                                        <th scope="col" class="px-6 py-3">Course</th>
                                        <th scope="col" class="px-6 py-3">Applied Date</th>
                                        <th scope="col" class="px-6 py-3">Live Status</th>
                                        <th scope="col" class="px-6 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($my_applications['data'])): ?>
                                        <?php foreach ($my_applications['data'] as $list):
                                            $currentStatus = $applicationStatus->get_status($list['value']);
                                            $applicationId = $list['id'];
                                            $courseId = $list['course'];
                                            $cosDetails = $course->get_by_id($courseId);
                                        ?>
                                            <tr class="bg-white border-b border-gray-200">
                                                <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($course->get_university_name($courseId)) ?></td>
                                                <td class="px-6 py-4"><?= htmlspecialchars($course->get_country_name_by_course($courseId)) ?></td>
                                                <td class="px-6 py-4"><?= htmlspecialchars($course->get_course_name($courseId)) ?></td>
                                                <td class="px-6 py-4"><?= date('d-m-Y', strtotime($list['created_date'])) ?></td>
                                                <td class="px-6 py-4"><?= htmlspecialchars($currentStatus) ?> <button onclick="openModal(<?= $applicationId ?>)" class="font-black text-blue-800"> (View) </button></td>
                                                <td class="px-6 py-4">
                                                    <button class="font-black text-blue-800 view-application-btn"
                                                        data-application-id="<?= $applicationId ?>"
                                                        data-university="<?= htmlspecialchars($course->get_university_name($courseId)) ?>"
                                                        data-country="<?= htmlspecialchars($course->get_country_name_by_course($courseId)) ?>"
                                                        data-course="<?= htmlspecialchars($course->get_course_name($courseId)) ?>"
                                                        data-course-duration="<?= htmlspecialchars($cosDetails['data']['f6'] ?? 'N/A') ?>"
                                                        data-course-fees="<?= htmlspecialchars($cosDetails['data']['f5'] ?? 'N/A') ?>"
                                                        data-course-intake="<?= htmlspecialchars($cosDetails['data']['f2'] ?? 'N/A') ?>"
                                                        data-course-level="<?= htmlspecialchars($cosDetails['data']['f4'] ?? 'N/A') ?>"
                                                        data-applied-date="<?= htmlspecialchars($list['created_date'] ?? 'N/A') ?>"
                                                        data-university-logo="<?= htmlspecialchars($course->get_university_logo($courseId)) ?>"
                                                        data-status="<?= htmlspecialchars($currentStatus) ?>">
                                                        View
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="bg-white border-b border-gray-200 text-center">
                                            <td class="px-6 py-4 whitespace-nowrap" colspan="6">No Applications Found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <div id="statusModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
                                <div class="relative w-full max-w-6xl mx-4 px-4 md:px-6 py-8 bg-white rounded-lg shadow-lg max-h-[90vh] overflow-y-auto">
                                    <button onclick="closeStatusModal()" class="absolute top-2 right-2 md:top-4 md:right-4 text-gray-600 hover:text-gray-900 text-3xl md:text-2xl font-bold z-10 px-4 py-2">
                                        &times;
                                    </button>

                                    <div class="flex flex-col justify-center divide-y divide-slate-200 [&>*]:py-8">
                                        <div class="w-full max-w-3xl mx-auto">
                                            <h1 class="text-2xl md:text-3xl font-extrabold text-center text-slate-900 mb-6 md:mb-10">
                                                <?= $form_config['tabs']['applications']['application_status']['modal_title'] ?>
                                            </h1>
                                            <div class="-my-4" id="statusTimeline"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="applicationModal" class="hidden fixed inset-0 z-50 bg-black/30 backdrop-blur-sm flex items-center justify-center p-4">
                                <!-- Application Modal Content -->
                            </div>
                        </div>
                    </div>

                    <!-- Documents Tab -->
                    <div class="hidden p-4 rounded-lg bg-white shadow-sm" id="my_documents" role="tabpanel" aria-labelledby="my_documents-tab">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <div class="flex justify-between items-center mb-5">
                                <h3 class="text-lg font-semibold text-gray-700">Documents Management</h3>
                                <button type="button" id="addNewDocument" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 transition-all" onclick="openAddDocumentModal()">
                                    <i class="fa fa-plus-circle mr-2"></i>
                                    Add New Document
                                </button>
                            </div>

                            <table class="w-full text-sm text-left rtl:text-right text-gray-600">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Document Name</th>
                                        <th scope="col" class="px-6 py-3">View</th>
                                        <th scope="col" class="px-6 py-3">Download</th>
                                        <th scope="col" class="px-6 py-3">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($documents['data'])): ?>
                                        <?php foreach ($documents['data'] as $doc): ?>
                                            <tr class="bg-white border-b border-gray-200">
                                                <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($doc['f2'] ?? 'File name not provided') ?></td>
                                                <td class="px-6 py-4"><button class="font-black text-blue-800" type="button" onclick="openDocument('<?= htmlspecialchars($doc['f1']) ?>')">View</button></td>
                                                <td class="px-6 py-4"><button class="font-black text-green-800" onclick="download_document('<?= htmlspecialchars($doc['f1']) ?>')">Download</button></td>
                                                <td class="px-6 py-4"><button class="font-black text-red-800" onclick="delete_item(<?= $doc['id'] ?>, 'document')">Delete</button></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="bg-white border-b border-gray-200 text-center">
                                            <td class="px-6 py-4 whitespace-nowrap" colspan="4">No Document Found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <div id="document-view-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
                            <div class="relative p-4 w-full max-w-lg max-h-[90vh] overflow-y-auto">
                                <div class="relative bg-white rounded-lg shadow-md dark:bg-gray-700">
                                    <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600 border-gray-200">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Document View</h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeDocumentModal()">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <div class="p-4 h-[28rem]">
                                        <iframe id="documentFileViewer" class="w-full h-full border-none" src=""></iframe>
                                    </div>
                                    <div class="flex items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <button type="button" onclick="closeDocumentModal()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="addDocumentModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
                            <div class="relative mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                                <div class="mt-3 text-center">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Upload New Document</h3>
                                    <div class="mt-4">
                                        <div class="mb-4">
                                            <input type="text" id="document_name" name="document_name" placeholder="Document Name(Optional)" class="w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500">
                                        </div>
                                        <div class="mb-4">
                                            <input type="file" id="document_file" name="document_file" accept="<?= $form_config['tabs']['my_documents']['documents']['allowed_types'] ?>" class="w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>
                                        </div>
                                        <input type="hidden" id="user_id" name="user_id" value="<?= $_SESSION['u_id'] ?>">
                                        <div class="flex justify-between items-center px-4 py-3">
                                            <button type="button" onclick="closeAddDocumentModal()" class="text-gray-600 hover:text-gray-800">Cancel</button>
                                            <button type="button" onclick="uploadDocument()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Upload Document</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Request Documents Tab -->
                    <div class="hidden p-4 rounded-lg bg-white shadow-sm" id="request_documents" role="tabpanel" aria-labelledby="request_documents-tab">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <div class="flex justify-between items-center mb-5">
                                <h3 class="text-lg font-semibold text-gray-700">Document Requests</h3>
                            </div>

                            <table class="w-full text-sm text-left rtl:text-right text-gray-600">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Document Type</th>
                                        <th scope="col" class="px-6 py-3">Requirements</th>
                                        <th scope="col" class="px-6 py-3">Request Date</th>
                                        <th scope="col" class="px-6 py-3">Status</th>
                                        <th scope="col" class="px-6 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($requestDocuments['data'])): ?>
                                        <?php foreach ($requestDocuments['data'] as $reqDoc): ?>
                                            <tr class="bg-white border-b border-gray-200">
                                                <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($documentTypes->get_doc_type_name($reqDoc['document_type'])) ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <?php if (empty($reqDoc['f2'])): ?>
                                                        <span class="font-serif text-red-700 cursor-default">Not Mentioned</span>
                                                    <?php else: ?>
                                                        <button class="font-black text-blue-800 mr-1" type="button" onclick="showTextModal('<?= htmlspecialchars($reqDoc['f2']) ?>')">View</button>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap cursor-default"><?= date('Y-m-d', strtotime($reqDoc['created_date'])) ?></td>
                                                <td class="px-6 py-4 font-serif whitespace-nowrap cursor-default <?= empty($reqDoc['f1']) ? 'text-red-700' : 'text-green-800' ?>">
                                                    <?= empty($reqDoc['f1']) ? 'Not Submitted' : 'Submitted' ?>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <?php if (empty($reqDoc['f1'])): ?>
                                                        <button class="font-black text-green-800" type="button" onclick="openSubmitDocumentModal('<?= $reqDoc['id'] ?>', '<?= $reqDoc['document_type'] ?>', '<?= htmlspecialchars($documentTypes->get_doc_type_name($reqDoc['document_type'])) ?>')">Submit</button>
                                                    <?php else: ?>
                                                        <button class="font-black text-green-800 mr-1" type="button" onclick="openSubmitDocumentModal('<?= $reqDoc['id'] ?>', '<?= $reqDoc['document_type'] ?>', '<?= htmlspecialchars($documentTypes->get_doc_type_name($reqDoc['document_type'])) ?>')">Edit</button>
                                                        <button class="font-black text-blue-800" type="button" onclick="openRequestDocument('<?= htmlspecialchars($reqDoc['f1']) ?>')">View</button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="bg-white border-b border-gray-200 text-center">
                                            <td class="px-6 py-4 whitespace-nowrap" colspan="4">No Document Found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <div id="textModal" class="hidden fixed inset-0 z-50 bg-black/30 backdrop-blur-sm flex items-center justify-center p-4">
                                <div class="bg-white w-full max-w-2xl rounded-xl shadow-2xl overflow-hidden transition-all duration-300 transform max-h-[90vh] flex flex-col">
                                    <div class="p-6 text-white flex-shrink-0 bg-gray-700">
                                        <div class="flex items-center justify-between">
                                            <h1 class="text-2xl font-bold">Document Requirements</h1>
                                            <button onclick="closeTextModal()" class="text-white hover:text-gray-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="overflow-y-auto flex-grow p-6">
                                        <div id="modalTextContent" class="prose prose-sm max-w-none"></div>
                                    </div>
                                    <div class="p-4 border-t border-gray-200 flex-shrink-0 bg-white">
                                        <div class="flex justify-end space-x-3">
                                            <button onclick="closeTextModal()" class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50 transition-colors duration-200">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="request-document-view-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
                                <div class="relative p-4 w-full max-w-lg max-h-[90vh] overflow-y-auto">
                                    <div class="relative bg-white rounded-lg shadow-md dark:bg-gray-700">
                                        <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600 border-gray-200">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Document View</h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeRequestDocumentModal()">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <div class="p-4 h-[28rem]">
                                            <iframe id="requestDocumentFileViewer" class="w-full h-full border-none" src=""></iframe>
                                        </div>
                                        <div class="flex items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            <button type="button" onclick="closeRequestDocumentModal()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="submitDocumentModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
                                <div class="relative mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                                    <div class="mt-3 text-center">
                                        <div id="documentTypeDisplay" class="text-lg leading-6 font-medium text-gray-900"></div>
                                        <div class="mt-4">
                                            <div class="mb-4">
                                                <input type="file" id="doc_file" name="doc_file" accept="<?= $form_config['tabs']['my_documents']['documents']['allowed_types'] ?>" class="w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>
                                            </div>
                                            <input type="hidden" id="request_id" name="request_id">
                                            <input type="hidden" id="user_id" name="id" value="<?= $_SESSION['u_id'] ?>">
                                            <input type="hidden" id="documentType" name="documentType">
                                            <div class="flex justify-between items-center px-4 py-3">
                                                <button type="button" onclick="closeSubmitDocumentModal()" class="text-gray-600 hover:text-gray-800">Cancel</button>
                                                <button type="button" onclick="submitDocument()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Upload Document</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Suggestions Tab -->
                    <div class="hidden p-4 rounded-lg bg-white shadow-sm" id="suggestions" role="tabpanel" aria-labelledby="suggestions-tab">
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-4">Suggest a New Course</h3>
                            <form id="courseSuggestionForm" action="<?= $form_config['tabs']['suggestions']['form_action'] ?>" method="POST" class="space-y-4">
                                <input type="hidden" name="user_id" value="<?= $_SESSION['u_id'] ?>">
                                <?php foreach ($form_config['tabs']['suggestions']['inputs'] as $field => $config): ?>
                                    <div>
                                        <label for="<?= $field ?>" class="block text-sm font-medium text-gray-700"><?= $config['label'] ?></label>
                                        <?php if ($config['type'] === 'textarea'): ?>
                                            <textarea id="<?= $field ?>" name="<?= $field ?>" rows="3" <?= $config['required'] ? 'required' : '' ?>
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                placeholder="<?= $config['placeholder'] ?>"></textarea>
                                        <?php else: ?>
                                            <input type="<?= $config['type'] ?>" id="<?= $field ?>" name="<?= $field ?>" <?= $config['required'] ? 'required' : '' ?>
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                placeholder="<?= $config['placeholder'] ?>">
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                                <div class="flex justify-end">
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Submit Suggestion
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include "footer.php" ?>
</div>

<script>
    // Global variable to store application status data
    let applicationStatusData = <?php echo json_encode($status); ?>;

    function openModal(applicationId) {
        const application = <?php echo json_encode($my_applications['data']); ?>.find(app => app.id == applicationId);
        if (!application) {
            alert('Application data not found');
            return;
        }

        const currentStatus = application.value;
        let timelineHTML = '';

        applicationStatusData.forEach(status => {
            const isCurrent = (status.id == currentStatus);
            const statusDate = isCurrent ? application.updated_date : '';

            timelineHTML += `
            <div class="relative pl-8 sm:pl-32 py-4 group">
                <div class="flex flex-col sm:flex-row items-start mb-1 group-last:before:hidden 
                    before:absolute before:left-2 sm:before:left-0 before:h-full before:px-px 
                    before:bg-slate-300 sm:before:ml-[6.5rem] before:self-start 
                    before:-translate-x-1/2 before:translate-y-3 
                    after:absolute after:left-2 sm:after:left-0 after:w-2 after:h-2 
                    after:${isCurrent ? 'bg-indigo-600' : 'bg-gray-300'} 
                    after:border-4 after:box-content after:border-slate-50 
                    after:rounded-full sm:after:ml-[6.5rem] after:-translate-x-1/2 after:translate-y-1.5">
                    
                    ${statusDate ? `
                        <time class="sm:absolute left-0 translate-y-0.5 inline-flex items-center 
                            justify-center text-xs font-semibold uppercase w-20 h-6 mb-3 sm:mb-0 
                            ${isCurrent ? 'text-emerald-600 bg-emerald-100' : 'text-gray-500 bg-gray-100'} 
                            rounded-full">
                            ${formatDate(statusDate)}
                        </time>
                    ` : ''}
                    
                    <div class="text-xl font-bold ${isCurrent ? 'text-indigo-600' : 'text-slate-600'}">
                        ${status.f1}
                    </div>
                </div>
                <div class="text-slate-500">${status.f2}</div>
            </div>
        `;
        });

        document.getElementById('statusTimeline').innerHTML = timelineHTML;
        document.getElementById('statusModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('statusModal').classList.add('hidden');
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-GB', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });
    }

    function previewProfileImage(file) {
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            document.getElementById('imageLoader').classList.remove('hidden');
            document.getElementById('editImageIcon').classList.add('hidden');

            reader.onload = function(e) {
                setTimeout(() => {
                    document.getElementById('profilePreview').src = e.target.result;
                    document.getElementById('imageLoader').classList.add('hidden');
                    document.getElementById('removeImage').classList.remove('hidden');
                }, 1000);
            };
            reader.readAsDataURL(file);
        } else {
            alert('Please select a valid image file.');
        }
    }

    document.getElementById('profileInput').addEventListener('change', function(event) {
        previewProfileImage(event.target.files[0]);
    });

    document.getElementById('removeImage').addEventListener('click', function() {
        document.getElementById('profilePreview').src = '<?= $form_config['tabs']['profile']['profile_image']['default'] ?>';
        document.getElementById('removeImage').classList.add('hidden');
        document.getElementById('editImageIcon').classList.remove('hidden');
        document.getElementById('profileInput').value = "";
    });

    function uploadProfileImage(event) {
        const file = event.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('profile_image', file);
        formData.append('user_id', <?= $_SESSION['u_id'] ?>);

        const profilePreview = document.getElementById('profilePreview');
        profilePreview.style.opacity = "0.5";

        fetch('<?= $form_config['tabs']['profile']['profile_image']['upload_endpoint'] ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profilePreview.src = e.target.result;
                        profilePreview.style.opacity = "1";
                    };
                    reader.readAsDataURL(file);
                    update_message('Profile picture updated successfully!');
                    updateProfileCompletion();
                } else {
                    error_message('Failed to update profile picture: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while uploading the image.');
            });
    }

    function openDocument(filePath) {
        const modal = document.getElementById('document-view-modal');
        const fileViewer = document.getElementById('documentFileViewer');
        fileViewer.src = filePath || '';
        modal.classList.remove('hidden');
    }

    function closeDocumentModal() {
        const modal = document.getElementById('document-view-modal');
        const fileViewer = document.getElementById('documentFileViewer');
        modal.classList.add('hidden');
        fileViewer.src = '';
    }

    function openRequestDocument(filePath) {
        const modal = document.getElementById('request-document-view-modal');
        const fileViewer = document.getElementById('requestDocumentFileViewer');
        fileViewer.src = filePath || '';
        modal.classList.remove('hidden');
    }

    function closeRequestDocumentModal() {
        const modal = document.getElementById('request-document-view-modal');
        const fileViewer = document.getElementById('requestDocumentFileViewer');
        modal.classList.add('hidden');
        fileViewer.src = '';
    }

    function openAddDocumentModal() {
        document.getElementById('addDocumentModal').classList.remove('hidden');
    }

    function closeAddDocumentModal() {
        document.getElementById('addDocumentModal').classList.add('hidden');
    }

    function download_document(filePath) {
        const link = document.createElement('a');
        link.href = filePath;
        link.download = filePath.split('/').pop();
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function delete_item(itemId, itemType) {
        if (!confirm(`Are you sure you want to delete this ${itemType}?`)) return;

        $.ajax({
            url: '<?= $form_config['tabs']['my_documents']['documents']['delete_endpoint'] ?>',
            type: 'POST',
            data: {
                id: itemId,
                type: itemType
            },
            success(response) {
                try {
                    const res = JSON.parse(response);
                    if (res.success) {
                        update_message(`${itemType.charAt(0).toUpperCase() + itemType.slice(1)} deleted successfully!`);
                        setTimeout(() => location.reload(), 1000);
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
                alert('An error occurred while deleting the item');
            }
        });
    }

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
            url: '<?= $form_config['tabs']['my_documents']['documents']['upload_endpoint'] ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                let res = typeof response === 'string' ? JSON.parse(response) : response;
                if (res.status === 1) {
                    update_message("Document Uploaded Successfully");
                    closeAddDocumentModal();
                    setTimeout(() => location.reload(), 1000);
                } else {
                    error_message(res.message || 'Upload failed');
                }
            },
            error: function(xhr, status, error) {
                error_message('Error uploading document: ' + error);
            },
            complete: function() {
                submitButton.disabled = false;
                submitButton.textContent = 'Upload Document';
            }
        });
    }

    function closeStatusModal() {
        document.getElementById('statusModal').classList.add('hidden');
    }

    function closeApplicationModal() {
        document.getElementById('applicationModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function openSubmitDocumentModal(requestId, docType, docTypeName) {
        document.getElementById('request_id').value = requestId;
        document.getElementById('documentType').value = docType;
        document.getElementById('documentTypeDisplay').textContent = 'Upload ' + docTypeName;
        document.getElementById('submitDocumentModal').classList.remove('hidden');
    }

    function closeSubmitDocumentModal() {
        document.getElementById('submitDocumentModal').classList.add('hidden');
    }

    function submitDocument() {
        const documentFileInput = document.getElementById('doc_file');
        const requestId = document.getElementById('request_id').value;
        const docType = document.getElementById('documentType').value;
        const userId = document.getElementById('user_id').value;
        const documentFile = documentFileInput.files[0];

        if (!documentFile) {
            error_message('Please select a file to upload');
            return;
        }

        const formData = new FormData();
        formData.append('document_file', documentFile);
        formData.append('request_id', requestId);
        formData.append('document_type', docType);
        formData.append('id', userId);

        const submitButton = document.querySelector('#submitDocumentModal button[onclick="submitDocument()"]');
        submitButton.disabled = true;
        submitButton.textContent = 'Uploading...';

        $.ajax({
            url: '<?= $form_config['tabs']['my_documents']['documents']['upload_endpoint'] ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                let res = typeof response === 'string' ? JSON.parse(response) : response;
                if (res.status === 1) {
                    update_message("Document Uploaded Successfully");
                    closeSubmitDocumentModal();
                    setTimeout(() => location.reload(), 1000);
                } else {
                    error_message(res.message || 'Upload failed');
                }
            },
            error: function(xhr, status, error) {
                error_message('Error uploading document: ' + error);
            },
            complete: function() {
                submitButton.disabled = false;
                submitButton.textContent = 'Upload Document';
            }
        });
    }

    function showTextModal(textContent) {
        const modal = document.getElementById('textModal');
        const contentDiv = document.getElementById('modalTextContent');
        const formattedContent = textContent
            .replace(/\n/g, '<br>')
            .replace(/- /g, '• ');
        contentDiv.innerHTML = formattedContent;
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeTextModal() {
        const modal = document.getElementById('textModal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function updateProfileCompletion() {
        fetch('data/get_profile_data.php?id=<?= $_SESSION['u_id'] ?>')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const completion = calculateProfileCompletion(data.profile, <?php echo json_encode($form_config['tabs']['profile']['profile_completion_fields']); ?>);

                    document.querySelector('.profile-completion-percent').textContent = completion.percentage + '%';
                    document.querySelector('.progress-bar').style.width = completion.percentage + '%';
                    document.querySelector('.progress-text').textContent =
                        completion.completed + ' of ' + completion.total + ' required fields completed';

                    const checklistItems = document.querySelectorAll('.progress-checklist-item');
                    checklistItems.forEach((item, index) => {
                        const field = Object.keys(completion.fields)[index];
                        if (data.profile[field]) {
                            item.classList.add('completed');
                            item.classList.remove('pending');
                            item.querySelector('svg').innerHTML =
                                '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />';
                        } else {
                            item.classList.add('pending');
                            item.classList.remove('completed');
                            item.querySelector('svg').innerHTML =
                                '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />';
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error updating profile completion:', error);
            });
    }

    function calculateProfileCompletion(profileData, fieldsConfig) {
        let completed = 0;
        const total = Object.keys(fieldsConfig).length;

        Object.keys(fieldsConfig).forEach(field => {
            if (profileData[field]) {
                completed++;
            }
        });

        const percentage = Math.round((completed / total) * 100);

        return {
            percentage,
            completed,
            total,
            fields: fieldsConfig
        };
    }

    document.querySelector('form[action="<?= $form_config['tabs']['profile']['form_action'] ?>"]').addEventListener('submit', function() {
        setTimeout(updateProfileCompletion, 1000);
    });

    document.getElementById('profileInput').addEventListener('change', function() {
        setTimeout(updateProfileCompletion, 1000);
    });

    // Initialize the first tab as active
    document.addEventListener('DOMContentLoaded', function() {
        const firstTab = document.querySelector('[data-tabs-target]');
        if (firstTab) {
            firstTab.click();
        }
    });

    // Handle suggestion form submission
    document.getElementById('courseSuggestionForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    update_message('Suggestion submitted successfully!');
                    this.reset();
                } else {
                    error_message(data.message || 'Failed to submit suggestion');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                error_message('An error occurred while submitting the suggestion');
            });
    });
</script>
</body>

</html>