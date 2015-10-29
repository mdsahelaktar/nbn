<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Dependent On 
|--------------------------------------------------------------------------
|
| The main table 'permission' directly mapped with this module dependent upon some table.
| We have followed some rule to link with those tables like -
| on 	: Joining based on key (Need for Sql Query)
| type 	: Joining type (Need for Sql Query)
| where	: Query where (Need for Sql Query)
| fetch : What to select (Need for Sql Query)
|
*/
$config['permission_configure']['dependent_on']		= array( 
												'permission_group' => array(
																		'on' 	=> 'permission_group.ai_permission_group_id = permission.group_id',
																		'type' 	=> 'left',
																		'where' => array(
																					array('permission_group.is_trashed', 0),
																					array('permission_group.is_deleted', 0)
																					),
																		'fetch' => array(
																					'group'
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
$config['permission_configure']['table_name']		= 'permission';

/*
|--------------------------------------------------------------------------
| Auto Increment Id 
|--------------------------------------------------------------------------
|
| The name of auto increment id column.
|
*/
$config['permission_configure']['ai_id']			= 'ai_permission_id';

/*
|--------------------------------------------------------------------------
| Group Id 
|--------------------------------------------------------------------------
|
| The name of group id column.
|
*/
$config['permission_configure']['gr_id']			= 'group_id';

/*
|--------------------------------------------------------------------------
| Main Column 
|--------------------------------------------------------------------------
|
| The name of main column.
|
*/
$config['permission_configure']['main_col']			= 'permission';

/*
|--------------------------------------------------------------------------
| Soft Delete 
|--------------------------------------------------------------------------
|
| The name of soft delete column. Used for frontend user.
|
*/
$config['permission_configure']['soft_delete']		= 'is_trashed';

/*
|--------------------------------------------------------------------------
| Permanent Delete 
|--------------------------------------------------------------------------
|
| The name of permanent delete column. Permanent delete is parallel to simple database row delete.
|
*/
$config['permission_configure']['permanent_delete'] = 'is_deleted';

/*
|--------------------------------------------------------------------------
| Possible Insert
|--------------------------------------------------------------------------
|
| The name of possibly insertable columns.
|
*/
$config['permission_configure']['possible_insert'] 	= array( 
												'group_id',
												'permission',
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
$config['permission_configure']['possible_orderby'] = array( 
												'sortbygroup' 		=> 'permission_group.group',
												'sortbypermission' 	=> 'permission',
												'sortbytime' 		=> 'creation_time',
												'sortbymfdtime' 	=> 'update_time',
												'sortbyactive' 		=> 'is_trashed' 
);

/*
|--------------------------------------------------------------------------
| Possible Like
|--------------------------------------------------------------------------
|
| The name of possibly like able columns. May include dependent table column also.
|
*/
$config['permission_configure']['possible_like'] 	= array( 
												'permission' 		=> 'permission'
);

/*
|--------------------------------------------------------------------------
| Possible Where
|--------------------------------------------------------------------------
|
| The name of possibly where able columns. May include dependent table column also.
|
*/
$config['permission_configure']['possible_where'] 	= array( 
												'edit_id' 			=> 'ai_permission_id',
												'permission_group' 	=> 'group_id',
												'is_trashed' 		=> 'is_trashed'
);

/*
|--------------------------------------------------------------------------
| Possible Update
|--------------------------------------------------------------------------
|
| The name of possibly updateable columns.
|
*/
$config['permission_configure']['possible_update'] 	= array( 
												'group_id',
												'permission'
);


$config['permission_configure']['sector'] 			= array(
													'add'			=> 2,
													'view_all'		=> 3,
													'edit_all'		=> 4
);
/* End of file permission_configure.php */
/* Location: ./application/modules/permission/config/permission_configure.php */