<?php ### Top Section Begin ### ?>
<?php echo $top;  ?>
<?php ### Top Section End ### ?>
<?php 
### If No Error Begin ###
if(!$response["event"]["error"]):?>

<?php echo form_open( '', array( 'name' => 'user_role_add_form', 'id' => 'user_role_add_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) )?> <?php echo form_label( '<p>'._e( 'User Category' ).'</p>', 'user_category_id' )?> <?php echo form_dropdown('user_category_id', $var['categories_dd'], $this->input->get('user_category_id'), 'id="user_category_id" class="validate" data-display="'._e( 'User Category' ).'" data-rules="required"');
?> <?php echo form_label( '<p>'._e( 'User Role' ).'</p>', 'user_role' )?> <?php echo form_input( array( 'name' => 'user_role', 'id' => 'user_role', 'placeholder' => 'add user role here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'User Role' ), 'data-rules' => 'required') );?>
<div class="clear"></div>
<?php echo form_submit( array( 'name' => 'user_role_add', 'id' => 'user_role_add', 'class' => 'margin-top10' ), _e( 'Add' ) );?> <?php echo form_close()?>
<?php
$js = $this->template->admin_view( 'user_role_js', '', true, "user_role");
$this->template->embed_asset_code('admin', 'js', 'user-role-js', $js);

endif;
### If No Error End ###

?>
