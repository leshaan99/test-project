<?php
include 'header.php';
include "nav.php";

$blogs = $blog->get_all()['error'] === null ? $blog->get_all()['data'] : [];
?>
<div id="content" class="hidden">
    <!-- Hero Section -->
    <section class="relative">
        <div class="h-56 md:h-96 bg-cover bg-center" style="background-image: url('assets/img/carasol_image1.jpg');"></div>
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <h1 class="text-4xl font-bold text-white">Blogs</h1>
        </div>
    </section>

    <!-- Blogs Section -->
    <section class="py-12">
        <div class="flex justify-center">
            <div class="container mx-auto text-center">
                <h1 class="text-3xl font-bold text-gray-800">Read Our Latest Blogs Change 3</h1>
                <p class="text-gray-600 mt-2">Our blogs will help you with everything you want to know about studying abroad</p>

                <?php if (!empty($blogs)) { ?>
                    <div class="mt-6 md:mt-16">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 px-6 lg:px-10">
                            <?php foreach ($blogs as $key) { ?>
                                <div onclick="navigateToBlog('<?= $key['id'] ?>')" class="rounded-lg shadow-lg overflow-hidden bg-white transform transition duration-500 hover:scale-105 cursor-pointer">
                                    <!-- Image -->
                                    <div class="w-full h-40 md:h-48 overflow-hidden flex items-center justify-center bg-gray-100">
                                        <img src="<?= htmlspecialchars($key['img1'] ?? './assets/images/NA Image.jpg') ?>" alt="Blog" class="w-full h-full object-cover">
                                    </div>
                                    <!-- Content -->
                                    <div class="p-4 text-center">
                                        <h4 class="md:text-base text-[10px] text-gray-800"><?= htmlspecialchars($key['f1']) ?></h4>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="mt-12">
                        <p class="text-gray-500 text-lg">No Data Available</p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>


    <!-- Call-to-Action Section -->
    <section class="bg-gray-100 py-12">
        <div class="container mx-auto text-center">
            <h2 class="text-2xl font-bold text-gray-800">Interested? Let's Talk!</h2>
            <p class="text-gray-600 mt-2">Reach out to us so that we can help you with the right information.</p>
            <a href="contactus" class="mt-6 inline-block px-6 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">
                Let's Talk
            </a>
        </div>
    </section>
    <?php include_once './footer.php'; ?>
</div>

</body>

</html>

<script>
    function navigateToBlog(blogId) {
        const encodedBlogId = btoa(blogId); // btoa() is used to encode to Base64
        window.location.href = 'blog?blog_id=' + encodedBlogId;
    }
</script>