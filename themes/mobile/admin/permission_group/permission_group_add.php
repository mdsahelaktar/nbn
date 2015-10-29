<?php ### Top Section Begin ### ?>
<?php echo $top;  ?>
<?php ### Top Section End ### ?>
<?php 
### If No Error Begin ###
if(!$response["event"]["error"]):?>
<?php echo form_open( '', array( 'name' => 'permission_group_add_form', 'id' => 'permission_group_add_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) )?> <?php echo form_label( '<p>'._e( 'Permission Group' ).'</p>', 'group' )?> <?php echo form_input( array( 'name' => 'group', 'id' => 'group', 'placeholder' => 'add permission group here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'Permission Group' ), 'data-rules' => 'required') );?>
<div class="clear"></div>
<?php echo form_submit( array( 'name' => 'permission_group_add', 'id' => 'permission_group_add', 'class' => 'margin-top10' ), _e( 'Add' ) );?> <?php echo form_close()?>
<?php
$js = $this->template->admin_view( 'permission_group_js', '', true, "permission_group");
$this->template->embed_asset_code('admin', 'js', 'permission-group-js', $js);
endif;
### If No Error End ###
?>
