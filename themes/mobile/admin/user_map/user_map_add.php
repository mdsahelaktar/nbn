<?php ### Top Section Begin ### ?>
<?php echo $top;  ?>
<?php ### Top Section End ### ?>
<?php 
### If No Error Begin ###
if(!$response["event"]["error"]):?>
<?php echo form_open( '', array( 'name' => 'user_map_add_form', 'id' => 'user_map_add_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) )?> 

<?php echo form_label( '<p>'._e( 'User Name' ).'</p>', 'user_name' )?> <?php echo form_input(array('name' => 'user_name', 'id' => 'user_name' ));
?>
<?php echo form_hidden('user_id'); ?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'User Category' ).'</p>', 'user_category_id' )?> <?php echo form_dropdown('user_category_id', $var['categories_dd'], $this->input->get('user_category_id'), 'id="user_category_id" class="validate" data-display="'._e( 'User Category' ).'" data-rules="required" onchange="getUserRoleByUserCat(this)"');
?> 
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'User Role' ).'</p>', 'user_role_id' )?>  <?php echo form_dropdown('user_role_id', $var['roles_dd'], '', 'id="user_role_id" disabled="disabled" class="validate" data-display="'._e( 'User Role' ).'" data-rules="required"'); ?>
<div class="clear"></div>
<?php echo form_submit( array( 'name' => 'user_map_add', 'id' => 'user_map_add', 'class' => 'margin-top10' ), _e( 'Add' ) );?> <?php echo form_close()?>
<?php
$this->template->add_remove_admin_css(array('jquery-ui.css'), 'add');
$this->template->add_remove_admin_js(array('jquery-ui.js'), 'add');

$js = $this->template->admin_view( 'user_map_js', '', true, "user_map");
$this->template->embed_asset_code('admin', 'js', 'user-map-js', $js);

$user_role_js = $this->load->view("web/admin/user_role/user_role_js_function.php", '', true);
$this->template->embed_asset_code('admin', 'js', 'user_role_js_function', $user_role_js);

$user_js = $this->load->view("web/admin/user/user_js_function.php", '', true);
$this->template->embed_asset_code('admin', 'js', 'user_js_function', $user_js);	
endif;
### If No Error End ###
?>
