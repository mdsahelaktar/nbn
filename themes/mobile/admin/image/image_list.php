<?php ### Top Section Begin ### ?>
<?php echo $top ?>
<?php ### Top Section End ### ?>
<?php ### Edit Section Begin ### 
### If No Error Begin ###
if(!$response["event"]["error"]):?>
<?php if($edit_id): ?>
<?php echo anchor( getBackUrl('edit_id'), '<span class="ion-android-system-back"></span>'._e( 'Back' ), array( 'title' => _e( 'Back to List' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left' ) )?>
<?php ### If Valid Edit Id Begin ###
	if(isset($results["records"][0]->ai_image_id)):
?>
<?php echo form_open( '', array( 'name' => 'image_edit_form', 'id' => 'image_edit_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) );
echo form_hidden('row_id', $results["records"][0]->ai_image_id); ?> 

<?php echo form_label( '<p>'._e( 'Context' ).'</p>', 'context_id' )?> 
<?php echo form_dropdown('context_id', $var['context_dd'], $results["records"][0]->context_id, 'id="context_id"  class="validate" data-display="'._e( 'Context' ).'" data-rules="required" onchange="getRelationByContext(this)"'); ?> 

<?php echo form_label( '<p>'._e( 'Relation' ).'</p>', 'relation_id' )?> 
<?php echo form_dropdown('relation_id', $var['relation_dd'], $results["records"][0]->relation_id, 'id="relation_id"  class="validate" data-display="'._e( 'Relation' ).'" data-rules="required"'); ?>
<div class="clear"></div>



<div id="itemRows">
 <fieldset class="clonefieldset"><span class="otherbutton"></span>
 <legend align="center" margin="auto"> <b>Image Information</b></legend>
 <?php echo form_hidden('method', 'edit'); ?>
 
<?php echo form_label( '<p>'._e( 'Images' ).'</p>', 'images' )?>
 <div class="imageplacer"><?php echo form_upload( array( 'name' => 'image_url[]',  'placeholder' => 'add images', 'value' => $results["records"][0]->image_url) );?>
 <img alt="" border="2%" src="<?php echo $this->template->get_frontend_image($results["records"][0]->image_url)?>" width="80px" height="60px"/>  </div>


<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Caption' ).'</p>', 'caption' )?>
<?php echo form_textarea( array( 'name' => 'caption', 'id' => 'caption', 'value' => $results["records"][0]->caption, 'placeholder' => 'add caption here', 'rows' => 2) );?>
<div class="clear"></div>

<?php echo form_label(_e( 'Is Main' ), 'main' )?>
<?php echo form_radio('is_main', '1', $results["records"][0]->is_main, 'id="is_main" '.set_radio('is_main', '1')); ?>

<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'Alt' ).'</p>', 'alt' )?>
<?php echo form_input( array( 'name' => 'alt', 'id' => 'alt', 'value' => $results["records"][0]->alt, 'placeholder' => 'alt' ) );?>
<div class="clear"></div>

 </fieldset>
</div>    

 <div class="clear"></div>


<?php echo form_submit( array( 'name' => 'image_update', 'id' => 'image_update', 'class' => 'margin-top10' ), _e( 'Update' ) );?> <?php echo form_close()?>
<?php

$this->template->add_remove_admin_css(array('jquery-ui.css'), 'add');
$this->template->add_remove_admin_js(array('jquery-ui.js'), 'add');

$js = $this->template->admin_view( 'image_js', '', true, "image");
$this->template->embed_asset_code('admin', 'js', 'image-js', $js);

$image_js = $this->load->view("web/admin/context/context_js_function.php", '', true);
$this->template->embed_asset_code('admin', 'js', 'context_js_function', $image_js);

	### If Valid Edit Id End ###
	else:
	### If Invalid Edit Id Begin ###
?>
<div class="error">
  <p><?php echo _e('No records found')?></p>
</div>
<?php
	### If Invalid Edit Id End ###
	endif;?>
<?php ### Edit Section End #### ?>
<?php else:?>
<?php ### List Section Begin ### ?>
<?php echo form_open( '', array( 'name' => 'image_search_form', 'id' => 'image_search_form', 'class' => 'width100 float-left margin-bottom30 margin-top10', 'method' => 'get' ) )?>




<table>
  <tr id="button_section">
    <td colspan="39"><?php echo anchor( 'admin/image/edit',_e( 'Reset' ), array( 'title' => _e( 'Reset' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left' ) )?> <?php echo form_button( array( 'name' => 'search', 'id' => 'search', 'class' => 'margin-top10', 'onclick' => 'return goFilter(this)' ), _e( 'Filter' ) );?></td>
  </tr>
  <tr id="caption_section">
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbycontext') ?>" class="<?php echo sortClass($var['CFG'], 'sortbycontext') ?>"><?php echo _e('Context')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbyrelation') ?>" class="<?php echo sortClass($var['CFG'], 'sortbyrelation') ?>"><?php echo _e('Relation')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbycaption') ?>" class="<?php echo sortClass($var['CFG'], 'sortbycaption') ?>"><?php echo _e('Caption')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbyimages') ?>" class="<?php echo sortClass($var['CFG'], 'sortbyimages') ?>"><?php echo _e('Images')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbymain') ?>" class="<?php echo sortClass($var['CFG'], 'sortbymain') ?>"><?php echo _e('Is Main')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbyalt') ?>" class="<?php echo sortClass($var['CFG'], 'sortbyalt') ?>"><?php echo _e('Alt')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbytime') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbytime') ?>"><?php echo _e('Time Created')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbymfdtime') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbymfdtime') ?>"><?php echo _e('Modified time')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbyactive') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbyactive') ?>"><?php echo _e('Status')?></a></th>
    <th><?php echo _e('Action')?></th>
  </tr>
  
  
  
  <tr id="filter_section">
    <td><?php echo form_input( array( 'name' => 'caption', 'id' => 'caption', 'placeholder' => 'search by caption', 'size' => 20, 'value' => $this->input->get('caption') ) );?></td>
    <td></td>
    <td></td>
    <td><?php echo form_dropdown('is_trashed', $var['filter_status_dd'], $this->input->get('is_trashed') != '' ? $this->input->get('is_trashed') : '' );
?></td>
    <td colspan="35"></td>
  </tr>
  <tr id="multiple_action_section">
    <td colspan="38"><?php echo anchor( '#', _e( 'Select All' ), array( 'title' => _e( 'Select All' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left', 'onclick' => 'return selectAll(this)' ) )?> <?php echo anchor( '#', _e( 'Unselect All' ), array( 'title' => _e( 'Unselect All' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left', 'onclick' => 'return unselectAll(this)' ) )?></td>
    <td><?php echo form_dropdown('action', $var['action_dd']); ?>

      <?php echo form_button( array( 'name' => 'go', 'id' => 'go', 'class' => 'margin-top10', 'onclick' => 'return goAction(this)' ), _e( 'Go' ) );?></td>
  </tr>
  <?php ### If Record Found Begin ### ?>
  <?php if(count($results["records"])) 
{
?>
  <?php foreach($results["records"] as $value):  ?>
  <tr>
    <td><?php echo form_checkbox('row_id[]', $value->ai_image_id);?><?php echo $value->context_id?></td>
    <td><?php echo $value->relation_id?></td>
    <td><?php echo $value->caption?></td>
     <td> <a href = "<?php echo $this->template->get_frontend_image($value->image_url)?>" rel="lightbox"/> <img alt="" border="2%" src="<?php echo $this->template->get_frontend_image($value->image_url)?>" width="40" height="30" rel="lightbox"/> </a>
    <td><?php echo $value->is_main ? _e("Yes") : _e("No")?></td>
    <td><?php echo $value->alt?></td>
    <td><?php echo $value->creation_time?></td>
    <td><?php echo $value->update_time?></td>
    <td><?php echo $value->is_trashed ? _e("Inactive") : _e("Active")?></td>
    
    <td><a href="<?php echo createEditUrl($value->ai_image_id)?>" class="ion-edit"></a>|<a href="<?php echo createRevertDeleteUrl($value->ai_image_id, $value->is_trashed)?>" class="editrevert<?php echo $value->is_trashed?>"></a></td>
    
  </tr>
  <?php endforeach;?>
  <tr>
    <td colspan="39"><?php echo $results["pagination"]?></td>
  </tr>
  
  
  
  
  
  <script type="text/javascript">
  var deleteconformstring = '<?php echo _e('Confirm delete image')?>';
  var pdeleteconformstring = '<?php echo _e('Confirm permanent delete image')?>';
  </script>
  <?php ### If Record Found End ### ?>
  <?php
}
else
{
?>
  <?php ### If No Record Found Begin ### ?>
  <tr>
    <td colspan="39"><div class="error">
        <p><?php echo _e('No records found')?></p>
      </div></td>
  </tr>
  <?php ### If No Record Found Begin ### ?>
  <?php
}?>
</table>
<?php echo form_close()?>
<?php ### List Section Begin ### ?>
<?php endif;
endif;
### If No Error End ###
?>
