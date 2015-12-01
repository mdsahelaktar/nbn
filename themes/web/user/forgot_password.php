<div id="body">
  <div class="wrapper">
    <div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
    <div msg="user"></div>
	<div class="forgot_password">
    	<div class="formwrap"> 
			<?php echo form_open('', array('name' => 'forgot_password_form', 'id' => 'forgot_password_form', 'class' => 'width100')) ?> 
            	<ul>
                    <li><?php echo form_label('<p>' . _e('user_name_email') . '</p>', 'user_name_email') ?> <?php echo form_input(array('name' => 'user_name_email', 'id' => 'user_name_email', 'placeholder' => 'Check user name/email here', 'class' => 'validate', 'data-display' => _e('user_name_email'), 'data-rules' => 'required')); ?></li>
                    <li><?php echo form_submit(array('name' => 'forgot_password', 'id' => 'forgot_password', 'class' => 'margin-top25'), _e('check_user_name_email')); ?></li>
            </ul>
            <?php echo form_close() ?>
    	</div>
    </div>
    </div>
  </div>
</div>
<!--body end-->
<?php
$user_js_function = $this->load->view("web/admin/user/user_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'user_js_function', $user_js_function);
    
$user_js = $this->template->frontend_view('user_js', '', true, "user");
$this->template->embed_asset_code('frontend', 'js', 'user_js', $user_js);