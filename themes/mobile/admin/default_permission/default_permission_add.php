<?php ### Top Section Begin ### ?>
<?php echo $top;  ?>
<?php ### Top Section End ### ?>
<?php 
### If No Error Begin ###
if(!$response["event"]["error"]):?>

<?php echo form_open( '', array( 'name' => 'default_permission_add_form', 'id' => 'default_permission_add_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) )?> 

<?php echo form_label( '<p>'._e( 'User Category' ).'</p>', 'user_category' )?> <?php echo form_dropdown('user_category', $var['categories_dd'], $this->input->get('user_category'), 'id="user_category" class="validate" data-display="'._e( 'User Category' ).'" data-rules="required" onchange="getUserRoleByUserCat(this)"');
?> <?php echo form_label( '<p>'._e( 'User Role' ).'</p>', 'user_role_id' )?>  <?php echo form_dropdown('user_role_id', $var['roles_dd'], '', 'id="user_role_id" disabled="disabled" class="validate" data-display="'._e( 'User Role' ).'" data-rules="required"'); ?>
<?php echo form_label( '<p>'._e( 'Permission Group' ).'</p>', 'permission_group' )?>  <?php echo form_dropdown('permission_group', $var['permission_groups_dd'], '', 'id="permission_group" class="validate" data-display="'._e( 'Permission Group' ).'" data-rules="required" onchange="getPermissionByGroup(this)"'); ?>
<?php echo form_label( '<p>'._e( 'Allowed Permission' ).'</p>', 'allowed_permission_id' )?>  <?php echo form_dropdown('allowed_permission_id', $var['permissions_dd'], '', 'id="allowed_permission_id" disabled="disabled" class="validate" data-display="'._e( 'Allowed Permission' ).'" data-rules="required"'); ?>
<div class="clear"></div>
<?php echo form_submit( array( 'name' => 'default_permission_add', 'id' => 'default_permission_add', 'class' => 'margin-top10' ), _e( 'Add' ) );?> <?php echo form_close()?>
<?php
$js = $this->template->admin_view( 'default_permission_js', '', true, "default_permission");
$this->template->embed_asset_code('admin', 'js', 'default-permission-js', $js);

$user_role_js = $this->load->view("web/admin/user_role/user_role_js_function.php", '', true);
$this->template->embed_asset_code('admin', 'js', 'user_role_js_function', $user_role_js);
endif;
### If No Error End ###

?>
