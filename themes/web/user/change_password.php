<div class="user_change_password">
	<div class="formwrap">
		<?php echo form_open('', array('name' => 'change_password_form', 'id' => 'change_password_form', 'class' => 'width100')) ?>
        	<ul> 
                <li><?php echo form_label('<p>' . _e('old_password') . '</p>', 'old_password') ?> <?php echo form_password(array('name' => 'old_password', 'id' => 'old_password', 'class' => 'validate', 'data-display' => _e('old_password'), 'data-rules' => 'required')); ?></li> 
                <li><?php echo form_label('<p>' . _e('new_assword') . '</p>', 'password') ?> <?php echo form_password(array('name' => 'password', 'id' => 'password', 'class' => 'validate', 'data-display' => _e('new_assword'), 'data-rules' => 'required|strict_password|matches[passconf]')); ?></li> 
                <li><?php echo form_label('<p>' . _e('confirm_password') . '</p>', 'passconf') ?> <?php echo form_password(array('name' => 'passconf', 'id' => 'passconf', 'class' => 'validate', 'data-display' => _e('confirm_password'), 'data-rules' => 'required')); ?></li> 
                <li><?php echo form_submit(array('name' => 'change_password', 'id' => 'change_password', 'class' => 'margin-top10'), _e('change_password')); ?></li>
        	</ul>
        <?php echo form_close() ?>
	</div>
</div>