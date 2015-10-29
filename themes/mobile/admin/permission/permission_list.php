<?php ### Top Section Begin ### ?>
<?php  echo $top ?>
<?php ### Top Section End ### ?>
<?php ### Edit Section Begin ### 
### If No Error Begin ###
if(!$response["event"]["error"]):?>

<?php if($edit_id): ?>
<?php echo anchor( getBackUrl('edit_id'), '<span class="ion-android-system-back"></span>'._e( 'Back' ), array( 'title' => _e( 'Back to List' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left' ) )?>
<?php ### If Valid Edit Id Begin ###
	if(isset($results["records"][0]->ai_permission_id)):
?>
<?php echo form_open( '', array( 'name' => 'permission_edit_form', 'id' => 'permission_edit_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) );
echo form_hidden('row_id', $results["records"][0]->ai_permission_id);?> <?php echo form_label( '<p>'._e( 'Permission Group' ).'</p>', 'group_id' )?> <?php echo form_dropdown('group_id', $var['permissions_dd'], $results["records"][0]->group_id, 'id="group_id" class="validate" data-display="'._e( 'Permission Group' ).'" data-rules="required"');
?> <?php echo form_label( '<p>'._e( 'Permission' ).'</p>', 'permission' )?> <?php echo form_input( array( 'name' => 'permission', 'id' => 'permission', 'placeholder' => 'add permission here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'Permission' ), 'data-rules' => 'required', 'value' => $results["records"][0]->permission) );?>
<div class="clear"></div>
<?php echo form_submit( array( 'name' => 'permission_update', 'id' => 'permission_update', 'class' => 'margin-top10' ), _e( 'Update' ) );?> <?php echo form_close()?>
<?php
$js = $this->template->admin_view( 'permission_js', '', true, "permission");
$this->template->embed_asset_code('admin', 'js', 'permission-js', $js);
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
<?php echo form_open( '', array( 'name' => 'permission_search_form', 'id' => 'permission_search_form', 'class' => 'width100 float-left margin-bottom30 margin-top10', 'method' => 'get' ) )?>
<table>
  <tr id="button_section">
    <td colspan="6"><?php echo anchor( 'admin/permission/edit',_e( 'Reset' ), array( 'title' => _e( 'Reset' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left' ) )?> <?php echo form_button( array( 'name' => 'search', 'id' => 'search', 'class' => 'margin-top10', 'onclick' => 'return goFilter(this)' ), _e( 'Filter' ) );?></td>
  </tr>
  <tr id="caption_section">
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbygroup') ?>" class="<?php echo sortClass($var['CFG'], 'sortbygroup') ?>"><?php echo _e('Permission Group')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbypermission') ?>" class="<?php echo sortClass($var['CFG'], 'sortbypermission') ?>"><?php echo _e('Permission')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbytime') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbytime') ?>"><?php echo _e('Time Created')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbymfdtime') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbymfdtime') ?>"><?php echo _e('Modified time')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbyactive') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbyactive') ?>"><?php echo _e('Status')?></a></th>
    <th><?php echo _e('Action')?></th>
  </tr>
  <tr id="filter_section">
    <td><?php echo form_dropdown('permission_group', $var['permissions_dd'], $this->input->get('permission_group') != '' ? $this->input->get('permission_group') : ''); ?></td>
    <td><?php echo form_input( array( 'name' => 'permission', 'id' => 'permission', 'placeholder' => 'search by permission', 'size' => 20, 'value' => $this->input->get('permission') ) );?></td>
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
    <td><?php echo form_checkbox('row_id[]', $value->ai_permission_id);?><?php echo $value->group?></td>
    <td><?php echo $value->permission?></td>
    <td><?php echo $value->creation_time?></td>
    <td><?php echo $value->update_time?></td>
    <td><?php echo $value->is_trashed ? _e("Inactive") : _e("Active")?></td>
    <td><a href="<?php echo createEditUrl($value->ai_permission_id)?>" class="ion-edit"></a>|<a href="<?php echo createRevertDeleteUrl($value->ai_permission_id, $value->is_trashed)?>" class="editrevert<?php echo $value->is_trashed?>"></a></td>
  </tr>
  <?php endforeach;?>
  <tr>
    <td colspan="4"><?php echo $results["pagination"]?></td>
  </tr>
  <script type="text/javascript">
  var deleteconformstring = '<?php echo _e('Confirm delete permission')?>';
  var pdeleteconformstring = '<?php echo _e('Confirm permanent delete permission')?>';
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