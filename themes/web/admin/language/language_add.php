<?php ### Top Section Begin ### ?>
<?php echo $top;  ?>
<?php ### Top Section End ### ?>
<?php 
### If No Error Begin ###
if(!$response["event"]["error"]):?>

<div class="formcont-small"><?php echo form_open( '', array( 'name' => 'language_add_form', 'id' => 'language_add_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) )?> <?php echo form_label( '<p>'._e( 'Language' ).'</p>', 'language' )?> <?php echo form_input( array( 'name' => 'language', 'id' => 'language', 'placeholder' => 'add language here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'Language' ), 'data-rules' => 'required') );?><br /><br />
<?php echo form_label( '<p><input id="is_current" type="checkbox" value="1" name="is_current">'._e( 'Make Current Language' ).'</p>', 'is_current' )?>
<?php /*?><?php echo form_checkbox( array( 'name' => 'is_current', 'id' => 'is_current', 'value' => 1 ) );?><?php */?>
<div class="clear"></div>
<?php echo form_submit( array( 'name' => 'language_add', 'id' => 'language_add', 'class' => 'margin-top10' ), _e( 'Add' ) );?> <?php echo form_close()?></div>
<?php
$js = $this->template->admin_view( 'language_js', '', true, "language");
$this->template->embed_asset_code('admin', 'js', 'language-js', $js);
?>
<?php endif;?>
