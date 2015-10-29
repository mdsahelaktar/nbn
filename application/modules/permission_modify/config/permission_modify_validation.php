<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Insert Validation Rule 
|--------------------------------------------------------------------------
|
| Validation rule for insert permission modify.
|
*/ 
$config['permission_group_validation']["insert"] = array(
											array(
												'field' => 'user_map_id',
												'label' => _e( 'user and role' ),
												'rules' => 'callback_check_unique[add]'
											)
);

/*
|--------------------------------------------------------------------------
| Update Validation Rule 
|--------------------------------------------------------------------------
|
| Validation rule for update permission modify.
|
*/
$config['permission_group_validation']["update"] = array(
											array(
												'field' => 'user_map_id',
												'label' => _e( 'user and role' ),
												'rules' => 'callback_check_unique[edit]'
												)
);
