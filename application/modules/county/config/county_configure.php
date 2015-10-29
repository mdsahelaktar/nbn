<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Table name 
|--------------------------------------------------------------------------
|
| The main table of this module.
|
*/
$config['county_configure']['table_name']			= 'county';

/*
|--------------------------------------------------------------------------
| Auto Increment Id 
|--------------------------------------------------------------------------
|
| The name of auto increment id column.
|
*/
$config['county_configure']['ai_id']				= 'ai_county_id';

/*
|--------------------------------------------------------------------------
| Province Id 
|--------------------------------------------------------------------------
|
| The name of province id column.
|
*/
$config['county_configure']['p_id']					= 'province_id';

/*
|--------------------------------------------------------------------------
| Main Column 
|--------------------------------------------------------------------------
|
| The name of main column.
|
*/
$config['county_configure']['main_col']				= 'county';

/*
|--------------------------------------------------------------------------
| Country Id 
|--------------------------------------------------------------------------
|
| The name of country id column.
|
*/
$config['county_configure']['country_id']				= 'country_id';

/*
|--------------------------------------------------------------------------
| Soft Delete 
|--------------------------------------------------------------------------
|
| The name of soft delete column. Used for frontend user.
|
*/
$config['county_configure']['soft_delete']			= 'is_trashed';

/*
|--------------------------------------------------------------------------
| Permanent Delete 
|--------------------------------------------------------------------------
|
| The name of permanent delete column. Permanent delete is parallel to simple database row delete.
|
*/
$config['county_configure']['permanent_delete'] 	= 'is_deleted';

/*
|--------------------------------------------------------------------------
| Possible Where
|--------------------------------------------------------------------------
|
| The name of possibly where able columns. May include dependent table column also.
|
*/
$config['county_configure']['possible_where'] 		= array(
												'edit_id' 		=> 'ai_county_id',
												'province' 		=> 'province_id',
												'is_trashed'	=> 'is_trashed',
												'county'		=> 'county',
												'country_id'	=> 'country_id'
);

/* End of file county_configure.php */
/* Location: ./application/modules/county/config/county_configure.php */