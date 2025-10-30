<?php
// Add this at the top of your PHP script.
error_reporting(E_ALL);
ini_set('display_errors', 1);

function replaceArrayKey($array, $oldKey, $newKey)
{
    if (array_key_exists($oldKey, $array)) {
        $keys = array_keys($array);
        $keys[array_search($oldKey, $keys)] = $newKey;
        $array = array_combine($keys, $array);
    }
    return $array;
}


function uploadFile($file, $upload_dir)
{

    if (isset($_FILES[$file]) && $_FILES[$file]['error'] == UPLOAD_ERR_OK) {
        $allowed_types = array('application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');

        $file_name = $_FILES[$file]['name'];
        $file_type = $_FILES[$file]['type'];
        $file_tmp = $_FILES[$file]['tmp_name'];
        $file_size = $_FILES[$file]['size'];

        if (in_array($file_type, $allowed_types)) {
            if ($file_size <= 5242880) {
                // $upload_dir = 'uploads/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                $file_name = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", $file_name); // Sanitize file name
                $file_path = $upload_dir . basename($file_name);
                if (move_uploaded_file($file_tmp, $file_path)) {
                    return $file_path;
                } else {
                    return "Failed to move the uploaded file.";
                }
            } else {
                return "File is too large. Maximum file size is 5MB.";
            }
        } else {
            return "Invalid file type. Only PDF and DOC files are allowed.";
        }
    } else {
        return "No file uploaded or there was an upload error.";
    }
}





function uploadPic($file_name, $target_dir)
{
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }


    if (($_FILES[$file_name]["name"]) != '') {
        $target_user_image = $target_dir . basename($_FILES[$file_name]["name"]);
        $uploadFileType_user_image = pathinfo($target_user_image, PATHINFO_EXTENSION);
        $newfilename_user_image = round(microtime(true)) . rand(1000, 9999) . '.' . $uploadFileType_user_image;

        if (basename($_FILES[$file_name]["name"]) != '') {
            if ($uploadFileType_user_image != "jpg" && $uploadFileType_user_image != "png" && $uploadFileType_user_image != "jpeg" && $uploadFileType_user_image != "gif" && $uploadFileType_user_image != "JPG" && $uploadFileType_user_image != "PNG" && $uploadFileType_user_image != "JPEG" && $uploadFileType_user_image != "GIF") {
                return '';
            } else {

                if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_dir . $newfilename_user_image)) {

                    return  $newfilename_user_image;
                } else {

                    return '';
                }
            }
        }
    } else {

        return '';
    }
}





function getResizeImg($file, $target_dir, $width, $height)
{


    if (basename($_FILES[$file]["name"]) != '') {
        $pd_Main_img = reSize($_FILES[$file]['tmp_name'], $_FILES[$file]['name'], 1, $target_dir, $width, $height);
    }
    return $pd_Main_img;
}




// back ground functions image uploading 



function reSize($file, $var_file, $var_name, $folderPath, $targetWidth, $targetHeight)
{

    $sourceProperties = getimagesize($file);
    $fileNewName = time() . $var_name;

    $ext = pathinfo($var_file, PATHINFO_EXTENSION);

    $imageType = $sourceProperties[2];

    switch ($imageType) {


        case IMAGETYPE_PNG:
            $imageResourceId = imagecreatefrompng($file);
            $targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1], $targetWidth, $targetHeight);
            imagepng($targetLayer, $folderPath . $fileNewName . "." . $ext);
            break;


        case IMAGETYPE_GIF:
            $imageResourceId = imagecreatefromgif($file);
            $targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1], $targetWidth, $targetHeight);
            imagegif($targetLayer, $folderPath . $fileNewName . "." . $ext);
            break;


        case IMAGETYPE_JPEG:
            $imageResourceId = imagecreatefromjpeg($file);
            $targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1], $targetWidth, $targetHeight);
            imagejpeg($targetLayer, $folderPath . $fileNewName . "." . $ext);
            break;


        default:
            echo "Invalid Image type.";
            exit;
            break;
    }

    $file_save_as =  $fileNewName . "." . $ext;


    move_uploaded_file($file, $folderPath . $file_save_as);

    return $file_save_as;
}

function imageResize($imageResourceId, $width, $height, $targetWidth, $targetHeight)
{




    $targetLayer = imagecreatetruecolor($targetWidth, $targetHeight);
    imagecopyresampled($targetLayer, $imageResourceId, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);


    return $targetLayer;
}




// Date and time functions ----------------------------------------------------

function printTime($date)
{
    try {

        $dateObject = new DateTime($date);
        return $dateObject->format("H:i:s");
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

function printDate($date)
{
    if ($date == null) return '';
 

    $ndate = date_create($date);


    return date_format($ndate, "d-m-Y");
}

function printDateTime($date)
{
    $ndate = date_create($date);

    return date_format($ndate, 'd-m-Y H:i:s');
}

function setExpDate($today, $days = 100)
{
    return date('d-m-Y H:i:s', strtotime($today . ' + ' . $days . 'days'));
}


//----------------------------------------------------------------


function calculateAge($birthdate)
{
    // Create a DateTime object from the birthdate
    $birthDate = new DateTime($birthdate);
    // Get the current date
    $currentDate = new DateTime();
    // Calculate the difference between the current date and the birthdate
    $age = $currentDate->diff($birthDate);
    // Return the age in years
    return $age->y;
}


function redirect_page($is_update, $result, $id, $page)
{
    if (($is_update && $result['error'] === null && $result['status'] === 1) || (!$is_update && $result['code'] === 200)) {
        $info = $is_update ? implode(" ", $result['message']) : '';
        $redirect_url = $is_update
            ? "../" . $page . "_list?error=" . base64_encode(1) . "&info=" . base64_encode($info)
            : "../" . $page . "_list?error=" . base64_encode(4);
    } else {
        $redirect_url = $is_update
            ? "../" . $page . "?id=" . base64_encode($id) . "&error=" . base64_encode(3)
            : "../" . $page . "?id=" . base64_encode($id) . "&error=" . base64_encode(3);
    }

    return $redirect_url;
}


function uploadMedia($file_name, $target_dir, $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov', 'mkv'])
{
    // Ensure the target directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Check if a file was uploaded
    if (!empty($_FILES[$file_name]["name"])) {
        $original_file_name = basename($_FILES[$file_name]["name"]);
        $file_extension = pathinfo($original_file_name, PATHINFO_EXTENSION);
        $new_file_name = round(microtime(true)) . rand(1000, 9999) . '.' . $file_extension;
        $target_file_path = $target_dir . $new_file_name;

        // Validate file type
        if (!in_array(strtolower($file_extension), $allowed_types)) {
            return '';
        }

        // Attempt to move the uploaded file to the target directory
        if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_file_path)) {
            return $new_file_name;
        } else {
            return '';
        }
    }

    return '';
}

// Example usage:
// $uploaded_file = uploadMedia('video_file', 'uploads/videos/', ['mp4', 'avi', 'mov', 'mkv']);
// $uploaded_image = uploadMedia('image_file', 'uploads/images/', ['jpg', 'jpeg', 'png', 'gif']);



function renderImageInputs($form_config, $row)
{
    foreach ($form_config['inputs'] as $name => $input) {
        // Check if the input is a file type with preview enabled
        if ($input['type'] === 'file' && isset($input['accept']) && strpos($input['accept'], 'image/') !== false) {
            $image_src = isset($row[$name]) && $row[$name] !== ''
                ? "../" . htmlspecialchars($row[$name])
                : './assets/img/add img.png';

            echo <<<HTML
            <div class="{$input['div_class']}">
                <label for="$name">{$input['label']}</label>
                <div class="mb-2" id="preview_$name">
                    <img src="$image_src" class="img-thumbnail" style="max-width: 150px;" />
                </div>
                <input type="file" name="$name" id="$name" class="form-control" accept="{$input['accept']}" />
            </div>
            HTML;
        }
    }
}

function renderInputs($form_config, $row)
{
    if (empty($form_config['inputs'])) {
        return;
    }

    foreach ($form_config['inputs'] as $key => $input) {
        // Skip inputs if marked to skip
        if (!empty($input['skip'])) {
            continue;
        }

        // Start the input wrapper based on the type
        switch ($input['type']) {
            case 'text':
            case 'date':
            case 'number':
            case 'datetime-local':
                $divClass = $input['div_class'] ?? 'col-lg-12 col-md-12 form-group';
                $label = isset($input['label']) ? '<label>' . htmlspecialchars($input['label']) . '</label>' : '';
                $value = htmlspecialchars($row[$key] ?? $input['value'] ?? '');
                $class = htmlspecialchars($input['class'] ?? 'form-control');
                $required = !empty($input['required']) ? 'required' : '';
                $pattern = !empty($input['pattern']) ? 'pattern="' . htmlspecialchars($input['pattern']) . '"' : '';
                echo <<<HTML
                <div class="$divClass">
                    $label
                    <input type="{$input['type']}" class="$class" id="$key" name="$key" value="$value" $required $pattern>
                </div>
                HTML;
                break;

            case 'hidden':
                $value = htmlspecialchars($row[$key] ?? $input['value'] ?? '');
                echo <<<HTML
                <input type="hidden" id="$key" name="$key" value="$value">
                HTML;
                break;

            case 'textarea':
                $divClass = $input['div_class'] ?? 'col-lg-12 col-md-12 form-group';
                $label = isset($input['label']) ? '<label>' . htmlspecialchars($input['label']) . '</label>' : '';
                $value = htmlspecialchars($row[$key] ?? $input['value'] ?? '');
                $class = htmlspecialchars($input['class'] ?? 'form-control');
                $required = !empty($input['required']) ? 'required' : '';
                $rows = $input['rows'] ?? '5';
                echo <<<HTML
                <div class="$divClass">
                    $label
                    <textarea class="$class" id="$key" name="$key" rows="$rows" $required>$value</textarea>
                </div>
                HTML;
                break;

            case 'switch':
                $divClass = $input['div_class'] ?? 'col-lg-12 col-md-12 form-group';
                $checked = !empty($input['checked']) ? 'checked' : '';
                $offColor = htmlspecialchars($input['color'][1] ?? 'primary');
                $onColor = htmlspecialchars($input['color'][0] ?? 'success');
                $offText = htmlspecialchars($input['label'][1] ?? 'OFF');
                $onText = htmlspecialchars($input['label'][0] ?? 'ON');
                echo <<<HTML
                <div class="$divClass">
                    <input type="checkbox" id="$key" name="$key" $checked data-bootstrap-switch
                        data-off-color="$offColor" data-on-color="$onColor"
                        data-off-text="$offText" data-on-text="$onText">
                </div>
                HTML;
                break;

            case 'multy-select':
                $divClass = $input['div_class'] ?? 'col-lg-12 col-md-12 form-group';
                $label = isset($input['label']) ? '<label>' . htmlspecialchars($input['label']) . '</label>' : '';
                $selectedColor = 'select2-' . ($input['selected-color'] ?? 'info');
                $dropdownColor = 'select2-' . ($input['dropdown-color'] ?? 'info');
                $placeholder = htmlspecialchars($input['placeholder'] ?? '');
                echo <<<HTML
                <div class="$divClass">
                    $label
                    <div class="$selectedColor">
                        <select id="$key" name="{$key}[]" class="select2 modal-class" multiple="multiple"
                            data-placeholder="$placeholder" data-dropdown-css-class="$dropdownColor" style="width: 100%;">
                HTML;
                foreach ($input['items'] as $item) {
                    $selected = (isset($row[$key]) && $row[$key] == $item['value']) ||
                        (!isset($row[$key]) && isset($input['value']) && $input['value'] == $item['value']) ? 'selected' : '';
                    echo '<option value="' . htmlspecialchars($item['value']) . '" ' . $selected . '>' . htmlspecialchars($item['label']) . '</option>';
                }
                echo <<<HTML
                        </select>
                    </div>
                </div>
                HTML;
                break;

            case 'checkbox':
                $divClass = $input['div_class'] ?? 'icheck-primary d-inline';
                $checked = !empty($input['checked']) ? 'checked' : '';
                $label = htmlspecialchars($input['label'] ?? '');
                echo <<<HTML
                <div class="form-group">
                    <div class="$divClass">
                        <input type="checkbox" id="$key" name="$key" $checked>
                        <label for="$key">$label</label>
                    </div>
                </div>
                HTML;
                break;

            default:
                if ($input['type'] === 'custom' && !empty($input['value'])) {
                    echo $input['value'];
                }
                break;


            case 'combobox':
                $divClass = $input['div_class'] ?? 'col-lg-12 col-md-12 form-group';
                $label = isset($input['label']) ? '<label>' . htmlspecialchars($input['label']) . '</label>' : '';
                $value = $row[$key] ?? $input['value'] ?? '';
                $class = htmlspecialchars($input['class'] ?? 'form-control');
                $placeholder = htmlspecialchars($input['placeholder'] ?? 'Select an option');

                echo <<<HTML
                    <div class="$divClass">
                    $label
                    <select class="$class" id="$key" name="$key">
                    <option value="" disabled selected>$placeholder</option>
                    HTML;
                foreach ($input['items'] as $item) {
                    $selected = (isset($row[$key]) && $row[$key] == $item['value']) ? 'selected' : '';
                    echo '<option value="' . htmlspecialchars($item['value']) . '" ' . $selected . '>' . htmlspecialchars($item['label']) . '</option>';
                }
                echo <<<HTML
                    </select>
                    </div>
                    HTML;
                break;

            case 'email':
                $divClass = $input['div_class'] ?? 'col-lg-12 col-md-12 form-group';
                $label = isset($input['label']) ? '<label>' . htmlspecialchars($input['label']) . '</label>' : '';
                $value = htmlspecialchars($row[$key] ?? $input['value'] ?? '');
                $class = htmlspecialchars($input['class'] ?? 'form-control');
                $required = !empty($input['required']) ? 'required' : '';
                $pattern = !empty($input['pattern']) ? 'pattern="' . htmlspecialchars($input['pattern']) . '"' : '';
                echo <<<HTML
                    <div class="$divClass">
                    $label
                    <input type="email" class="$class" id="$key" name="$key" value="$value" $required $pattern>
                    </div>
                    HTML;
                break;

            case 'mobile':
                $divClass = $input['div_class'] ?? 'col-lg-12 col-md-12 form-group';
                $label = isset($input['label']) ? '<label>' . htmlspecialchars($input['label']) . '</label>' : '';
                $value = htmlspecialchars($row[$key] ?? $input['value'] ?? '');
                $class = htmlspecialchars($input['class'] ?? 'form-control');
                $required = !empty($input['required']) ? 'required' : '';
                $pattern = !empty($input['pattern']) ? 'pattern="' . htmlspecialchars($input['pattern']) . '"' : '';
                $placeholder = htmlspecialchars($input['placeholder'] ?? '+94 71 234 5678'); // Default Sri Lankan Format

                echo <<<HTML
                    <div class="$divClass">
                        $label
                        <input type="{$input['type']}" class="$class" id="$key" name="$key" value="$value" placeholder="$placeholder" $required $pattern>
                    </div>
                    HTML;
                break;
        }
    }
}

function redirect_page_single($is_update, $result, $id, $page)
{
    // If $page already has ?, then we need to append using &
    $separator = (strpos($page, '?') !== false) ? '&' : '?';

    if (($is_update && $result['error'] === null && $result['status'] === 1) || (!$is_update && $result['code'] === 200)) {
        $info = $is_update ? implode(" ", $result['message']) : '';
        $redirect_url = $is_update
            ? "../" . $page . $separator . "error=" . base64_encode(1) . "&info=" . base64_encode($info)
            : "../" . $page . $separator . "error=" . base64_encode(4);
    } else {
        $redirect_url = $is_update
            ? "../" . $page . $separator . "id=" . base64_encode($id) . "&error=" . base64_encode(3)
            : "../" . $page . $separator . "id=" . base64_encode($id) . "&error=" . base64_encode(3);
    }

    return $redirect_url;
}




function input($key)
{
    global $form_config, $row;

    if (!isset($form_config['inputs'][$key])) {
        return '';
    }

    $input = $form_config['inputs'][$key];

    // Check if the input should be skipped
    if (isset($input['skip']) && $input['skip'] === true) {
        return '';
    }

    ob_start();

    switch ($input['type']) {
        case 'text':
        case 'email':
?>


            <div class="<?= isset($input['div_class']) ? $input['div_class'] : 'col-lg-12 col-md-12 form-group' ?>">
                <?php if (isset($input['label'])) echo ' <label class="' . (isset($input['label-class']) ? $input['label-class'] : "") . '">' . $input['label'] . '</label>'; ?>

                <?php if (isset($input['input-div-class'])) : ?>
                    <div class="<?= $input['input-div-class'] ?>">
                    <?php endif; ?>

                    <?php if (isset($input['button'])) : ?>
                        <div class="input-group">
                        <?php endif; ?>

                        <input type="<?= $input['type'] ?>" class="<?= isset($input['class']) ? $input['class'] : 'form-control' ?>" id="<?= isset($input['id']) ? $input['id'] : $key ?>" name="<?= $key ?>" <?php if (isset($input['required'])) echo 'required'; ?> <?php if (isset($input['pattern'])) echo 'pattern="' . $input['pattern'] . '"'; ?> value="<?= isset($row[$key]) ? $row[$key] : (isset($input['value']) ? $input['value'] : '') ?>" placeholder="<?= isset($input['placeholder']) ? $input['placeholder'] : '' ?>">

                        <?php if (isset($input['button'])) : ?>
                            <span class="input-group-append">
                                <button id="<?= $input['button']['id'] ?>" type="button" class="<?= $input['button']['class'] ?>"><?= $input['button']['text'] ?></button>
                            </span>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($input['input-div-class'])) : ?>
                    </div>
                <?php endif; ?>
            </div>

        <?php
            break;

        case 'text-button':
        ?>

            <div class="<?= isset($input['div_class']) ? $input['div_class'] : 'col-lg-12 col-md-12 input-group' ?>">
                <?php if (isset($input['label'])) echo ' <label class="' . (isset($input['label-class']) ? $input['label-class'] : "") . '">' . $input['label'] . '</label>'; ?>
                <?php if (isset($input['input-div-class'])) : ?>
                    <div class="<?= $input['input-div-class'] ?>">
                    <?php endif; ?>

                    <div class="input-group">
                        <input type="<?= $input['type'] ?>" class="<?= isset($input['class']) ? $input['class'] : 'form-control' ?>" id="<?= isset($input['id']) ? $input['id'] : $key ?>" name="<?= $key ?>" <?php if (isset($input['required'])) echo 'required'; ?> <?php if (isset($input['pattern'])) echo 'pattern="' . $input['pattern'] . '"'; ?> value="<?= isset($row[$key]) ? $row[$key] : (isset($input['value']) ? $input['value'] : '') ?>">
                        <span class="input-group-append">
                            <button id="email_button" type="button" class="btn btn-success">Verify</button>
                        </span>
                    </div>
                    <?php if (isset($input['input-div-class'])) : ?>
                    </div>
                <?php endif; ?>
            </div>

        <?php
            break;

        case 'password':
        ?>
            <div class="<?= isset($input['div_class']) ? $input['div_class'] : 'col-lg-12 col-md-12 form-group' ?>">
                <?php if (isset($input['label'])) : ?>
                    <label class="<?= isset($input['label-class']) ? $input['label-class'] : '' ?>"><?= $input['label'] ?></label>
                <?php endif; ?>

                <div class="input-group password-input-group">
                    <input type="password"
                        id="<?= isset($input['id']) ? $input['id'] : $key ?>"
                        placeholder="<?= isset($input['placeholder']) ? $input['placeholder'] : '' ?>"
                        name="<?= $key ?>"
                        class="form-control password-input"
                        <?= isset($input['required']) ? 'required' : '' ?>
                        value="<?= isset($input['value']) ? $input['value'] : '' ?>">
                    <div class="input-group-append">
                        <button type="button"
                            class="btn btn-outline-secondary toggle-password"
                            data-target="#<?= isset($input['id']) ? $input['id'] : $key ?>">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php
            break;
            break;

        case 'custom':
            if (isset($input['value']) && $input['value'] != '') {
                echo $input['value'];
            }
            break;

        case 'h':
        ?>
            <input type="hidden" id="<?= isset($input['id']) ? $input['id'] : $key ?>" name="<?= $key ?>" value="<?= isset($row[$key]) ? $row[$key] : (isset($input['value']) ? $input['value'] : '') ?>">
        <?php
            break;

        case 'number':
        ?>
            <div class="<?= isset($input['div_class']) ? $input['div_class'] : 'col-lg-12 col-md-12 form-group' ?>">
                <?php if (isset($input['label'])) echo ' <label class="' . (isset($input['label-class']) ? $input['label-class'] : "") . '">' . $input['label'] . '</label>'; ?>
                <?php if (isset($input['input-div-class'])) : ?>
                    <div class="<?= $input['input-div-class'] ?>">
                    <?php endif; ?>

                    <input type="number" <?php if (isset($input['minlength'])) echo 'minlength="' . $input['minlength'] . '"'; ?> class="<?= isset($input['class']) ? $input['class'] : 'form-control' ?>" id="<?= isset($input['id']) ? $input['id'] : $key ?>" name="<?= $key ?>" <?php if (isset($input['required'])) echo 'required'; ?> <?php if (isset($input['pattern'])) echo 'pattern="' . $input['pattern'] . '"'; ?> value="<?= isset($row[$key]) ? $row[$key] : (isset($input['value']) ? $input['value'] : '') ?>">
                    <?php if (isset($input['input-div-class'])) : ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php
            break;

        case 'switch':
        ?>
            <div class="<?= isset($input['div_class']) ? $input['div_class'] : 'col-lg-12 col-md-12 form-group' ?>">
                <input type="checkbox" id="<?= isset($input['id']) ? $input['id'] : $key ?>" name="<?= $key ?>" <?php if (isset($row[$key]) && $row[$key] == 1) echo 'checked'; ?> data-bootstrap-switch data-off-color="<?= isset($input['color'][1]) ? $input['color'][1] : 'primary' ?>" data-on-color="<?= isset($input['color'][0]) ? $input['color'][0] : 'success' ?> " data-off-text="<?= isset($input['label'][1]) ? $input['label'][1] : 'OFF' ?>" data-on-text="<?= isset($input['label'][0]) ? $input['label'][0] : 'ON' ?>">
            </div>
        <?php
            break;

        case 'combobox':
        ?>

            <div class="<?= isset($input['div_class']) ? $input['div_class'] : 'col-lg-12 col-md-12 form-group' ?>">
                <?php if (isset($input['label'])) echo ' <label class="' . (isset($input['label-class']) ? $input['label-class'] : "") . '">' . $input['label'] . '</label>'; ?>
                <?php if (isset($input['input-div-class'])) : ?>
                    <div class="<?= $input['input-div-class'] ?>">
                    <?php endif; ?>

                    <div class="<?= isset($input['selected-color']) ? 'select2-' . $input['selected-color'] : 'select2-info' ?>">
                        <select class="<?= isset($input['class']) ? $input['class'] : 'form-control' ?>" id="<?= isset($input['id']) ? $input['id'] : $key ?>" name="<?= $key ?>" <?php if (isset($input['required'])) echo 'required'; ?>>
                            <option value=""><?= isset($input['placeholder']) ? $input['placeholder'] : 'Choose an option' ?></option>
                            <?php foreach ($input['items'] as $item) { ?>
                                <option value="<?= $item['value'] ?>" <?php if (isset($row[$key]) && $row[$key] == $item['value']) echo 'selected';
                                                                        elseif (isset($input['value']) && $input['value'] == $item['value']) echo 'selected'; ?>><?= $item['label'] ?></option>
                            <?php } ?>
                        </select>
                    </div>



                    <?php if (isset($input['input-div-class'])) : ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php
            break;

        case 'multy-select':
        ?>
            <div class="<?= isset($input['div_class']) ? $input['div_class'] : 'col-lg-12 col-md-12 form-group' ?>">
                <?php if (isset($input['label'])) echo ' <label class="' . (isset($input['label-class']) ? $input['label-class'] : "") . '">' . $input['label'] . '</label>'; ?>
                <?php if (isset($input['input-div-class'])) : ?>
                    <div class="<?= $input['input-div-class'] ?>">
                    <?php endif; ?>

                    <div class="<?= isset($input['selected-color']) ? 'select2-' . $input['selected-color'] : 'select2-info' ?>">
                        <select id="<?= isset($input['id']) ? $input['id'] : $key ?>" name="<?= $key ?>[]" class="select2 modal-class" multiple="multiple" data-placeholder="<?= isset($input['placeholder']) ? $input['placeholder'] : '' ?>" data-dropdown-css-class="<?= isset($input['dropdown-color']) ? 'select2-' . $input['dropdown-color'] : 'select2-info' ?>" <?php if (isset($input['required'])) echo 'required'; ?> style="width: 100%;">
                            <?php foreach ($input['items'] as $item) { ?>
                                <option value="<?= $item['value'] ?>" <?php if (isset($row[$key]) && $row[$key] == $item['value']) echo 'selected';
                                                                        elseif (isset($input['value']) && $input['value'] == $item['value']) echo 'selected'; ?>><?= $item['label'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php if (isset($input['input-div-class'])) : ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php
            break;

        case 'image':
        ?>
            <div class="<?= isset($input['div_class']) ? $input['div_class'] : 'col-lg-12 col-md-12 form-group' ?>">
                <input type="file" class="<?= isset($input['class']) ? $input['class'] : '' ?>" id="<?= isset($input['id']) ? $input['id'] : $key ?>" name="<?= $key ?>" accept="image/*" <?php if (isset($input['required'])) echo 'required'; ?>>
            </div>
        <?php
            break;

        case 'checkbox':
        ?>

            <div class="<?= isset($input['div_class']) ? $input['div_class'] : 'col-lg-12 col-md-12' ?>">
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input class="<?= isset($input['class']) ? $input['class'] : 'custom-control-input' ?>" type="checkbox" id="<?= isset($input['id']) ? $input['id'] : $key ?>" name="<?= $key ?>" <?php if (isset($input['required'])) echo 'required'; ?> <?php if ((isset($row[$key]) && $row[$key] == 1) || (isset($input['checked']) && $input['checked'] === true)) echo 'checked'; ?>>
                        <label class="custom-control-label" for="<?= isset($input['id']) ? $input['id'] : $key ?>"><?= $input['label'] ?></label>
                    </div>
                </div>
            </div>

        <?php
            break;

        case 'country':
        ?>
            <div class="<?= isset($input['div_class']) ? $input['div_class'] : 'col-lg-12 col-md-12 form-group' ?>">
                <?php if (isset($input['label'])) echo ' <label class="' . (isset($input['label-class']) ? $input['label-class'] : "") . '">' . $input['label'] . '</label>'; ?>
                <?php if (isset($input['input-div-class'])) : ?>
                    <div class="<?= $input['input-div-class'] ?>">
                    <?php endif; ?>

                    <div class="niceCountryInputSelector <?= isset($input['class']) ? $input['class'] : 'form-control' ?>" data-selectedcountry="<?= isset($row[$key]) ? $row[$key] : (isset($input['value']) ? $input['value'] : 'GB') ?>" data-showspecial="false" data-showflags="true" data-i18nall="All selected" data-i18nnofilter="No selection" data-i18nfilter="Filter" data-onchangecallback="<?= isset($input['onChangeCallback']) ? $input['onChangeCallback'] : 'onChangeCallback' ?>"></div>
                    <input type="hidden" id="<?= isset($input['id']) ? $input['id'] : $key ?>" name="<?= $key ?>" value="<?= isset($row[$key]) ? $row[$key] : (isset($input['value']) ? $input['value'] : '') ?>">
                    <?php if (isset($input['input-div-class'])) : ?>
                    </div>
                <?php endif; ?>

            </div>
        <?php
            break;

        case 'textarea':
        ?>
            <div class="<?= isset($input['div_class']) ? $input['div_class'] : 'col-lg-12 col-md-12 form-group' ?>">
                <?php if (isset($input['label'])) echo ' <label class="' . (isset($input['label-class']) ? $input['label-class'] : "") . '">' . $input['label'] . '</label>'; ?>
                <?php if (isset($input['input-div-class'])) : ?>
                    <div class="<?= $input['input-div-class'] ?>">
                    <?php endif; ?>

                    <textarea class="<?= $input['class'] ?>" id="<?= isset($input['id']) ? $input['id'] : $key ?>" name="<?= $key ?>" <?php if (isset($input['required'])) echo 'required'; ?> <?php if (isset($input['pattern'])) echo 'pattern="' . $input['pattern'] . '"'; ?> rows="<?= isset($input['rows']) ? $input['rows'] : '5' ?>"><?= isset($row[$key]) ? $row[$key] : (isset($input['value']) ? $input['value'] : '') ?></textarea>
                    <?php if (isset($input['input-div-class'])) : ?>
                    </div>
                <?php endif; ?>

            </div>



        <?php
            break;

        case 'date':
        ?>


            <div class="<?= isset($input['div_class']) ? $input['div_class'] : 'col-lg-12 col-md-12 form-group' ?>">
                <?php if (isset($input['label'])) echo ' <label class="' . (isset($input['label-class']) ? $input['label-class'] : "") . '">' . $input['label'] . '</label>'; ?>

                <?php if (isset($input['input-div-class'])) : ?>
                    <div class="<?= $input['input-div-class'] ?>">
                    <?php endif; ?>
                    <?php if (isset($input['button'])) : ?>
                        <div class="input-group">
                        <?php endif; ?>

                        <input type="date" class="<?= isset($input['class']) ? $input['class'] : 'form-control' ?>" id="<?= isset($input['id']) ? $input['id'] : $key ?>" name="<?= $key ?>" <?php if (isset($input['required'])) echo 'required'; ?> <?php if (isset($input['pattern'])) echo 'pattern="' . $input['pattern'] . '"'; ?> value="<?= isset($row[$key]) ? date('Y-m-d', strtotime($row[$key])) : (isset($input['value']) ? $input['value'] : '') ?>">

                        <?php if (isset($input['button'])) : ?>
                            <span class="input-group-append">
                                <button id="<?= $input['button']['id'] ?>" type="button" class="<?= $input['button']['class'] ?>"><?= $input['button']['text'] ?></button>
                            </span>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($input['input-div-class'])) : ?>
                    </div>
                <?php endif; ?>
            </div>


        <?php
            break;

        case 'datetime':
        ?>
            <div class="<?= isset($input['div_class']) ? $input['div_class'] : 'col-lg-12 col-md-12 form-group' ?>">
                <?php if (isset($input['label'])) echo ' <label class="' . (isset($input['label-class']) ? $input['label-class'] : "") . '">' . $input['label'] . '</label>'; ?>
                <?php if (isset($input['input-div-class'])) : ?>
                    <div class="<?= $input['input-div-class'] ?>">
                    <?php endif; ?>

                    <input type="datetime-local" class="<?= isset($input['class']) ? $input['class'] : 'form-control' ?>" id="<?= isset($input['id']) ? $input['id'] : $key ?>" name="<?= $key ?>" <?php if (isset($input['required'])) echo 'required'; ?> <?php if (isset($input['pattern'])) echo 'pattern="' . $input['pattern'] . '"'; ?> value="<?= isset($row[$key]) ? date('Y-m-d\TH:i', strtotime($row[$key])) : (isset($input['value']) ? $input['value'] : '') ?>">
                    <?php if (isset($input['input-div-class'])) : ?>
                    </div>
                <?php endif; ?>
            </div>
<?php
            break;

        default:
            break;
    }

    $output = ob_get_clean();
    return $output;
}

function generate_form_inputs($config, $row = [])
{
    $html = '';
    $form_action = htmlspecialchars($config['form_action'] ?? '#');
    $defaultClasses = 'w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors';



    foreach ($config['inputs'] as $name => $input) {
        // Extract common attributes
        $label = $input['label'] ?? '';
        $type = $input['type'] ?? 'text';
        $placeholder = $input['placeholder'] ?? '';
        $required = !empty($input['required']) ? 'required' : '';
        $disabled = !empty($input['disabled']) ? 'disabled' : '';
        $value = isset($row[$name]) ? htmlspecialchars($row[$name]) : '';
        $validation = $input['validation'] ?? [];


        // Validation attributes
        $pattern = isset($validation['pattern']) ? "pattern='{$validation['pattern']}'" : '';
        $minlength = isset($validation['minlength']) ? "minlength='{$validation['minlength']}'" : '';
        $maxlength = isset($validation['maxlength']) ? "maxlength='{$validation['maxlength']}'" : '';
        $message = isset($validation['message']) ? $validation['message'] : '';


        // HTML for label
        $html .= "<div>
                    <label class='block text-gray-600 mb-1'>{$label}</label>";

        // Switch statement for different input types
        switch ($type) {
            case 'select':
                if (isset($input['options'])) {
                    $html .= "<select name='{$name}' class='{$defaultClasses}' {$required} {$disabled}>";
                    foreach ($input['options'] as $option) {
                        $selected = ($value === $option) ? 'selected' : '';
                        $html .= "<option value='{$option}' {$selected}>{$option}</option>";
                    }
                    $html .= "</select>";
                }
                break;

            case 'textarea':
                $rows = $input['rows'] ?? '4';
                $html .= "<textarea name='{$name}' placeholder='{$placeholder}' rows='{$rows}' class='{$defaultClasses}' {$required} {$disabled} onkeyup='validateInput(this)'>{$value}</textarea>";
                break;

            default:
                // Handle other input types (text, email, password, etc.)
                $html .= "<input type='{$type}' name='{$name}' placeholder='{$placeholder}' value='{$value}' class='{$defaultClasses}' {$required} {$disabled} {$pattern} {$minlength} {$maxlength} {$message} onkeyup='validateInput(this)'>";
                break;
        }

        if (!empty($message)) {
            $html .= "<small class='text-red-500 hidden' id='{$name}-error'>{$message}</small>";
        }
        // Closing div for input
        $html .= "</div>";
    }





    // JavaScript for validation
    $html .= "<script>
        function validateInput(input) {
            const errorMessage = document.getElementById(input.name + '-error');
            if (input.checkValidity()) {
                input.classList.remove('border-red-500');
                input.classList.remove('focus:ring-blue-500');
                input.classList.add('border-green-500');
                if (errorMessage) errorMessage.classList.add('hidden');
            } else {
                input.classList.remove('focus:ring-blue-500');
                input.classList.remove('border-green-500');
                input.classList.add('border-red-500');
                if (errorMessage) errorMessage.classList.remove('hidden');
            }
        }
    </script>";

    return $html;
}


function upload_pic($file_name, $target_dir, $new_width = 800, $new_height = 600)
{
    // Sanitize target directory path
    $target_dir = rtrim($target_dir, '/') . '/';

    // Create directory if it doesn't exist
    if (!is_dir($target_dir)) {
        $old_umask = umask(0);
        mkdir($target_dir, 0755, true);
        umask($old_umask);
    }

    // Check file upload
    if (!isset($_FILES[$file_name]) || $_FILES[$file_name]['error'] !== UPLOAD_ERR_OK) {
        return '';
    }

    $tmp_name = $_FILES[$file_name]['tmp_name'];

    // Validate as image
    $image_info = @getimagesize($tmp_name);
    if ($image_info === false) {
        return '';
    }

    $original_width  = $image_info[0];
    $original_height = $image_info[1];
    $mime_type       = $image_info['mime'];

    // Generate extension
    $extension = '';
    if (preg_match('/image\/([a-z0-9]+)/i', $mime_type, $matches)) {
        $extension = strtolower($matches[1]);
    } else {
        return '';
    }

    // Create image from file based on MIME type
    switch ($mime_type) {
        case 'image/jpeg':
            $src_image = imagecreatefromjpeg($tmp_name);
            break;
        case 'image/png':
            $src_image = imagecreatefrompng($tmp_name);
            break;
        case 'image/gif':
            $src_image = imagecreatefromgif($tmp_name);
            break;
        case 'image/webp':
            $src_image = imagecreatefromwebp($tmp_name);
            break;
        default:
            return ''; // Unsupported format for resizing
    }

    if (!$src_image) {
        return '';
    }

    // Create new resized image
    $resized_image = imagecreatetruecolor($new_width, $new_height);

    // Preserve transparency for PNG & GIF
    if ($mime_type == 'image/png' || $mime_type == 'image/gif') {
        imagecolortransparent($resized_image, imagecolorallocatealpha($resized_image, 0, 0, 0, 127));
        imagealphablending($resized_image, false);
        imagesavealpha($resized_image, true);
    }

    // Resize
    imagecopyresampled(
        $resized_image,
        $src_image,
        0,
        0,
        0,
        0,
        $new_width,
        $new_height,
        $original_width,
        $original_height
    );

    // Save resized image
    $new_filename = md5(uniqid() . microtime()) . '.' . $extension;
    $target_file = $target_dir . $new_filename;

    switch ($mime_type) {
        case 'image/jpeg':
            imagejpeg($resized_image, $target_file, 90);
            break;
        case 'image/png':
            imagepng($resized_image, $target_file, 6);
            break;
        case 'image/gif':
            imagegif($resized_image, $target_file);
            break;
        case 'image/webp':
            imagewebp($resized_image, $target_file, 80);
            break;
    }

    // Cleanup
    imagedestroy($src_image);
    imagedestroy($resized_image);

    chmod($target_file, 0644); // Secure permissions

    return $new_filename;
}

function convertHtmlToTailwind($html)
{
    // First clean up the HTML by removing unnecessary attributes and styles
    $html = preg_replace('/ style="[^"]*"/', '', $html);
    $html = preg_replace('/ data-start="[^"]*"/', '', $html);
    $html = preg_replace('/ data-end="[^"]*"/', '', $html);
    $html = preg_replace('/ class="[^"]*"/', '', $html);
    $html = preg_replace('/<span style="[^"]*">(.*?)<\/span>/', '$1', $html);
    $html = preg_replace('/<span lang="[^"]*">(.*?)<\/span>/', '$1', $html);
    $html = preg_replace('/<o:p><\/o:p>/', '', $html);

    // Convert b tags to strong
    $html = preg_replace('/<b>(.*?)<\/b>/', '<strong>$1</strong>', $html);

    // Now apply Tailwind classes to all elements
    $replacements = [
        // Paragraphs and text
        '/<p>/' => '<p class="mb-4 text-base text-gray-700 leading-relaxed">',
        '/<p class="MsoNormal">/' => '<p class="mb-4 text-base text-gray-700 leading-relaxed">',

        // Headings
        '/<h1>/' => '<h1 class="text-4xl font-bold text-gray-900 mb-6 mt-8">',
        '/<h2>/' => '<h2 class="text-3xl font-bold text-gray-900 mb-5 mt-7">',
        '/<h3>/' => '<h3 class="text-2xl font-semibold text-gray-900 mb-4 mt-6">',
        '/<h4>/' => '<h4 class="text-xl font-semibold text-gray-800 mb-3 mt-5">',
        '/<h5>/' => '<h5 class="text-lg font-medium text-gray-800 mb-2 mt-4">',
        '/<h6>/' => '<h6 class="text-base font-medium text-gray-700 mb-2 mt-3">',

        // Lists
        '/<ul>/' => '<ul class="list-disc pl-6 space-y-2 mb-6">',
        '/<ol>/' => '<ol class="list-decimal pl-6 space-y-2 mb-6">',
        '/<li>/' => '<li class="mb-2 text-gray-700">',
        '/<li class="MsoNormal">/' => '<li class="mb-2 text-gray-700">',

        // Links
        '/<a(.*?)>/' => '<a$1 class="text-blue-600 hover:text-blue-800 underline transition-colors">',

        // Tables
        '/<table>/' => '<table class="w-full border-collapse mb-8">',
        '/<table class="table table-bordered">/' => '<table class="w-full border-collapse border border-gray-300 mb-8">',
        '/<td>/' => '<td class="px-4 py-3 border border-gray-300 text-sm text-gray-800">',
        '/<th>/' => '<th class="px-4 py-3 border border-gray-300 text-sm font-semibold text-gray-800 bg-gray-100">',
        '/<tr>/' => '<tr class="hover:bg-gray-50">',
        '/<tbody>/' => '<tbody class="divide-y divide-gray-200">',

        // Strong/emphasis
        '/<strong>/' => '<strong class="font-semibold">',
        '/<em>/' => '<em class="italic">',

        // Divs and sections
        '/<div>/' => '<div class="mb-6">',
        '/<section>/' => '<section class="mb-8">',

        // Special cases from your content
        '/<p class="MsoNormal" style="text-align: justify;">/' => '<p class="mb-4 text-base text-gray-700 leading-relaxed text-justify">',
        '/<p style="font-weight: 400; color: rgb(117, 117, 117); font-size: 16px; text-align: justify;">/' =>
        '<p class="mb-4 text-base text-gray-500 leading-relaxed text-justify">',

        // Remove empty spans
        '/<span><\/span>/' => '',

        // Add responsive container for the first div
        '/<div class="w-full md:w-3\/4">/' => '<div class="w-full md:w-3/4 mx-auto px-4">',
    ];

    $html = preg_replace(array_keys($replacements), array_values($replacements), $html);

    // Add responsive container if missing
    if (strpos($html, 'container mx-auto') === false) {
        $html = '<div class="container mx-auto px-4">' . $html . '</div>';
    }

    return $html;
}
