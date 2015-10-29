<?php ### Top Section Begin ### ?>
<?php echo $top;  ?>
<?php ### Top Section End ### ?>
<?php 
### If No Error Begin ###
if(!$response["event"]["error"]):?>

<?php echo form_open( '', array( 'name' => 'theme_add_form', 'id' => 'theme_add_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) )?> <?php echo form_label( '<p>'._e( 'Theme' ).'</p>', 'theme' )?> <?php echo form_input( array( 'name' => 'theme', 'id' => 'theme', 'placeholder' => 'add theme here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'Theme' ), 'data-rules' => 'required') );?><br /><br />
<?php echo form_label( '<p>'._e( 'Make Current Theme' ).'</p>', 'is_current' )?>
<?php echo form_checkbox( array( 'name' => 'is_current', 'id' => 'is_current', 'value' => 1 ) );?>
<div class="clear"></div>
<?php echo form_submit( array( 'name' => 'theme_add', 'id' => 'theme_add', 'class' => 'margin-top10' ), _e( 'Add' ) );?> <?php echo form_close()?>
<?php
$js = $this->template->admin_view( 'theme_js', '', true, "theme");
$this->template->embed_asset_code('admin', 'js', 'theme-js', $js);
endif;
### If No Error End ###

?>
