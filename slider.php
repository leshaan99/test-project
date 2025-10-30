<?php
$sliders = $slide->get_all()['error'] === null ? $slide->get_all()['data'] : null;
?>

<section class="relative">
    <div id="default-carousel" class="relative w-full" data-carousel="slide">

        <!-- Gradient Overlay with Search Section -->
        <div class="absolute inset-0 md:flex hidden flex-col items-center justify-center text-center z-50 bg-gradient-to-b from-black/60 via-transparent to-black/80">
            <?php include "search_section.php" ?>

        </div>
        <?php
        if (isset($sliders) && !empty($sliders)) {
        ?>
            <div class="relative h-56 md:h-[40rem] overflow-hidden rounded-lg">
                <?php foreach ($sliders as $key) { ?>

                    <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                        <img src="<?= $key['img1'] ?>"
                            class="absolute w-full h-full object-cover brightness-90 hover:brightness-100 transition-all duration-700"
                            alt="<?= $key['f1'] ?>">
                    </div>

                <?php } ?>
            </div>

        <?php
        } else {
        ?>
            <div class="mt-12">
                <p class="text-gray-500 text-lg">No Data Available</p>
            </div>
        <?php
        }
        ?>



        <!-- Slider Indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse hidden md:block lg:block">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
        </div>

        <!-- Left Control Button -->
        <button type="button" class="absolute top-0 left-0 z-[30] flex items-center justify-center h-full px-4 cursor-pointer hidden md:block lg:block" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 shadow-md hover:scale-110 transition-transform">
                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                </svg>
            </span>
        </button>

        <!-- Right Control Button -->
        <button type="button" class="absolute top-0 right-0 z-[30] flex items-center justify-center h-full px-4 cursor-pointer hidden md:block lg:block" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-r from-indigo-600 to-blue-500 shadow-md hover:scale-110 transition-transform">
                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                </svg>
            </span>
        </button>


    </div>
</section>