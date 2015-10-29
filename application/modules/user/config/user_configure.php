<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Dependent On
  |--------------------------------------------------------------------------
  |
  | The main table 'user' directly mapped with this module dependent upon some table.
  | We have followed some rule to link with those tables like -
  | on 	: Joining based on key (Need for Sql Query)
  | type 	: Joining type (Need for Sql Query)
  | where	: Query where (Need for Sql Query)
  | fetch : What to select (Need for Sql Query)
  |
 */
$config['user_configure']['dependent_on'] = array();

/*
  |--------------------------------------------------------------------------
  | Table name
  |--------------------------------------------------------------------------
  |
  | The main table of this module.
  |
 */
$config['user_configure']['table_name'] = 'user';

/*
  |--------------------------------------------------------------------------
  | Auto Increment Id
  |--------------------------------------------------------------------------
  |
  | The name of auto increment id column.
  |
 */
$config['user_configure']['ai_id'] = 'ai_user_id';

/*
  |--------------------------------------------------------------------------
  | User Name
  |--------------------------------------------------------------------------
  |
  | The name of user name column.
  |
 */
$config['user_configure']['uname'] = 'user_name';

/*
  |--------------------------------------------------------------------------
  | Email
  |--------------------------------------------------------------------------
  |
  | The name of email column.
  |
 */
$config['user_configure']['email'] = 'email';

/*
  |--------------------------------------------------------------------------
  | Password
  |--------------------------------------------------------------------------
  |
  | The name of password column.
  |
 */
$config['user_configure']['password'] = 'password';

/*
  |--------------------------------------------------------------------------
  | Salutation
  |--------------------------------------------------------------------------
  |
  | The name of salutation column.
  |
 */
$config['user_configure']['slt'] = 'salutation';

/*
  |--------------------------------------------------------------------------
  | First Name
  |--------------------------------------------------------------------------
  |
  | The name of first name column.
  |
 */
$config['user_configure']['fname'] = 'first_name';

/*
  |--------------------------------------------------------------------------
  | Middle Name
  |--------------------------------------------------------------------------
  |
  | The name of middle name column.
  |
 */
$config['user_configure']['mname'] = 'middle_name';

/*
  |--------------------------------------------------------------------------
  | Last Name
  |--------------------------------------------------------------------------
  |
  | The name of last name column.
  |
 */
$config['user_configure']['lname'] = 'last_name';

/*
  |--------------------------------------------------------------------------
  | Work Phone No
  |--------------------------------------------------------------------------
  |
  | The name of work phone no column.
  |
 */
$config['user_configure']['wpn'] = 'work_phone_no';

/*
  |--------------------------------------------------------------------------
  | Mobile Phone No
  |--------------------------------------------------------------------------
  |
  | The name of mobile phone no column.
  |
 */
$config['user_configure']['mpn'] = 'mobile_phone_no';

/*
  |--------------------------------------------------------------------------
  | Fax Number
  |--------------------------------------------------------------------------
  |
  | The name of fax number column.
  |
 */
$config['user_configure']['fnum'] = 'fax_num';

/*
  |--------------------------------------------------------------------------
  | Parent Id
  |--------------------------------------------------------------------------
  |
  | The name of parent id column.
  |
 */
$config['user_configure']['p_id'] = 'parent_id';

/*
  |--------------------------------------------------------------------------
  | Activation Key
  |--------------------------------------------------------------------------
  |
  | The name of activation key column.
  |
 */
$config['user_configure']['activation_key'] = 'activation_key';

/*
  |--------------------------------------------------------------------------
  | Soft Delete
  |--------------------------------------------------------------------------
  |
  | The name of soft delete column. Used for frontend user.
  |
 */
$config['user_configure']['soft_delete'] = 'disable';

/*
  |--------------------------------------------------------------------------
  | Permanent Delete
  |--------------------------------------------------------------------------
  |
  | The name of permanent delete column. Permanent delete is parallel to simple database row delete.
  |
 */
$config['user_configure']['permanent_delete'] = 'is_deleted';

/*
  |--------------------------------------------------------------------------
  | Possible Insert
  |--------------------------------------------------------------------------
  |
  | The name of possibly insertable columns.
  |
 */
$config['user_configure']['possible_insert'] = array(
    'user_name',
    'email',
    'password',
    'salutation',
    'first_name',
    'middle_name',
    'last_name',
    'work_phone_no',
    'mobile_phone_no',
    'fax_num',
    'parent_id',
	'activation_key',
	'disable',
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
$config['user_configure']['possible_orderby'] = array(
    'sortbyusername' => 'user_name',
    'sortbyemail' => 'email',
    'sortbysalutation' => 'salutation',
    'sortbyfirstname' => 'first_name',
    'sortbymiddlename' => 'middle_name',
    'sortbylastname' => 'last_name',
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
$config['user_configure']['possible_like'] = array(
    'uname' => 'user_name',
    'email' => 'email',
    'slt' => 'salutation',
    'fname' => 'first_name',
    'mname' => 'middle_name',
    'lname' => 'last_name',
    'wpn' => 'work_phone_no',
    'mpn' => 'mobile_phone_no',
    'fnum' => 'fax_num'
);

/*
  |--------------------------------------------------------------------------
  | Possible Where
  |--------------------------------------------------------------------------
  |
  | The name of possibly where able columns. May include dependent table column also.
  |
 */
$config['user_configure']['possible_where'] = array(
    'user_name' => 'user_name',
    'password' => 'password',
    'edit_id' => 'ai_user_id',
    'parent_id' => 'parent_id',
	'activation_key' => 'activation_key', 
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
$config['user_configure']['possible_update'] = array(
    'user_name',
    'email',
    'password',
    'salutation',
    'first_name',
    'middle_name',
    'last_name',
    'work_phone_no',
    'mobile_phone_no',
    'fax_num',
	'activation_key',
	'disable'
);


$config['user_configure']['sector'] = array(
    'add' => 16,
    'view_all' => 17,
    'view_child' => 18,
    'edit_all' => 19,
    'edit_child' => 20
);

/* End of file user_configure.php */
/* Location: ./application/modules/user/config/user_configure.php */