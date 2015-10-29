<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Dependent On 
|--------------------------------------------------------------------------
|
| The main table 'biz_type' directly mapped with this module dependent upon some table.
| We have followed some rule to link with those tables like -
| on 	: Joining based on key (Need for Sql Query)
| type 	: Joining type (Need for Sql Query)
| where	: Query where (Need for Sql Query)
| fetch : What to select (Need for Sql Query)
|
*/
$config['biz_type_configure']['dependent_on']		= array(
												'biz_domain' => array(
																	'on' 	=> 'biz_domain.ai_biz_domain_id = biz_type.domain_id',
																	'type' 	=> 'left',
																	'where' => array(
																				array('biz_domain.is_trashed', 0),
																				array('biz_domain.is_deleted', 0)
																				),
																	'fetch' => array(
																				'domain'
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
$config['biz_type_configure']['groupby_select']		= array(
												'biz_domain.domain',
												'biz_type.domain_id',
												"GROUP_CONCAT( biz_type.ai_biz_type_id SEPARATOR '[@]' ) AS ai_biz_type_ids",
												"GROUP_CONCAT( biz_type.biz_type SEPARATOR '[@]' ) AS biz_types"
);

/*
|--------------------------------------------------------------------------
| Table name 
|--------------------------------------------------------------------------
|
| The main table of this module.
|
*/
$config['biz_type_configure']['table_name']			= 'biz_type';

/*
|--------------------------------------------------------------------------
| Auto Increment Id 
|--------------------------------------------------------------------------
|
| The name of auto increment id column.
|
*/
$config['biz_type_configure']['ai_id']				= 'ai_biz_type_id';

/*
|--------------------------------------------------------------------------
| Domain Id 
|--------------------------------------------------------------------------
|
| The name of user domain id column.
|
*/
$config['biz_type_configure']['d_id']				= 'domain_id';

/*
|--------------------------------------------------------------------------
| Main Column 
|--------------------------------------------------------------------------
|
| The name of main column.
|
*/
$config['biz_type_configure']['main_col']			= 'biz_type';

/*
|--------------------------------------------------------------------------
| Soft Delete 
|--------------------------------------------------------------------------
|
| The name of soft delete column. Used for frontend user.
|
*/
$config['biz_type_configure']['soft_delete']		= 'is_trashed';

/*
|--------------------------------------------------------------------------
| Permanent Delete 
|--------------------------------------------------------------------------
|
| The name of permanent delete column. Permanent delete is parallel to simple database row delete.
|
*/
$config['biz_type_configure']['permanent_delete'] 	= 'is_deleted';

/*
|--------------------------------------------------------------------------
| Possible Insert
|--------------------------------------------------------------------------
|
| The name of possibly insertable columns.
|
*/
$config['biz_type_configure']['possible_insert'] 	= array();

/*
|--------------------------------------------------------------------------
| Possible Order By
|--------------------------------------------------------------------------
|
| The name of possibly orderby able columns. May include dependent table column also.
|
*/
$config['biz_type_configure']['possible_orderby'] 	= array();

/*
|--------------------------------------------------------------------------
| Possible Like
|--------------------------------------------------------------------------
|
| The name of possibly like able columns. May include dependent table column also.
|
*/
$config['biz_type_configure']['possible_like'] 		= array(
												'biz_type' => 'biz_type'
);

/*
|--------------------------------------------------------------------------
| Possible Where
|--------------------------------------------------------------------------
|
| The name of possibly where able columns. May include dependent table column also.
|
*/
$config['biz_type_configure']['possible_where'] 	= array(
												'edit_id' 		=> 'ai_biz_type_id',
												'domain' 		=> 'domain_id',
												'is_trashed'	=> 'is_trashed'
);

/*
|--------------------------------------------------------------------------
| Possible Update
|--------------------------------------------------------------------------
|
| The name of possibly updateable columns.
|
*/
$config['biz_type_configure']['possible_update'] 	= array();

/* End of file biz_type_configure.php */
/* Location: ./application/modules/biz_type/config/biz_type_configure.php */