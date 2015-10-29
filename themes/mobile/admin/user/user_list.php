<?php ### Top Section Begin ### ?>
<?php echo $top ?>
<?php ### Top Section End ### ?>
<?php ### Edit Section Begin ### 
### If No Error Begin ###
if(!$response["event"]["error"]):?>
<?php if($edit_id): ?>
<?php echo anchor( getBackUrl('edit_id'), '<span class="ion-android-system-back"></span>'._e( 'Back' ), array( 'title' => _e( 'Back to List' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left' ) )?>
<?php ### If Valid Edit Id Begin ###
	if(isset($results["records"][0]->ai_user_id)):
?>
<?php echo form_open( '', array( 'name' => 'user_edit_form', 'id' => 'user_edit_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) );
echo form_hidden('row_id', $results["records"][0]->ai_user_id);?> 

<?php echo form_label( '<p>'._e( 'User Name' ).'</p>', 'user_name' )?> 
<?php echo form_input( array( 'name' => 'user_name', 'id' => 'user_name', 'placeholder' => 'add user name here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'User Name' ), 'value' => $results["records"][0]->user_name,  'data-rules' => 'required') );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'Email' ).'</p>', 'email' )?> 
<?php echo form_input( array( 'name' => 'email', 'id' => 'email', 'placeholder' => 'add email here', 'class' => 'validate', 'data-display' =>  _e( 'Email' ), 'value' => $results["records"][0]->email, 'data-rules' => 'required|valid_email') );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'Password' ).'</p>', 'password' )?> 
<?php echo form_password( array( 'name' => 'password', 'id' => 'password', 'class' => 'validate', 'data-display' =>  _e( 'Password' ), 'data-rules' => 'required|matches[passconf]') );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'Confirm Password' ).'</p>', 'passconf' )?> 
<?php echo form_password( array( 'name' => 'passconf', 'id' => 'passconf', 'class' => 'validate', 'data-display' =>  _e( 'Confirm Password' ), 'data-rules' => 'required') );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'Salutation' ).'</p>', 'salutation' )?> 
<?php echo form_input( array( 'name' => 'salutation', 'id' => 'salutation', 'value' => $results["records"][0]->salutation) );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'First Name' ).'</p>', 'first_name' )?> 
<?php echo form_input( array( 'name' => 'first_name', 'id' => 'first_name', 'value' => $results["records"][0]->first_name) );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'Last Name' ).'</p>', 'last_name' )?> 
<?php echo form_input( array( 'name' => 'last_name', 'id' => 'last_name', 'value' => $results["records"][0]->last_name) );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'Middle Name' ).'</p>', 'middle_name' )?> 
<?php echo form_input( array( 'name' => 'middle_name', 'id' => 'middle_name', 'value' => $results["records"][0]->middle_name) );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'Work Phone No' ).'</p>', 'work_phone_no' )?> 
<?php echo form_input( array( 'name' => 'work_phone_no', 'id' => 'work_phone_no', 'value' => $results["records"][0]->work_phone_no) );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'Mobile Phone No' ).'</p>', 'mobile_phone_no' )?> 
<?php echo form_input( array( 'name' => 'mobile_phone_no', 'id' => 'mobile_phone_no', 'value' => $results["records"][0]->mobile_phone_no) );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'Fax Number' ).'</p>', 'fax_num' )?> 
<?php echo form_input( array( 'name' => 'fax_num', 'id' => 'fax_num', 'value' => $results["records"][0]->fax_num) );?>

<div class="clear"></div>
<?php echo form_hidden('user_category_id', 1); ?>
<?php echo form_hidden('user_role_id', 2); ?>
<?php echo form_hidden('parent_id', $results["records"][0]->parent_id); ?>
<?php echo form_submit( array( 'name' => 'user_update', 'id' => 'user_update', 'class' => 'margin-top10' ), _e( 'Update' ) );?> <?php echo form_close()?>
<?php
$js = $this->template->admin_view( 'user_js', '', true, "user");
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
<?php echo form_open( '', array( 'name' => 'user_search_form', 'id' => 'user_search_form', 'class' => 'width100 float-left margin-bottom30 margin-top10', 'method' => 'get' ) )?>
<table>
  <tr id="button_section">
    <td colspan="13"><?php echo anchor( 'admin/user/edit',_e( 'Reset' ), array( 'title' => _e( 'Reset' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left' ) )?> <?php echo form_button( array( 'name' => 'search', 'id' => 'search', 'class' => 'margin-top10', 'onclick' => 'return goFilter(this)' ), _e( 'Filter' ) );?></td>
  </tr>
  <tr id="caption_section">
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbyusername') ?>" class="<?php echo sortClass($var['CFG'], 'sortbyusername') ?>"><?php echo _e('User Name')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbyemail') ?>" class="<?php echo sortClass($var['CFG'], 'sortbyemail') ?>"><?php echo _e('Email')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbysalutation') ?>" class="<?php echo sortClass($var['CFG'], 'sortbysalutation') ?>"><?php echo _e('Salutation')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbyfirstname') ?>" class="<?php echo sortClass($var['CFG'], 'sortbyfirstname') ?>"><?php echo _e('First Name')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbymiddlename') ?>" class="<?php echo sortClass($var['CFG'], 'sortbymiddlename') ?>"><?php echo _e('Middle Name')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbylastname') ?>" class="<?php echo sortClass($var['CFG'], 'sortbylastname') ?>"><?php echo _e('Last Name')?></a></th>
    <th><?php echo _e('Work Phone No')?></th>
    <th><?php echo _e('Mobile Phone No')?></th>
    <th><?php echo _e('Fax No')?></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbytime') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbytime') ?>"><?php echo _e('Time Created')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbymfdtime') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbymfdtime') ?>"><?php echo _e('Modified time')?></a></th>
    <th><a href="<?php echo sortBy($var['CFG'], 'sortbyactive') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbyactive') ?>"><?php echo _e('Status')?></a></th>
    <th><?php echo _e('Action')?></th>
  </tr>
  <tr id="filter_section">
    <td><?php echo form_input( array( 'name' => 'uname', 'id' => 'uname', 'placeholder' => 'search by user name', 'size' => 20, 'value' => $this->input->get('uname') ) );?></td>
    <td><?php echo form_input( array( 'name' => 'email', 'id' => 'email', 'placeholder' => 'search by email', 'size' => 20, 'value' => $this->input->get('email') ) );?></td>
    <td><?php echo form_input( array( 'name' => 'slt', 'id' => 'slt', 'placeholder' => 'search by salutation', 'size' => 20, 'value' => $this->input->get('slt') ) );?></td>
    <td><?php echo form_input( array( 'name' => 'fname', 'id' => 'fname', 'placeholder' => 'search by first name', 'size' => 20, 'value' => $this->input->get('fname') ) );?></td>
    <td><?php echo form_input( array( 'name' => 'mname', 'id' => 'mname', 'placeholder' => 'search by middle name', 'size' => 20, 'value' => $this->input->get('mname') ) );?></td>
    <td><?php echo form_input( array( 'name' => 'lname', 'id' => 'lname', 'placeholder' => 'search by last name', 'size' => 20, 'value' => $this->input->get('lname') ) );?></td>
    <td><?php echo form_input( array( 'name' => 'wpn', 'id' => 'wpn', 'placeholder' => 'search by work phone no', 'size' => 20, 'value' => $this->input->get('wpn') ) );?></td>
    <td><?php echo form_input( array( 'name' => 'mpn', 'id' => 'mpn', 'placeholder' => 'search by mobile phone no', 'size' => 20, 'value' => $this->input->get('mpn') ) );?></td>
    <td><?php echo form_input( array( 'name' => 'fnum', 'id' => 'fnum', 'placeholder' => 'search by fax no', 'size' => 20, 'value' => $this->input->get('fnum') ) );?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php echo form_dropdown('is_trashed', $var['filter_status_dd'], $this->input->get('is_trashed') != '' ? $this->input->get('is_trashed') : ''); ?></td>
    <td></td>
  </tr>
  <tr id="multiple_action_section">
    <td colspan="12"><?php echo anchor( '#', _e( 'Select All' ), array( 'title' => _e( 'Select All' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left', 'onclick' => 'return selectAll(this)' ) )?> <?php echo anchor( '#', _e( 'Unselect All' ), array( 'title' => _e( 'Unselect All' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left', 'onclick' => 'return unselectAll(this)' ) )?></td>
    <td><?php echo form_dropdown('action', $var['action_dd']);
?> <?php echo form_button( array( 'name' => 'go', 'id' => 'go', 'class' => 'margin-top10', 'onclick' => 'return goAction(this)' ), _e( 'Go' ) );?></td>
  </tr>
  <?php ### If Record Found Begin ### ?>
  <?php if(count($results["records"])) 
{
?>
  <?php foreach($results["records"] as $value):?>
  <tr>
    <td><?php echo form_checkbox('row_id[]', $value->ai_user_id);?><?php echo $value->user_name?></td>
    <td><?php echo $value->email?></td>
    <td><?php echo $value->salutation?></td>
    <td><?php echo $value->first_name?></td>
    <td><?php echo $value->middle_name?></td>
    <td><?php echo $value->last_name?></td>
    <td><?php echo $value->work_phone_no?></td>
    <td><?php echo $value->mobile_phone_no?></td>
    <td><?php echo $value->fax_num?></td>
    <td><?php echo $value->creation_time?></td>
    <td><?php echo $value->update_time?></td>
    <td><?php echo $value->disable ? _e("Inactive") : _e("Active")?></td>
    <td><a href="<?php echo createEditUrl($value->ai_user_id)?>" class="ion-edit"></a>|<a href="<?php echo createRevertDeleteUrl($value->ai_user_id, $value->disable)?>" class="editrevert<?php echo $value->disable?>"></a></td>
  </tr>
  <?php endforeach;?>
  <tr>
    <td colspan="13"><?php echo $results["pagination"]?></td>
  </tr>
  <script type="text/javascript">
  var deleteconformstring = '<?php echo _e('Confirm delete user')?>';
  var pdeleteconformstring = '<?php echo _e('Confirm permanent delete user')?>';
  </script>
  <?php ### If Record Found End ### ?>
  <?php
}
else
{
?>
  <?php ### If No Record Found Begin ### ?>
  <tr>
    <td colspan="13"><div class="error">
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