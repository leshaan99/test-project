<?php include 'header.php'; ?>
<?php include "nav.php" ?>
<?php

$branch = $branch->get_all()['error'] === null ? $branch->get_all()['data'] : null;

if (isset($_SESSION['message_type'])) {
    if ($_SESSION['message_type'] === 'success') {
        echo '<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                Your message was successfully sent. We will get back to you soon!
              </div>';
    } elseif ($_SESSION['message_type'] === 'error') {
        echo '<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                There was an error processing your request. Please try again later.
              </div>';
    }
    // Clear the message from the session
    unset($_SESSION['message_type']);
}

?>


<!-- Hero Section -->
<section class="relative">
    <div class="h-56 md:h-96 bg-cover bg-center" style="background-image: url('assets/img/carasol_image1.jpg');"></div>
    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <h1 class="text-4xl font-bold text-white">Contact Us</h1>
    </div>
</section>
<!-- Contact Information -->
<section class="py-8 px-3 md:px-16 flex justify-center pb-12">
    <div class="w-full md:w-3/4">
        <!-- Contact Details -->
        <div class="bg-white p-2 md:p-8 shadow-lg rounded-xl">
            <h2 class="text-xl md:text-2xl font-semibold text-start">Contact Information</h2>
            <p class="mb-6 text-gray-600 text-start">Feel free to reach us through any of the methods below.</p>
            <div class="space-y-4 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                <!-- Email -->
                <div class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-mail text-blue-500 w-6 h-6 mr-4">
                        <rect width="20" height="16" x="2" y="4" rx="2" />
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                    </svg>
                    <a href="mailto:<?= $setting->getSettings('f5') ?>" class="text-gray-800 hover:text-blue-600">
                        <?= $setting->getSettings('f5') ?>
                    </a>
                </div>
                <!-- Mobile Number -->
                <div class="flex items-start mt-4 sm:mt-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-phone-call text-green-500 w-6 h-6 mr-4">
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                        <path d="M14.05 2a9 9 0 0 1 8 7.94" />
                        <path d="M14.05 6A5 5 0 0 1 18 10" />
                    </svg>
                    <a href="tel:<?= preg_replace('/[^0-9+]/', '', $setting->getSettings('f4')) ?>" class="text-gray-800 hover:text-green-600">
                        <?= $setting->getSettings('f4') ?>
                    </a>
                </div>
                <!-- Location -->
                <div class="flex items-start mt-4 sm:mt-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-map-pin text-red-500 w-6 h-6 mr-4">
                        <path
                            d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($setting->getSettings('f7')) ?>"
                        target="_blank"
                        class="text-gray-800 hover:text-red-600">
                        <?= $setting->getSettings('f7') ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- our branches section -->
<section class="py-8 flex flex-col justify-center items-center px-4">
    <h2 class="text-xl md:text-2xl font-bold text-end">Contact Our Branches</h2>
    <p class="mb-6 text-gray-600 text-start">Feel free to reach us through our below branches.</p>

    <?php if (isset($branch) && !empty($branch)) { ?>
        <div class="flex flex-wrap justify-center gap-6 w-full lg:w-3/4 lg:mx-10">
            <?php foreach ($branch as $key) { ?>
                <div class="relative rounded-lg shadow-lg group transform transition duration-500 hover:scale-105 cursor-pointer w-64" id="branch_<?= $key['id'] ?>">
                    <img src="<?= $key['img1'] ?>" class="w-full h-48 object-cover rounded-t-xl" alt="<?= $key['f1'] ?>">

                    <div class="p-4 bg-white text-center rounded-b-xl">
                        <h3 class="text-lg font-bold text-gray-800"><?= $key['f1'] ?></h3>
                    </div>

                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 rounded-xl">
                        <span class="text-white text-base font-semibold text-center">
                            <ul>
                                <li><?= $key['f5'] ?></li>
                                <li><?= $key['f4'] ?></li>
                            </ul>
                        </span>
                    </div>

                    <!-- Popup Form -->
                    <div class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 popup-form" id="popup_<?= $key['id'] ?>">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                            <!-- Close Button -->
                            <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 close-popup" id="close_<?= $key['id'] ?>">✖</button>
                            <h3 class="text-lg font-bold mb-4">Contact <?= $key['f1'] ?></h3>
                            <form id="branchForm" action="./data/branch_form_handler.php" method="POST">
                                <input type="hidden" name="branch_id" value="<?= $key['id'] ?>">

                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700">Your Name</label>
                                    <input
                                        type="text"
                                        name="name"
                                        required
                                        maxlength="50"
                                        pattern="[A-Za-z\s]{2,50}"
                                        title="Name must be 2-50 letters only"
                                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                                </div>

                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700">Your Email</label>
                                    <input
                                        type="email"
                                        name="email"
                                        required
                                        pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                                        title="Enter a valid email address"
                                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                                </div>

                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700">Message</label>
                                    <textarea
                                        name="message"
                                        required
                                        rows="3"
                                        maxlength="500"
                                        placeholder="Enter your message (max 500 characters)"
                                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md"></textarea>
                                </div>

                                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    <?php } else { ?>
        <div class="mt-12">
            <p class="text-gray-500 text-lg">No Data Available</p>
        </div>
    <?php } ?>
</section>




<?php include "contactus_form.php" ?>
<?php include "footer.php" ?>


</body>

</html>

<!-- Add JavaScript to handle popup functionality -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Select all branch cards and their corresponding popups
        const branches = document.querySelectorAll(".group");

        branches.forEach(function(branch) {
            // Add click event to each branch
            branch.addEventListener("click", function() {
                const branchId = branch.id.split("_")[1];
                const popup = document.querySelector(`#popup_${branchId}`);
                popup.classList.remove("hidden");
            });
        });

        // Close popup when close button is clicked
        const closeButtons = document.querySelectorAll(".close-popup");
        closeButtons.forEach(function(button) {
            button.addEventListener("click", function(event) {
                event.stopPropagation(); // This stops the event from bubbling up
                event.preventDefault();
                const branchId = button.id.split("_")[1];
                const popup = document.querySelector(`#popup_${branchId}`);
                popup.classList.add("hidden");
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // All branch name inputs
        const nameInputs = document.querySelectorAll('input[name="name"]');
        nameInputs.forEach(function(input) {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^A-Za-z\s]/g, ''); // letters and spaces only
            });
        });

        // All message textareas
        const messageInputs = document.querySelectorAll('textarea[name="message"]');
        messageInputs.forEach(function(textarea) {
            textarea.addEventListener('input', function() {
                const maxLen = 500;
                if (this.value.length > maxLen) {
                    this.value = this.value.substring(0, maxLen);
                }
            });
        });
    });
</script>