<?php
// Example of initializing $courses_data
$universities = $university->get_all()['error'] === null ? $university->get_all()['data'] : [];

?>
<div class="bg-gray-50 flex items-center justify-center py-16">
    <div class="text-center">
        <!-- Section Heading -->
        <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Our Global University Network</h2>
        <p class="text-gray-600 mb-8">Your Gateway to World-Class Education.</p>
        <?php
        if (empty($universities)) {
            echo '<p class="text-center text-gray-500 col-span-full">No Universities Available.</p>';
        } else { ?>
            <div id="image-slider" class="splide w-full max-w-7xl">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php foreach ($universities as $key) { ?>
                            <li class="splide__slide">
                                <img src="<?= $key['img1'] ?>" class="w-32 h-32 rounded-full">
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<style>
    .splide__pagination {
        position: absolute;
        bottom: -50px;
        /* Moves dots down */
        left: 45%;
        transform: translateX(-50%);
    }
</style>

<script>
    //   university partner slider

    document.addEventListener('DOMContentLoaded', function() {
        new Splide('#image-slider', {
            type: 'loop', // Infinite loop
            perPage: 5, // Show 1 slide at a time
            perMove: 1, // Move 1 slide at a time
            autoplay: true, // Enable autoplay
            interval: 3000, // Slide every 3 seconds
            pauseOnHover: false, // Keep sliding on hover
            pauseOnFocus: false, // Keep sliding on focus
            speed: 800, // Transition speed (800ms)
            arrows: false, // Show navigation arrows
            pagination: true, // Show navigation dots

            // Responsive settings
            breakpoints: {
                1024: { // Screens smaller than 1024px (Tablets)
                    perPage: 5,
                    gap: '10px',
                },
                768: { // Screens smaller than 768px (Mobile)
                    perPage: 3,
                    gap: '10px',
                    arrows: false, // Hide arrows on mobile
                },
            }
        }).mount();
    });
</script>