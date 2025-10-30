<?php include_once './header.php';
include_once './controllers/index.php';


?>



<?php include_once './navbar.php'; ?>

<?php include_once './sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php
    $t1 =  'Permissions';
    $t2 = 'Details';
    $t2 = 'Permissions';

    include_once './page_header.php';
    ?>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12 form-group">
                                        <label>Categories</label>
                                        <select class="form-control select2" id="role" name="role" style="width: 100%;">
                                            <option value="">---SELECT ---</option>
                                            <option value="2">Admin</option>
                                            <option value="3">Carer</option>
                                        </select>
                                    </div>






                                    <div class="col-lg-12 col-md-12">
                                        <table style="width: 100%; border-collapse: collapse;">
                                            <?php foreach ($menu_data as $mainmenu) : ?>
                                                <tr>
                                                    <!-- Main menu item -->
                                                    <td style="vertical-align: top; padding-right: 10px;">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input menu-switch main-switch" type="checkbox" role="switch" id="flexSwitchMain<?= $mainmenu['id']; ?>" data-main-id="<?= $mainmenu['id']; ?>">
                                                            <label class="form-check-label" for="flexSwitchMain<?= $mainmenu['id']; ?>"><?= $mainmenu['name']; ?></label>
                                                        </div>

                                                        <!-- Main menu permissions -->
                                                        <div class="d-flex" style="margin-left: 20px;">
                                                            <?php if (!empty($mainmenu['events'])) : ?>
                                                                <?php foreach ($mainmenu['events'] as $eventKey => $event) : ?>
                                                                    <div class="form-check form-switch" style="margin-right: 15px;">
                                                                        <input class="form-check-input event-switch" type="checkbox" id="main_<?= $event . '_' . $mainmenu['id']; ?>" name="permissions[<?= $mainmenu['id']; ?>][<?= $event; ?>]" value="<?= $eventKey; ?>" data-main-id="<?= $mainmenu['id']; ?>">
                                                                        <label class="form-check-label" for="main_<?= $event . '_' . $mainmenu['id']; ?>"><?= ucfirst($event); ?></label>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>

                                                    <!-- Submenu items and permissions -->
                                                    <td style="vertical-align: top;">
                                                        <?php if (!empty($mainmenu['submenu'])) : ?>
                                                            <?php foreach ($mainmenu['submenu'] as $submenu) : ?>
                                                                <div class="form-check form-switch" style="margin-bottom: 5px;">
                                                                    <input class="form-check-input menu-switch sub-switch" type="checkbox" role="switch" id="flexSwitchSub<?= $submenu['id']; ?>" data-main-id="<?= $mainmenu['id']; ?>" data-sub-id="<?= $submenu['id']; ?>" disabled>
                                                                    <label class="form-check-label" for="flexSwitchSub<?= $submenu['id']; ?>"><?= $submenu['name']; ?></label>
                                                                </div>

                                                                <!-- Submenu permissions -->
                                                                <div class="d-flex" style="margin-left: 40px;">
                                                                    <?php if (!empty($submenu['events'])) : ?>
                                                                        <?php foreach ($submenu['events'] as $eventKey => $event) : ?>
                                                                            <div class="form-check form-switch" style="margin-right: 15px;">
                                                                                <input class="form-check-input event-switch" type="checkbox" id="sub_<?= $event . '_' . $submenu['id']; ?>" name="permissions[<?= $mainmenu['id']; ?>][submenus][<?= $submenu['id']; ?>][<?= $event; ?>]" value="<?= $eventKey; ?>" data-main-id="<?= $mainmenu['id']; ?>" data-sub-id="<?= $submenu['id']; ?>" disabled>
                                                                                <label class="form-check-label" for="sub_<?= $event . '_' . $submenu['id']; ?>"><?= ucfirst($event); ?></label>
                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <!-- Adding a break line after each row -->
                                                    <td colspan="2" style="padding: 5px 0;">
                                                        <hr style="border: none; border-top: 1px solid #ccc; margin: 5px 0;">
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </table>
                                    </div>

                                </div>
                                <hr>

                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->


                    </div>






                </div>

            </div>




            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?php include_once './footer.php'; ?>



<script>
    $(document).ready(function() {
        // Event listener for main menu switches
        $('.main-switch').change(function() {

            let mainId = $(this).data('main-id');
            let isChecked = $(this).is(':checked');

            // Toggle sub-menu switches based on main menu switch
            $('.sub-switch[data-main-id="' + mainId + '"]').prop('disabled', !isChecked);
            $('.sub-switch[data-main-id="' + mainId + '"]').prop('checked', isChecked);

            $('.event-switch[data-main-id="' + mainId + '"]').prop('disabled', !isChecked);
            $('.event-switch[data-main-id="' + mainId + '"]').prop('checked', isChecked);

            // Update role permissions via AJAX for main menu
            updateRolePermission(mainId, null, isChecked, 0);

            // Update role permissions via AJAX for each submenu under the main menu
            $('.sub-switch[data-main-id="' + mainId + '"]').each(function() {
                updateRolePermission(mainId, $(this).data('sub-id'), isChecked, 0);
            });
        });

        // Event listener for sub menu switches
        $('.sub-switch').change(function() {


            let mainId = $(this).data('main-id');
            let subId = $(this).data('sub-id');
            let isChecked = $(this).is(':checked');

            $('.event-switch[data-sub-id="' + subId + '"]').prop('disabled', !isChecked);
            $('.event-switch[data-sub-id="' + subId + '"]').prop('checked', isChecked);


            // Update role permissions via AJAX for the specific submenu
            updateRolePermission(mainId, subId, isChecked, 0);
        });



        $('.event-switch').change(function() {

            let mainId = $(this).data('main-id');
            let subId = $(this).data('sub-id');
            let isChecked = $(this).is(':checked');
            let event_val = $(this).val();





            // Update role permissions via AJAX for the specific submenu
            updateRolePermission(mainId, subId, isChecked, event_val);
        });




        // Function to update role permissions via AJAX
        function updateRolePermission(mainId, subId, isChecked, type) {

            let role = $('#role').val();
            // console.log('Sub-menu ID:', subId, 'of Main menu ID:', mainId, 'is checked:', isChecked);
            $.ajax({
                url: './data/update_role_permissions.php', // Replace with your PHP script handling AJAX requests
                method: 'POST',
                data: {
                    role: role,
                    mainId: mainId,
                    subId: subId,
                    type: type,
                    isChecked: isChecked ? 1 : 0
                },
                success: function(response) {
                    console.log(response); // Log server response if needed
                },
                error: function(xhr, status, error) {
                    console.error('Error updating role permissions:', error);
                }
            });
        }
    });
</script>
<script>
    $(document).ready(function() {
        // Load permissions when role is selected
        $('#role').change(function() {

            $('.main-switch').prop('checked', false);
            $('.sub-switch').prop('checked', false).prop('disabled', true);
            $('.event-switch').prop('checked', false).prop('disabled', true);

            let roleId = $(this).val();

            if (roleId) {
                $.ajax({
                    url: './data/get_role_permission.php', // Replace with your endpoint
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        role: roleId
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // Update switches based on the response
                            let permissions = response.data;




                            $('.main-switch').each(function() {
                                let mainId = $(this).data('main-id');
                                let isChecked = permissions.main.includes(mainId);

                                $(this).prop('checked', isChecked);


                                $('.sub-switch[data-main-id="' + mainId + '"]').prop('disabled', !isChecked).each(function() {
                                    let subId = $(this).data('sub-id');
                                    $(this).prop('checked', permissions.sub.includes(subId));

                                });



                                // Toggle related events for main menu
                                if (isChecked) {
                                    // Get the main event permissions
                                    let mainEvents = permissions.main_event.find(event => event.main_id === mainId);
                                    if (mainEvents) {
                                        $('#main_save_' + mainId).prop('checked', mainEvents.save_event === 1).prop('disabled', false);

                                        $('#main_edit_' + mainId).prop('checked', mainEvents.edit_event === 1).prop('disabled', false);
                                        $('#main_delete_' + mainId).prop('checked', mainEvents.delete_event === 1).prop('disabled', false);
                                    }

                                    // Now handle sub-events
                                    permissions.sub_event.forEach(subEvent => {
                                        if (subEvent.main_id === mainId) {
                                            $('#sub_save_' + subEvent.sub_id).prop('checked', subEvent.save_event === 1).prop('disabled', false);
                                            $('#sub_edit_' + subEvent.sub_id).prop('checked', subEvent.edit_event === 1).prop('disabled', false);
                                            $('#sub_delete_' + subEvent.sub_id).prop('checked', subEvent.delete_event === 1).prop('disabled', false);
                                        }
                                    });
                                }
                            });




                        } else {
                            // Handle error
                            console.error(response.message);
                            $('.main-switch').prop('checked', false);
                            $('.sub-switch').prop('checked', false).prop('disabled', true);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                    }
                });
            } else {
                // Reset switches if no role is selected
                $('.main-switch').prop('checked', false);
                $('.sub-switch').prop('checked', false).prop('disabled', true);
                $('.event-switch').prop('checked', false).prop('disabled', true);
            }
        });

        // Toggle sub-menu switches based on main-menu switch
        $('.main-switch').change(function() {
            let mainId = $(this).data('main-id');
            let isChecked = $(this).is(':checked');

            $('.sub-switch[data-main-id="' + mainId + '"]').prop('disabled', !isChecked).prop('checked', isChecked);
        });
    });
</script>
</body>

</html>