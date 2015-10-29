<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Insert Validation Rule
  |--------------------------------------------------------------------------
  |
  | Validation rule for insert user category.
  |
 */
$config['user_category_validation']["insert"] = array(
    array(
        'field' => 'user_category',
        'label' => _e('User Category'),
        'rules' => 'required|callback_check_unique[add]|callback_check_permission'
    )
);

/*
  |--------------------------------------------------------------------------
  | Update Validation Rule
  |--------------------------------------------------------------------------
  |
  | Validation rule for update user category.
  |
 */
$config['user_category_validation']["update"] = array(
    array(
        'field' => 'user_category',
        'label' => _e('User Category'),
        'rules' => 'required|callback_check_unique[edit]'
    )
);

/* End of file user_category_validation.php */
/* Location: ./application/modules/user_category/config/user_category_validation.php */