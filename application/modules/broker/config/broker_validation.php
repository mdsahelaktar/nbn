<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Insert Validation Rule 
|--------------------------------------------------------------------------
|
| Validation rule for insert broker.
|
*/
$config['broker_validation']["insert"] = array(
											array(
												'field' => 'location_id',
												'label' => _e( 'Location' )
											),
											array(
												'field' => 'images',
												'label' => _e( 'Images' ),
												'rules' => 'callback_upload_validation[add]'
											) 
);

/* End of file broker_validation.php */
/* Location: ./application/modules/broker/config/broker_validation.php */