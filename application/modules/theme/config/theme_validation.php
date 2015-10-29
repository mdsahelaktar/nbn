<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Insert Validation Rule 
|--------------------------------------------------------------------------
|
| Validation rule for insert theme.
|
*/ 
$config['theme_validation']["insert"] = array(
								array(
									'field' => 'theme',
									'label' => _e( 'Theme' ),
									'rules' => 'required|callback_check_unique[add]'
								)
);

/*
|--------------------------------------------------------------------------
| Update Validation Rule 
|--------------------------------------------------------------------------
|
| Validation rule for update theme.
|
*/
$config['theme_validation']["update"] = array(
								array(
									'field' => 'theme',
									'label' => _e( 'Theme' ),
									'rules' => 'required|callback_check_unique[edit]'
									)
); 

/* End of file theme_validation.php */
/* Location: ./application/modules/theme/config/theme_validation.php */