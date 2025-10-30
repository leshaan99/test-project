<?php
include 'header.php';
include 'nav.php';

// Store the country_id in a variable that can be accessed by the coaching form
$selected_country_id = isset($_POST['country_id']) ? $_POST['country_id'] : null;

if ($selected_country_id) {
    $country_details = $country->get_by_id($selected_country_id)['error'] === null ? $country->get_by_id($selected_country_id)['data'] : null;

    // Fetch courses for this country
    $filters = ['country_id' => $selected_country_id];
    $courses_data = $course->getCourses(1, 12, $filters); // Get first page with 12 items
    $courses = $courses_data['courses'] ?? [];
}
?>
<?php include_once 'coaching_form.php'; ?>

<div id="content" class="hidden">
    <?php if (isset($country_details) && !empty($country_details)) { ?>
        <!-- Main Content -->
        <div class="container mx-auto px-4 py-8">
            <div class="bg-gray-100 p-6 rounded-lg shadow-md">

                <!-- Image Section -->
                <div class="image-container mb-6">
                    <img src="<?= $country_details['img1'] ?>" alt="Destination Image" class="w-full h-64 object-cover">
                </div>

                <!-- Title and Description -->
                <div class="title-description-container mb-8">
                    <h2 class="text-xl md:text-2xl font-bold mb-4"><?= $country_details['f1'] ?></h2>

                    <?= !empty($country_details['f2'])
                        ? convertHtmlToTailwind($country_details['f2'])
                        : 'Please Enter Details'; ?>
                </div>


                <!-- Detailed Overview Section -->
                <div class="bg-gray-100 p-6 rounded-lg shadow-md mb-8">
                    <?= !empty($country_details['f3'])
                        ? convertHtmlToTailwind($country_details['f3'])
                        : 'Please Enter Details'; ?>
                </div>
                <!-- Courses Section Header -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-800">Courses Available in <?= $country_details['f1'] ?></h3>
                </div>
                <?php include_once 'course_grid.php'; ?>

            </div>
        </div>
    <?php }  ?>
</div>
<?php include "footer.php" ?>

</body>

</html>

<script>
    function navigateToCourse(courseId) {
        const encodedCourseId = btoa(courseId); // btoa() is used to encode to Base64
        window.location.href = 'course?course_id=' + encodedCourseId;
    }
</script>