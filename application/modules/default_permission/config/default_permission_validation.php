<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Insert Validation Rule 
|--------------------------------------------------------------------------
|
| Validation rule for insert default permission.
|
*/
$config['default_permission_validation']["insert"] = array(
												array(
													'field' => 'user_role_id',
													'label' => _e( 'User Role' ),
													'rules' => 'required'
												),
												array(
													'field' => 'allowed_permission_id',
													'label' => _e( 'Allowed Permission' ),
													'rules' => 'required|trim|callback_check_unique_self[add]'
												)
);

/*
|--------------------------------------------------------------------------
| Update Validation Rule 
|--------------------------------------------------------------------------
|
| Validation rule for update default permission.
|
*/
$config['default_permission_validation']["update"] = array(
												array(
													'field' => 'user_role_id',
													'label' => _e( 'User Role' ),
													'rules' => 'required'
												),
												array(
													'field' => 'allowed_permission_id',
													'label' => _e( 'Allowed Permission' ),
													'rules' => 'required|trim|callback_check_unique_self[edit]'
												)
); 

/* End of file default_permission_validation.php */
/* Location: ./application/modules/default_permission/config/default_permission_validation.php */