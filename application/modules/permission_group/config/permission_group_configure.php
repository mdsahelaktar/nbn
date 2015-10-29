<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Table name 
|--------------------------------------------------------------------------
|
| The main table of this module.
|
*/
$config['permission_group_configure']['table_name']			= 'permission_group';

/*
|--------------------------------------------------------------------------
| Auto Increment Id 
|--------------------------------------------------------------------------
|
| The name of auto increment id column.
|
*/
$config['permission_group_configure']['ai_id']				= 'ai_permission_group_id';

/*
|--------------------------------------------------------------------------
| Main Column 
|--------------------------------------------------------------------------
|
| The name of main column.
|
*/
$config['permission_group_configure']['main_col']			= 'group';

/*
|--------------------------------------------------------------------------
| Soft Delete 
|--------------------------------------------------------------------------
|
| The name of soft delete column. Used for frontend user.
|
*/
$config['permission_group_configure']['soft_delete']		= 'is_trashed';

/*
|--------------------------------------------------------------------------
| Permanent Delete 
|--------------------------------------------------------------------------
|
| The name of permanent delete column. Permanent delete is parallel to simple database row delete.
|
*/
$config['permission_group_configure']['permanent_delete'] 	= 'is_deleted';

/*
|--------------------------------------------------------------------------
| Possible Insert
|--------------------------------------------------------------------------
|
| The name of possibly insertable columns.
|
*/
$config['permission_group_configure']['possible_insert'] 	= array(
														'group',
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
$config['permission_group_configure']['possible_orderby'] 	= array(
														'sortbygroup' 	=> 'group',
														'sortbytime' 	=> 'creation_time',
														'sortbymfdtime' => 'update_time',
														'sortbyactive' 	=> 'is_trashed'
);

/*
|--------------------------------------------------------------------------
| Possible Like
|--------------------------------------------------------------------------
|
| The name of possibly like able columns. May include dependent table column also.
|
*/
$config['permission_group_configure']['possible_like'] 		= array(
														'permission_group' => 'group'
);

/*
|--------------------------------------------------------------------------
| Possible Where
|--------------------------------------------------------------------------
|
| The name of possibly where able columns. May include dependent table column also.
|
*/
$config['permission_group_configure']['possible_where'] 	= array(
														'edit_id' 		=> 'ai_permission_group_id',
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
$config['permission_group_configure']['possible_update'] 	= array(
														'group'
);

$config['permission_group_configure']['sector'] 			= array(
													'add'			=> 2,
													'view_all'		=> 3,
													'edit_all'		=> 4
);