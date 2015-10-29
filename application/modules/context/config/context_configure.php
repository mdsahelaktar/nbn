<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Table name 
|--------------------------------------------------------------------------
|
| The main table of this module.
|
*/
$config['context_configure']['table_name']		= 'context';

/*
|--------------------------------------------------------------------------
| Auto Increment Id 
|--------------------------------------------------------------------------
|
| The name of auto increment id column.
|
*/
$config['context_configure']['ai_id'] 			= 'ai_context_id';

/*
|--------------------------------------------------------------------------
| Main Column 
|--------------------------------------------------------------------------
|
| The name of main column.
|
*/
$config['context_configure']['main_col'] 			= 'context';

/*
|--------------------------------------------------------------------------
| description
|--------------------------------------------------------------------------
|
| The name of description column.
|
*/
$config['context_configure']['description'] 		= 'description';

/*
|--------------------------------------------------------------------------
| Soft Delete 
|--------------------------------------------------------------------------
|
| The name of soft delete column. Used for frontend user.
|
*/
$config['context_configure']['soft_delete'] 		= 'is_trashed';

/*
|--------------------------------------------------------------------------
| Permanent Delete 
|--------------------------------------------------------------------------
|
| The name of permanent delete column. Permanent delete is parallel to simple database row delete.
|
*/
$config['context_configure']['permanent_delete'] 	= 'is_deleted';

/*
|--------------------------------------------------------------------------
| Possible Insert
|--------------------------------------------------------------------------
|
| The name of possibly insertable columns.
|
*/
$config['context_configure']['possible_insert'] 	= array(
													'context',
													'description',
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
$config['context_configure']['possible_orderby'] 	= array(
													'sortbycontext' 	=> 'context',
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
$config['context_configure']['possible_like'] 	= array(
													'context' 		=> 'context'
);

/*
|--------------------------------------------------------------------------
| Possible Where
|--------------------------------------------------------------------------
|
| The name of possibly where able columns. May include dependent table column also.
|
*/
$config['context_configure']['possible_where'] 	= array(
													'edit_id' 		=> 'ai_context_id',
													'ai_context_id' => 'ai_context_id',
													'creator_id' 	=> 'creator_id',
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
$config['context_configure']['possible_update'] 	= array(
													'context',
													'description'
);

/*
|--------------------------------------------------------------------------
| Sector
|--------------------------------------------------------------------------
|
| Configuration for sector to check permission.
|
*/
$config['context_configure']['sector'] 			= array(
													'add'			=> 2,
													'view_all'		=> 3,
													'view_child'	=> 54,
													'edit_all'		=> 4,
													'edit_child'	=> 55
);

/* End of file user_context_configure.php */
/* Location: ./application/modules/user_context/config/user_context_configure.php */