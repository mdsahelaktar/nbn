<?php ### Top Section Begin ### ?>
<?php echo $top ?>
<?php ### Top Section End ### ?>
<?php ### Edit Section Begin ### 
### If No Error Begin ###
if(!$response["event"]["error"]):?>
<?php if($edit_id): ?>
<?php echo anchor( getBackUrl('edit_id'), '<span class="ion-android-system-back"></span>'._e( 'Back' ), array( 'title' => _e( 'Back to List' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left' ) )?>
<?php ### If Valid Edit Id Begin ###
	if(isset($results["records"][0]->ai_user_role_id)):
?>
<?php echo form_open( '', array( 'name' => 'user_role_edit_form', 'id' => 'user_role_edit_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) );
echo form_hidden('row_id', $results["records"][0]->ai_user_role_id);?> <?php echo form_label( '<p>'._e( 'User Category' ).'</p>', 'user_category_id' )?> <?php echo form_dropdown('user_category_id', $var['categories_dd'], $results["records"][0]->user_category_id, 'id="user_category_id" class="validate" data-display="'._e( 'User Category' ).'" data-rules="required"');
?> <?php echo form_label( '<p>'._e( 'User Role' ).'</p>', 'user_role' )?> <?php echo form_input( array( 'name' => 'user_role', 'id' => 'user_role', 'placeholder' => 'add user role here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'User Role' ), 'data-rules' => 'required', 'value' => $results["records"][0]->user_role) );?>
<div class="clear"></div>
<?php echo form_submit( array( 'name' => 'user_role_update', 'id' => 'user_role_update', 'class' => 'margin-top10' ), _e( 'Update' ) );?> <?php echo form_close()?>
<?php
$js = $this->template->admin_view( 'user_role_js', '', true, "user_role");
$this->template->embed_asset_code('admin', 'js', 'user-role-js', $js);
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
<?php echo form_open( '', array( 'name' => 'user_role_search_form', 'id' => 'user_role_search_form', 'class' => 'width100 float-left margin-bottom30 margin-top10', 'method' => 'get' ) )?>
<table>
  <tr id="button_section">
    <td colspan="6"><?php echo anchor( 'admin/user_role/edit',_e( 'Reset' ), array( 'title' => _e( 'Reset' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left' ) )?> <?php echo form_button( array( 'name' => 'search', 'id' => 'search', 'class' => 'margin-top10', 'onclick' => 'return goFilter(this)' ), _e( 'Filter' ) );?></td>
  </tr>
  <tr id="caption_section">
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbyusercategory') ?>" class="<?php echo sortClass($var['CFG'], 'sortbyusercategory') ?>"><?php echo _e('User Category')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbyuserrole') ?>" class="<?php echo sortClass($var['CFG'], 'sortbyuserrole') ?>"><?php echo _e('User Role')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbytime') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbytime') ?>"><?php echo _e('Time Created')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbymfdtime') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbymfdtime') ?>"><?php echo _e('Modified time')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbyactive') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbyactive') ?>"><?php echo _e('Status')?></a></th>
    <th><?php echo _e('Action')?></th>
  </tr>
  <tr id="filter_section">
    <td><?php echo form_dropdown('user_category', $var['categories_dd'], $this->input->get('user_category') != '' ? $this->input->get('user_category') : ''); ?></td>
    <td><?php echo form_input( array( 'name' => 'user_role', 'id' => 'user_role', 'placeholder' => 'search by user role', 'size' => 20, 'value' => $this->input->get('user_role') ) );?></td>
    <td></td>
    <td></td>
    <td><?php echo form_dropdown('is_trashed', $var['filter_status_dd'], $this->input->get('is_trashed') != '' ? $this->input->get('is_trashed') : ''); ?></td>
    <td></td>
  </tr>
  <tr id="multiple_action_section">
    <td colspan="5"><?php echo anchor( '#', _e( 'Select All' ), array( 'title' => _e( 'Select All' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left', 'onclick' => 'return selectAll(this)' ) )?> <?php echo anchor( '#', _e( 'Unselect All' ), array( 'title' => _e( 'Unselect All' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left', 'onclick' => 'return unselectAll(this)' ) )?></td>
    <td><?php echo form_dropdown('action', $var['action_dd']);
?> <?php echo form_button( array( 'name' => 'go', 'id' => 'go', 'class' => 'margin-top10', 'onclick' => 'return goAction(this)' ), _e( 'Go' ) );?></td>
  </tr>
  <?php ### If Record Found Begin ### ?>
  <?php if(count($results["records"])) 
{
?>
  <?php foreach($results["records"] as $value):?>
  <tr>
    <td><?php echo form_checkbox('row_id[]', $value->ai_user_role_id);?><?php echo $value->user_category?></td>
    <td><?php echo $value->user_role?></td>
    <td><?php echo $value->creation_time?></td>
    <td><?php echo $value->update_time?></td>
    <td><?php echo $value->is_trashed ? _e("Inactive") : _e("Active")?></td>
    <td><a href="<?php echo createEditUrl($value->ai_user_role_id)?>" class="ion-edit"></a>|<a href="<?php echo createRevertDeleteUrl($value->ai_user_role_id, $value->is_trashed)?>" class="editrevert<?php echo $value->is_trashed?>"></a></td>
  </tr>
  <?php endforeach;?>
  <tr>
    <td colspan="4"><?php echo $results["pagination"]?></td>
  </tr>
  <script type="text/javascript">
  var deleteconformstring = '<?php echo _e('Confirm delete user role')?>';
  var pdeleteconformstring = '<?php echo _e('Confirm permanent delete user role')?>';
  </script>
  <?php ### If Record Found End ### ?>
  <?php
}
else
{
?>
  <?php ### If No Record Found Begin ### ?>
  <tr>
    <td colspan="6"><div class="error">
        <p><?php echo _e('No records found')?></p>
      </div></td>
  </tr>
  <?php ### If No Record Found Begin ### ?>
  <?php
}?>
</table>
<?php echo form_close()?>
<?php ### List Section Begin ### ?>
<?php endif;?>
<?php endif;?>