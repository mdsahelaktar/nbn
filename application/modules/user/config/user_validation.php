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
        'label' => _e('User Category Id'),
        'rules' => 'trim|required'
    ),
    array(
        'field' => 'user_role_id',
        'label' => _e('User Role'),
        'rules' => 'trim|required'
    ),
    array(
        'field' => 'email',
        'label' => _e('Email'),
        'rules' => 'trim|required|valid_email|callback_check_unique[email,add]'
    ),
    array(
        'field' => 'password',
        'label' => _e('Password'),
        'rules' => 'trim|required|matches[passconf]|md5'
    ),
    array(
        'field' => 'passconf',
        'label' => _e('Confirm Password'),
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
        'label' => _e('Email'),
        'rules' => 'trim|required|valid_email|callback_check_unique[email,edit]'
    ),
    array(
        'field' => 'password',
        'label' => _e('Password'),
        'rules' => 'trim|required|matches[passconf]|md5'
    ),
    array(
        'field' => 'passconf',
        'label' => _e('Confirm Password'),
        'rules' => 'trim|required'
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
$config['user_validation']["password_update"] = array(
    array(
        'field' => 'old_password',
        'label' => _e('Current Password'),
        'rules' => 'trim|required|md5'
    ),
    array(
        'field' => 'password',
        'label' => _e('New Password'),
        'rules' => 'trim|required|matches[passconf]|md5'
    ),
    array(
        'field' => 'passconf',
        'label' => _e('Confirm Password'),
        'rules' => 'trim|required'
    )
);

/* End of file user_validation.php */
/* Location: ./application/modules/user/config/user_validation.php */