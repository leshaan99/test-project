<!-- Mobile Menu -->
<div class="relative lg:hidden flex items-center gap-4">
  <!-- Notification Button for Mobile -->
  <?php if (!empty($_SESSION['login_success'])): ?>
    <div class="relative">
      <button id="mobileNotificationButton" class="relative focus:outline-none py-2 px-2 text-gray-900 hover:bg-blue-100 rounded">
        <!-- Bell Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700 hover:text-gray-900" fill="none"
          viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M15 17h5l-1.405-1.405C18.215 14.79 18 13.918 18 13V9a6 6 0 10-12 0v4c0 .918-.215 1.79-.595 2.595L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        <!-- Notification Dot -->
        <span class="absolute top-1 right-1 inline-block w-2 h-2 bg-red-600 rounded-full"></span>
      </button>

      <!-- Notification Dropdown for Mobile -->
      <div id="mobileNotificationMenu" class="hidden absolute right-0 mt-2 w-96 bg-white border rounded-lg shadow-lg z-10">
        <div class="flex items-center justify-between p-4 text-sm font-semibold text-gray-700 border-b bg-gray-50">
          <span>Notifications</span>
          <button
            id="mobileClearNotifications"
            class="text-xs text-gray-700 transition duration-150 ease-in-out">
            Clear All
          </button>
        </div>

        <ul class="max-h-60 overflow-y-auto">
          <?php if (!empty($notificationList['data'])): ?>
            <?php foreach ($notificationList['data'] as $notificationItem): ?>
              <a href="profile" class="block">
                <li class="px-4 py-2 hover:bg-gray-200 text-sm text-gray-600 cursor-pointer">
                  <strong><?= htmlspecialchars($notificationItem['f1'] ?? 'No Title'); ?></strong><br>
                  <span><?= htmlspecialchars($notificationItem['f2'] ?? 'No Description'); ?></span>
                </li>
              </a>
            <?php endforeach; ?>
          <?php else: ?>
            <li class="px-4 py-2 text-gray-500">No notifications available</li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  <?php endif; ?>

  <!-- Profile Button for Mobile -->
  <div class="relative">
    <?php if (!empty($_SESSION['login_success'])): ?>
      <!-- Profile Dropdown for Mobile -->
      <button id="mobileDropdownButton" class="flex items-center gap-2 cursor-pointer focus:outline-none py-2 px-4 text-gray-900 hover:bg-blue-100 rounded">
        <img src="<?= !empty($_SESSION['profile_image']) ? $_SESSION['profile_image'] : './assets/images/userProfile.png'; ?>" alt="Profile Image" class="w-8 h-8 rounded-full">
        <span class="font-bold">Profile</span>
      </button>

      <!-- Dropdown Menu for Mobile -->
      <div id="mobileDropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg z-10">
        <a href="profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
        <a href="javascript:logout()" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Log Out</a>
      </div>
    <?php else: ?>
      <!-- Sign-In Button for Mobile -->
      <a href="#" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="block py-2 px-4 text-gray-900 hover:bg-blue-100 rounded">
        <div class="flex items-center font-bold">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-user-round">
            <path d="M18 21a6 6 0 0 0-12 0" />
            <circle cx="12" cy="11" r="4" />
            <rect width="18" height="18" x="3" y="3" rx="2" />
          </svg>
        </div>
      </a>
    <?php endif; ?>
  </div>
</div>

<script>
  // Toggle dropdown menu for mobile
  document.getElementById('mobileDropdownButton')?.addEventListener('click', function () {
    document.getElementById('mobileDropdownMenu').classList.toggle('hidden');
  });

  // Toggle notification menu for mobile
  document.getElementById('mobileNotificationButton')?.addEventListener('click', function () {
    document.getElementById('mobileNotificationMenu').classList.toggle('hidden');
  });

  // Clear notifications for mobile
  document.getElementById('mobileClearNotifications')?.addEventListener('click', function () {
    fetch('data/delete_item.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
          type: 'clear'
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          window.location.reload();
        } else {
          console.error('Failed to clear:', data.message);
        }
      })
      .catch(error => console.error('Error clearing notifications:', error));
  });

  // Close dropdowns when clicking outside (for mobile)
  document.addEventListener('click', function (event) {
    const mobileDropdown = document.getElementById('mobileDropdownMenu');
    const mobileButton = document.getElementById('mobileDropdownButton');
    const mobileNotificationMenu = document.getElementById('mobileNotificationMenu');
    const mobileNotificationButton = document.getElementById('mobileNotificationButton');

    if (mobileDropdown && !mobileButton.contains(event.target) && !mobileDropdown.contains(event.target)) {
      mobileDropdown.classList.add('hidden');
    }

    if (mobileNotificationMenu && !mobileNotificationButton.contains(event.target) && !mobileNotificationMenu.contains(event.target)) {
      mobileNotificationMenu.classList.add('hidden');
    }
  });
</script>