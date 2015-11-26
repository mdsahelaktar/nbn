<div id="body">
  <div class="wrapper">
    <div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
      <div class="width60 float-left">
        <div class="float-left margin-left355 margin-top20"> <?php echo renderResposeMessage('login', $response) ?><?php echo form_open( '', array( 'name' => 'login_form', 'id' => 'login_form' ) )?>
          <ul>
            <li> <?php echo form_label( '<p><strong>'._e( 'User Name/Email Address' ).'</strong></p>', 'user_name' )?> <?php echo form_input( array( 'name' => 'user_name', 'id' => 'user_name', 'placeholder' => 'user or user@email.com', 'class' => 'validate', 'data-display' =>  _e( 'User Name/Email Address' ), 'data-rules' => 'required') );?> </li>
            <li> <?php echo form_label( '<p><strong>'._e( 'Password' ).'</strong></p>', 'password' )?> <?php echo form_password( array( 'name' => 'password', 'id' => 'password', 'placeholder' => '****************', 'class' => 'validate', 'data-display' =>  _e( 'Password' ), 'data-rules' => 'required' ) );?> </li>
            <li> <?php echo form_submit( array( 'name' => 'submit', 'id' => 'submit' ), _e( 'Login' ) );?> <?php echo form_label( _e( 'Remember my passsword' ), 'remember', array( "class" => "type1" ) )?> <?php echo form_checkbox( array( 'name' => 'remember', 'id' => 'remember' ), 1, TRUE )?> </li>
            <?php echo form_hidden('next', $next)?>
            <li> <?php echo anchor( current_url().'#', _e( 'Forgot Your Password' ), array( 'class' => 'forgot_password' ) )?> </li>
          </ul>
          <?php echo form_close()?>
          <?php
		$js = $this->template->admin_view( 'login_js', '', true, "login");
		$this->template->embed_asset_code('frontend', 'js', 'login_js', $js);
		
		$js_function = $this->template->admin_view( 'login_js_function', '', true, "login");
		$this->template->embed_asset_code('frontend', 'js', 'login_js_function', $js_function);
		### If No Error End ###
?>
          Don't have an account? <span class="registerbtn"><?php echo anchor( $register_link, _e( 'Register' ), array( 'title' => _e( 'Register' ) ) )?></span> </div>
      </div>
      <div class="width320 float-right"> </div>
    </div>
  </div>
</div>
<?php
$biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);
?>
