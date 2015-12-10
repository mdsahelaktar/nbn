<?php ### Top Section Begin ### ?>
<?php echo $top;  ?>
<?php ### Top Section End ### ?>
<?php 
### If No Error Begin ###
if(!$response["event"]["error"]):?>
<div class="formcont-small"><?php echo form_open( '', array( 'name' => 'package_add_form', 'id' => 'package_add_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) )?>
<?php echo form_label( '<p>'._e( 'Context' ).'</p>', 'context_id' )?> <?php echo form_dropdown('context_id', $var['context_dd'], $this->input->get('context_id'), 'id="context_id" class="validate" data-display="'._e( 'Context' ).'" data-rules="required"');
?>
<?php echo form_label( '<p>'._e( 'Package' ).'</p>', 'package' )?><?php echo form_input( array( 'name' => 'package', 'id' => 'package', 'placeholder' => 'add package here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'Package' ), 'data-rules' => 'required') );?>
<?php echo form_label( '<p>'._e( 'Description' ).'</p>', 'description' )?><?php echo form_textarea( array( 'name' => 'description', 'id' => 'description', 'placeholder' => 'add package description here', 'class' => 'validate', 'data-display' =>  _e( 'Package Description' ), 'data-rules' => 'required') );?>
<?php echo form_label( '<p>'._e( 'Amount' ).'</p>', 'amount' )?><?php echo form_input( array( 'name' => 'amount', 'id' => 'amount', 'placeholder' => 'add amount here', 'class' => 'validate', 'data-display' =>  _e( 'Amount' ), 'data-rules' => 'required') );?>
<?php echo form_label( '<p>'._e( 'Validity In Month' ).'</p>', 'vim' )?><?php echo form_input( array( 'name' => 'vim', 'id' => 'vim', 'placeholder' => 'add validity here', 'class' => 'validate', 'data-display' =>  _e( 'Validity In Month' ), 'data-rules' => 'required') );?>
<div class="clear"></div>
<?php echo form_submit( array( 'name' => 'package_add', 'id' => 'package_add', 'class' => 'margin-top10' ), _e( 'Add' ) );?> <?php echo form_close()?></div>
<?php
$js = $this->template->admin_view( 'package_js', '', true, "package");
$this->template->embed_asset_code('admin', 'js', 'package-js', $js);
endif;
### If No Error End ###
?>
