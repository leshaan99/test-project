<?php
include_once 'header.php';
include_once 'nav.php';

if (isset($_GET['blog_id'])) {
    $encoded_blog_id = $_GET['blog_id'];
    $id = base64_decode($encoded_blog_id);
}
$row = ($id > 0) ? $blog->get_by_id($id)['data'] : null;
$recentBlogs = $blog->get_all()['data'];
?>

<div id="content" class="hidden">
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap -mx-4">
                
                <!-- Blog Detail -->
                <div id="primary" class="w-full md:w-2/3 px-4">
                    <main id="main" class="space-y-8">
                        <!-- Blog Header -->
                        <div class="space-y-2">
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">
                                <?= htmlspecialchars($row['f1'] ?? 'Title Not Available') ?>
                            </h1>
                            <div class="text-sm text-gray-500">
                                <span><?= htmlspecialchars(printDate($row['created_date'])) ?></span>
                            </div>
                        </div>

                        <!-- Blog Image -->
                        <div class="w-full h-72 md:h-[28rem] overflow-hidden rounded-xl bg-gray-100 flex items-center justify-center shadow-lg group">
                            <img src="<?= htmlspecialchars($row['img1'] ?? './assets/images/NA Image.jpg') ?>"
                                alt="Image"
                                class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-105">
                        </div>

                        <!-- Blog Content -->
                        <article class="prose prose-lg max-w-none text-gray-700">
                            <?= !empty($row['f2']) ? convertHtmlToTailwind($row['f2']) : 'Content Not Available'; ?>
                        </article>
                    </main>
                </div>

                <!-- Recent Blogs -->
                <div id="secondary" class="w-full md:w-1/3 px-4 mt-12 md:mt-0">
                    <aside class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-900 border-b pb-2">Recent Blogs</h3>
                        <div class="space-y-4">
                            <?php if (!empty($recentBlogs)): ?>
                                <?php foreach ($recentBlogs as $blogs): ?>
                                    <div onclick="navigateToBlog('<?= $blogs['id'] ?>')"
                                        class="flex items-center space-x-4 bg-white  group transform transition duration-500  cursor-pointer">
                                        
                                        <!-- Thumbnail -->
                                        <div class="flex-shrink-0 w-24 h-16 overflow-hidden rounded-md bg-gray-100">
                                            <img src="<?= htmlspecialchars($blogs['img1'] ?? './assets/images/NA Image.jpg') ?>"
                                                 alt="<?= htmlspecialchars($blogs['f1']) ?>"
                                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        </div>

                                        <!-- Details -->
                                        <div class="flex-1">
                                            <h4 class="text-sm font-medium text-gray-900 line-clamp-2">
                                                <?= htmlspecialchars($blogs['f1'] ?? 'Title Not Available') ?>
                                            </h4>
                                            <small class="text-gray-500">
                                                <?= htmlspecialchars(printDate($blogs['created_date']) ?? 'Not Found') ?>
                                            </small>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-gray-500">No recent blogs available.</p>
                            <?php endif; ?>
                        </div>
                    </aside>
                </div>

            </div>
        </div>
    </section>

    <?php include_once 'footer.php'; ?>
</div>

<script>
    function navigateToBlog(blogId) {
        const encodedBlogId = btoa(blogId); // Encode to Base64
        window.location.href = 'blog?blog_id=' + encodedBlogId;
    }
</script>
