<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Table name 
|--------------------------------------------------------------------------
|
| The main table of this module.
|
*/
$config['popularlog_configure']['table_name']			= 'popular_log';

/*
|--------------------------------------------------------------------------
| Auto Increment Id 
|--------------------------------------------------------------------------
|
| The name of auto increment id column.
|
*/
$config['popularlog_configure']['ai_id']				= 'ai_log_id';

/*
|--------------------------------------------------------------------------
| Main Column 
|--------------------------------------------------------------------------
|
| The name of main column.
|
*/
$config['popularlog_configure']['main_col']			= 'ai_log_id';


$config['popularlog_configure']['possible_insert'] 	= array(
													'popular_id',
													'ip_address',
													'creation_time'
													
);
$config['popularlog_configure']['permanent_delete'] 	= 'is_deleted';
/*
|--------------------------------------------------------------------------
| Possible Order By
|--------------------------------------------------------------------------
|
| The name of possibly orderby able columns. May include dependent table column also.
|
*/
$config['popularlog_configure']['possible_orderby'] 	= array(
													'ip_address' 			=> 'ip_address'
);

/*
|--------------------------------------------------------------------------
| Possible Like
|--------------------------------------------------------------------------
|
| The name of possibly like able columns. May include dependent table column also.
|
*/
$config['popularlog_configure']['possible_like'] 	= array(
													'ip_address' 		=> 'ip_address'
);

/*
/*
|--------------------------------------------------------------------------
| Possible Where
|--------------------------------------------------------------------------
|
| The name of possibly where able columns. May include dependent table column also.
|
*/
$config['popularlog_configure']['possible_where'] 	= array(
												'edit_id' 		=> 'ai_log_id'
);

/* End of file popularlog_configure.php */
/* Location: ./application/modules/popularlog/config/popularlog_configure.php */