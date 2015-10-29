<?php ### Top Section Begin ###  ?>
<?php echo $top ?>
<div msg="permission_modify"></div>
<?php ### Top Section End ### ?>
<?php
### Edit Section Begin ### 
### If No Error Begin ###
if (!$response["event"]["error"]):
    ?>
    <?php echo form_open('', array('name' => 'user_map_search_form', 'id' => 'user_map_search_form', 'class' => 'width100 float-left margin-bottom30 margin-top10', 'method' => 'get')) ?>
    <table>
        <tr id="caption_section">
            <th><a href="<?php echo sortBy($var['CFG'], 'sortbyusername') ?>" class="<?php echo sortClass($var['CFG'], 'sortbyusername') ?>"><?php echo _e('User Name') ?></a></th>
            <th><a href="<?php echo sortBy($var['CFG'], 'sortbycategory') ?>" class="<?php echo sortClass($var['CFG'], 'sortbycategory') ?>"><?php echo _e('User Category') ?></a></th>
            <th><a href="<?php echo sortBy($var['CFG'], 'sortbyrole') ?>" class="<?php echo sortClass($var['CFG'], 'sortbyrole') ?>"><?php echo _e('User Role') ?></a></th>
            <th><a href="<?php echo sortBy($var['CFG'], 'sortbytime') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbytime') ?>"><?php echo _e('Time Created') ?></a></th>
            <th><a href="<?php echo sortBy($var['CFG'], 'sortbymfdtime') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbymfdtime') ?>"><?php echo _e('Modified time') ?></a></th>
            <th><a href="<?php echo sortBy($var['CFG'], 'sortbyactive') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbyactive') ?>"><?php echo _e('Status') ?></a></th>
            <th class="actionth"><?php echo _e('Action') ?></th>
        </tr>
        <tr id="blanktr">
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr id="filter_section">
            <td><?php echo form_input(array('name' => 'user_name', 'id' => 'user_name', 'placeholder' => 'search by user name', 'size' => 20, 'value' => $this->input->get('user_name'))); ?></td>
            <td><?php echo form_dropdown('user_category', $var['categories_dd'], $this->input->get('user_category') != '' ? $this->input->get('user_category') : ''); ?></td>
            <td><?php echo form_dropdown('role', $var['roles_dd'], $this->input->get('role') != '' ? $this->input->get('role') : ''); ?></td>
            <td></td>
            <td></td>
            <td><?php echo form_dropdown('is_trashed', $var['filter_status_dd'], $this->input->get('is_trashed') != '' ? $this->input->get('is_trashed') : ''); ?></td>
            <td><?php echo anchor('admin/user_map/edit', _e('Reset'), array('title' => _e('Reset'), 'class' => 'refresh btn-type1 margin-right10 margin-left20 float-left')) ?> <?php echo form_button(array('name' => 'search', 'id' => 'search', 'class' => 'filter', 'onclick' => 'return goFilter(this)'), _e('Filter')); ?></td>
        </tr>
        <tr id="blanktr">
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr id="multiple_action_section">
            <td colspan="6"><a onclick="return selectAll(this)" class="btn-type1 margin-right10 margin-top10 float-left" title="<?php echo _e('Select All') ?>" href="#"><span class="ion-checkmark-circled"></span><?php echo _e('Select All') ?></a> <a onclick="return unselectAll(this)" class="btn-type1 margin-right10 margin-top10 float-left" title="<?php echo _e('Unselect All') ?>" href="#"><span class="ion-close-circled"></span><?php echo _e('Unselect All') ?></a></td>
            <td><?php echo form_dropdown('action', $var['action_dd']); ?>
                <button onclick="return goAction(this)" class="margin-left5 go" id="go" type="button" name="go"><?php echo _e('Go') ?> <span class="ion-play"></span></button></td>
        </tr>
        <tr id="blanktr">
            <td colspan="6">&nbsp;</td>
        </tr>
        <?php ### If Record Found Begin ### ?>
        <?php
        if (count($results["records"])) {
            ?>
        <?php foreach ($results["records"] as $value): ?>
                <tr id="oddeven">
                    <td><?php echo form_checkbox('row_id[]', $value->ai_user_map_id); ?><?php echo $value->user_name ?></td>
                    <td align="center"><?php echo $value->user_category ?></td>
                    <td align="center"><?php echo $value->user_role ?></td>
                    <td align="center"><?php echo $value->creation_time ?></td>
                    <td align="center"><?php echo $value->update_time ?></td>
                    <td align="center"><?php echo $value->disable ? _e("Inactive") : _e("Active") ?></td>
                    <td align="center"><a href="<?php echo createRevertDeleteUrl($value->ai_user_map_id, $value->disable) ?>" class="editrevert<?php echo $value->disable ?>"></a>     | &nbsp;<a onclick="showPermissionPopBox(this)" href="#" data-user_role_id="<?php echo $value->user_role_id ?>" data-user_map_id="<?php echo $value->ai_user_map_id ?>" title="<?php echo _e('Modify Permission') ?>" class="ion-settings modify-permission"></a></td>
                </tr>
        <?php endforeach; ?>
            <tr>
                <td colspan="7"><?php echo $results["pagination"] ?></td>
            </tr>
            <script type="text/javascript">
                var deleteconformstring = '<?php echo _e('Confirm delete user this role') ?>';
                var pdeleteconformstring = '<?php echo _e('Confirm permanent delete user this role') ?>';
            </script>
            <?php ### If Record Found End ### ?>
            <?php
            $this->template->add_remove_admin_css(array('jquery-ui.css'), 'add');
            $this->template->add_remove_admin_js(array('jquery-ui.js'), 'add');

            $js = $this->template->admin_view('user_map_js', '', true, "user_map");
            $this->template->embed_asset_code('admin', 'js', 'user-map-js', $js);

            $user_map_js = $this->template->admin_view('user_map_js_function', '', true, "user_map");
            $this->template->embed_asset_code('admin', 'js', 'user_map_js_function', $user_map_js);

            $permission_modify_js = $this->load->view("web/admin/permission_modify/permission_modify_js_function.php", '', true);
            $this->template->embed_asset_code('admin', 'js', 'permission_modify_js_function', $permission_modify_js);

            $default_permission_js = $this->load->view("web/admin/default_permission/default_permission_js_function.php", '', true);
            $this->template->embed_asset_code('admin', 'js', 'default_permission_js_function', $default_permission_js);
        }
        else {
            ?>
        <?php ### If No Record Found Begin ###  ?>
            <tr>
                <td colspan="7"><div class="error">
                        <p><?php echo _e('No records found') ?></p>
                    </div></td>
            </tr>
            <?php ### If No Record Found Begin ### ?>
            <?php }
        ?>
    </table>
    <?php echo form_close() ?>
<?php
endif;
### List Section Begin ### ?>