<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Dependent On
  |--------------------------------------------------------------------------
  |
  | The main table 'user_map' directly mapped with this module dependent upon some table.
  | We have followed some rule to link with those tables like -
  | on 	: Joining based on key (Need for Sql Query)
  | type 	: Joining type (Need for Sql Query)
  | where	: Query where (Need for Sql Query)
  | fetch : What to select (Need for Sql Query)
  |
 */
$config['user_map_configure']['dependent_on'] = array(
    'user' => array(
        'on' => 'user.ai_user_id = user_id',
        'type' => 'left',
        'where' => array(
            array('user.disable', 0),
            array('user.is_deleted', 0)
        ),
        'fetch' => array(
            'user_name'
        )
    ),
    'user_category' => array(
        'on' => 'user_category.ai_user_category_id = user_map.user_category_id',
        'type' => 'left',
        'where' => array(
            array('user_category.is_trashed', 0),
            array('user_category.is_deleted', 0)
        ),
        'fetch' => array(
            'user_category'
        )
    ),
    'user_role' => array(
        'on' => 'user_role.ai_user_role_id = user_map.user_role_id',
        'type' => 'left',
        'where' => array(
            array('user_role.is_trashed', 0),
            array('user_role.is_deleted', 0)
        ),
        'fetch' => array(
            'user_role'
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
$config['user_map_configure']['groupby_select'] = array(
    'user_map.user_category_id',
    'user_category.user_category',
    'GROUP_CONCAT( user_map.ai_user_map_id ) AS ai_user_map_ids',
    'GROUP_CONCAT( user_map.user_role_id ) AS user_role_ids',
    'GROUP_CONCAT( user_role.user_role ) AS user_roles'
);

/*
  |--------------------------------------------------------------------------
  | Table name
  |--------------------------------------------------------------------------
  |
  | The main table of this module.
  |
 */
$config['user_map_configure']['table_name'] = 'user_map';

/*
  |--------------------------------------------------------------------------
  | Auto Increment Id
  |--------------------------------------------------------------------------
  |
  | The name of auto increment id column.
  |
 */
$config['user_map_configure']['ai_id'] = 'ai_user_map_id';

/*
  |--------------------------------------------------------------------------
  | User Id
  |--------------------------------------------------------------------------
  |
  | The name of user id column.
  |
 */
$config['user_map_configure']['u_id'] = 'user_id';

/*
  |--------------------------------------------------------------------------
  | User Category Id
  |--------------------------------------------------------------------------
  |
  | The name of user category id column.
  |
 */
$config['user_map_configure']['uc_id'] = 'user_category_id';

/*
  |--------------------------------------------------------------------------
  | User Role Id
  |--------------------------------------------------------------------------
  |
  | The name of user role id column.
  |
 */
$config['user_map_configure']['role_id'] = 'user_role_id';

/*
  |--------------------------------------------------------------------------
  | Soft Delete
  |--------------------------------------------------------------------------
  |
  | The name of soft delete column. Used for frontend user.
  |
 */
$config['user_map_configure']['soft_delete'] = 'disable';

/*
  |--------------------------------------------------------------------------
  | Creation Time
  |--------------------------------------------------------------------------
  |
  | The name of creation time column.
  |
 */
$config['user_map_configure']['crt'] = 'creation_time';

/*
  |--------------------------------------------------------------------------
  | Permanent Delete
  |--------------------------------------------------------------------------
  |
  | The name of permanent delete column. Permanent delete is parallel to simple database row delete.
  |
 */
$config['user_map_configure']['permanent_delete'] = 'is_deleted';

/*
  |--------------------------------------------------------------------------
  | Possible Insert
  |--------------------------------------------------------------------------
  |
  | The name of possibly insertable columns.
  |
 */
$config['user_map_configure']['possible_insert'] = array(
    'user_id',
    'user_category_id',
    'user_role_id',
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
$config['user_map_configure']['possible_orderby'] = array(
    'sortbyusername' => 'user.user_name',
    'sortbycategory' => 'user_category.user_category',
    'sortbyrole' => 'user_role.user_role',
    'sortbytime' => 'creation_time',
    'sortbymfdtime' => 'update_time',
    'sortbyactive' => 'disable'
);

/*
  |--------------------------------------------------------------------------
  | Possible Like
  |--------------------------------------------------------------------------
  |
  | The name of possibly like able columns. May include dependent table column also.
  |
 */
$config['user_map_configure']['possible_like'] = array(
    'user_name' => 'user.user_name'
);

/*
  |--------------------------------------------------------------------------
  | Possible Where
  |--------------------------------------------------------------------------
  |
  | The name of possibly where able columns. May include dependent table column also.
  |
 */
$config['user_map_configure']['possible_where'] = array(
    'edit_id' => 'ai_user_map_id',
    'user_id' => 'user_id',
    'user_category' => 'user_category_id',
    'role' => 'user_role_id',
    'is_trashed' => 'disable'
);

/*
  |--------------------------------------------------------------------------
  | Possible Update
  |--------------------------------------------------------------------------
  |
  | The name of possibly updateable columns.
  |
 */
$config['user_map_configure']['possible_update'] = array();

/* End of file user_map_configure.php */
/* Location: ./application/modules/user_map/config/user_map_configure.php */

$config['user_map_configure']['sector'] = array(
    'add' => 2,
    'view_all' => 3,
    'view_child' => 54,
    'edit_all' => 4,
    'edit_child' => 55
);
