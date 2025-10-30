<?php
include 'header.php';
include "nav.php";

$policiesData = $policies->get_by_id(2)['error'] === null ? $policies->get_by_id(2)['data'] : null;
?>


<!-- Content -->
<section class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <?php
        if (isset($policiesData['f1']) && !empty($policiesData['f1'])) {
        ?>

            <span><?= convertHtmlToTailwind($policiesData['f1']) ?: 'NOT AVAILABLE' ?></span>

        <?php
        } else {
        ?>
            <div class="text-center">
                <p class="text-gray-500 text-lg">No Data Available</p>
            </div>
        <?php
        }
        ?>

    </div>
</section>

<?php include_once 'footer.php'; ?>