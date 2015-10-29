<?php ### Top Section Begin ### ?>
<?php echo $top;  ?>
<?php ### Top Section End ### ?>
<?php 
### If No Error Begin ###
if(!$response["event"]["error"]):?>
<?php echo form_open( '', array( 'name' => 'permission_add_form', 'id' => 'permission_add_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) )?> <?php echo form_label( '<p>'._e( 'Permission Group' ).'</p>', 'group_id' )?> <?php echo form_dropdown('group_id', $var['permissions_dd'], $this->input->get('group_id'), 'id="group_id" class="validate" data-display="'._e( 'Permission' ).'" data-rules="required"');
?> <?php echo form_label( '<p>'._e( 'Permission' ).'</p>', 'permission' )?> <?php echo form_input( array( 'name' => 'permission', 'id' => 'permission', 'placeholder' => 'add permission here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'Permission' ), 'data-rules' => 'required') );?>
<div class="clear"></div>
<?php echo form_submit( array( 'name' => 'permission_add', 'id' => 'permission_add', 'class' => 'margin-top10' ), _e( 'Add' ) );?> <?php echo form_close()?>
<?php
$js = $this->template->admin_view( 'permission_js', '', true, "permission");
$this->template->embed_asset_code('admin', 'js', 'permission-js', $js);
endif;
### If No Error End ###
?>
