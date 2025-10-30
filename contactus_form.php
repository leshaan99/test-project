<?php
$form_config = [
    'form_action' => 'data/data_contact.php',
    'inputs' => [
        'f3' => [
            'label' => 'Name',
            'type' => 'text',
            'required' => true,
            'placeholder' => 'Enter your name',
            'validation' => ['pattern' => '[A-Za-z]{1,100}', 'minlength' => 1, 'maxlength' => 100, 'message' => 'Must be 1-100 chars']
        ],
        'f4' => [
            'label' => 'Your Email',
            'type' => 'email',
            'required' => true,
            'placeholder' => 'Enter your email',
            'validation' => [
                'pattern' => '[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$',
                'message' => 'Invalid email'
            ]
        ],
        'f5' => [
            'label' => 'Mobile',
            'type' => 'tel',
            'required' => true,
            'placeholder' => 'Enter your mobile number',
            'validation' => ['pattern' => '[0-9]{10,15}', 'message' => 'Phone number must be 10-15 digits', 'minlength' => 10, 'maxlength' => 15]
        ],
        'f6' => [
            'label' => 'Subject',
            'type' => 'text',
            'required' => true,
            'placeholder' => 'Let us know how we can help you',
            'validation' => ['pattern' => '[A-Za-z]{1,100}', 'minlength' => 1, 'maxlength' => 200, 'message' => 'Must be 1-200 chars']

        ],
        'f7' => [
            'label' => 'Your Message',
            'type' => 'textarea',
            'required' => true,
            'placeholder' => 'Leave a comment...',
            'rows' => 6,
            'validation' => ['maxlength' => 1000, 'message' => 'Message cannot exceed 1000 characters']
        ]
    ],
    'submit_text' => 'Send Message'
];
?>
<section class="bg-white">
    <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900">
            Have Questions? We’re Here to Help!
        </h2>
        <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 sm:text-xl">
            Contact us now for personalized guidance and support.
        </p>

        <form id="contactForm" action="<?= $form_config['form_action'] ?>" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach ($form_config['inputs'] as $name => $input):
                $val = $input['validation'] ?? []; ?>

                <div class="<?= $name === 'f7' ? 'md:col-span-2' : '' ?>">
                    <label for="<?= $name ?>" class="block mb-2 text-sm font-medium text-gray-900">
                        <?= $input['label'] ?><?= !empty($input['required']) ? '<span class="text-red-500">*</span>' : '' ?>
                    </label>

                    <?php if ($input['type'] === 'textarea'): ?>
                        <textarea
                            id="<?= $name ?>"
                            name="<?= $name ?>"
                            rows="<?= $input['rows'] ?? 4 ?>"
                            placeholder="<?= $input['placeholder'] ?? '' ?>"
                            class="w-full p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            <?= !empty($input['required']) ? 'required' : '' ?>
                            <?= isset($val['minlength']) ? 'minlength="' . $val['minlength'] . '"' : '' ?>
                            <?= isset($val['maxlength']) ? 'maxlength="' . $val['maxlength'] . '"' : '' ?>></textarea>
                    <?php else: ?>
                        <input
                            type="<?= $input['type'] ?>"
                            id="<?= $name ?>"
                            name="<?= $name ?>"
                            placeholder="<?= $input['placeholder'] ?? '' ?>"
                            class="w-full p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            <?= !empty($input['required']) ? 'required' : '' ?>
                            <?= isset($val['pattern']) ? 'pattern="' . $val['pattern'] . '"' : '' ?>
                            <?= isset($val['minlength']) ? 'minlength="' . $val['minlength'] . '"' : '' ?>
                            <?= isset($val['maxlength']) ? 'maxlength="' . $val['maxlength'] . '"' : '' ?>>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <div class="md:col-span-2 text-center">
                <button type="submit" class="mt-4 px-8 py-3 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 hover:scale-105 transform transition duration-300">
                    <?= $form_config['submit_text'] ?>
                </button>
            </div>
        </form>
        <!-- Success/Error Message -->
        <div id="responseMessage" class="text-center mt-4 text-sm font-medium"></div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#contactForm").on("submit", function(event) {
            event.preventDefault(); // Prevent default form submission

            const formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: "./admin/data/register_faq.php",
                type: "POST",
                data: formData,
                success: function(response) {
                    // Display success message
                    $("#responseMessage").text("Your message has been sent successfully!").css("color", "green");
                    $("#contactForm")[0].reset(); // Reset form
                },
                error: function() {
                    // Display error message
                    $("#responseMessage").text("An error occurred. Please try again.").css("color", "red");
                }
            });
        });
    });

    document.getElementById('f3').addEventListener('input', function() {
        // allow letters and single spaces only
        this.value = this.value.replace(/[^A-Za-z\s]/g, '') // remove non-letters/non-space
            .replace(/\s{2,}/g, ' '); // replace multiple spaces with single space
    });

    document.getElementById('f5').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, ''); // remove non-digits
    });
    document.getElementById('f6').addEventListener('input', function() {
        // allow letters and single spaces only
        this.value = this.value.replace(/[^A-Za-z\s]/g, '') // remove non-letters/non-space
            .replace(/\s{2,}/g, ' '); // replace multiple spaces with single space
    });
</script>