<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Dependent On 
|--------------------------------------------------------------------------
|
| The main table 'popular' directly mapped with this module dependent upon some table.
| We have followed some rule to link with those tables like -
| on 	: Joining based on key (Need for Sql Query)
| type 	: Joining type (Need for Sql Query)
| where	: Query where (Need for Sql Query)
| fetch : What to select (Need for Sql Query)
|
*/
$config['popular_configure']['dependent_on'][1]		= array(
												'biz_listing' => array(
															'on' 	=> 'popular.object = biz_listing.ai_biz_listing_id',
															'type' 	=> 'left',
															'where' => array('(CASE WHEN biz_listing.headline IS NULL THEN 1 ELSE biz_listing.is_deleted =  0 and biz_listing.status =  2 END)'),
															'fetch' => array(
																		'headline',
																		'asking_price',
																		'ai_biz_listing_id',
																		'biz_type_id',
																		'county_id',
																		'province_id'
																		)
												),
												'province' => array(
															'on' 	=> 'biz_listing.province_id = province.ai_province_id',
															'type' 	=> 'left',
															'fetch' => array(
																		'province',
																		'abber',
																		'ai_province_id'
																		)
												),
												'image' => array(
															'on' 	=> 'popular.object = image.relation_id',
															'type' 	=> 'left',
															'where' => array( '(CASE WHEN image.context_id IS NULL THEN 1 ELSE image.context_id = 3 END)' ),// Place image context id now biz = 3 as image context id
															'fetch' => array(
																		'image_url',
																		'is_trashed',
																		'is_deleted',
																		'is_main',
																		'context_id'
																		)
												),
												'popular_log' => array(
															'on' 	=> 'popular.ai_popular_id = popular_log.popular_id',
															'type' 	=> 'left',
															'fetch' => array(
																		'ip_address'
																		)
												)
												
);


$config['popular_configure']['dependent_on'][2]		= array(				
												'popular_log' => array(
															'on' 	=> 'popular.ai_popular_id = popular_log.popular_id',
															'type' 	=> 'left',
															'fetch' => array(
																		'ip_address'
																		)
												),
												'biz_listing' => array(
															'on' 	=> 'popular.object = biz_listing.biz_type_id',
															'type' 	=> 'left',
															'fetch' => array(
																		'country_id',
																		'province_id'
																		)
												),
												'biz_type' => array(
															'on' 	=> 'popular.object = biz_type.ai_biz_type_id',
															'type' 	=> 'left',
															'fetch' => array(
																		'biz_type',
																		'ai_biz_type_id',
																		'domain_id'
																		)
												)
																								
);


$config['popular_configure']['dependent_on'][3]		= array(												
												'popular_log' => array(
															'on' 	=> 'popular.ai_popular_id = popular_log.popular_id',
															'type' 	=> 'left',
															'fetch' => array(
																		'ip_address'
																		),
															'where' => array('(CASE WHEN popular_log.ip_address IS NULL THEN 1 ELSE popular_log.is_deleted =  0 END)')	
												),
												'biz_listing' => array(
															'on' 	=> 'popular.object = biz_listing.province_id',
															'type' 	=> 'left',
															'fetch' => array(
																		'country_id',
																		'province_id'
																		)
												),
												'province' => array(
															'on' 	=> 'popular.object = province.ai_province_id',
															'type' 	=> 'left',
															'fetch' => array(
																		'province',
																		'ai_province_id'
																		)
												)
												
);


$config['popular_configure']['dependent_on'][4]		= array(	
												'biz_listing' => array(
															'on' 	=> 'popular.object = biz_listing.city',
															'type' 	=> 'left',
															'where' => array('(CASE WHEN biz_listing.city IS NULL THEN 1 ELSE biz_listing.is_deleted =  0 END)'),
															'fetch' => array(
																		'country_id',
																		'province_id'
																		)
												),											
												'popular_log' => array(
															'on' 	=> 'popular.ai_popular_id = popular_log.popular_id',
															'type' 	=> 'left',
															'fetch' => array(
																		'ip_address'
																		)
												)												
);


$config['popular_configure']['dependent_on'][5]		= array(	

											    'popular_log' => array(
															'on' 	=> 'popular.ai_popular_id = popular_log.popular_id',
															'type' 	=> 'left',
															'fetch' => array(
																		'ip_address'
																		)
												),										
												'county' => array(
															'on' 	=> 'popular.object = county.ai_county_id',
															'type' 	=> 'left',
															'fetch' => array(
																		'county',
																		'ai_county_id'
																		)
												),
												'biz_listing' => array(
															'on' 	=> 'popular.object = biz_listing.county_id',
															'type' 	=> 'left',
															'fetch' => array(
																		'county_id',
																		'province_id'
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

$config['popular_configure']['groupby_select'][1]		= array(
												'popular.*',
												'biz_listing.headline',
												'biz_listing.county_id',
												'biz_listing.province_id',
												'biz_listing.ai_biz_listing_id',
												'biz_listing.asking_price',
												'province.province',
												'province.abbre',
												'province.ai_province_id',
												"GROUP_CONCAT( popular_log.ip_address SEPARATOR '[@]' ) AS ip_address",
												"GROUP_CONCAT( DISTINCT CONCAT(image.image_url , ',',image.context_id, ',', image.is_trashed , ',', image.is_deleted , ',', image.is_main) SEPARATOR '[@]' ) AS image_information"
);


$config['popular_configure']['groupby_select'][2]		= array(
												'popular.*',	
												'biz_type.ai_biz_type_id',												
												'biz_type.biz_type',
												'biz_type.domain_id',
												'biz_listing.county_id',
												'biz_listing.province_id',
												"GROUP_CONCAT( popular_log.ip_address SEPARATOR '[@]' ) AS ip_address"
);


$config['popular_configure']['groupby_select'][3]		= array(
												'popular.*',
												'province.province',
												'province.ai_province_id',
												'biz_listing.county_id',
												'biz_listing.province_id',
												"GROUP_CONCAT( popular_log.ip_address SEPARATOR '[@]' ) AS ip_address"
);


$config['popular_configure']['groupby_select'][4]		= array(
												'popular.*',
												'biz_listing.county_id',
												'biz_listing.province_id',
												"GROUP_CONCAT( popular_log.ip_address SEPARATOR '[@]' ) AS ip_address"
);

$config['popular_configure']['groupby_select'][5]		= array(
												'popular.*',
												'county.county',
												'county.ai_county_id',
												"GROUP_CONCAT( DISTINCT CONCAT(`ai_biz_listing_id`, '_', `county_id`) SEPARATOR ';') AS county_str"
);

/*
|--------------------------------------------------------------------------
| Table name 
|--------------------------------------------------------------------------
|
| The main table of this module.
|
*/
$config['popular_configure']['table_name']			= 'popular';

/*
|--------------------------------------------------------------------------
| Auto Increment Id 
|--------------------------------------------------------------------------
|
| The name of auto increment id column.
|
*/
$config['popular_configure']['ai_id']				= 'ai_popular_id';

/*
|--------------------------------------------------------------------------
| Main Column 
|--------------------------------------------------------------------------
|
| The name of main column.
|
*/
$config['popular_configure']['main_col']			= 'main_cat_type';

$config['popular_configure']['possible_insert'] 	= array(
													'main_cat_type',
													'child_cat_type',
													'object',
													'count'
);
$config['popular_configure']['permanent_delete'] 	= 'is_deleted';

$config['popular_configure']['soft_delete'] 		= 'is_deleted';
/*
|--------------------------------------------------------------------------
| Possible Order By
|--------------------------------------------------------------------------
|
| The name of possibly orderby able columns. May include dependent table column also.
|
*/
$config['popular_configure']['possible_orderby'] 	= array(
													'count'			=> 'count'
);

/*
|--------------------------------------------------------------------------
| Possible Like
|--------------------------------------------------------------------------
|
| The name of possibly like able columns. May include dependent table column also.
|
*/
$config['popular_configure']['possible_like'] 	= array(
													'ip_address' 		=> 'ip_address'
);

/*
/*
|--------------------------------------------------------------------------
| Possible Where
|--------------------------------------------------------------------------
|
| The name of possibly where able columns. May include dependent table column also.
|
*/
$config['popular_configure']['possible_where'] 	= array(
												'edit_id' 		 => 'ai_popular_id',
												'ip_address'	 => 'popular_log.ip_address',
												'child_cat_type' => 'child_cat_type',
												'object'  		 => 'object',
												'main_cat_type'  => 'main_cat_type',
												'is_deleted'	 => 'is_deleted',
												'biz_type_id'	 => 'biz_listing.biz_type_id',
												'country_id' 	 => 'biz_listing.country_id',
												'province_id' 	 => 'biz_listing.province_id'
);

/*
|--------------------------------------------------------------------------
| Possible Update
|--------------------------------------------------------------------------
|
| The name of possibly updateable columns.
|
*/
$config['popular_configure']['possible_update'] 	= array(
													'count',
													'child_cat_type'
);
/* End of file popular_configure.php */
/* Location: ./application/modules/popular/config/popular_configure.php */