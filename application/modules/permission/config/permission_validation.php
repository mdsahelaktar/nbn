<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Insert Validation Rule 
|--------------------------------------------------------------------------
|
| Validation rule for insert permission.
|
*/
$config['permission_validation']["insert"] = array(
										array(
											'field' => 'group_id',
											'label' => _e( 'Permission Group' ),
											'rules' => 'required'
										),
										array(
											'field' => 'permission',
											'label' => _e( 'Permission' ),
											'rules' => 'required|trim|callback_check_unique_self[add]'
										)
);

/*
|--------------------------------------------------------------------------
| Update Validation Rule 
|--------------------------------------------------------------------------
|
| Validation rule for update permission.
|
*/
$config['permission_validation']["update"] = array(
										array(
											'field' => 'group_id',
											'label' => _e( 'Permission Group' ),
											'rules' => 'required'
										),
										array(
											'field' => 'permission',
											'label' => _e( 'Permission' ),
											'rules' => 'required|trim|callback_check_unique_self[edit]'
										)
); 

/* End of file permission_validation.php */
/* Location: ./application/modules/permission/config/permission_validation.php */