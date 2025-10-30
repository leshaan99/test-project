<?php
$countries = $country->get_all()['error'] === null ? $country->get_all()['data'] : null;
$counter = 0;
?>

<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-4 lg:px-[52px]">
        <!-- Section Heading -->
        <div class="text-center mb-10">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Choose Your Path to Success</h2>
            <p class="text-gray-600 mb-8">Explore a Variety of Pathways Tailored to Your Ambitions.</p>
        </div>

        <?php
        if (isset($countries) && !empty($countries)) {
        ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach ($countries as $key): ?>
                    <?php if ($counter >= 8) break; ?>

                    <div class="relative group rounded-lg overflow-hidden shadow-md bg-white">
                        <a href="javascript:void(0);" onclick="navigateToCountry(<?= $key['id'] ?>)">
                            <img src="<?= $key['img1'] ?>" class="w-full h-48 object-cover group-hover:scale-105 transition-transform" alt="<?= $key['f1'] ?>">
                            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-lg font-medium text-center py-3">
                                <?= htmlspecialchars($key['f1']) ?>
                            </div>
                        </a>
                    </div>

                    <?php $counter++; ?>
                <?php endforeach; ?>
            </div>

        <?php
        } else {
        ?>
            <div class="mt-12">
                <p class="text-gray-500 text-lg">No Data Available</p>
            </div>
        <?php
        }
        ?>

    </div>
</section>

<script>
    function navigateToCountry(countryId) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'destination_details';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'country_id';
        input.value = countryId;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }
</script>