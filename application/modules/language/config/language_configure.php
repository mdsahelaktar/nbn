<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Table name 
|--------------------------------------------------------------------------
|
| The main table of this module.
|
*/
$config['language_configure']['table_name']			= 'language';

/*
|--------------------------------------------------------------------------
| Auto Increment Id 
|--------------------------------------------------------------------------
|
| The name of auto increment id column.
|
*/
$config['language_configure']['ai_id']				= 'ai_language_id';

/*
|--------------------------------------------------------------------------
| Main Column 
|--------------------------------------------------------------------------
|
| The name of main column.
|
*/
$config['language_configure']['main_col']			= 'language';

/*
|--------------------------------------------------------------------------
| Current Language Flag 
|--------------------------------------------------------------------------
|
| The name of is current language? column.
|
*/
$config['language_configure']['is_current']			= 'is_current';

/*
|--------------------------------------------------------------------------
| Soft Delete 
|--------------------------------------------------------------------------
|
| The name of soft delete column. Used for frontend user.
|
*/
$config['language_configure']['soft_delete']		= 'is_trashed';

/*
|--------------------------------------------------------------------------
| Permanent Delete 
|--------------------------------------------------------------------------
|
| The name of permanent delete column. Permanent delete is parallel to simple database row delete.
|
*/
$config['language_configure']['permanent_delete'] 	= 'is_deleted';

/*
|--------------------------------------------------------------------------
| Possible Insert
|--------------------------------------------------------------------------
|
| The name of possibly insertable columns.
|
*/
$config['language_configure']['possible_insert'] 	= array(
												'language',
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
$config['language_configure']['possible_orderby'] 	= array(
												'sortbylanguage' => 'language',
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
$config['language_configure']['possible_like'] 		= array(
												'language' => 'language'
);

/*
|--------------------------------------------------------------------------
| Possible Where
|--------------------------------------------------------------------------
|
| The name of possibly where able columns. May include dependent table column also.
|
*/
$config['language_configure']['possible_where'] 	= array(
												'edit_id' => 'ai_language_id',
												'is_current' => 'is_current',
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
$config['language_configure']['possible_update'] 	= array(
												'language',
												'is_current'
);

$config['language_configure']['sector'] 		    = array(
													'add'			=> 2,
													'view_all'		=> 3,
													'edit_all'		=> 4
);
/* End of file language_configure.php */
/* Location: ./application/modules/language/config/language_configure.php */