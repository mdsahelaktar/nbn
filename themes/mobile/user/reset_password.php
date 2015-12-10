<div id="body">
  <div class="wrapper">
    <div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
      <?php if( $response['event'] ):?>
      <?php echo renderResposeMessage( 'user', array( 'event' => $response['event'], 'msg' => $response['msg'] ) ); ?>
      <?php else:?>
      <div msg="user"></div>
      <div class="reset_password"> 
      <div class="formwrap">		 
         <?php echo form_open('', array('name' => 'reset_password_form', 'id' => 'reset_password_form', 'class' => 'width100')) ?> 
         	<ul>
              <li><?php echo form_label('<p>' . _e('new_password') . '</p>', 'password') ?> <?php echo form_password(array('name' => 'password', 'id' => 'password', 'class' => 'validate', 'data-display' => _e('new_password'), 'data-rules' => 'required|strict_password|matches[passconf]')); ?></li> 
              <li><?php echo form_label('<p>' . _e('confirm_password') . '</p>', 'passconf') ?> <?php echo form_password(array('name' => 'passconf', 'id' => 'passconf', 'class' => 'validate', 'data-display' => _e('confirm_password'), 'data-rules' => 'required')); ?></li>
              <?php echo form_hidden('row_id', $user_id); ?>
              <li><?php echo form_submit(array('name' => 'reset_password', 'id' => 'reset_password', 'class' => 'margin-top35'), _e('reset_password')); ?></li>       </ul>
              <?php echo form_close() ?> 
         </div>
      </div>
      <?php
	  $user_js_function = $this->load->view("web/admin/user/user_js_function.php", '', true);
	  $this->template->embed_asset_code('frontend', 'js', 'user_js_function', $user_js_function);
	  
	  $user_js = $this->template->frontend_view('user_js', '', true, "user");
	  $this->template->embed_asset_code('frontend', 'js', 'user_js', $user_js);
	  endif;?>
    </div>
  </div>
</div>
<!--body end-->