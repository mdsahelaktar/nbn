<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Insert Validation Rule
  |--------------------------------------------------------------------------
  |
  | Validation rule for insert package.
  |
 */
$config['package_validation']["insert"] = array(
    array(
        'field' => 'package',
        'label' => _e('Package'),
        'rules' => 'required|callback_check_unique[add]|callback_check_permission'
    )
);

/*
  |--------------------------------------------------------------------------
  | Update Validation Rule
  |--------------------------------------------------------------------------
  |
  | Validation rule for update package.
  |
 */
$config['package_validation']["update"] = array(
    array(
        'field' => 'package',
        'label' => _e('Package'),
        'rules' => 'required|callback_check_unique[edit]'
    )
);

/* End of file package_validation.php */
/* Location: ./application/modules/package/config/package_validation.php */