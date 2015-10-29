<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Table name 
|--------------------------------------------------------------------------
|
| The main table of this module.
|
*/
$config['country_configure']['table_name']			= 'country';

/*
|--------------------------------------------------------------------------
| Auto Increment Id 
|--------------------------------------------------------------------------
|
| The name of auto increment id column.
|
*/
$config['country_configure']['ai_id']				= 'ai_country_id';

/*
|--------------------------------------------------------------------------
| Main Column 
|--------------------------------------------------------------------------
|
| The name of main column.
|
*/
$config['country_configure']['main_col']			= 'country';

/*
|--------------------------------------------------------------------------
| Soft Delete 
|--------------------------------------------------------------------------
|
| The name of soft delete column. Used for frontend user.
|
*/
$config['country_configure']['soft_delete']		= 'is_trashed';

/*
|--------------------------------------------------------------------------
| Permanent Delete 
|--------------------------------------------------------------------------
|
| The name of permanent delete column. Permanent delete is parallel to simple database row delete.
|
*/
$config['country_configure']['permanent_delete'] 	= 'is_deleted';

/*
|--------------------------------------------------------------------------
| Possible Where
|--------------------------------------------------------------------------
|
| The name of possibly where able columns. May include dependent table column also.
|
*/
$config['country_configure']['possible_where'] 	= array(
												'edit_id' 		=> 'ai_country_id',
												'is_trashed'	=> 'is_trashed',
												'country'		=> 'country',
												'abbre'			=> 'abbre'
);

/* End of file country_configure.php */
/* Location: ./application/modules/country/config/country_configure.php */