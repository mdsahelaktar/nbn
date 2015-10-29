<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Table name 
|--------------------------------------------------------------------------
|
| The main table of this module.
|
*/
$config['image_configure']['table_name']			= 'image';

/*
|--------------------------------------------------------------------------
| Auto Increment Id 
|--------------------------------------------------------------------------
|
| The name of auto increment id column.
|
*/
$config['image_configure']['ai_id'] 				= 'ai_image_id';

/*
|--------------------------------------------------------------------------
| category_id
|--------------------------------------------------------------------------
|
| The name of category_id column.
|
*/
$config['image_configure']['context_id']			= 'context_id';

/*
|--------------------------------------------------------------------------
| relation_id 
|--------------------------------------------------------------------------
|
| The name of relation_id column.
|
*/
$config['image_configure']['relation_id']			= 'relation_id';

/*
|--------------------------------------------------------------------------
| caption 
|--------------------------------------------------------------------------
|
| The name of caption column.
|
*/
$config['image_configure']['caption']				= 'caption';

/*
|--------------------------------------------------------------------------
| image_url
|--------------------------------------------------------------------------
|
| The name of image_url column.
|
*/
$config['image_configure']['image_url']				= 'image_url';

/*
|--------------------------------------------------------------------------
| alt
|--------------------------------------------------------------------------
|
| The name of alt column.
|
*/
$config['image_configure']['alt']					= 'alt';

/*
|--------------------------------------------------------------------------
| edit_history
|--------------------------------------------------------------------------
|
| The name of edit_history column.
|
*/
$config['image_configure']['edit_history']			= 'edit_history';

/*
|--------------------------------------------------------------------------
| order
|--------------------------------------------------------------------------
|
| The name of order column.
|
*/
$config['image_configure']['order']					= 'order';

/*
|--------------------------------------------------------------------------
| is_main
|--------------------------------------------------------------------------
|
| The name of is_main column.
|
*/
$config['image_configure']['is_main']				= 'is_main';


/*
|--------------------------------------------------------------------------
| Soft Delete 
|--------------------------------------------------------------------------
|
| The name of soft delete column. Used for frontend user.
|
*/
$config['image_configure']['soft_delete'] 			= 'is_trashed';

/*
|--------------------------------------------------------------------------
| Permanent Delete 
|--------------------------------------------------------------------------
|
| The name of permanent delete column. Permanent delete is parallel to simple database row delete.
|
*/
$config['image_configure']['permanent_delete'] 		= 'is_deleted';

/*
| creation_time
|--------------------------------------------------------------------------
|
| The name of creation_time column.
|
*/
$config['image_configure']['creation_time']			= 'creation_time';

/*
|--------------------------------------------------------------------------
| update_time
|--------------------------------------------------------------------------
|
| The name of update_time column.
|
*/
$config['image_configure']['update_time'] 			= 'update_time';

/*
|--------------------------------------------------------------------------
| Possible Insert
|--------------------------------------------------------------------------
|
| The name of possibly insertable columns.
|
*/
$config['image_configure']['possible_insert'] 		= array(
														'context_id',
														'relation_id',
														'caption',
														'image_url',
														'alt',
														'edit_history',
														'order',
														'is_main',
														'creation_time',
														'update_time'
);

/*
|--------------------------------------------------------------------------
| Possible Order By
|--------------------------------------------------------------------------
|
| The name of possibly orderby able columns. May include dependent table column also.
|
*/
$config['image_configure']['possible_orderby'] 	= array(
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
$config['image_configure']['possible_like'] 		= array();

/*
|--------------------------------------------------------------------------
| Possible Where
|--------------------------------------------------------------------------
|
| The name of possibly where able columns. May include dependent table column also.
|
*/
$config['image_configure']['possible_where'] 		= array(
													'edit_id' 			=> 'ai_image_id',
													'relation_id'		=> 'relation_id',
													'context_id'		=> 'context_id',
													'is_trashed' 		=> 'is_trashed',
													'is_main' 			=> 'is_main',
													'is_deleted' 		=> 'is_deleted'
);

/*
|--------------------------------------------------------------------------
| Possible Update
|--------------------------------------------------------------------------
|
| The name of possibly updateable columns.
|
*/
$config['image_configure']['possible_update'] 	= array(
													'context_id',
													'relation_id',
													'caption',
													'image_url',
													'alt',
													'edit_history',
													'order',
													'is_main',
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
$config['image_configure']['sector'] 				= array(
														'add'			=> 63,
														'view'			=> 64,
														'edit'			=> 65,
);

/* End of file image_configure.php */
/* Location: ./application/modules/image/config/image_configure.php */