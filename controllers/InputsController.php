<?php
class InputsController
{
    public function renderImageInputs($form_config, $row)
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

    public function renderInputs($form_config, $row)
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
}
