<?php
$faq_data = $faq->get_all()['error'] === null ? $faq->get_all()['data'] : [];
?>
<section class="container mx-auto px-4 py-8">
    <div class="p-4 bg-white rounded-lg" id="faq" role="tabpanel" aria-labelledby="faq-tab">
        <div id="accordion-flush">
            <?php
            if (empty($faq_data)) {
                echo '<p class="text-center text-gray-500">No FAQ Available.</p>';
            } else {
                foreach ($faq_data as $index => $item) {
                    $headingId = "accordion-flush-heading-$index";
                    $bodyId = "accordion-flush-body-$index";
            ?>
                    <h2 id="<?= $headingId ?>">
                        <button
                            type="button" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200" data-accordion-target="#<?= $bodyId ?>" aria-expanded="false" aria-controls="<?= $bodyId ?>">
                            <span><?= htmlspecialchars($item['f1'] ?? 'Not Available') ?></span>
                            <svg data-accordion-icon class="w-3 h-3 shrink-0 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l4 4 4-4" />
                            </svg>
                        </button>
                    </h2>
                    <div id="<?= $bodyId ?>" class="hidden" aria-labelledby="<?= $headingId ?>">
                        <div class="py-5 border-b border-gray-200">
                            <p class="mb-2 text-gray-500"><?= $item['f2'] ?? 'Not available' ?></p>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>

<script>
    document.querySelectorAll('[data-accordion-target]').forEach((btn) => {
        btn.addEventListener('click', function() {
            const targetId = this.getAttribute('data-accordion-target');
            const content = document.querySelector(targetId);
            const expanded = this.getAttribute('aria-expanded') === 'true';
            const icon = this.querySelector('[data-accordion-icon]');

            // Close all accordions
            document.querySelectorAll('#accordion-flush > div').forEach((div) => div.classList.add('hidden'));
            document.querySelectorAll('[aria-expanded]').forEach((btn) => btn.setAttribute('aria-expanded', 'false'));
            document.querySelectorAll('[data-accordion-icon]').forEach((icon) => icon.classList.remove('rotate-180'));

            if (!expanded) {
                // Open the current accordion
                content.classList.remove('hidden');
                this.setAttribute('aria-expanded', 'true');
                icon.classList.add('rotate-180');
            }
        });
    });
</script>