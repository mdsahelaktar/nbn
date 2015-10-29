<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Insert Validation Rule
  |--------------------------------------------------------------------------
  |
  | Validation rule for insert user map.
  |
 */
$config['user_map_validation']["insert"] = array(
    array(
        'field' => 'user_id',
        'label' => _e('User Name'),
        'rules' => 'required'
    ),
    array(
        'field' => 'user_category_id',
        'label' => _e('User Category'),
        'rules' => 'required'
    ),
    array(
        'field' => 'user_role_id',
        'label' => _e('User Role'),
        'rules' => 'required|callback_check_unique_self[user_id,user_category_id,add]'
    )
);

/* End of file user_map_validation.php */
/* Location: ./application/modules/user_map/config/user_map_validation.php */