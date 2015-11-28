<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Dependent On
  |--------------------------------------------------------------------------
  |
  | The main table 'biz_listing' directly mapped with this module dependent upon some table.
  | We have followed some rule to link with those tables like -
  | on 	: Joining based on key (Need for Sql Query)
  | type 	: Joining type (Need for Sql Query)
  | where	: Query where (Need for Sql Query)
  | fetch : What to select (Need for Sql Query)
  |
 */
$config['biz_listing_configure']['dependent_on'] = array(
    'image' => array(
        'on' => 'biz_listing.ai_biz_listing_id = image.relation_id',
        'type' => 'left',
        'fetch' => array(
            'image_url',
            'is_trashed',
            'is_deleted',
            'is_main',
            'context_id'
        ),
		'where' => array( '(CASE WHEN image.context_id IS NULL THEN 1 ELSE image.context_id = 1 END)' )// Place image context id now biz = 3 as image context id
    ),
    'country' => array(
        'on' => 'biz_listing.country_id = country.ai_country_id',
        'type' => 'left',
        'where' => array('(CASE WHEN country.ai_country_id IS NULL THEN 1 ELSE country.is_deleted =  0 and country.is_trashed = 0 END)'),
        'fetch' => array(
            'country'
        )
    ),
    'province' => array(
        'on' => 'biz_listing.province_id = province.ai_province_id',
        'type' => 'left',
        'fetch' => array(
            'province'
        ),
        'where' => array('(CASE WHEN province.province IS NULL THEN 1 ELSE province.is_deleted =  0 END)')
    ),
    'county' => array(
        'on' => 'biz_listing.county_id = county.ai_county_id',
        'type' => 'left',
        'fetch' => array(
            'county'
        ),
        'where' => array('(CASE WHEN county.county IS NULL THEN 1 ELSE county.is_deleted =  0 END)')
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
$config['biz_listing_configure']['groupby_select'] = array(
    'biz_listing.*',
    'county.county',
    'country.country',
    'province.province',
    "GROUP_CONCAT( image.image_url , ',',image.context_id , ',', image.is_trashed , ',', image.is_deleted , ',', image.is_main SEPARATOR '[@]' ) AS image_information"
);

/*
  |--------------------------------------------------------------------------
  | Table name
  |--------------------------------------------------------------------------
  |
  | The main table of this module.
  |
 */
$config['biz_listing_configure']['table_name'] = 'biz_listing';

/*
  |--------------------------------------------------------------------------
  | Auto Increment Id
  |--------------------------------------------------------------------------
  |
  | The name of auto increment id column.
  |
 */
$config['biz_listing_configure']['ai_id'] = 'ai_biz_listing_id';

/*
  |--------------------------------------------------------------------------
  | Main Column
  |--------------------------------------------------------------------------
  |
  | The name of main column.
  |
 */
$config['biz_listing_configure']['main_col'] = 'headline';

/*
  |--------------------------------------------------------------------------
  | Relation Id
  |--------------------------------------------------------------------------
  |
  | The name of relation id column.
  |
 */
$config['biz_listing_configure']['d_id'] = 'relation_id';

/*
  |--------------------------------------------------------------------------
  | Tagline
  |--------------------------------------------------------------------------
  |
  | The name of tagline column.
  |
 */

$config['biz_listing_configure']['tagline'] = 'tagline';

/*
  |--------------------------------------------------------------------------
  | Description
  |--------------------------------------------------------------------------
  |
  | The name of description column.
  |
 */
$config['biz_listing_configure']['description'] = 'description';

/*
  |--------------------------------------------------------------------------
  | Biz Type Id
  |--------------------------------------------------------------------------
  |
  | The name of biz_type_id column.
  |
 */
$config['biz_listing_configure']['biz_type_id'] = 'biz_type_id';

/*
  |--------------------------------------------------------------------------
  | Other Biz Type Id
  |--------------------------------------------------------------------------
  |
  | The name of other_biz_type_id column.
  |
 */
$config['biz_listing_configure']['other_biz_type_id'] = 'other_biz_type_id';

/*
  |--------------------------------------------------------------------------
  | Country Id
  |--------------------------------------------------------------------------
  |
  | The name of country_id column.
  |
 */
$config['biz_listing_configure']['country_id'] = 'country_id';

/*
  |--------------------------------------------------------------------------
  | Province Id
  |--------------------------------------------------------------------------
  |
  | The name of province_id column.
  |
 */
$config['biz_listing_configure']['province_id'] = 'province_id';

/*
  |--------------------------------------------------------------------------
  | County Id
  |--------------------------------------------------------------------------
  |
  | The name of county_id column.
  |
 */
$config['biz_listing_configure']['county_id'] = 'county_id';

/*
  |--------------------------------------------------------------------------
  | Is County Confidential
  |--------------------------------------------------------------------------
  |
  | The name of is_county_cnfdntl column.
  |
 */
$config['biz_listing_configure']['icc'] = 'is_county_cnfdntl';

/*
  |--------------------------------------------------------------------------
  | City
  |--------------------------------------------------------------------------
  |
  | The name of city column.
  |
 */
$config['biz_listing_configure']['city'] = 'city';

/*
  |--------------------------------------------------------------------------
  | Asking Price
  |--------------------------------------------------------------------------
  |
  | The name of asking_price column.
  |
 */
$config['biz_listing_configure']['asking_price'] = 'asking_price';

/*
  |--------------------------------------------------------------------------
  | Is Finanicing Available
  |--------------------------------------------------------------------------
  |
  | The name of is_fincng_avlble column.
  |
 */
$config['biz_listing_configure']['ifa'] = 'is_fincng_avlble';

/*
  |--------------------------------------------------------------------------
  | Year Established
  |--------------------------------------------------------------------------
  |
  | The name of year_established column.
  |
 */
$config['biz_listing_configure']['ye'] = 'year_established';

/*
  |--------------------------------------------------------------------------
  | Employees
  |--------------------------------------------------------------------------
  |
  | The name of employees column.
  |
 */
$config['biz_listing_configure']['empls'] = 'employees';

/*
  |--------------------------------------------------------------------------
  | Biz Website
  |--------------------------------------------------------------------------
  |
  | The name of biz_website column.
  |
 */
$config['biz_listing_configure']['bw'] = 'biz_website';

/*
  |--------------------------------------------------------------------------
  | Gross Revenue
  |--------------------------------------------------------------------------
  |
  | The name of gross_revenue column.
  |
 */
$config['biz_listing_configure']['gr'] = 'gross_revenue';

/*
  |--------------------------------------------------------------------------
  | Gross Revenue Comments
  |--------------------------------------------------------------------------
  |
  | The name of gross_revenue_comments column.
  |
 */
$config['biz_listing_configure']['grc'] = 'gross_revenue_comments';

/*
  |--------------------------------------------------------------------------
  | Cash Flow
  |--------------------------------------------------------------------------
  |
  | The name of cash_flow column.
  |
 */
$config['biz_listing_configure']['cf'] = 'cash_flow';

/*
  |--------------------------------------------------------------------------
  | Cash Flow Comments
  |--------------------------------------------------------------------------
  |
  | The name of cash_flow_comments column.
  |
 */
$config['biz_listing_configure']['cfc'] = 'cash_flow_comments';

/*
  |--------------------------------------------------------------------------
  | Inventory Value
  |--------------------------------------------------------------------------
  |
  | The name of inv_value column.
  |
 */
$config['biz_listing_configure']['iv'] = 'inv_value';

/*
  |--------------------------------------------------------------------------
  | Is Inventory Value Included
  |--------------------------------------------------------------------------
  |
  | The name of is_inv_included column.
  |
 */
$config['biz_listing_configure']['iii'] = 'is_inv_included';

/*
  |--------------------------------------------------------------------------
  | Furniture, Fixture, Equipment Value
  |--------------------------------------------------------------------------
  |
  | The name of ffe_value column.
  |
 */
$config['biz_listing_configure']['fv'] = 'ffe_value';

/*
  |--------------------------------------------------------------------------
  | Is Furniture, Fixture, Equipment Value Included
  |--------------------------------------------------------------------------
  |
  | The name of is_ffe_included column.
  |
 */
$config['biz_listing_configure']['fvi'] = 'is_ffe_included';

/*
  |--------------------------------------------------------------------------
  | Real Estate Value
  |--------------------------------------------------------------------------
  |
  | The name of rs_value column.
  |
 */
$config['biz_listing_configure']['rv'] = 'rs_value';

/*
  |--------------------------------------------------------------------------
  | Is Real Estate Value Included
  |--------------------------------------------------------------------------
  |
  | The name of is_rs_included column.
  |
 */
$config['biz_listing_configure']['rvi'] = 'is_rs_included';

/*
  |--------------------------------------------------------------------------
  | Is Biz Relocatable
  |--------------------------------------------------------------------------
  |
  | The name of is_biz_relctble column.
  |
 */
$config['biz_listing_configure']['ibr'] = 'is_biz_relctble';

/*
  |--------------------------------------------------------------------------
  | Is Biz Franchise
  |--------------------------------------------------------------------------
  |
  | The name of is_biz_franchis column.
  |
 */
$config['biz_listing_configure']['ibf'] = 'is_biz_franchis';

/*
  |--------------------------------------------------------------------------
  | Is Biz Home Based
  |--------------------------------------------------------------------------
  |
  | The name of is_biz_hb column.
  |
 */
$config['biz_listing_configure']['ibh'] = 'is_biz_hb';

/*
  |--------------------------------------------------------------------------
  | Seller Financing Info
  |--------------------------------------------------------------------------
  |
  | The name of seller_fincng_info column.
  |
 */
$config['biz_listing_configure']['sfi'] = 'seller_fincng_info';

/*
  |--------------------------------------------------------------------------
  | Selling Reason
  |--------------------------------------------------------------------------
  |
  | The name of selling_reason column.
  |
 */
$config['biz_listing_configure']['sr'] = 'selling_reason';

/*
  |--------------------------------------------------------------------------
  | Market Outlook / Competition
  |--------------------------------------------------------------------------
  |
  | The name of mkt_outlook_cmp column.
  |
 */
$config['biz_listing_configure']['moc'] = 'mkt_outlook_cmp';

/*
  |--------------------------------------------------------------------------
  | Keywords
  |--------------------------------------------------------------------------
  |
  | The name of keywords column.
  |
 */
$config['biz_listing_configure']['keywords'] = 'keywords';

/*
  |--------------------------------------------------------------------------
  | Keywords
  |--------------------------------------------------------------------------
  |
  | The name of keywords column.
  |
 */
$config['biz_listing_configure']['user_id'] = 'user_id';

/*
  |--------------------------------------------------------------------------
  | Keywords
  |--------------------------------------------------------------------------
  |
  | The name of keywords column.
  |
 */
$config['biz_listing_configure']['country'] = 'country';

/*
  |--------------------------------------------------------------------------
  | Keywords
  |--------------------------------------------------------------------------
  |
  | The name of keywords column.
  |
 */
$config['biz_listing_configure']['creation_time'] = 'creation_time';

/*
  |--------------------------------------------------------------------------
  | Creator Id
  |--------------------------------------------------------------------------
  |
  | The name of creator id column.
  |
 */
$config['biz_listing_configure']['c_id'] = 'user_id';

/*
  |--------------------------------------------------------------------------
  | Soft Delete
  |--------------------------------------------------------------------------
  |
  | The name of soft delete column. Used for frontend user.
  |
 */
$config['biz_listing_configure']['soft_delete'] = 'is_trashed';

/*
  |--------------------------------------------------------------------------
  | Permanent Delete
  |--------------------------------------------------------------------------
  |
  | The name of permanent delete column. Permanent delete is parallel to simple database row delete.
  |
 */
$config['biz_listing_configure']['permanent_delete'] = 'is_deleted';

/*
  |--------------------------------------------------------------------------
  | Permanent unset
  |--------------------------------------------------------------------------
  |
  | The name of permanent delete column. Permanent delete is parallel to simple database row delete.
  |
 */
$config['biz_listing_configure']['pagination_unset_tables'] = array(
    'image'
);

/*
  |--------------------------------------------------------------------------
  | Possible Insert
  |--------------------------------------------------------------------------
  |
  | The name of possibly insertable columns.
  |
 */
$config['biz_listing_configure']['possible_insert'] = array(
    'headline',
    'tagline',
    'description',
    'biz_type_id',
    'other_biz_type_id',
    'country_id',
    'province_id',
    'county_id',
    'is_county_cnfdntl',
    'city',
    'asking_price',
    'is_fincng_avlble',
    'year_established',
    'employees',
    'biz_website',
    'gross_revenue',
    'gross_revenue_comments',
    'cash_flow',
    'cash_flow_comments',
    'inv_value',
    'is_inv_included',
    'ffe_value',
    'is_ffe_included',
    'rs_value',
    'is_rs_included',
    'is_biz_relctble',
    'is_biz_franchis',
    'is_biz_hb',
    'seller_fincng_info',
    'training_support',
    'selling_reason',
    'facilities',
    'mkt_outlook_cmp',
    'keywords',
    'creation_time',
    'creator_id',
    'status',
    'user_id'
);

/*
  |--------------------------------------------------------------------------
  | Possible Order By
  |--------------------------------------------------------------------------
  |
  | The name of possibly orderby able columns. May include dependent table column also.
  |
 */
$config['biz_listing_configure']['possible_orderby'] = array(
    'sortbyheadline' => 'headline',
	'sortbytagline' => 'tagline',
	'sortbyasking_price' => 'asking_price',
    'sortbycash_flow' => 'cash_flow',
    'sortbycreation_time' => 'creation_time',
    'sortbyprovince_id' => 'province.province',
    'sortbycounty_id' => 'county.county',
    'sortbycity' => 'city',
	'sortbytime' => 'creation_time',
    'sortbymfdtime' => 'update_time',
    'sortbyactive' => 'biz_listing.is_trashed'
);

/*
  |--------------------------------------------------------------------------
  | Possible Like
  |--------------------------------------------------------------------------
  |
  | The name of possibly like able columns. May include dependent table column also.
  |
 */
$config['biz_listing_configure']['possible_like'] = array(
    'headline' => 'headline',
    'description' => 'description'
);

/*
  |--------------------------------------------------------------------------
  | Possible Where
  |--------------------------------------------------------------------------
  |
  | The name of possibly where able columns. May include dependent table column also.
  |
 */
$config['biz_listing_configure']['possible_where'] = array(
    'edit_id' => 'ai_biz_listing_id',
    'is_trashed' => 'is_trashed',
    'status' => 'status',
    'user_id' => 'user_id',
    'biz_type_id' => 'biz_type_id',
    'other_biz_type_id' => 'other_biz_type_id',
    'country_id' => 'country_id',
    'province_id' => 'province_id',
    'county_id' => 'county_id',
    'asking_price' => 'asking_price',
    'gross_revenue' => 'gross_revenue',
    'cash_flow' => 'cash_flow',
    'creation_time' => 'creation_time',
    'headline' => 'headline',
    'description' => 'description',
    'tagline' => 'tagline',
    'country' => 'country',
    'is_fincng_avlble' => 'is_fincng_avlble',
    'city' => 'city',
	'active' => 'active',
    'ai_biz_listing_id' => 'ai_biz_listing_id'
);

/*
  |--------------------------------------------------------------------------
  | Possible Update
  |--------------------------------------------------------------------------
  |
  | The name of possibly updateable columns.
  |
 */
$config['biz_listing_configure']['possible_update'] = array(
    'headline',
    'tagline',
    'description',
    'biz_type_id',
    'other_biz_type_id',
    'country_id',
    'province_id',
    'county_id',
    'is_county_cnfdntl',
    'city',
    'asking_price',
    'is_fincng_avlble',
    'year_established',
    'employees',
    'biz_website',
    'gross_revenue',
    'gross_revenue_comments',
    'cash_flow',
    'cash_flow_comments',
    'inv_value',
    'is_inv_included',
    'ffe_value',
    'is_ffe_included',
    'rs_value',
    'is_rs_included',
    'is_biz_relctble',
    'is_biz_franchis',
    'is_biz_hb',
    'seller_fincng_info',
    'training_support',
    'selling_reason',
    'facilities',
    'mkt_outlook_cmp',
    'keywords',
    'status',
	'active',
    'user_id'
);

/*
  |--------------------------------------------------------------------------
  | Sector
  |--------------------------------------------------------------------------
  |
  | Configuration for sector to check permission.
  |
 */
$config['biz_listing_configure']['sector'] = array(
    'add' => 46,
    'view_all' => 47,
    'view_child' => 61,
    'edit_all' => 48,
    'edit_child' => 62
);

/* End of file biz_listing_configure.php */ 

/* Location: ./application/modules/biz_listing/config/biz_listing_configure.php */