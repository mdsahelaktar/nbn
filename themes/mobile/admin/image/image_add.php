<?php ### Top Section Begin ### ?>
<?php echo $top;  ?>
<?php ### Top Section End ### ?>
<?php 
### If No Error Begin ###
if(!$response["event"]["error"]):?>
<div class="fullwidthform">
<?php echo form_open( '', array( 'name' => 'image_add_form', 'id' => 'image_add_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) )?> 
<ul>
<li><?php echo form_label( '<p>'._e( 'Context' ).'</p>', 'context_id' )?> <?php echo form_dropdown('context_id', $var['context_dd'], $this->input->get('context_id'), 'id="context_id" class="validate" data-display="'._e( 'Context' ).'" data-rules="required" onchange="getRelationByContext(this)"');
?> </li>

<li><?php echo form_label( '<p>'._e( 'User Relation' ).'</p>', 'relation_id' )?>  <?php echo form_dropdown('relation_id', $var['relation_dd'], '', 'id="relation_id" disabled="disabled" class="validate" data-display="'._e( 'Relation' ).'" data-rules="required"'); ?></li>
</ul>
</div>

 <div id="itemRows">
 <fieldset class="clonefieldset"><span class="otherbutton"></span>
 <legend align="center" margin="auto"> <b>Image Information</b></legend>
 <?php echo form_hidden('method', 'add'); ?>
<?php echo form_label( '<p>'._e( 'Images' ).'</p>', 'images' )?>
<div class="imageplacer"><?php echo form_upload( array( 'name' => 'image_url[]', 'placeholder' => 'add images', 'class' => 'margin-top5' ) );?></div>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Caption' ).'</p>', 'caption' )?>
<?php echo form_textarea( array( 'name' => 'caption[]', 'id' => 'caption', 'class' => 'margin-top5', 'placeholder' => 'add caption here', 'rows' => 2) );?>

<div class="clear"></div>
<div class="margin-top10"><?php echo form_label(_e( 'Is Main' ), 'main' )?></div>
<?php echo form_radio('is_main[]', '1', NULL, 'id="is_main1" '.set_radio('is_main', '1')); ?>

<div class="clear"></div>

<div class="margin-top10"><?php echo form_label( '<p>'._e( 'Alt' ).'</p>', 'alt' )?></div>
<?php echo form_input( array( 'name' => 'alt[]', 'id' => 'alt', 'placeholder' => 'alt' ) );?>
<div class="clear"></div>

 </fieldset>
<a href="#" class="more_images" onclick="return addMoreElement('#itemRows', '.otherbutton', '<fieldset class=\'clonefieldset\'>', '</fieldset>', this)">Add more image</a>
</div>    

 <div class="clear"></div>

<?php echo form_submit( array( 'name' => 'image_add', 'id' => 'image_add', 'class' => 'margin-top10' ), _e( 'Add' ) );?> <?php echo form_close()?>
<?php
$this->template->add_remove_admin_css(array('jquery-ui.css'), 'add');
$this->template->add_remove_admin_js(array('jquery-ui.js'), 'add');

$context_js = $this->load->view("web/admin/context/context_js_function.php", '', true);
$this->template->embed_asset_code('admin', 'js', 'context_js_function', $context_js);

$js = $this->template->admin_view( 'image_js', '', true, "image");
$this->template->embed_asset_code('admin', 'js', 'image-js', $js);

endif;
### If No Error End ###
?>
