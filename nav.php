<!-- Navigation -->
<div class="bg-white sticky top-0 w-full z-[100] border-b border-gray-200">
  <!-- Desktop Navigation -->
  <div class="hidden lg:block bg-white shadow-md">
    <div class="container mx-auto px-6 py-2">
      <nav class="flex justify-between items-center max-w-screen-xl flex-wrap mx-auto p-1">
        <!-- Logo -->
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img src="./<?= $setting->getSettings('img2') ?>" class="h-12 w-12" alt="New wing logo">
          <span class="self-center text-2xl font-bold whitespace-nowrap"><?= $setting->getSettings('f1') ?></span>
        </a>

        <!-- Desktop Navigation Links -->
        <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
          <?php
          // Fetch labels and URLs from the database
          $lables = json_encode($nav_lables = str_getcsv($setting->getSettings('f9')));
          $data = json_decode($lables, true);

          // Loop through the array in steps of 2 (label and URL pairs)
          for ($i = 0; $i < count($data); $i += 2) {
          ?>
            <li>
              <a href="<?= $data[$i + 1] ?>" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                <?= $data[$i] ?>
              </a>
            </li>
          <?php } ?>
        </ul>

        <!-- Profile Section -->
        <?php include_once './nav_profile.php'; ?>
      </nav>
    </div>
  </div>

  <!-- Mobile Navigation -->
  <div class="flex justify-between align-items-center">
    <!-- Mobile Menu Toggle Button -->
    <button id="menu-toggle" class="p-4 text-gray-800 lg:hidden">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <?php include_once './nav_mobile_profile.php'; ?>
  </div>

  <!-- Mobile Navigation Menu -->
  <div id="mobile-nav" class="fixed top-0 left-0 h-full bg-white shadow-lg nav-slide lg:hidden px-4 py-6">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
      <!-- Mobile Logo -->
      <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="<?= $setting->getSettings('img2') ?>" class="h-10 w-10" alt="New wing logo">
        <span class="self-center text-xl font-bold whitespace-nowrap"><?= $setting->getSettings('f2') ?></span>
      </a>
      <!-- Close Button -->
      <button id="close-nav" class="text-gray-800 ml-4">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <!-- Mobile Navigation Links -->
    <nav class="p-4">
      <ul class="p-2 pt-4 space-y-1">
        <?php

        $icons[0] = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                  fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round" class="lucide lucide-home">
                  <path d="M3 9L12 2l9 7v11a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2v-4H9v4a2 2 0 0 1-2 2H3z" />
                </svg>';

        $icons[2] = ' <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round" class="lucide lucide-building-2">
                  <path d="M3 22V6a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v16" />
                  <path d="M9 22h6" />
                  <path d="M13 22V2l8 4v16" />
                  <path d="M13 13h5" />
                  <path d="M13 9h5" />
                </svg>';
        $icons[4] = '     <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round" class="lucide lucide-book-open">
                  <path d="M2 3h6a4 4 0 0 1 4 4v14a4 4 0 0 0-4-4H2z" />
                  <path d="M22 3h-6a4 4 0 0 0-4 4v14a4 4 0 0 1 4-4h6z" />
                </svg>';

        $icons[6] = ' <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round" class="lucide lucide-calendar-days">
                  <rect width="18" height="18" x="3" y="4" rx="2" />
                  <line x1="16" x2="16" y1="2" y2="6" />
                  <line x1="8" x2="8" y1="2" y2="6" />
                  <line x1="3" x2="21" y1="10" y2="10" />
                </svg>';

        $icons[8] = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round" class="lucide lucide-pen-line">
                  <path d="M12 20h9" />
                  <path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4Z" />
                </svg>';

        $icons[10] = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round" class="lucide lucide-user">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                  <circle cx="12" cy="7" r="4" />
                </svg>';



        // Reuse the same data for mobile navigation
        for ($i = 0; $i < count($data); $i += 2) {
        ?>
          <li>
            <a href="<?= $data[$i + 1] ?>" class="block py-2 px-1 text-gray-900 hover:bg-blue-100 rounded">
              <div class="flex items-center font-bold">
                <?= $icons[$i] ?>
                &nbsp;&nbsp;&nbsp;<span><?= $data[$i] ?></span>
              </div>
            </a>
          </li>
          <hr>
        <?php } ?>
      </ul>
    </nav>
  </div>

  <!-- Overlay -->
  <div id="overlay" class="fixed inset-0 pointer-events-none hidden lg:hidden"></div>
</div>

<!-- Login/Register Modal -->
<?php include_once 'login_register.php'; ?>




<!-- Scripts -->
<script>
  // Mobile Navigation Toggle
  document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menu-toggle');
    const closeNav = document.getElementById('close-nav');
    const mobileNav = document.getElementById('mobile-nav');
    const overlay = document.getElementById('overlay');

    menuToggle.addEventListener('click', () => {
      mobileNav.classList.toggle('active');
      overlay.classList.toggle('hidden');
      document.body.classList.toggle('overflow-hidden');
    });

    closeNav.addEventListener('click', () => {
      mobileNav.classList.remove('active');
      overlay.classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    });

    overlay.addEventListener('click', () => {
      mobileNav.classList.remove('active');
      overlay.classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    });
  });

  // Login Modal Logic
  function showForm(formId) {
    const forms = ["sign-in-form", "email-form", "otp-form", "sign-up-form"];
    forms.forEach(id => {
      document.getElementById(id).classList.add("hidden");
    });
    document.getElementById(formId).classList.remove("hidden");
  }

  document.getElementById("go-to-emailVerify").addEventListener("click", (e) => {
    e.preventDefault();
    showForm("email-form");
  });

  document.getElementById("verify-email-btn").addEventListener("click", (e) => {
    e.preventDefault();
    showForm("otp-form");
  });

  document.getElementById("otp-form-element").addEventListener("submit", (e) => {
    e.preventDefault();
    showForm("sign-up-form");
  });

  document.getElementById("go-to-sign-in").addEventListener("click", (e) => {
    e.preventDefault();
    showForm("sign-in-form");
  });

  function resetForm() {
    showForm("sign-in-form");
  }
</script>


