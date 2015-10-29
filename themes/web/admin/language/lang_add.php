<?php 
ob_start();  
?>
<?php echo form_open( '', array( 'name' => 'language_add_form', 'id' => 'language_add_form', 'class' => 'width100 float-left margin-bottom30 margin-top10', 'onsubmit'=>"return addLanguageFormVal();" ) )?>
<?php echo form_label( '<p>'._e( 'Language' ).'</p>', 'language' )?> 
<?php echo form_input( array( 'name' => 'language_val', 'id' => 'language_val', 'placeholder' => 'add language here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'Language Add' ), 'data-rules' => 'required') );?><br /><br />
<div class="clear"></div>
<?php echo form_submit( array( 'name' => 'language_add', 'id' => 'language_add', 'class' => 'margin-top10' ), _e( 'Add' ) );?> <?php echo form_close()?>
<?php
echo ob_get_clean(); 
?>
<?php
$js = $this->template->admin_view( 'language_js', '', true, "language");
$this->template->embed_asset_code('admin', 'js', 'language-js', $js);
?>

  
   