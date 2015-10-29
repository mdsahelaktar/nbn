<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Table name 
|--------------------------------------------------------------------------
|
| The main table of this module.
|
*/
$config['province_configure']['table_name']			= 'province';

/*
|--------------------------------------------------------------------------
| Auto Increment Id 
|--------------------------------------------------------------------------
|
| The name of auto increment id column.
|
*/
$config['province_configure']['ai_id']				= 'ai_province_id';

/*
|--------------------------------------------------------------------------
| Main Column 
|--------------------------------------------------------------------------
|
| The name of main column.
|
*/
$config['province_configure']['main_col']			= 'province';

/*
|--------------------------------------------------------------------------
| Country Id 
|--------------------------------------------------------------------------
|
| The name of country id.
|
*/
$config['province_configure']['country_id']			= 'country_id';

/*
|--------------------------------------------------------------------------
| Soft Delete 
|--------------------------------------------------------------------------
|
| The name of soft delete column. Used for frontend user.
|
*/
$config['province_configure']['soft_delete']		= 'is_trashed';

/*
|--------------------------------------------------------------------------
| Permanent Delete 
|--------------------------------------------------------------------------
|
| The name of permanent delete column. Permanent delete is parallel to simple database row delete.
|
*/
$config['province_configure']['permanent_delete'] 	= 'is_deleted';
/*
|--------------------------------------------------------------------------
| province
|--------------------------------------------------------------------------
|
| The name of province column.
|
*/
$config['province_configure']['province'] 	= 'province';
/*
|--------------------------------------------------------------------------
| Possible Where
|--------------------------------------------------------------------------
|
| The name of possibly where able columns. May include dependent table column also.
|
*/
$config['province_configure']['possible_where'] 	= array(
												'edit_id' 		=> 'ai_province_id',
												'is_trashed'	=> 'is_trashed',
												'country_id' 	=> 'country_id',
												'province'		=> 'province'
);

/* End of file province_configure.php */
/* Location: ./application/modules/province/config/province_configure.php */