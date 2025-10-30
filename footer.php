<footer class="bg-gray-900">
    <div class="mx-auto w-full max-w-screen-xl px-4 py-6 lg:py-8">
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <div class="md:flex md:justify-between">
            <!-- Logo and Contact Info -->
            <div class="mb-6 md:mb-0">
                <a href="/" class="flex items-center">
                    <img src="./<?= $setting->getSettings('img3') ?>" class="h-12 w-12 me-3" alt="new wing logo" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap text-white"><?= $setting->getSettings('f1') ?></span>
                </a>
                <ul class="text-gray-500 dark:text-gray-400 font-medium mt-6">
                    <!-- email address -->
                    <li class="flex gap-3 mb-3 items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-mail mt-1 flex-shrink-0">
                            <rect width="20" height="16" x="2" y="4" rx="2" />
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                        </svg>
                        <a href="mailto:<?= $setting->getSettings('f5') ?>" class="text-gray-350">
                            <?= $setting->getSettings('f5') ?>
                        </a>
                    </li>

                    <!-- Contact Number -->
                    <li class="flex gap-3 mb-3 items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-phone-call mt-1 flex-shrink-0">
                            <path
                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                            <path d="M14.05 2a9 9 0 0 1 8 7.94" />
                            <path d="M14.05 6A5 5 0 0 1 18 10" />
                        </svg>
                        <a href="tel:<?= $setting->getSettings('f4') ?>" class="text-gray-350">
                            <?= $setting->getSettings('f4') ?>
                        </a>
                    </li>
                    <!-- location -->
                    <li class="flex gap-3 items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-map-pin mt-1 flex-shrink-0">
                            <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($setting->getSettings('f7')) ?>"
                            target="_blank"
                            class="text-gray-350">
                            <?= $setting->getSettings('f7') ?>
                        </a>
                    </li>

                </ul>
            </div>

            <!-- Links Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 sm:gap-6 md:grid-cols-3">
                <div>
                    <h2 class="mb-4 text-sm font-semibold text-white uppercase">Resources</h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium space-y-2">
                        <?php
                        // Fetch labels and URLs from the database
                        $lables = json_encode($nav_lables = str_getcsv($setting->getSettings('f9')));
                        $data = json_decode($lables, true);

                        // Loop through the array in steps of 2 (label and URL pairs)
                        for ($i = 0; $i < count($data); $i += 2) {
                        ?>
                            <li>
                                <a href="<?= $data[$i + 1] ?>" class="text-gray-500 hover:text-gray-100 dark:hover:text-white transition-colors duration-300">
                                    <?= $data[$i] ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <div>
                    <h2 class="mb-4 text-sm font-semibold text-white uppercase">Legal</h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium space-y-2">
                        <li>
                            <a href="privacy_policy" class="text-gray-500 hover:text-gray-100 dark:hover:text-white transition-colors duration-300">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a href="terms_conditions" class="text-gray-500 hover:text-gray-100 dark:hover:text-white transition-colors duration-300">
                                Terms &amp; Conditions
                            </a>
                        </li>
                    </ul>

                </div>

                <div class="sm:col-span-2 md:col-span-1">
                    <h2 class="mb-4 text-sm font-semibold text-white uppercase">Follow Us</h2>
                    <div class="flex space-x-5">
                        <a href="<?= $setting->getSettings('f10') ?>" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                                <path fill-rule="evenodd"
                                    d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Facebook page</span>
                        </a>

                        <a href="<?= $setting->getSettings('f12') ?>" class="text-gray-500 hover:text-gray-600 dark:hover:text-white">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                            </svg>
                            <span class="sr-only">LinkedIn profile</span>
                        </a>

                        <a href="<?= $setting->getSettings('f11') ?>" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 17">
                                <path fill-rule="evenodd"
                                    d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Twitter</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-center sm:text-left">
            <span class="text-gray-500 text-sm">Copyright &copy; <?= date("Y") ?> All rights reserved</span>
            <span class="text-gray-500 text-sm mt-2 sm:mt-0">Develop & Maintain By <a class="text-gray-500 hover:text-gray-100 dark:hover:text-white transition-colors duration-300" href="https://etronicsolutions.com">Etronic Solutions</a></span>
        </div>
    </div>
</footer>
<!-- WhatsApp Button -->
<a href="https://wa.me/<?= $setting->getSettings('f4') ?>" target="_blank"
    id="whatsappButton"
    class="fixed bottom-28 right-5 flex items-center justify-center w-12 h-12 bg-green-500 text-white rounded-full shadow-lg hover:bg-green-600 transition">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
    </svg>
</a>

<!-- Back to Top Button -->
<a href="#" id="backToTop"
    class="hidden fixed bottom-5 right-5 flex items-center justify-center w-12 h-12 bg-blue-500 text-white rounded-full shadow-lg hover:bg-blue-600 transition">
    <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
    </svg>
</a>

<script src="./assets/js/alerts.js"></script>
<script src="./assets/js/main.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/flowbite@1.6.4/dist/flowbite.js"></script>