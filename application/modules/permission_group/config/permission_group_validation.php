<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Insert Validation Rule 
|--------------------------------------------------------------------------
|
| Validation rule for insert permission group.
|
*/
$config['permission_group_validation']["insert"] = array(
											array(
												'field' => 'group',
												'label' => _e( 'Permission Group' ),
												'rules' => 'required|callback_check_unique[add]'
											)
);

/*
|--------------------------------------------------------------------------
| Update Validation Rule 
|--------------------------------------------------------------------------
|
| Validation rule for update permission group.
|
*/
$config['permission_group_validation']["update"] = array(
											array(
												'field' => 'group',
												'label' => _e( 'Permission Group' ),
												'rules' => 'required|callback_check_unique[edit]'
											)
); 

/* End of file permission_group_validation.php */
/* Location: ./application/modules/permission_group/config/permission_group_validation.php */