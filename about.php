<?php include 'header.php';
$about_data = $about->get_all()['error'] === null ? $about->get_all()['data'] : null;
?>



<div id="content" class="hidden">

    <?php include "nav.php" ?>

    <!-- Hero Section -->
    <section class="relative">
        <div class="h-56 md:h-96 bg-cover bg-center" style="background-image: url('assets/img/carasol_image1.jpg');"></div>
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <h1 class="text-4xl font-bold text-white">About Us</h1>
        </div>
    </section>
    <div class="container mx-auto px-4 py-8">
        <?php
        if (empty($about_data)) {
            echo '<p class="text-center text-gray-500 col-span-full">No Data Available</p>';
        } else { ?>
            <?php foreach ($about_data as $key) { ?>
                <section class="container-fluid mx-auto px-20 py-10">
                    <!-- First Section -->
                    <div class="flex flex-col md:flex-row items-center gap-8 mb-12">
                        <img src="<?= $key['img1'] ?>" alt="Campus Direct Office" class="w-full md:w-1/3 rounded-lg shadow-lg">
                        <div class="md:w-2/3">
                            <h2 class="text-2xl md:text-3xl font-bold mb-4"><?= $key['f7'] ?></h2>
                            <?= !empty($key['f1'])? convertHtmlToTailwind($key['f1']): 'Please Enter Details'; ?>
                        </div>
                    </div>

                    <!-- Second Section -->
                    <div class="flex flex-col md:flex-row-reverse items-center gap-8 mb-12">
                        <img src="<?= $key['img2'] ?>" alt="Counseling Services" class="w-full md:w-1/3 rounded-lg shadow-lg">
                        <div class="md:w-2/3">
                            <h2 class="text-2xl md:text-3xl font-bold mb-4"><?= $key['f8'] ?></h2>
                            <?= !empty($key['f2'])? convertHtmlToTailwind($key['f2']): 'Please Enter Details'; ?>
                        </div>
                    </div>

                    <!-- Third Section -->
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        <img src="<?= $key['img3'] ?>" alt="Accreditation and Certifications" class="w-full md:w-1/3 rounded-lg shadow-lg">
                        <div class="md:w-2/3">
                            <h2 class="text-2xl md:text-3xl font-bold mb-4"><?= $key['f9'] ?></h2>
                            <?= !empty($key['f3'])? convertHtmlToTailwind($key['f3']): 'Please Enter Details'; ?>
                        </div>
                    </div>
                </section>


                <section class="py-12 px-6 bg-gray-100">
                    <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Mission Card -->
                        <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mb-4 text-black-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                <path d="M12 7a5 5 0 1 0 5 5" />
                                <path d="M13 3.055a9 9 0 1 0 7.941 7.945" />
                                <path d="M15 6v3h3l3 -3h-3v-3z" />
                                <path d="M15 9l-3 3" />
                            </svg>
                            <h3 class="text-lg font-bold">Our Mission</h3>
                            <p class="text-gray-600 mt-2">
                                <?= $key['f4'] ?>
                            </p>
                        </div>

                        <!-- Vision Card -->
                        <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-start">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mb-4 text-black-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" />
                                <path d="M9 16a5 5 0 1 1 6 0a3.5 3.5 0 0 0 -1 3a2 2 0 0 1 -4 0a3.5 3.5 0 0 0 -1 -3" />
                                <path d="M9.7 17l4.6 0" />
                            </svg>

                            <h3 class="text-lg font-bold">Our Vision</h3>
                            <p class="text-gray-600 mt-2">
                                <?= $key['f5'] ?>
                            </p>
                        </div>

                        <!-- Join Our Community Card -->
                        <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mb-4 text-black-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                                <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                            </svg>
                            <h3 class="text-lg font-bold">Join Our Community</h3>
                            <p class="text-gray-600 mt-2">
                                <?= $key['f6'] ?>
                            </p>
                        </div>
                    </div>
                </section>
            <?php } ?>
        <?php } ?>
    </div>
</div>

<?php include "footer.php" ?>


</div>
</body>

</html>