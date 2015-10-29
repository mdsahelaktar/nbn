<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Dependent On 
|--------------------------------------------------------------------------
|
| The main table 'package' directly mapped with this module dependent upon some table.
| We have followed some rule to link with those tables like -
| on 	: Joining based on key (Need for Sql Query)
| type 	: Joining type (Need for Sql Query)
| where	: Query where (Need for Sql Query)
| fetch : What to select (Need for Sql Query)
|
*/
$config['package_configure']['dependent_on']		= array( 
												'context' => array(
																'on' 	=> 'context.ai_context_id = package.context_id',
																'type' 	=> 'left',
																'where' => array(
																			array('context.is_trashed', 0),
																			array('context.is_deleted', 0)
																			),
																'fetch' => array(
																			'context'
																			)
																)
);

/*
  |--------------------------------------------------------------------------
  | Table name
  |--------------------------------------------------------------------------
  |
  | The main table of this module.
  |
 */
$config['package_configure']['table_name'] = 'package';

/*
  |--------------------------------------------------------------------------
  | Auto Increment Id
  |--------------------------------------------------------------------------
  |
  | The name of auto increment id column.
  |
 */
$config['package_configure']['ai_id'] = 'ai_package_id';

/*
  |--------------------------------------------------------------------------
  | Context Id
  |--------------------------------------------------------------------------
  |
  | The name of context id column.
  |
 */
$config['package_configure']['c_id'] = 'context_id';

/*
  |--------------------------------------------------------------------------
  | Main Column
  |--------------------------------------------------------------------------
  |
  | The name of main column.
  |
 */
$config['package_configure']['main_col'] = 'package';

/*
  |--------------------------------------------------------------------------
  | Soft Delete
  |--------------------------------------------------------------------------
  |
  | The name of soft delete column. Used for frontend user.
  |
 */
$config['package_configure']['soft_delete'] = 'is_trashed';

/*
  |--------------------------------------------------------------------------
  | Permanent Delete
  |--------------------------------------------------------------------------
  |
  | The name of permanent delete column. Permanent delete is parallel to simple database row delete.
  |
 */
$config['package_configure']['permanent_delete'] = 'is_deleted';

/*
  |--------------------------------------------------------------------------
  | Possible Insert
  |--------------------------------------------------------------------------
  |
  | The name of possibly insertable columns.
  |
 */
$config['package_configure']['possible_insert'] = array(
    'context_id',
	'package',
	'description',
	'amount',
	'vim',
	'order',
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
$config['package_configure']['possible_orderby'] = array(
    'sortbypackage' => 'package',
	'sortbyamount' => 'amount',
	'sortbyvim' => 'vim',
    'sortbytime' => 'creation_time',
    'sortbymfdtime' => 'update_time',
    'sortbyactive' => 'is_trashed'
);

/*
  |--------------------------------------------------------------------------
  | Possible Like
  |--------------------------------------------------------------------------
  |
  | The name of possibly like able columns. May include dependent table column also.
  |
 */
$config['package_configure']['possible_like'] = array(
    'package' => 'package'
);

/*
  |--------------------------------------------------------------------------
  | Possible Where
  |--------------------------------------------------------------------------
  |
  | The name of possibly where able columns. May include dependent table column also.
  |
 */
$config['package_configure']['possible_where'] = array(
	'context_id' => 'context_id',
    'edit_id' => 'ai_package_id',
    'creator_id' => 'creator_id',
    'is_trashed' => 'is_trashed'
);

/*
  |--------------------------------------------------------------------------
  | Possible Update
  |--------------------------------------------------------------------------
  |
  | The name of possibly updateable columns.
  |
 */
$config['package_configure']['possible_update'] = array(
    'context_id',
	'package',
	'description',
	'amount',
	'vim',
	'order',
	'creation_time',
	'update_time'
);

/*
  |--------------------------------------------------------------------------
  | Sector
  |--------------------------------------------------------------------------
  |
  | Configuration for sector to check permission.
  |
 */
$config['package_configure']['sector'] = array(
    'add' => 2,
    'view_all' => 3,    
    'edit_all' => 5    
);

/* End of file package_configure.php */
/* Location: ./application/modules/package/config/package_configure.php */