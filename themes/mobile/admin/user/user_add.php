<?php ### Top Section Begin ### ?>
<?php echo $top;  ?>
<?php ### Top Section End ### ?>
<?php 
### If No Error Begin ###
if(!$response["event"]["error"]):?>
<?php echo form_open( '', array( 'name' => 'user_add_form', 'id' => 'user_add_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) )?> 

<?php echo form_label( '<p>'._e( 'User Name' ).'</p>', 'user_name' )?> 
<?php echo form_input( array( 'name' => 'user_name', 'id' => 'user_name', 'placeholder' => 'add user name here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'User Name' ), 'data-rules' => 'required') );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'Email' ).'</p>', 'email' )?> 
<?php echo form_input( array( 'name' => 'email', 'id' => 'email', 'placeholder' => 'add email here', 'class' => 'validate', 'data-display' =>  _e( 'Email' ), 'data-rules' => 'required|valid_email') );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'Password' ).'</p>', 'password' )?> 
<?php echo form_password( array( 'name' => 'password', 'id' => 'password', 'class' => 'validate', 'data-display' =>  _e( 'Password' ), 'data-rules' => 'required|matches[passconf]') );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'Confirm Password' ).'</p>', 'passconf' )?> 
<?php echo form_password( array( 'name' => 'passconf', 'id' => 'passconf', 'class' => 'validate', 'data-display' =>  _e( 'Confirm Password' ), 'data-rules' => 'required') );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'Salutation' ).'</p>', 'salutation' )?> 
<?php echo form_input( array( 'name' => 'salutation', 'id' => 'salutation', 'placeholder' => 'add salutation here') );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'First Name' ).'</p>', 'first_name' )?> 
<?php echo form_input( array( 'name' => 'first_name', 'id' => 'first_name', 'placeholder' => 'add first name here') );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'Last Name' ).'</p>', 'last_name' )?> 
<?php echo form_input( array( 'name' => 'last_name', 'id' => 'last_name', 'placeholder' => 'add last name here') );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'Middle Name' ).'</p>', 'middle_name' )?> 
<?php echo form_input( array( 'name' => 'middle_name', 'id' => 'middle_name', 'placeholder' => 'add middle name here') );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'Work Phone No' ).'</p>', 'work_phone_no' )?> 
<?php echo form_input( array( 'name' => 'work_phone_no', 'id' => 'work_phone_no', 'placeholder' => 'add phone no[w] here') );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'Mobile Phone No' ).'</p>', 'mobile_phone_no' )?> 
<?php echo form_input( array( 'name' => 'mobile_phone_no', 'id' => 'mobile_phone_no', 'placeholder' => 'add mobile no here') );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'Fax Number' ).'</p>', 'fax_num' )?> 
<?php echo form_input( array( 'name' => 'fax_num', 'id' => 'fax_num', 'placeholder' => 'add fax no here') );?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'User Category' ).'</p>', 'user_category_id' )?> 
<?php echo form_dropdown('user_category_id', $var['categories_dd'], '', 'id="user_category_id" class="validate" data-display="'._e( 'User Category' ).'" data-rules="required" onchange="getUserRoleByUserCat(this)"'); ?>
<div class="clear"></div>

<?php echo form_label( '<p>'._e( 'User Role' ).'</p>', 'user_role_id' )?>  <?php echo form_dropdown('user_role_id', $var['roles_dd'], '', 'id="user_role_id" disabled="disabled" class="validate" data-display="'._e( 'User Role' ).'" data-rules="required"'); ?>
<div class="clear"></div>
<?php echo form_hidden('parent_id', $this->login["user_id"]); ?>
<?php echo form_submit( array( 'name' => 'user_add', 'id' => 'user_add', 'class' => 'margin-top10' ), _e( 'Add' ) );?> <?php echo form_close()?>
<?php
$js = $this->template->admin_view( 'user_js', '', true, "user");
$this->template->embed_asset_code('admin', 'js', 'user-role-js', $js);

$user_role_js = $this->load->view("web/admin/user_role/user_role_js_function.php", '', true);
$this->template->embed_asset_code('admin', 'js', 'user_role_js_function', $user_role_js);
endif;

?>
