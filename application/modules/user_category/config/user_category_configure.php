<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Table name
  |--------------------------------------------------------------------------
  |
  | The main table of this module.
  |
 */
$config['user_category_configure']['table_name'] = 'user_category';

/*
  |--------------------------------------------------------------------------
  | Auto Increment Id
  |--------------------------------------------------------------------------
  |
  | The name of auto increment id column.
  |
 */
$config['user_category_configure']['ai_id'] = 'ai_user_category_id';

/*
  |--------------------------------------------------------------------------
  | Main Column
  |--------------------------------------------------------------------------
  |
  | The name of main column.
  |
 */
$config['user_category_configure']['main_col'] = 'user_category';

/*
  |--------------------------------------------------------------------------
  | Creator Id
  |--------------------------------------------------------------------------
  |
  | The name of creator id column.
  |
 */
$config['user_category_configure']['c_id'] = 'creator_id';

/*
  |--------------------------------------------------------------------------
  | Soft Delete
  |--------------------------------------------------------------------------
  |
  | The name of soft delete column. Used for frontend user.
  |
 */
$config['user_category_configure']['soft_delete'] = 'is_trashed';

/*
  |--------------------------------------------------------------------------
  | Permanent Delete
  |--------------------------------------------------------------------------
  |
  | The name of permanent delete column. Permanent delete is parallel to simple database row delete.
  |
 */
$config['user_category_configure']['permanent_delete'] = 'is_deleted';

/*
  |--------------------------------------------------------------------------
  | Possible Insert
  |--------------------------------------------------------------------------
  |
  | The name of possibly insertable columns.
  |
 */
$config['user_category_configure']['possible_insert'] = array(
    'user_category',
    'creation_time',
    'creator_id'
);

/*
  |--------------------------------------------------------------------------
  | Possible Order By
  |--------------------------------------------------------------------------
  |
  | The name of possibly orderby able columns. May include dependent table column also.
  |
 */
$config['user_category_configure']['possible_orderby'] = array(
    'sortbyusercategory' => 'user_category',
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
$config['user_category_configure']['possible_like'] = array(
    'user_category' => 'user_category'
);

/*
  |--------------------------------------------------------------------------
  | Possible Where
  |--------------------------------------------------------------------------
  |
  | The name of possibly where able columns. May include dependent table column also.
  |
 */
$config['user_category_configure']['possible_where'] = array(
    'edit_id' => 'ai_user_category_id',
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
$config['user_category_configure']['possible_update'] = array(
    'user_category'
);

/*
  |--------------------------------------------------------------------------
  | Sector
  |--------------------------------------------------------------------------
  |
  | Configuration for sector to check permission.
  |
 */
$config['user_category_configure']['sector'] = array(
    'add' => 2,
    'view_all' => 3,
    'view_child' => 4,
    'edit_all' => 5,
    'edit_child' => 6
);

/* End of file user_category_configure.php */
/* Location: ./application/modules/user_category/config/user_category_configure.php */