<?php echo renderResposeMessage('login', $response) ?><?php echo form_open( '', array( 'name' => 'login_form', 'id' => 'login_form' ) )?>
<ul>
  <li> <?php echo form_label( '<p><strong>'._e( 'user_name_email' ).'</strong></p>', 'user_name' )?> <?php echo form_input( array( 'name' => 'user_name', 'id' => 'user_name', 'placeholder' => 'user or user@email.com', 'class' => 'validate', 'data-display' =>  _e( 'user_name_email' ), 'data-rules' => 'required') );?> </li>
  <li> <?php echo form_label( '<p><strong>'._e( 'password' ).'</strong></p>', 'password' )?> <?php echo form_password( array( 'name' => 'password', 'id' => 'password', 'placeholder' => '****************', 'class' => 'validate', 'data-display' =>  _e( 'password' ), 'data-rules' => 'required' ) );?> </li>
  <li> <?php echo form_submit( array( 'name' => 'submit', 'id' => 'submit' ), _e( 'login' ) );?> <?php echo form_label( _e( 'remember_my_passsword' ), 'remember', array( "class" => "type1" ) )?> <?php echo form_checkbox( array( 'name' => 'remember', 'id' => 'remember' ), 1, TRUE )?> </li>
  <?php echo form_hidden('next', 'biz_listing/secondstep')?>
  <li> <?php echo anchor( "user/forgot_password", _e( 'forgot_your_password' ), array( 'class' => 'forgot_password' ) )?> </li>
</ul>
<?php echo form_close()?>
<?php
$js = $this->template->admin_view( 'login_js', '', true, "login");
$this->template->embed_asset_code('admin', 'js', 'login-js', $js);

$js_function = $this->template->admin_view( 'login_js_function', '', true, "login");
$this->template->embed_asset_code('admin', 'js', 'login-js-function', $js_function);
### If No Error End ###
?>
