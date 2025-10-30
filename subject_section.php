<?php
$categories = $category->get_all()['error'] === null ? $category->get_all()['data'] : [];
$initialCategories = array_slice($categories, 0, 3); // Get first 3 categories
$hasMoreCategories = count($categories) > 3; // Check if there are more categories to show
?>

<section>
  <div class="bg-gray-100 flex items-center justify-center py-16">
    <div class="max-w-7xl mx-auto text-center">
      <!-- Section Heading -->
      <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Shape Your Future with the Right Subjects</h2>
      <p class="text-gray-600 mb-8">Choose from a wide range of disciplines to build a successful and fulfilling career.</p>

      <!-- Cards Container -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-4" id="categoriesContainer">
        <?php foreach ($initialCategories as $row): ?>
        <?php $_POST['subject'] = $row['id'] ?>
        <div
          class="relative overflow-hidden rounded-lg shadow-lg group transform transition duration-500 hover:scale-105 cursor-pointer initial-category"
          onclick="navigateToSubject(<?=$_POST['subject']?>)">

          <?php $image = !empty($row['img1']) ? htmlspecialchars($row['img1'], ENT_QUOTES, 'UTF-8') : './assets/images/NA Image.jpg'; ?>
          <img src="<?=$image?>" alt="Image" class="w-full h-48 object-cover">
          <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
            <span class="text-white text-lg font-semibold">Explore More</span>
          </div>
          <div class="p-4 bg-white">
            <h3 class="text-lg font-bold text-gray-800"><?=$row['f1']?></h3>
          </div>
        </div>
        <?php endforeach; ?>

        <!-- Additional categories -->
        <?php foreach (array_slice($categories, 3) as $row): ?>
        <?php $_POST['subject'] = $row['id'] ?>
        <div
          class="relative overflow-hidden rounded-lg shadow-lg group transform transition duration-500 hover:scale-105 cursor-pointer additional-category hidden"
          onclick="navigateToSubject(<?=$_POST['subject']?>)">

          <?php $image = !empty($row['img1']) ? htmlspecialchars($row['img1'], ENT_QUOTES, 'UTF-8') : './assets/images/NA Image.jpg'; ?>
          <img src="<?=$image?>" alt="Image" class="w-full h-48 object-cover">
          <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
            <span class="text-white text-lg font-semibold">Explore More</span>
          </div>
          <div class="p-4 bg-white">
            <h3 class="text-lg font-bold text-gray-800"><?=$row['f1']?></h3>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- See More/Show Less Button -->
      <?php if ($hasMoreCategories): ?>
      <div class="text-center mt-8">
        <button id="toggleCategoriesBtn" class="mt-8 px-6 py-2 text-blue-600 border border-blue-600 font-semibold rounded-md hover:bg-blue-600 hover:text-white transition duration-300 transform hover:scale-105">
          See More →
        </button>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<script>
  function navigateToSubject(subject) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'courses';

    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'subject';
    input.value = subject;

    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
  }

  document.getElementById('toggleCategoriesBtn')?.addEventListener('click', function() {
    const additionalCategories = document.querySelectorAll('.additional-category');
    const toggleBtn = document.getElementById('toggleCategoriesBtn');
    
    // Check current state
    const isShowingAll = additionalCategories[0]?.classList.contains('hidden') === false;
    
    if (isShowingAll) {
      // Hide additional categories
      additionalCategories.forEach(card => {
        card.classList.add('hidden');
      });
      toggleBtn.textContent = 'See More →';
    } else {
      // Show additional categories
      additionalCategories.forEach(card => {
        card.classList.remove('hidden');
      });
      toggleBtn.textContent = 'Show Less';
    }
  });
</script>