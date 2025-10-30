<?php include 'header.php'; ?>

<?php
// At the top of your courses file
if (isset($_SESSION['filters']['timestamp']) && 
    time() - $_SESSION['filters']['timestamp'] > 3600) { // 1 hour expiry
    unset($_SESSION['filters']);
}

// When setting filters
$_SESSION['filters'] = [
    'search' => $_POST['search'] ?? null,
    'study_level' => $_POST['study_level'] ?? null,
    'country_id' => $_POST['country_id'] ?? null,
    'subject' => $_POST['subject'] ?? null,
    'timestamp' => time() // Add timestamp
];

// Get filters from session
$filters = $_SESSION['filters'] ?? [];



// Pagination logic
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 12;
$courses_data = $course->getCourses($page, $records_per_page, $filters);



$courses = $courses_data['courses'] ?? [];
$total_pages = $courses_data['total_pages'] ?? 1;

// Fetch all countries for the dropdown
$countries = $country->get_all()['error'] === null ? $country->get_all()['data'] : [];
?>

<div id="content" class="hidden">
    <?php include "nav.php" ?>
    <section class="relative">
        <div class="h-60 md:h-96 bg-cover bg-center" style="background-image: url('assets/img/carasol_image1.jpg');"></div>
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="absolute inset-0 md:flex hidden flex-col items-center justify-center text-center z-50 bg-gradient-to-b from-black/60 via-transparent to-black/80">
                <?php include_once 'search_section.php'; ?>
            </div>
        </div>
</div>
<section>
    <section class="py-16">
        <div class="container mx-auto px-4 lg:px-[52px]">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Top Courses for a Brighter Future</h2>
                <p class="text-gray-600 mb-8">Explore our wide range of courses tailored for your success.</p>
            </div>
                <?php include_once 'course_grid.php'; ?>

            <!-- Pagination -->
            <div class="text-center mt-8">
                <nav aria-label="Page navigation example">
                    <ul class="inline-flex -space-x-px text-base h-10">
                        <li>
                            <a href="?page=<?= max(1, $page - 1) ?>" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">Previous</a>
                        </li>
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li>
                                <a href="?page=<?= $i ?>" class="flex items-center justify-center px-4 h-10 <?= ($i == $page) ? 'text-blue-600 bg-blue-50' : 'text-gray-500 bg-white' ?> border border-gray-300 hover:bg-blue-100 hover:text-blue-700"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li>
                            <a href="?page=<?= min($total_pages, $page + 1) ?>" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
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