<?php ### Top Section Begin ### ?>
<?php echo $top;  ?>
<?php ### Top Section End ### ?>
<?php 
### If No Error Begin ###
if(!$response["event"]["error"]):?>
<div class="formcont-small"><?php echo form_open( '', array( 'name' => 'user_category_add_form', 'id' => 'user_category_add_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) )?>
<?php echo form_label( '<p>'._e( 'User Category' ).'</p>', 'user_category' )?> 
<?php echo form_input( array( 'name' => 'user_category', 'id' => 'user_category', 'placeholder' => 'add user category here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'User Category' ), 'data-rules' => 'required') );?>

<div class="clear"></div>
<?php echo form_submit( array( 'name' => 'user_category_add', 'id' => 'user_category_add', 'class' => 'margin-top10' ), _e( 'Add' ) );?> <?php echo form_close()?></div>
<?php
$js = $this->template->admin_view( 'user_category_js', '', true, "user_category");
$this->template->embed_asset_code('admin', 'js', 'user-category-js', $js);
endif;
### If No Error End ###
?>
