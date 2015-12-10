<div class="profile-steps">
  <h2 class="helvetica bg-seperator padding-bottom20 float-left">Welcome to Needbiznow
    <p class="font14 light-black margin-top10">We're glad to have you as part of our businesss for sale community.</p>
  </h2>
  <div msg="user"></div>
  <div class="user_change_password">
    <div class="formwrap"> <?php echo form_open('', array('name' => 'change_password_form', 'id' => 'change_password_form', 'class' => 'width100')) ?>
      <ul>
        <li><?php echo form_label('<dfn>' . _e('old_password') . '</dfn>', 'old_password') ?> <?php echo form_password(array('name' => 'old_password', 'id' => 'old_password', 'class' => 'validate', 'data-display' => _e('old_password'), 'data-rules' => 'required')); ?></li>
        <li><?php echo form_label('<dfn>' . _e('new_password') . '</dfn>', 'password') ?> <?php echo form_password(array('name' => 'password', 'id' => 'password', 'class' => 'validate', 'data-display' => _e('new_password'), 'data-rules' => 'required|strict_password|matches[passconf]')); ?></li>
        <li><?php echo form_label('<dfn>' . _e('confirm_password') . '</dfn>', 'passconf') ?> <?php echo form_password(array('name' => 'passconf', 'id' => 'passconf', 'class' => 'validate', 'data-display' => _e('confirm_password'), 'data-rules' => 'required')); ?></li>
        <li><?php echo form_submit(array('name' => 'change_password', 'id' => 'change_password', 'class' => 'margin-top10'), _e('change_password')); ?></li>
      </ul>
      <?php echo form_close() ?> </div>
  </div>
</div>
<?php
$user_js_function = $this->load->view("web/admin/user/user_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'user_js_function', $user_js_function);
    
$user_js = $this->template->frontend_view('user_js', '', true, "user");
$this->template->embed_asset_code('frontend', 'js', 'user_js', $user_js);
