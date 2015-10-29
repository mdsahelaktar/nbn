<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Insert Validation Rule 
|--------------------------------------------------------------------------
|
| Validation rule for insert image.
|
*/
$config['image_validation']["insert"] = array(
									array(
										'field' => 'context_id',
										'label' => _e( 'Context' ),
										'rules' => 'required'
									),
									array(
										'field' => 'relation_id',
										'label' => _e( 'Relation' ),
										'rules' => 'required'
									),
									array(
										'field' => 'image_url',
										'label' => _e( 'Images' ),
										'rules' => 'callback_upload_validation[add]'
										),
									array(
										'field' => 'caption',
										'label' => _e( 'Caption' ),
										'rules' => 'required'
									),
									array(
										'field' => 'alt',
										'label' => _e( 'Alt' ),
										'rules' => 'required'
									)
);

$config['image_validation']["update"] = array(
									array(
										'field' => 'context_id',
										'label' => _e( 'Context' ),
										'rules' => 'required'
									),
									array(
										'field' => 'relation_id',
										'label' => _e( 'Relation' ),
										'rules' => 'required'
									),
									array(
										'field' => 'image_url',
										'label' => _e( 'Images' ),
										'rules' => 'callback_upload_validation[edit]'
										),
									array(
										'field' => 'caption',
										'label' => _e( 'Caption' ),
										'rules' => 'required'
									),
									array(
										'field' => 'alt',
										'label' => _e( 'Alt' ),
										'rules' => 'required'
									)
);


/* End of file image_validation.php */
/* Location: ./application/modules/image/config/image_validation.php */