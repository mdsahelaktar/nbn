<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Table name 
|--------------------------------------------------------------------------
|
| The main table of this module.
|
*/
$config['theme_configure']['table_name']		= 'theme';

/*
|--------------------------------------------------------------------------
| Auto Increment Id 
|--------------------------------------------------------------------------
|
| The name of auto increment id column.
|
*/
$config['theme_configure']['ai_id']				= 'ai_theme_id';

/*
|--------------------------------------------------------------------------
| Main Column 
|--------------------------------------------------------------------------
|
| The name of main column.
|
*/
$config['theme_configure']['main_col']			= 'theme';

/*
|--------------------------------------------------------------------------
| Current Theme Flag 
|--------------------------------------------------------------------------
|
| The name of is current theme? column.
|
*/
$config['theme_configure']['is_current']		= 'is_current';

/*
|--------------------------------------------------------------------------
| Soft Delete 
|--------------------------------------------------------------------------
|
| The name of soft delete column. Used for frontend user.
|
*/
$config['theme_configure']['soft_delete']		= 'is_trashed';

/*
|--------------------------------------------------------------------------
| Permanent Delete 
|--------------------------------------------------------------------------
|
| The name of permanent delete column. Permanent delete is parallel to simple database row delete.
|
*/
$config['theme_configure']['permanent_delete'] 	= 'is_deleted';

/*
|--------------------------------------------------------------------------
| Possible Insert
|--------------------------------------------------------------------------
|
| The name of possibly insertable columns.
|
*/
$config['theme_configure']['possible_insert'] 	= array(
											'theme',
											'is_current',
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
$config['theme_configure']['possible_orderby'] 	= array(
											'sortbytheme' 	=> 'theme',
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
$config['theme_configure']['possible_like'] 	= array(
											'theme' => 'theme'
);

/*
|--------------------------------------------------------------------------
| Possible Where
|--------------------------------------------------------------------------
|
| The name of possibly where able columns. May include dependent table column also.
|
*/
$config['theme_configure']['possible_where'] 	= array(
											'edit_id' 		=> 'ai_theme_id',
											'is_current' 	=> 'is_current',
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
$config['theme_configure']['possible_update'] 	= array(
											'theme',
											'is_current'
);

$config['theme_configure']['sector'] 			= array(
													'add'			=> 2,
													'view_all'		=> 3,
													'edit_all'		=> 4
);
/* End of file theme_configure.php */
/* Location: ./application/modules/theme/config/theme_configure.php */