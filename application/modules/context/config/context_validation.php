<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Insert Validation Rule 
|--------------------------------------------------------------------------
|
| Validation rule for insert user context.
|
*/
$config['context_validation']["insert"] = array(
											array(
												'field' => 'context',
												'label' => _e( 'Context' ),
												'rules' => 'required|callback_check_unique[add]|callback_check_permission'
											),
											array(
												'field' => 'description',
												'label' => _e( 'Description' ),
												'rules' => 'required|callback_check_unique[add]|callback_check_permission'
											)
											
);

/*
|--------------------------------------------------------------------------
| Update Validation Rule 
|--------------------------------------------------------------------------
|
| Validation rule for update user context.
|
*/
$config['context_validation']["update"] = array(
											array(
												'field' => 'context',
												'label' => _e( 'Context' ),
												'rules' => 'required|callback_check_unique[edit]'
											),
											array(
												'field' => 'description',
												'label' => _e( 'Description' ),
												'rules' => 'required|callback_check_unique[edit]'
											)
); 

/* End of file user_context_validation.php */
/* Location: ./application/modules/user_context/config/user_context_validation.php */