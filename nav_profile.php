<div class="relative">
  <div class="flex space-x-3 items-center justify-center gap-5">
    <!-- Profile Dropdown -->
    <div class="relative">
      <?php if (!empty($_SESSION['login_success'])): ?>
        <button id="dropdownButton" class="flex mt-1 gap-2 cursor-pointer focus:outline-none">
          <img src="<?= !empty($_SESSION['profile_image']) ? $_SESSION['profile_image'] : './assets/images/userProfile.png'; ?>" alt="Profile Image" class="w-8 h-8 rounded-full">
          <span class="font-bold">Profile</span>
        </button>

        <!-- Dropdown Menu -->
        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg z-10">
          <a href="profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
          <a href="javascript:logout()" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Log Out</a>
        </div>

      <?php else: ?>
        <div data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
          class="flex mt-1 gap-2 cursor-pointer">
          <button id="dropdownButton" class="flex mt-1 gap-2 cursor-pointer focus:outline-none">
            <span>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="lucide lucide-square-user-round">
                <path d="M18 21a6 6 0 0 0-12 0" />
                <circle cx="12" cy="11" r="4" />
                <rect width="18" height="18" x="3" y="3" rx="2" />
              </svg>
            </span>
            <span class="font-bold">Sign In</span>
          </button>
        </div>
      <?php endif; ?>
    </div>

    <!-- Notification Bell -->
    <?php
    // Count unread notifications

    $unreadCount = $notification->get_count_anyone('user', "user = " . intval(isset($_SESSION['u_id']) ? $_SESSION['u_id'] : 'null'));
    if (isset($unreadCount['data']['tot']) && $unreadCount['data']['tot'] > 0) {
      $unreadCount['data']['tot'] = $unreadCount['data']['tot'];
    } else {
      $unreadCount['data']['tot'] = 0;
    }

    ?>

    <?php if (!empty($_SESSION['login_success'])): ?>
      <div class="relative">
        <button id="notificationButton" class="relative focus:outline-none">
          <!-- Bell Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700 hover:text-gray-900" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M15 17h5l-1.405-1.405C18.215 14.79 18 13.918 18 13V9a6 6 0 10-12 0v4c0 .918-.215 1.79-.595 2.595L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
          </svg>

          <!-- Only show red dot if unread exists -->
          <?php if ($unreadCount['data']['tot'] > 0): ?>
            <span class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-600 rounded-full"></span>
          <?php endif; ?>
        </button>

        <?php
        $notificationList = $notification->get_by_foreignKey('user', $_SESSION['u_id'], 'created_date DESC', 2);
        ?>

        <!-- Notification Dropdown -->
        <div id="notificationMenu" class="hidden absolute right-0 mt-2 w-96 bg-white border rounded-lg shadow-lg z-10">
          <div class="flex items-center justify-between p-4 text-sm font-semibold text-gray-700 border-b bg-gray-50">
            <span>Notifications</span>
            <button
              id="clearNotifications"
              class="text-xs text-gray-700  transition duration-150 ease-in-out">
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

    <!-- Button -->
    <div>
      <a href="courses"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">Find
        My Course</a>
    </div>

  </div>
</div>

<script>
  // Profile menu
  document.getElementById('dropdownButton').addEventListener('click', function() {
    document.getElementById('dropdownMenu').classList.toggle('hidden');
  });

  // Notification menu
  document.getElementById('notificationButton')?.addEventListener('click', function() {
    document.getElementById('notificationMenu')?.classList.toggle('hidden');
  });

  document.getElementById('clearNotifications')?.addEventListener('click', function() {
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
          // Reload the page to reflect the changes
          window.location.reload();
        } else {
          console.error('Failed to clear:', data.message);
        }
      })
      .catch(error => console.error('Error clearing notifications:', error));
  });




  // Close dropdowns on outside click
  document.addEventListener('click', function(event) {
    const profileDropdown = document.getElementById('dropdownMenu');
    const profileButton = document.getElementById('dropdownButton');
    const notificationMenu = document.getElementById('notificationMenu');
    const notificationButton = document.getElementById('notificationButton');

    if (profileDropdown && !profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
      profileDropdown.classList.add('hidden');
    }

    if (notificationMenu && !notificationButton.contains(event.target) && !notificationMenu.contains(event.target)) {
      notificationMenu.classList.add('hidden');
    }
  });
</script>