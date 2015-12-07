<div class="user_edit_profile">
    <div class="formwrap"> 
		<?php echo form_open('', array('name' => 'edit_profile_form', 'id' => 'edit_profile_form', 'class' => 'width100')) ?>
            <ul> 
                <li><?php echo form_label('<dfn>' . _e('user_name') . '</dfn>', 'user_name') ?> <?php echo form_input(array('name' => 'user_name', 'id' => 'user_name', 'placeholder' => 'add user name here', 'value'=> $user_details->user_name, 'class' => 'validate', 'data-display' => _e('user_name'), 'data-rules' => 'required')); ?></li> 
                <li><?php echo form_label('<dfn>' . _e('salutation') . '</dfn>', 'salutation') ?> <?php echo form_dropdown('salutation', $salutations, $user_details->salutation); ?></li> 
                <li><?php echo form_label('<dfn>' . _e('first_name') . '</dfn>', 'first_name') ?> <?php echo form_input(array('name' => 'first_name', 'id' => 'first_name', 'value'=> $user_details->first_name, 'placeholder' => 'add first name here')); ?></li> 
                <li><?php echo form_label('<dfn>' . _e('last_name') . '</dfn>', 'last_name') ?> <?php echo form_input(array('name' => 'last_name', 'id' => 'last_name', 'value'=> $user_details->last_name, 'placeholder' => 'add last name here')); ?></li> 
                <li><?php echo form_label('<dfn>' . _e('middle_name') . '</dfn>', 'middle_name') ?> <?php echo form_input(array('name' => 'middle_name', 'id' => 'middle_name', 'value'=> $user_details->middle_name, 'placeholder' => 'add middle name here')); ?></li> 
                <li><?php echo form_label('<dfn>' . _e('work_phone_no') . '</dfn>', 'work_phone_no') ?> <?php echo form_input(array('name' => 'work_phone_no', 'id' => 'work_phone_no', 'value'=> $user_details->work_phone_no, 'placeholder' => 'add phone no[w] here')); ?></li> 
                <li><?php echo form_label('<dfn>' . _e('mobile_phone_no') . '</dfn>', 'mobile_phone_no') ?> <?php echo form_input(array('name' => 'mobile_phone_no', 'id' => 'mobile_phone_no', 'value'=> $user_details->mobile_phone_no, 'placeholder' => 'add mobile no here')); ?></li> 
                <li><?php echo form_label('<dfn>' . _e('fax_no') . '</dfn>', 'fax_num') ?> <?php echo form_input(array('name' => 'fax_num', 'id' => 'fax_num', 'value'=> $user_details->fax_num, 'placeholder' => 'add fax no here')); ?></li> 
                <li><?php echo form_submit(array('name' => 'user_edit', 'id' => 'user_edit', 'class' => ''), _e('update_profile')); ?></li>
            </ul>
        <?php echo form_close() ?>
</div>
</div>