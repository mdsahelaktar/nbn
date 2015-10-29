<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Insert Validation Rule
  |--------------------------------------------------------------------------
  |
  | Validation rule for insert user role.
  |
 */
$config['user_role_validation']["insert"] = array(
    array(
        'field' => 'user_category_id',
        'label' => _e('User Category Id'),
        'rules' => 'required'
    ),
    array(
        'field' => 'user_role',
        'label' => _e('User Role'),
        'rules' => 'required|trim|callback_check_unique_self[add]'
    )
);

/*
  |--------------------------------------------------------------------------
  | Update Validation Rule
  |--------------------------------------------------------------------------
  |
  | Validation rule for update user role.
  |
 */
$config['user_role_validation']["update"] = array(
    array(
        'field' => 'user_category_id',
        'label' => _e('User Category Id'),
        'rules' => 'required'
    ),
    array(
        'field' => 'user_role',
        'label' => _e('User Role'),
        'rules' => 'required|trim|callback_check_unique_self[edit]'
    )
);

/* End of file user_role_validation.php */
/* Location: ./application/modules/user_role/config/user_role_validation.php */							