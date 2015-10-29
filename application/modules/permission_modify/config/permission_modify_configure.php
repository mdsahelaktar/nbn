<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Table name 
|--------------------------------------------------------------------------
|
| The main table of this module.
|
*/
$config['permission_modify_configure']['table_name']		= 'permission_modify';

/*
|--------------------------------------------------------------------------
| Auto Increment Id 
|--------------------------------------------------------------------------
|
| The name of auto increment id column.
|
*/
$config['permission_modify_configure']['ai_id']				= 'ai_permission_modify_id';

/*
|--------------------------------------------------------------------------
| User Map Id 
|--------------------------------------------------------------------------
|
| The name of user map id column.
|
*/
$config['permission_modify_configure']['umap_id']			= 'user_map_id';

/*
|--------------------------------------------------------------------------
| Permission Id 
|--------------------------------------------------------------------------
|
| The name of permission id column.
|
*/
$config['permission_modify_configure']['per_id']			= 'permission_id';

/*
|--------------------------------------------------------------------------
| Soft Delete 
|--------------------------------------------------------------------------
|
| The name of soft delete column. Used for frontend user.
|
*/
$config['permission_modify_configure']['soft_delete']		= 'is_trashed';

/*
|--------------------------------------------------------------------------
| Permanent Delete 
|--------------------------------------------------------------------------
|
| The name of permanent delete column. Permanent delete is parallel to simple database row delete.
|
*/
$config['permission_modify_configure']['permanent_delete'] 	= 'is_deleted';

/*
|--------------------------------------------------------------------------
| Possible Insert
|--------------------------------------------------------------------------
|
| The name of possibly insertable columns.
|
*/
$config['permission_modify_configure']['possible_insert'] 	= array(
														'permission_id',
														'user_map_id',
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
$config['permission_modify_configure']['possible_orderby'] 	= array(  );

/*
|--------------------------------------------------------------------------
| Possible Like
|--------------------------------------------------------------------------
|
| The name of possibly like able columns. May include dependent table column also.
|
*/
$config['permission_modify_configure']['possible_like'] 	= array(  );

/*
|--------------------------------------------------------------------------
| Possible Where
|--------------------------------------------------------------------------
|
| The name of possibly where able columns. May include dependent table column also.
|
*/
$config['permission_modify_configure']['possible_where'] 	= array(
														'user_map_id' 	=> 'user_map_id',
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
$config['permission_modify_configure']['possible_update'] 	= array(
														'permission_id',
														'user_map_id'
);

$config['permission_modify_configure']['sector'] 			= array(
													'add'			=> 2,
													'view_all'		=> 3,
													'edit_all'		=> 4
);
/* End of file permission_modify_configure.php */
/* Location: ./application/modules/permission_modify/config/permission_modify_configure.php */