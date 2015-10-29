<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Login Validation Rule 
|--------------------------------------------------------------------------
|
| Validation rule for insert language.
|
*/
$config['login_validation']["check"] = array(
								array(
									'field' => 'user_name',
									'label' => _e( 'User Name/Email Address' ),
									'rules' => 'required'
								),
								array(
									'field' => 'password',
									'label' => _e( 'Password' ),
									'rules' => 'required'
								)
);

/* End of file login_validation.php */
/* Location: ./application/modules/login/config/login_validation.php */