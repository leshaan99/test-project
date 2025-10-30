<?php
include 'header.php';
include 'nav.php';


if (isset($_GET['course_id'])) {
    $encoded_course_id = $_GET['course_id'];
    $course_id = base64_decode($encoded_course_id);     // Base64 decode the course_id
    $course_data = $course->getCourseById($course_id);
} else {
    echo 'Course ID is missing.';
}


?>


<div class="container mx-auto py-8 px-4">
    <div class="md:col-span-2 bg-white p-6 rounded-lg shadow">
        <div class="bg-blue-50 border border-gray-200 rounded-lg p-6 shadow-sm  justify-around">

            <h2 class="text-4xl text-center font-semibold text-blue-900">
                <?= isset($course_data['data']['f2']) ? htmlspecialchars($course_data['data']['f2']) : 'Not Available' ?> </h2>
            </h2>

            <!-- Flex container for university logo and info, aligned to the right -->
            <div class="flex items-center space-x-6 justify-end">
                <!-- University Logo -->
                <div class="w-12 h-12 flex items-center justify-center border border-blue-200 rounded-full">
                    <?php
                    if (isset($course_data['data']['university'])) {
                        $id = $course_data['data']['university'];
                        $university_info = $university->getUniversityCountryIdNameImageById($id);
                        $img = isset($university_info['img']) ? $university_info['img'] : './assets/images/NA Image.jpg';
                    } else {
                        echo 'Value Not Passed';
                    }
                    ?>
                    <img src="<?= $img ?>" alt="University Logo" class="w-full h-full object-contain  rounded-full">
                </div>

                <!-- University Name and Country -->
                <div class="flex flex-col justify-center">
                    <p class="text-gray-700 font-light text-sm flex ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2l2 7h-4l2-7z"></path>
                            <path d="M4 14h16"></path>
                            <path d="M6 10h12"></path>
                        </svg>
                        <?php
                        if (isset($course_data['data']['university'])) {
                            $id = $course_data['data']['university'];
                            $university_info = $university->getUniversityCountryIdNameImageById($id);
                            echo $university_info['error'] === null ? $university_info['name'] : 'Not Found';
                        } else {
                            echo 'Value Not Passed';
                        }
                        ?>
                    </p>
                    <p class="text-gray-700 font-light text-sm flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 6-9 13-9 13s-9-7-9-13a9 9 0 1 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <?php
                        if (isset($university_info['country'])) {
                            $id = $university_info['country'];
                            $country_name = $country->getCountryNameById($id);
                            echo $country_name['error'] === null ? $country_name['name'] : 'Not Found';
                        } else {
                            echo 'Value Not Passed';
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <!-- Course Overview Section -->
        <section class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-5">
            <div class="md:col-span-10 bg-gray-50 p-4 rounded-lg">
                <h3 class="text-2xl font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-4">
                    Overview of the Course
                </h3>
                <p class="text-gray-700 text-justify leading-relaxed">
                    <?= !empty($course_data['data']['f3']) ? convertHtmlToTailwind($course_data['data']['f3']) : 'Content Not Available'; ?>
                </p>
            </div>

            <div class="md:col-span-2 p-4 rounded-lg space-y-4 h-[23.1rem]">
                <div class="flex flex-col items-center space-y-4">
                    <!-- Apply Button -->
                    <div class="w-full">
                        <a href="javascript:void(0)" onclick="apply_course(<?= $course_id ?>, <?= isset($_SESSION['u_id']) ? $_SESSION['u_id'] : 'null' ?>)"
                            class="block bg-blue-600 text-white text-lg font-semibold py-3 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 focus:outline-none transition duration-200 ease-in-out text-center">
                            Apply Now
                        </a>
                    </div>
                    <!-- Course Details Section -->
                    <section class="w-full max-w-md relative">
                        <ul class="space-y-4">
                            <li class="flex-1 bg-blue-50 p-4 shadow-lg rounded-lg text-center">
                                <strong class="text-blue-900 block">Fee</strong>
                                <span class="ml-2 block">
                                    $<?= isset($course_data['data']['f5']) ? htmlspecialchars($course_data['data']['f5']) : 'Not Available' ?>
                                </span>
                            </li>

                            <li class="flex-1 bg-blue-50 p-4 shadow-lg rounded-lg text-center">
                                <strong class="text-blue-900 block">Start Date</strong>
                                <span class="ml-2 block">
                                    <?= isset($course_data['data']['f6']) ? htmlspecialchars($course_data['data']['f6']) : 'Not Available' ?>
                                </span>
                            </li>

                            <li class="flex-1 bg-blue-50 p-4 shadow-lg rounded-lg text-center">
                                <strong class="text-blue-900 block">Venue</strong>
                                <span class="ml-2 block">
                                <?= isset($university_info['location']) ? htmlspecialchars($university_info['location'] ) : 'Not Available' ?>

                                </span>
                            </li>
                    </section>
                </div>

            </div>
            <!-- Entry Requirements Section -->
            <div class="md:col-span-10 bg-gray-50 p-4 rounded-lg text-center">
                <div class='col-span-10'>
                    <h3 class="text-xl font-semibold mt-6 mb-4">Entry Requirements</h3>
                    <p class="text-gray-700 text-justify leading-relaxed">
                        <?= !empty($course_data['data']['f1']) ? convertHtmlToTailwind($course_data['data']['f1']) : 'Content Not Available'; ?>
                    </p>
                </div>
            </div>

            <div class="md:col-span-12 rounded-lg flex justify-end pr-4 mt-0">
                <button onclick="shareCourse(<?= $course_id ?>)"
                    class="p-3 bg-gray-200 rounded-full hover:bg-gray-300 transition duration-200 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-share">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M18 6m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M8.7 10.7l6.6 -3.4" />
                        <path d="M8.7 13.3l6.6 3.4" />
                    </svg>
                </button>
            </div>

        </section>
    </div>
</div>
</div>

<?php include 'footer.php'; ?>

<script>
    function apply_course(course_id, user_id) {
        // Make AJAX request to apply for the course

        if (user_id == null)
            loadLoginRegisterModal();
        else {



            $.ajax({
                url: 'data/apply_course.php',
                type: 'POST',
                data: {
                    course: course_id,
                    user: user_id
                },
                success(response) {
                    try {
                        const res = JSON.parse(response);
                        if (res.success === 1) {
                            update_message('Application applied successfully!');
                        } else {
                            error_message('Failed to applied application. Already Applied!');
                        }
                    } catch (error) {
                        console.error('Error parsing response:', error, response);
                        alert(error);
                    }
                },
                error() {
                    alert('error', 'Failed to contact the server. Please try again later.');
                },
            });




        }


    }

    function loadLoginRegisterModal() {
        $.ajax({
            url: 'login_register.php',
            type: 'GET',
            success(response) {
                document.body.insertAdjacentHTML('beforeend', response);

                openLoginRegisterModal();
            },
            error() {
                alert('Error loading the login/register modal. Please try again.');
            }
        });
    }

    function openLoginRegisterModal() {
        const modal = document.getElementById('authentication-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeLoginRegisterModal() {
        const modal = document.getElementById('authentication-modal');
        modal.classList.add('hidden');
    }
</script>
</body>

</html>

<script>
    function shareCourse(courseId) {
        const courseURL = `${window.location.href}?course_id=${courseId}`; // Append course ID to the URL

        if (navigator.share) {
            navigator.share({
                    text: "Check out this course!",
                    url: courseURL
                }).then(() => console.log('Shared successfully'))
                .catch((error) => console.log('Error sharing:', error));
        } else {
            navigator.clipboard.writeText(courseURL).then(() => {
                alert("Course link copied to clipboard!");
            }).catch(() => {
                alert("Failed to copy link.");
            });
        }
    }
</script>