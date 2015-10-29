<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Table name 
|--------------------------------------------------------------------------
|
| The main table of this module.
|
*/
$config['location_configure']['table_name']		= 'location';

/*
|--------------------------------------------------------------------------
| Auto Increment Id 
|--------------------------------------------------------------------------
|
| The name of auto increment id column.
|
*/
$config['location_configure']['ai_id'] 			= 'ai_location_id'; 

/*
|--------------------------------------------------------------------------
| zip
|--------------------------------------------------------------------------
|
| The name of zip column.
|
*/
$config['location_configure']['zipcode'] 			= 'zipcode';

/*
|--------------------------------------------------------------------------
| Main Column 
|--------------------------------------------------------------------------
|
| The name of main column.
|
*/
$config['location_configure']['main_col'] 			= 'city';

/*
|--------------------------------------------------------------------------
| Country Id
|--------------------------------------------------------------------------
|
| The name of country id column.
|
*/
$config['location_configure']['country_id'] 			= 'country_id';

/*
|--------------------------------------------------------------------------
| Province Id 
|--------------------------------------------------------------------------
|
| The name of province id column.
|
*/
$config['location_configure']['province_id'] 			= 'province_id';

/*
|--------------------------------------------------------------------------
| County Id
|--------------------------------------------------------------------------
|
| The name of county id column.
|
*/
$config['location_configure']['county_id'] 			= 'county_id';

/*
|--------------------------------------------------------------------------
| Soft Delete 
|--------------------------------------------------------------------------
|
| The name of soft delete column. Used for frontend user.
|
*/
$config['location_configure']['soft_delete'] 		= 'is_trashed';

/*
|--------------------------------------------------------------------------
| Permanent Delete 
|--------------------------------------------------------------------------
|
| The name of permanent delete column. Permanent delete is parallel to simple database row delete.
|
*/
$config['location_configure']['permanent_delete'] 	= 'is_deleted';

/*
|--------------------------------------------------------------------------
| Possible Like
|--------------------------------------------------------------------------
|
| The name of possibly like able columns. May include dependent table column also.
|
*/
$config['location_configure']['possible_like'] 	= array(
													'zipcode' 		=> 'zipcode'
);

/*
|--------------------------------------------------------------------------
| Possible Where
|--------------------------------------------------------------------------
|
| The name of possibly where able columns. May include dependent table column also.
|
*/
$config['location_configure']['possible_where'] 	= array(
													'edit_id' 		=> 'ai_location_id',
													'zipcode' 		=> 'zipcode',
													'country_id'	=> 'country_id',
													'province_id'	=> 'province_id',
													'county_id' 	=> 'county_id',													
													'city' 			=> 'city',			
													'is_trashed' 	=> 'is_trashed',
);


/*
|--------------------------------------------------------------------------
| Sector
|--------------------------------------------------------------------------
|
| Configuration for sector to check permission.
|
*/
$config['location_configure']['sector'] 			= array(
													'add'			=> 2,
													'view_all'		=> 3,
													'view_child'	=> 54,
													'edit_all'		=> 4,
													'edit_child'	=> 55
);

/* End of file location_configure.php */
/* Location: ./application/modules/location/config/location_configure.php */