<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Insert Validation Rule
  |--------------------------------------------------------------------------
  |
  | Validation rule for insert user.
  |
 */
$config['user_validation']["insert"] = array(
    array(
        'field' => 'user_category_id',
        'label' => _e('user_category_id'),
        'rules' => 'trim|required'
    ),
    array(
        'field' => 'user_role_id',
        'label' => _e('user_role'),
        'rules' => 'trim|required'
    ),
    array(
        'field' => 'email',
        'label' => _e('email'),
        'rules' => 'trim|required|valid_email|callback_check_unique[email,add]'
    ),
    array(
        'field' => 'password',
        'label' => _e('password'),
        'rules' => 'trim|required|matches[passconf]|md5'
    ),
    array(
        'field' => 'passconf',
        'label' => _e('confirm_password'),
        'rules' => 'trim|required'
    )
);

/*
  |--------------------------------------------------------------------------
  | Update Validation Rule
  |--------------------------------------------------------------------------
  |
  | Validation rule for update user.
  |
 */
$config['user_validation']["update"] = array(    
    array(
        'field' => 'email',
        'label' => _e('email'),
        'rules' => 'trim|required|valid_email|callback_check_unique[email,edit]'
    ),
    array(
        'field' => 'password',
        'label' => _e('password'),
        'rules' => 'trim|required|matches[passconf]|md5'
    ),
    array(
        'field' => 'passconf',
        'label' => _e('confirm_password'),
        'rules' => 'trim|required'
    )
);

/*
  |--------------------------------------------------------------------------
  | Update Validation Rule Frontend
  |--------------------------------------------------------------------------
  |
  | Validation rule for update user.
  |
 */
$config['user_validation']["frontend_update"] = array(    
    array(
        'field' => 'user_name',
        'label' => _e('user_name'),
        'rules' => 'trim|required|callback_check_unique[user_name,edit_profile]'
    )
);


/*
  |--------------------------------------------------------------------------
  | Password Update Validation Rule
  |--------------------------------------------------------------------------
  |
  | Validation rule for update user password.
  |
 */
$config['user_validation']["change_password"] = array(
    array(
        'field' => 'old_password',
        'label' => _e('current_password'),
        'rules' => 'trim|required|callback_check_unique[old_password,change_password]'
    ),
    array(
        'field' => 'password',
        'label' => _e('new_password'),
        'rules' => 'trim|required|matches[passconf]|md5'
    ),
    array(
        'field' => 'passconf',
        'label' => _e('confirm_password'),
        'rules' => 'trim|required'
    )
);

/*
  |--------------------------------------------------------------------------
  | Password Forgot Validation Rule
  |--------------------------------------------------------------------------
  |
  | Validation rule for forgot user password.
  |
 */
$config['user_validation']["forgot_password"] = array(
    array(
        'field' => 'user_name_email',
        'label' => _e('user_name_email'),
        'rules' => 'trim|required|callback_check_unique[user_name*email,forgot_password]'
    )
);

/*
  |--------------------------------------------------------------------------
  | Reset Password Validation Rule
  |--------------------------------------------------------------------------
  |
  | Validation rule for reset password.
  |
 */
$config['user_validation']["reset_password"] = array(    
    array(
        'field' => 'password',
        'label' => _e('password'),
        'rules' => 'trim|required|matches[passconf]|md5'
    ),
    array(
        'field' => 'passconf',
        'label' => _e('confirm_password'),
        'rules' => 'trim|required'
    )
);

/* End of file user_validation.php */
/* Location: ./application/modules/user/config/user_validation.php */