<h2><?php echo $title ?></h2>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'User Name [Auto Suggest]' ).'</p>', 'user_name' )?> <?php echo form_input(array('name' => 'user_name', 'id' => 'user_name' ));
?>
<div class="clear"></div>
<div id="userallrolesplacer"></div>
<?php echo form_close()?>
<?php
$this->template->add_remove_admin_css(array('jquery-ui.css'), 'add');
$this->template->add_remove_admin_js(array('jquery-ui.js'), 'add');

$js = $this->template->admin_view( 'permission_modify_js', '', true, "permission_modify");
$this->template->embed_asset_code('admin', 'js', 'permission-modify-js', $js);

$js_function = $this->template->admin_view( 'permission_modify_js_function', '', true, "permission_modify");
$this->template->embed_asset_code('admin', 'js', 'permission-modify-js-function', $js_function);

$user_js = $this->load->view("web/admin/user/user_js_function.php", '', true);
$this->template->embed_asset_code('admin', 'js', 'user_js_function', $user_js);

$user_map_js = $this->load->view("web/admin/user_map/user_map_js_function.php", '', true);
$this->template->embed_asset_code('admin', 'js', 'user_map_js_function', $user_map_js);	

$default_permission_js = $this->load->view("web/admin/default_permission/default_permission_js_function.php", '', true);
$this->template->embed_asset_code('admin', 'js', 'default_permission_js_function', $default_permission_js);	
?>
