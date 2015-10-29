<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Insert Validation Rule 
|--------------------------------------------------------------------------
|
| Validation rule for insert language.
|
*/
$config['language_validation']["insert"] = array(
									array(
										'field' => 'language',
										'label' => _e( 'Theme' ),
										'rules' => 'required|callback_check_unique[add]'
									)
);

/*
|--------------------------------------------------------------------------
| Update Validation Rule 
|--------------------------------------------------------------------------
|
| Validation rule for update language.
|
*/
$config['language_validation']["update"] = array(
									array(
										'field' => 'language',
										'label' => _e( 'Theme' ),
										'rules' => 'required|callback_check_unique[edit]'
									)
); 

/* End of file language_validation.php */
/* Location: ./application/modules/language/config/language_validation.php */