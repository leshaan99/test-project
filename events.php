<?php
include 'header.php';

$events = $event->get_all()['error'] === null ? $event->get_all()['data'] : null;
?>

<div id="content" class="hidden">
    <!-- Navbar -->
    <?php include "nav.php" ?>

    <!-- Hero Section -->
    <section class="relative">
        <div class="h-56 md:h-96 bg-cover bg-center" style="background-image: url('assets/img/carasol_image1.jpg')"></div>
        <div class="absolute inset-0 bg-blue-900 bg-opacity-50 flex flex-col items-center justify-center">
            <h2 class="text-3xl font-extrabold mb-2 text-white">Events</h2>
            <h4 class="text-white mb-8 text-lg">Connecting you with knowledge and opportunities.</h4>
        </div>
    </section>
    <?php
    if (isset($events) && !empty($events)) {
    ?>

        <!-- Events Information -->
        <div class="flex justify-center">
            <div class="flex justify-between md:w-3/4">
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 px-6 lg:mx-10 mt-6 md:mt-16">
                    <?php foreach ($events as $key) { ?>
                        <div onclick="navigateToEvent(<?= $key['id'] ?>)" class="relative overflow-hidden rounded-lg shadow-lg group transform transition duration-500 hover:scale-105 cursor-pointer ">
                            <img src="<?= htmlspecialchars($key['img1'] ?? './assets/images/NA Image.jpg') ?>" alt="Event Image" class="object-contain p-4">

                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                <span class="text-white text-lg font-semibold">Explore More</span>
                            </div>

                            <!-- Content Section -->
                            <div class="p-4 bg-white text-center">
                                <h4 class="md:text-base text-[8px] text-gray-800"><?= $key['f1'] ?></h4>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="flex justify-center items-center mt-12">
            <p class="text-gray-500 text-lg">No Data Available</p>
        </div>
    <?php
    }
    ?>


    <!-- Call-to-Action Section -->
    <section class="bg-gray-100 py-12 mt-12">
        <div class="container mx-auto text-center">
            <h2 class="text-2xl font-bold text-gray-800">Interested? Let's Talk!</h2>
            <p class="text-gray-600 mt-2">Reach out to us so that we can help you with the right information.</p>
            <a href="contactus" class="mt-6 inline-block px-6 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">
                Let's Talk
            </a>
        </div>
    </section>
    <!-- footer -->
    <?php include "footer.php" ?>
</div>
</body>

</html>


<script>
    function navigateToEvent(eventId) {
        const encodedEventId = btoa(eventId); // btoa() is used to encode to Base64
        window.location.href = 'event?event_id=' + encodedEventId;
    }
</script>