<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Dependent On 
|--------------------------------------------------------------------------
|
| The main table 'default_permission' directly mapped with this module dependent upon some table.
| We have followed some rule to link with those tables like -
| on 	: Joining based on key (Need for Sql Query)
| type 	: Joining type (Need for Sql Query)
| where	: Query where (Need for Sql Query)
| fetch : What to select (Need for Sql Query)
|
*/
$config['default_permission_configure']['dependent_on']		= array(
														'user_role' 		=> array( 
																			'on' 	=> 'user_role.ai_user_role_id = default_permission.user_role_id',
																			'type' 	=> 'left',
																			'where' => array( 
																						array('user_role.is_trashed', 0),
																						array('user_role.is_deleted', 0)
																						),
																			'fetch' => array( 
																						'user_category_id',
																						'user_role'
																						) 
																				),
														'permission' 		=> array(
																			'on' 	=> 'permission.ai_permission_id = allowed_permission_id',
																			'type' 	=> 'left',
																			'where' => array(
																						array('permission.is_trashed', 0),
																						array('permission.is_deleted', 0)
																						),
																			'fetch' => array(
																						'group_id',
																						'permission'
																						)
																				),
														'permission_group' 	=> array(
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
| Groupby Select 
|--------------------------------------------------------------------------
|
| When 'groupby_select' required then these array values are fetched in select query.
|
*/
$config['default_permission_configure']['groupby_select']	= array(
														'permission_group.group',
														'GROUP_CONCAT( permission.ai_permission_id ) AS permission_ids',
														'GROUP_CONCAT( permission.permission ) AS permissions'
);

/*
|--------------------------------------------------------------------------
| Table name 
|--------------------------------------------------------------------------
|
| The main table of this module.
|
*/
$config['default_permission_configure']['table_name']		= 'default_permission';

/*
|--------------------------------------------------------------------------
| Auto Increment Id 
|--------------------------------------------------------------------------
|
| The name of auto increment id column.
|
*/
$config['default_permission_configure']['ai_id']			= 'ai_default_permission_id';

/*
|--------------------------------------------------------------------------
| User Role Id 
|--------------------------------------------------------------------------
|
| The name of user role id column.
|
*/
$config['default_permission_configure']['user_role_id']		= 'user_role_id';

/*
|--------------------------------------------------------------------------
| Allowed Permission Id 
|--------------------------------------------------------------------------
|
| The name of allowed permission id column.
|
*/
$config['default_permission_configure']['ap_id']			= 'allowed_permission_id';

/*
|--------------------------------------------------------------------------
| Soft Delete 
|--------------------------------------------------------------------------
|
| The name of soft delete column. Used for frontend user.
|
*/
$config['default_permission_configure']['soft_delete']		= 'is_trashed';

/*
|--------------------------------------------------------------------------
| Permanent Delete 
|--------------------------------------------------------------------------
|
| The name of permanent delete column. Permanent delete is parallel to simple database row delete.
|
*/
$config['default_permission_configure']['permanent_delete'] = 'is_deleted';

/*
|--------------------------------------------------------------------------
| Possible Insert
|--------------------------------------------------------------------------
|
| The name of possibly insertable columns.
|
*/
$config['default_permission_configure']['possible_insert'] 	= array(
														'user_role_id',
														'allowed_permission_id',
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
$config['default_permission_configure']['possible_orderby'] = array(
														'sortbyrole' 		=> 'user_role.user_role',
														'sortbygroup' 		=> 'permission_group.group',
														'sortbypermission' 	=> 'permission.permission',
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
$config['default_permission_configure']['possible_like'] 	= array(
														'permission' => 'permission.permission'
);

/*
|--------------------------------------------------------------------------
| Possible Where
|--------------------------------------------------------------------------
|
| The name of possibly where able columns. May include dependent table column also.
|
*/
$config['default_permission_configure']['possible_where'] 	= array(
														'edit_id' 		=> 'ai_default_permission_id',
														'role' 			=> 'user_role_id',
														'group' 		=> 'permission.group_id',
														'is_trashed' 	=> 'is_trashed'
);

/*
|--------------------------------------------------------------------------
| Possible Update
|--------------------------------------------------------------------------
|
| The name of possibly updateable columns.
|
*/
$config['default_permission_configure']['possible_update'] 	= array(
														'user_role_id',
														'allowed_permission_id'
);

$config['default_permission_configure']['sector'] 			= array(
													'add'			=> 2,
													'view_all'		=> 3,
													'edit_all'		=> 4
);
/* End of file default_permission_configure.php */
/* Location: ./application/modules/default_permission/config/default_permission_configure.php */