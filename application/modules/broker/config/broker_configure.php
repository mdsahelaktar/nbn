<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
|--------------------------------------------------------------------------
| Dependent On 
|--------------------------------------------------------------------------
|
| The main table 'user_map' directly mapped with this module dependent upon some table.
| We have followed some rule to link with those tables like -
| on 	: Joining based on key (Need for Sql Query)
| type 	: Joining type (Need for Sql Query)
| where	: Query where (Need for Sql Query)
| fetch : What to select (Need for Sql Query)
|
*/
$config['broker_configure']['dependent_on']		= array(
												'location' => array(
															'on' 	=> 'broker.location_id = location.ai_location_id',
															'type' 	=> 'left',
															'fetch' => array(
																		'country_id',
																		'province',
																		'county',
																		'city',
																		'zipcode',
																		'latitude',
																		'longitude'
																		)
												),
												'user' => array(
															'on' 	=> 'broker.user_id = user.ai_user_id',
															'type' 	=> 'left',
															'where' => array(
																		array('user.disable', 0),
																		array('user.is_deleted', 0)
																		),
															'fetch' => array(
																		'user_name'
																		)
												),
												'biz_listing' => array(
															'on' 	=> 'broker.user_id = biz_listing.user_id',
															'type' 	=> 'left',
															'where' => array('(CASE WHEN biz_listing.user_id IS NULL THEN 1 ELSE biz_listing.is_deleted =  0 END)'),	
															'fetch' => array(
																		'headline',
																		'ai_biz_listing_id',
																		'asking_price',
																		'province_id',
																		)
												),
												'image' => array(
															'on' 	=> 'broker.ai_broker_id = image.relation_id',
															'type' 	=> 'left',
															'fetch' => array(
																		'image_url',
																		'is_trashed',
																		'is_deleted',
																		'is_main',
																		'context_id'
																		)
												)
);
/*
|--------------------------------------------------------------------------
| Groupby Select 
|--------------------------------------------------------------------------
|
| When 'groupby_select' required then these array values are fetched in select query.
|
*/

$config['broker_configure']['groupby_select']		= array(
												'broker.*',
												'user.*',
												'location.*',
												"GROUP_CONCAT( DISTINCT CONCAT(biz_listing.headline , ',', biz_listing.asking_price , ',', biz_listing.province_id , ',', biz_listing.ai_biz_listing_id) SEPARATOR '[@]' ) AS biz_information",
												"GROUP_CONCAT( image.image_url ,',',image.context_id , ',', image.is_trashed , ',', image.is_deleted , ',', image.is_main SEPARATOR '[@]' ) AS image_information"
								
												
);
/*
|--------------------------------------------------------------------------
| Table name 
|--------------------------------------------------------------------------
|
| The main table of this module.
|
*/
$config['broker_configure']['table_name']		= 'broker';

/*
|--------------------------------------------------------------------------
| Auto Increment Id 
|--------------------------------------------------------------------------
|
| The name of auto increment id column.
|
*/
$config['broker_configure']['ai_id'] 			= 'ai_broker_id';

/*
|--------------------------------------------------------------------------
| Main Column 
|--------------------------------------------------------------------------
|
| The name of main column.
|
*/
$config['broker_configure']['main_col'] 			= 'broker';

/*
|--------------------------------------------------------------------------
| Creator Id 
|--------------------------------------------------------------------------
|
| The name of creator id column.
|
*/
$config['broker_configure']['c_id'] 				= 'user_id';

/*
|--------------------------------------------------------------------------
| Soft Delete 
|--------------------------------------------------------------------------
|
| The name of soft delete column. Used for frontend user.
|
*/
$config['broker_configure']['soft_delete'] 		= 'is_trashed';

/*
|--------------------------------------------------------------------------
| Permanent Delete 
|--------------------------------------------------------------------------
|
| The name of permanent delete column. Permanent delete is parallel to simple database row delete.
|
*/
$config['broker_configure']['permanent_delete'] 	= 'is_deleted';

/*
|--------------------------------------------------------------------------
| Possible Insert
|--------------------------------------------------------------------------
|
| The name of possibly insertable columns.
|
*/
$config['broker_configure']['possible_insert'] 	= array(
													'user_id',
													'service_area',
													'additional_services',
													'company_details',
													'bio',
													'location_id',
													'is_trashed',
													'is_deleted',
													'creation_time'
);

/*
|--------------------------------------------------------------------------
| Possible Order By
|--------------------------------------------------------------------------
|
| The name of possibly orderby able columns. May include dependent table column also.
|
*/
$config['broker_configure']['possible_orderby'] 	= array(
													'sortbytime' 			=> 'creation_time',
													'sortbymfdtime' 		=> 'update_time',
													'sortbyactive' 			=> 'is_trashed'
);

/*
|--------------------------------------------------------------------------
| Possible Like
|--------------------------------------------------------------------------
|
| The name of possibly like able columns. May include dependent table column also.
|
*/
$config['broker_configure']['possible_like'] 	= array(
													'service_area' 		=> 'service_area'
);

/*
|--------------------------------------------------------------------------
| Possible Where
|--------------------------------------------------------------------------
|
| The name of possibly where able columns. May include dependent table column also.
|
*/
$config['broker_configure']['possible_where'] 	= array(
													'edit_id' 		=> 'ai_broker_id',
													'user_id' 		=> 'user_id',
													'is_trashed' 	=> 'is_trashed',
													'zipcode'	    => 'location.zipcode',
													'province_id'	=> 'location.province_id',
													'city'	  	    => 'location.city',
													'county_id'	    => 'location.county_id',
													'is_deleted'	=>  'is_deleted',
													'status'		=>	'biz_listing.status'
);

/*
|--------------------------------------------------------------------------
| Possible Update
|--------------------------------------------------------------------------
|
| The name of possibly updateable columns.
|
*/
$config['broker_configure']['possible_update'] 	= array(
													'service_area'
);

/*
|--------------------------------------------------------------------------
| Sector
|--------------------------------------------------------------------------
|
| Configuration for sector to check permission.
|
*/
$config['broker_configure']['sector'] 			= array(
													'add'			=> 2,
													'view_all'		=> 3,
													'view_child'	=> 54,
													'edit_all'		=> 4,
													'edit_child'	=> 55
);

/* End of file broker_configure.php */
/* Location: ./application/modules/broker/config/broker_configure.php */