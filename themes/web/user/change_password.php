<div class="user_change_password">
<?php echo form_open('', array('name' => 'change_password_form', 'id' => 'change_password_form', 'class' => 'width100')) ?> 
<span><?php echo form_label('<p>' . _e('old_password') . '</p>', 'old_password') ?> <?php echo form_password(array('name' => 'old_password', 'id' => 'old_password', 'class' => 'validate', 'data-display' => _e('old_password'), 'data-rules' => 'required')); ?></span> 
<span><?php echo form_label('<p>' . _e('new_assword') . '</p>', 'password') ?> <?php echo form_password(array('name' => 'password', 'id' => 'password', 'class' => 'validate', 'data-display' => _e('new_assword'), 'data-rules' => 'required|strict_password|matches[passconf]')); ?></span> 
<span><?php echo form_label('<p>' . _e('confirm_password') . '</p>', 'passconf') ?> <?php echo form_password(array('name' => 'passconf', 'id' => 'passconf', 'class' => 'validate', 'data-display' => _e('confirm_password'), 'data-rules' => 'required')); ?></span> 
<span><?php echo form_submit(array('name' => 'change_password', 'id' => 'change_password', 'class' => 'margin-top35'), _e('change_password')); ?></span>
<?php echo form_close() ?>
</div>