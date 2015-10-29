<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Insert Validation Rule
  |--------------------------------------------------------------------------
  |
  | Validation rule for insert biz listing.
  |
 */
$config['biz_listing_validation']["insert"] = array(
    array(
        'field' => 'headline',
        'label' => _e('Headline'),
        'rules' => 'required|callback_check_unique[add]|callback_check_permission'
    ),
    array(
        'field' => 'tagline',
        'label' => _e('Tagline'),
        'rules' => 'required'
    ),
    array(
        'field' => 'description',
        'label' => _e('Description'),
        'rules' => 'required'
    ),
    array(
        'field' => 'biz_type_id',
        'label' => _e('Type of Business'),
        'rules' => 'required'
    ),
    array(
        'field' => 'country_id',
        'label' => _e('Country'),
        'rules' => 'required'
    ),
    array(
        'field' => 'images',
        'label' => _e('Images'),
        'rules' => 'callback_upload_validation[add]'
    )
);

/*
  |--------------------------------------------------------------------------
  | Update Validation Rule
  |--------------------------------------------------------------------------
  |
  | Validation rule for update biz listing.
  |
 */
$config['biz_listing_validation']["update"] = array(
    array(
        'field' => 'headline',
        'label' => _e('Headline'),
        'rules' => 'required|callback_check_unique[edit]'
    ),
    array(
        'field' => 'tagline',
        'label' => _e('Tagline'),
        'rules' => 'required'
    ),
    array(
        'field' => 'description',
        'label' => _e('Description'),
        'rules' => 'required'
    ),
    array(
        'field' => 'biz_type_id',
        'label' => _e('Type of Business'),
        'rules' => 'required'
    ),
    array(
        'field' => 'country_id',
        'label' => _e('Country'),
        'rules' => 'required'
    )
);

/* End of file biz_listing_validation.php */
/* Location: ./application/modules/biz_listing/config/biz_listing_validation.php */