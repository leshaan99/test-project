<?php
// Example of initializing $courses_data
$course = $course->get_all()['error'] === null ? $course->get_all()['data'] : [];
$counter = 0;

?>

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 lg:px-[52px]">
        <!-- Section Heading -->
        <div class="text-center mb-10">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Top Courses for a Brighter Future</h2>
            <p class="text-gray-600 mb-8">Top Courses for a Brighter Future</p>
        </div>

        <div id="courses-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php foreach ($course as $key): ?>
                <?php if ($counter >= 8) break; ?>
                <button onclick="navigateToCourse(<?= $key['id'] ?>)">
                    <div class="course-card group border rounded-lg shadow-sm p-4 bg-white transition-transform duration-300 ease-in-out transform hover:scale-105">
                        <div class="flex items-center mb-4">
                            <!-- University logo -->
                            <?php
                            if (isset($key['university'])) {
                                $id = $key['university'];
                                $university_info = $university->getUniversityCountryIdNameImageById($id);
                                $img = isset($university_info['img']) ? $university_info['img'] : './admin/assets/img/add img.png';
                            } else {
                                echo 'Not Available';
                            }
                            ?>
                            <img src="<?= $img ?>" alt="University Logo" class="w-12 h-12 rounded-full mr-3">
                            <ul class="space-y-1 text-gray-500">
                                <!-- University name -->
                                <li class="text-sm font-semibold flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                                    </svg>
                                    <?php
                                    echo $university_info['error'] === null ? $university_info['name'] : 'Not Found';
                                    ?>
                                </li>
                                <!-- Country name -->
                                <li class="text-sm font-semibold flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                    <?php
                                    if (isset($university_info['country'])) {
                                        $country_id = $university_info['country'];
                                        $country_name = $country->getCountryNameById($country_id);
                                        echo $country_name['error'] === null ? $country_name['name'] : 'Not Found';
                                    } else {
                                        echo 'Not Available';
                                    }
                                    ?>
                                </li>
                            </ul>
                        </div>
                        <ul class="space-y-3 flex-grow">
                            <!-- Course name -->
                            <li class="text-base font-semibold flex items-center text-blue-900 text-left">
                                <?= $key['f2'] ?>
                            </li>
                            <!-- Fee -->
                            <li class="text-lg font-semibold text-left mt-auto">
                                $<?= $key['f5'] ?>
                            </li>
                        </ul>
                    </div>
                </button>
                <?php $counter++; ?>
            <?php endforeach; ?>
        </div>

        <!-- Show More / Hide Button -->
        <div class="text-center mt-8">
            <a href="courses" class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 transition">
                Show More
            </a>
        </div>
    </div>
</section>

<script>
    function navigateToCourse(courseId) {
        const encodedCourseId = btoa(courseId); // btoa() is used to encode to Base64
        window.location.href = 'course?course_id=' + encodedCourseId;
    }
</script>