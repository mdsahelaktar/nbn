<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Dependent On
  |--------------------------------------------------------------------------
  |
  | The main table 'user_role' directly mapped with this module dependent upon some table.
  | We have followed some rule to link with those tables like -
  | on 	: Joining based on key (Need for Sql Query)
  | type 	: Joining type (Need for Sql Query)
  | where	: Query where (Need for Sql Query)
  | fetch : What to select (Need for Sql Query)
  |
 */
$config['user_role_configure']['dependent_on'] = array(
    'user_category' => array(
        'on' => 'user_category.ai_user_category_id = user_role.user_category_id',
        'type' => 'left',
        'where' => array(
            array('user_category.is_trashed', 0),
            array('user_category.is_deleted', 0)
        ),
        'fetch' => array(
            'user_category', 'creator_id'
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
$config['user_role_configure']['table_name'] = 'user_role';

/*
  |--------------------------------------------------------------------------
  | Auto Increment Id
  |--------------------------------------------------------------------------
  |
  | The name of auto increment id column.
  |
 */
$config['user_role_configure']['ai_id'] = 'ai_user_role_id';

/*
  |--------------------------------------------------------------------------
  | User Category Id
  |--------------------------------------------------------------------------
  |
  | The name of user category id column.
  |
 */
$config['user_role_configure']['uc_id'] = 'user_category_id';

/*
  |--------------------------------------------------------------------------
  | Main Column
  |--------------------------------------------------------------------------
  |
  | The name of main column.
  |
 */
$config['user_role_configure']['main_col'] = 'user_role';

/*
  |--------------------------------------------------------------------------
  | Soft Delete
  |--------------------------------------------------------------------------
  |
  | The name of soft delete column. Used for frontend user.
  |
 */
$config['user_role_configure']['soft_delete'] = 'is_trashed';

/*
  |--------------------------------------------------------------------------
  | Permanent Delete
  |--------------------------------------------------------------------------
  |
  | The name of permanent delete column. Permanent delete is parallel to simple database row delete.
  |
 */
$config['user_role_configure']['permanent_delete'] = 'is_deleted';

/*
  |--------------------------------------------------------------------------
  | Possible Insert
  |--------------------------------------------------------------------------
  |
  | The name of possibly insertable columns.
  |
 */
$config['user_role_configure']['possible_insert'] = array(
    'user_category_id',
    'user_role',
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
$config['user_role_configure']['possible_orderby'] = array(
    'sortbyusercategory' => 'user_category.user_category',
    'sortbyuserrole' => 'user_role',
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
$config['user_role_configure']['possible_like'] = array(
    'user_role' => 'user_role'
);

/*
  |--------------------------------------------------------------------------
  | Possible Where
  |--------------------------------------------------------------------------
  |
  | The name of possibly where able columns. May include dependent table column also.
  |
 */
$config['user_role_configure']['possible_where'] = array(
    'edit_id' => 'ai_user_role_id',
    'user_category' => 'user_category_id',
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
$config['user_role_configure']['possible_update'] = array(
    'user_category_id',
    'user_role'
);


$config['user_role_configure']['sector'] = array(
    'add' => 8,
    'view_all' => 9,
    'edit_all' => 10
);

/* End of file user_role_configure.php */
/* Location: ./application/modules/user_role/config/user_role_configure.php */