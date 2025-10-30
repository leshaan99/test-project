<!-- Coaching Form Modal -->
<div id="coaching-modal" class="fixed left-2 top-20 z-50 mr-4">
    <div class="bg-white rounded-lg shadow-xl w-80 max-h-[90vh] overflow-y-auto border border-gray-200">
        <div class="flex justify-between items-center p-3 border-b">
            <h3 class="text-lg font-semibold">Register With Us</h3>
            <span class="cursor-pointer" onclick="closeCoachingModal()">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </span>
        </div>
        <div class="p-4">
            <h3 class="text-sm font-bold mb-4">World-class coaching services</h3>
            <form id="coach">
                <div id="responseMessage" class="mb-3 text-center text-sm"></div>
                <div class="mb-3">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-1">I am</label>
                    <input type="text" id="name" name="name" class="w-full border border-gray-300 p-2 rounded text-sm" placeholder="Name" required>
                </div>
                <div class="mb-3">
                    <label for="course" class="block text-gray-700 text-sm font-bold mb-1">Course</label>
                    <select id="course" name="course" class="w-full border border-gray-300 p-2 rounded text-sm" required>
                        <option value="">Select Course</option>
                        <?php
                        $courseList = $course->get_all()['error'] === null ? $course->get_all()['data'] : [];
                        foreach ($courseList as $courseItem) {
                            echo '<option value="' . htmlspecialchars($courseItem['id']) . '">'
                                . htmlspecialchars($courseItem['f2']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="country" class="block text-gray-700 text-sm font-bold mb-1">Country</label>
                    <select id="country" name="country" class="w-full border border-gray-300 p-2 rounded text-sm" required>
                        <option value="">Select Country</option>
                        <?php
                        $countries = $country->get_all()['error'] === null ? $country->get_all()['data'] : [];
                        foreach ($countries as $countryItem) {
                            $selected = (isset($selected_country_id) && $selected_country_id == $countryItem['id']) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($countryItem['id']) . '" ' . $selected . '>'
                                . htmlspecialchars($countryItem['f1']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-1">Contact me at</label>
                    <div class="flex space-x-2">
                        <select id="country_code" name="country_code" class="border border-gray-300 p-2 rounded text-sm w-20" required>
                            <?php foreach ($countryCodes as $cId): ?>
                                <option value="<?= htmlspecialchars($cId['code']) ?>">
                                    <?= htmlspecialchars($cId['flag']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="tel" id="phone" name="phone" class="flex-grow border border-gray-300 p-2 rounded text-sm" placeholder="Phone" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="inline-flex items-center text-sm">
                        <input type="checkbox" name="whatsapp" class="mr-2">
                        Use as Whatsapp
                    </label>
                </div>
                <div class="mb-3">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-1">Email</label>
                    <input type="email" id="email" name="email" class="w-full border border-gray-300 p-2 rounded text-sm" placeholder="Email" required>
                </div>
                <div class="mb-4">
                    <label class="inline-flex items-center text-sm">
                        <input type="checkbox" name="terms" class="mr-2" required>
                        Accept <a href="#" class="text-blue-600 ml-1"> Terms & Conditions </a>
                    </label>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Minimized Icon (Hidden after success) -->
<div id="minimized-icon" class="hidden fixed left-2 bottom-28 z-50 p-2 bg-blue-600 text-white rounded-full cursor-pointer shadow-lg hover:bg-blue-700 transition-colors" onclick="openCoachingModal()">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-plus">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
        <path d="M13.5 6.5l4 4" />
        <path d="M16 19h6" />
        <path d="M19 16v6" />
    </svg>
</div>

<!-- Success Message -->
<div id="success-message" class="hidden fixed left-2 top-20 z-50 mr-4">
    <div class="bg-white rounded-lg shadow-xl w-80 p-4 border border-gray-200">
        <div class="text-center">
            <svg class="mx-auto h-12 w-12 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <h3 class="text-lg font-semibold text-gray-900 mt-2">Thank You!</h3>
            <div class="mt-2 text-sm text-gray-500">
                <p>Your submission has been received successfully.</p>
                <p>We'll contact you.</p>
            </div>
            <div class="mt-4">
                <button type="button" onclick="closeSuccessMessage()" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-blue-900 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-open form on page load
        openCoachingModal();

        // Set country if available
        if (typeof selectedCountryId !== 'undefined' && selectedCountryId !== null) {
            document.getElementById('country').value = selectedCountryId;
        }

        // Modal interactions
        const modal = document.getElementById('coaching-modal');
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeCoachingModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeCoachingModal();
            }
        });

        // Form submission
        document.getElementById('coach').addEventListener('submit', function(event) {
            event.preventDefault();
            const responseMessage = document.getElementById('responseMessage');
            responseMessage.textContent = '';

            if (!this.checkValidity()) {
                responseMessage.textContent = 'Please fill all required fields.';
                responseMessage.style.color = 'red';
                return;
            }

            fetch('./data/register_coach.php', {
                    method: 'POST',
                    body: new FormData(this)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showSuccessMessage();
                        this.reset();
                    } else {
                        responseMessage.textContent = data.message || 'An error occurred.';
                        responseMessage.style.color = 'red';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    responseMessage.textContent = 'An error occurred. Please try again.';
                    responseMessage.style.color = 'red';
                });
        });
    });

    function openCoachingModal() {
        document.getElementById('coaching-modal').classList.remove('hidden');
        document.getElementById('minimized-icon').classList.add('hidden');
        document.getElementById('success-message').classList.add('hidden');
    }

    function closeCoachingModal() {
        document.getElementById('coaching-modal').classList.add('hidden');
        document.getElementById('minimized-icon').classList.remove('hidden');
    }

    function showSuccessMessage() {
        document.getElementById('coaching-modal').classList.add('hidden');
        document.getElementById('minimized-icon').remove();
        document.getElementById('success-message').classList.remove('hidden');
    }

    function closeSuccessMessage() {
        document.getElementById('success-message').classList.add('hidden');
    }
</script>

<style>
    .fade-in {
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>