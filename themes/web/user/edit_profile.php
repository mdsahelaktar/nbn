<div class="user_edit_profile"> 
<?php echo form_open('', array('name' => 'edit_profile_form', 'id' => 'edit_profile_form', 'class' => 'width100')) ?> 
<span><?php echo form_label('<p>' . _e('user_name') . '</p>', 'user_name') ?> <?php echo form_input(array('name' => 'user_name', 'id' => 'user_name', 'placeholder' => 'add user name here', 'value'=> $user_details->user_name, 'class' => 'validate', 'data-display' => _e('user_name'), 'data-rules' => 'required')); ?></span> 
<span><?php echo form_label('<p>' . _e('salutation') . '</p>', 'salutation') ?> <?php echo form_dropdown('salutation', $salutations, $user_details->salutation); ?></span> 
<span><?php echo form_label('<p>' . _e('first_name') . '</p>', 'first_name') ?> <?php echo form_input(array('name' => 'first_name', 'id' => 'first_name', 'value'=> $user_details->first_name, 'placeholder' => 'add first name here')); ?></span> 
<span><?php echo form_label('<p>' . _e('last_name') . '</p>', 'last_name') ?> <?php echo form_input(array('name' => 'last_name', 'id' => 'last_name', 'value'=> $user_details->last_name, 'placeholder' => 'add last name here')); ?></span> 
<span><?php echo form_label('<p>' . _e('middle_name') . '</p>', 'middle_name') ?> <?php echo form_input(array('name' => 'middle_name', 'id' => 'middle_name', 'value'=> $user_details->middle_name, 'placeholder' => 'add middle name here')); ?></span> 
<span><?php echo form_label('<p>' . _e('work_phone_no') . '</p>', 'work_phone_no') ?> <?php echo form_input(array('name' => 'work_phone_no', 'id' => 'work_phone_no', 'value'=> $user_details->work_phone_no, 'placeholder' => 'add phone no[w] here')); ?></span> 
<span><?php echo form_label('<p>' . _e('mobile_phone_no') . '</p>', 'mobile_phone_no') ?> <?php echo form_input(array('name' => 'mobile_phone_no', 'id' => 'mobile_phone_no', 'value'=> $user_details->mobile_phone_no, 'placeholder' => 'add mobile no here')); ?></span> 
<span><?php echo form_label('<p>' . _e('fax_no') . '</p>', 'fax_num') ?> <?php echo form_input(array('name' => 'fax_num', 'id' => 'fax_num', 'value'=> $user_details->fax_num, 'placeholder' => 'add fax no here')); ?></span> 
<span><?php echo form_submit(array('name' => 'user_edit', 'id' => 'user_edit', 'class' => 'margin-top35'), _e('update_profile')); ?></span>
<?php echo form_close() ?>
</div>