<br />
<br />
<br />
<br />
<br />
<br />
<br />
<?php 
### If No Error Begin ###
if(!$response["event"]["error"]):?>
<div id="body">
  <div class="wrapper">
  <?php if($_GET['ct'] == 8 && $_GET['rl'] == 1)
  {
  ?>
    	<h2>Seller Registration</h2>
   <?php
  }
  elseif($_GET['ct'] == 10 && $_GET['rl'] == 1)
  {
  ?>
  		<h2>Broker Registration</h2>
  <?php
  }
  ?>
    <div msg="user"></div>
    <?php echo form_open( '', array( 'name' => 'user_add_form', 'id' => 'user_add_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) )?> <?php echo form_label( '<p><strong>'._e( 'User Name' ).'</strong></p>', 'user_name' )?> <?php echo form_input( array( 'name' => 'user_name', 'id' => 'user_name', 'placeholder' => 'add user name here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'User Name' ), 'data-rules' => 'required') );?>
    <div class="clear"></div>
    <?php echo form_label( '<p><strong>'._e( 'Email' ).'</strong></p>', 'email' )?> <?php echo form_input( array( 'name' => 'email', 'id' => 'email', 'placeholder' => 'add email here', 'class' => 'validate', 'data-display' =>  _e( 'Email' ), 'data-rules' => 'required|valid_email') );?>
    <div class="clear"></div>
    <?php echo form_label( '<p><strong>'._e( 'Password' ).'</strong></p>', 'password' )?> <?php echo form_password( array( 'name' => 'password', 'id' => 'password', 'class' => 'validate', 'data-display' =>  _e( 'Password' ), 'data-rules' => 'required|matches[passconf]') );?>
    <div class="clear"></div>
    <?php echo form_label( '<p><strong>'._e( 'Confirm Password' ).'</strong></p>', 'passconf' )?> <?php echo form_password( array( 'name' => 'passconf', 'id' => 'passconf', 'class' => 'validate', 'data-display' =>  _e( 'Confirm Password' ), 'data-rules' => 'required') );?>
    <div class="clear"></div>
    <?php echo form_label( '<p>'._e( 'Salutation' ).'</p>', 'salutation' )?> <?php echo form_input( array( 'name' => 'salutation', 'id' => 'salutation', 'placeholder' => 'add salutation here') );?>
    <div class="clear"></div>
    <?php echo form_label( '<p>'._e( 'First Name' ).'</p>', 'first_name' )?> <?php echo form_input( array( 'name' => 'first_name', 'id' => 'first_name', 'placeholder' => 'add first name here') );?>
    <div class="clear"></div>
    <?php echo form_label( '<p>'._e( 'Last Name' ).'</p>', 'last_name' )?> <?php echo form_input( array( 'name' => 'last_name', 'id' => 'last_name', 'placeholder' => 'add last name here') );?>
    <div class="clear"></div>
    <?php echo form_label( '<p>'._e( 'Middle Name' ).'</p>', 'middle_name' )?> <?php echo form_input( array( 'name' => 'middle_name', 'id' => 'middle_name', 'placeholder' => 'add middle name here') );?>
    <div class="clear"></div>
    <?php echo form_label( '<p>'._e( 'Work Phone No' ).'</p>', 'work_phone_no' )?> <?php echo form_input( array( 'name' => 'work_phone_no', 'id' => 'work_phone_no', 'placeholder' => 'add phone no[w] here') );?>
    <div class="clear"></div>
    <?php echo form_label( '<p>'._e( 'Mobile Phone No' ).'</p>', 'mobile_phone_no' )?> <?php echo form_input( array( 'name' => 'mobile_phone_no', 'id' => 'mobile_phone_no', 'placeholder' => 'add mobile no here') );?>
    <div class="clear"></div>
    <?php echo form_label( '<p>'._e( 'Fax Number' ).'</p>', 'fax_num' )?> <?php echo form_input( array( 'name' => 'fax_num', 'id' => 'fax_num', 'placeholder' => 'add fax no here') );?>
    <div class="clear"></div>
    <?php $cat_id = $_GET['ct']; ?>
    <?php $role_id = $_GET['rl']; ?>
    <?php echo form_hidden('user_category_id', $cat_id); ?> <?php echo form_hidden('user_role_id', $role_id); ?> <?php echo form_submit( array( 'name' => 'user_add', 'id' => 'user_add', 'class' => 'margin-top10' ), _e( 'Add' ) );?> <?php echo form_close()?>
    <div id="loggedin_cont" class="login">Already a member? <?php echo anchor('login/', _e('Log In'))?></div>
  </div>
</div>
<?php
$user_js = $this->template->frontend_view( 'user_js', '', true, "user");
$this->template->embed_asset_code('frontend', 'js', 'user-js', $user_js);

$biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);
endif;
?>