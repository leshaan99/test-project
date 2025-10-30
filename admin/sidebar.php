<?php


// side menu
$side_menu = array();

array_push($side_menu, array('name' => 'Dashboard', 'icon' => 'fas fa-tachometer-alt', 'url' => 'dashboard', 'active' => 'active', 'menu' => 'menu-open', 'submenu' => ''));

array_push($side_menu, array('name' => 'Staff', 'icon' => 'fas fa-user-tie', 'url' => 'admin_list', 'active' => '', 'menu' => '', 'submenu' => array(array('name' => 'List', 'icon' => 'fas fa-list', 'url' => 'admin_list?role=Mg=='))));

array_push($side_menu, array('name' => 'Students', 'icon' => 'fas fa-users', 'url' => 'user_list', 'active' => '', 'menu' => '', 'submenu' => array(array('name' => 'List', 'icon' => 'fas fa-list', 'url' => 'user_list?level=1'))));

array_push($side_menu, array('name' => 'Courses', 'icon' => 'fas fa-book-open', 'url' => '#', 'active' => '', 'menu' => '', 'submenu' => array(array('name' => 'List', 'icon' => 'fas fa-list', 'url' => 'course_list'), array('name' => 'Categories', 'icon' => 'fas fa-list', 'url' => 'category_list'))));

array_push($side_menu, array('name' => 'Blogs', 'icon' => 'fas fa-newspaper', 'url' => '#', 'active' => '', 'menu' => '', 'submenu' => array(array('name' => 'List', 'icon' => 'fas fa-list', 'url' => 'blog_list'))));

array_push($side_menu, array('name' => 'Applications', 'icon' => 'fas fa-folder', 'url' => '#', 'active' => '', 'menu' => '', 'submenu' => array(array('name' => 'List', 'icon' => 'fas fa-list', 'url' => 'application_list'), array('name' => 'Add Application Labels', 'icon' => 'fas fa-list', 'url' => 'application_status_list'), array('name' => 'Add Document Types', 'icon' => 'fas fa-list', 'url' => 'document_type_list'))));

array_push($side_menu, array('name' => 'Events', 'icon' => 'fas fa-calendar-alt mr-2', 'url' => '#', 'active' => '', 'menu' => '', 'submenu' => array(array('name' => 'List', 'icon' => 'fas fa-list', 'url' => 'event_list'))));

array_push($side_menu, array('name' => 'University', 'icon' => 'fas fa-university', 'url' => '#', 'active' => '', 'menu' => '', 'submenu' => array(array('name' => 'List', 'icon' => 'fas fa-list', 'url' => 'university_list'))));

array_push($side_menu, array('name' => 'Countries', 'icon' => 'fas fa-globe', 'url' => '#', 'active' => '', 'menu' => '', 'submenu' => array(array('name' => 'List', 'icon' => 'fas fa-list', 'url' => 'country_list'))));

array_push($side_menu, array('name' => 'Branches', 'icon' => 'fas fa-building', 'url' => '#', 'active' => '', 'menu' => '', 'submenu' => array(array('name' => 'List', 'icon' => 'fas fa-list', 'url' => 'branch_list'), array('name' => 'Messages', 'icon' => 'fas fa-list', 'url' => 'messages_list'))));

array_push($side_menu, array('name' => 'Sliders', 'icon' => 'fas fa-box', 'url' => '#', 'active' => '', 'menu' => '', 'submenu' => array(array('name' => 'List', 'icon' => 'fas fa-list', 'url' => 'slide_list'))));

array_push($side_menu, array('name' => 'Testimonials', 'icon' => 'fas fa-comments', 'url' => '#', 'active' => '', 'menu' => '', 'submenu' => array(array('name' => 'List', 'icon' => 'fas fa-list', 'url' => 'testimonial_list'))));

array_push($side_menu, array('name' => 'Messages(FAQ)', 'icon' => 'fas fa-question-circle', 'url' => '#', 'active' => '', 'menu' => '', 'submenu' => array(array('name' => 'List', 'icon' => 'fas fa-list', 'url' => 'faq_list'))));

array_push($side_menu, array('name' => 'Coaching Inquiries', 'icon' => 'fa fa-chalkboard-teacher', 'url' => '#', 'active' => '', 'menu' => '', 'submenu' => array(array('name' => 'List', 'icon' => 'fas fa-list', 'url' => 'coaching_list'))));

array_push($side_menu, array('name' => 'Settings', 'icon' => 'fa fa-cog', 'url' => '#', 'active' => '', 'menu' => '', 'submenu' => array(array('name' => 'General', 'icon' => 'fas fa-cogs', 'url' => 'settings'),  array('name' => 'Privacy Policy', 'icon' => 'fa fa-file-alt', 'url' => 'terms_conditions', 'id' => 'privacy'), array('name' => 'Terms & conditions', 'icon' => 'fa fa-file-alt', 'url' => 'terms_conditions', 'id' => 'terms'), array('name' => 'About Info', 'icon' => 'fa fa-info-circle', 'url' => 'about'))));

//Logout button
array_push($side_menu, array('name' => 'Log Out', 'icon' => ' fas  fa-sign-out-alt', 'url' => 'javascript:logout()', 'active' => '', 'menu' => '', 'submenu' => ''));

?>


<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link">
        <img src="../<?= $setting->getSettings('img5') ?>" alt="Application Logo" class="brand-image img-circle elevation-3" style="opacity: 1">
        <span class="brand-text font-weight-light"><?= $setting->getSettings('f2') ?></span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php if (!empty($side_menu) && is_array($side_menu)) { ?>
                    <?php foreach ($side_menu as $item) { ?>
                        <li class="nav-item has-treeview <?= $item['menu'] ?>">
                            <a href="<?= $item['url'] ?>" class="nav-link <?= $item['active'] ?>">
                                <i class="nav-icon <?= $item['icon'] ?>"></i>
                                <p>
                                    <?= $item['name'] ?>
                                    <?= !empty($item['submenu']) ? '<i class="right fas fa-angle-left"></i>' : '' ?>
                                </p>
                            </a>
                            <?php if (!empty($item['submenu']) && is_array($item['submenu'])) { ?>
                                <ul class="nav nav-treeview">
                                    <?php foreach ($item['submenu'] as $sub_item) { ?>
                                        <li class="nav-item">
                                            <a href="<?= $sub_item['url'] . (!empty($sub_item['id']) ? '?type=' . urlencode($sub_item['id']) : '') ?>"
                                                class="nav-link" style="font-size: 13px;">
                                                <i class="nav-icon <?= $sub_item['icon'] ?>"></i>
                                                <p><?= $sub_item['name'] ?></p>
                                                <?= !empty($sub_item['subsubmenu']) ? '<i class="right fas fa-angle-left"></i>' : '' ?>
                                            </a>
                                            <?php if (!empty($sub_item['subsubmenu']) && is_array($sub_item['subsubmenu'])) { ?>
                                                <ul class="nav nav-treeview">
                                                    <?php foreach ($sub_item['subsubmenu'] as $sub_sub_item) { ?>
                                                        <li class="nav-item">
                                                            <a href="<?= $sub_sub_item['url'] ?>" class="nav-link" style="font-size: 13px;">
                                                                <i class="nav-icon <?= $sub_sub_item['icon'] ?>"></i>
                                                                <p><?= $sub_sub_item['name'] ?></p>
                                                            </a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </nav>
    </div>
</aside>