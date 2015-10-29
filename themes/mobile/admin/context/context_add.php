<?php ### Top Section Begin ### ?>
<?php echo $top;  ?>
<?php ### Top Section End ### ?>
<?php 
### If No Error Begin ###
if(!$response["event"]["error"]):?>
<?php echo form_open( '', array( 'name' => 'context_add_form', 'id' => 'context_add_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) )?>
<?php echo form_label( '<p>'._e( 'Context' ).'</p>', 'context' )?> 
<?php echo form_input( array( 'name' => 'context', 'id' => 'context', 'placeholder' => 'add context here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'Context' ), 'data-rules' => 'required') );?>

<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Description' ).'</p>', 'description' )?>
<?php echo form_textarea( array( 'name' => 'description', 'id' => 'description', 'placeholder' => 'add description here', 'class' => 'validate', 'data-display' =>  _e( 'Description' ), 'rows' => 5, 'data-rules' => 'required') );?>


<div class="clear"></div>
<?php echo form_submit( array( 'name' => 'context_add', 'id' => 'context_add', 'class' => 'margin-top10' ), _e( 'Add' ) );?> <?php echo form_close()?>
<?php
$js = $this->template->admin_view( 'context_js', '', true, "context");
$this->template->embed_asset_code('admin', 'js', 'context-js', $js);
endif;
### If No Error End ###
?>
