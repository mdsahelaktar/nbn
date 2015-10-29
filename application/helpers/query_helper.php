<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * CodeIgniter Query Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Webzstore Solutions
 */
// ------------------------------------------------------------------------

/**
 * checkDbDefinedCol
 *
 * This function check if any column which value is predefined
 *
 * @param	string	columnname
 * @return	string	predefined value or false
 */
if (!function_exists('checkDbDefinedCol')) {

    function checkDbDefinedCol($column) {
        $single_value = false;
        switch ($column) {
            case 'creation_time':
                $single_value = date('Y-m-d H:i:s');
                break;
            case 'creator_id':
            case    'user_id':
                $ci = & get_instance();
                $login_details = $ci->session->userdata('login');
                $single_value = $login_details["user_id"];
                break;
        }
        return $single_value;
    }

}

/**
 * returnInsertArray
 *
 * This function is very simple to create array of insert query
 *
 * @param	array	raw data may be post or get or array
 * @param	array	configuration
 * @return	array	
 */
if (!function_exists('returnInsertArray')) {

    function returnInsertArray($RAWDATA, $CFG) {
        $ci = & get_instance();
        $values = array();
        $data = array();
        $col_clone = $CFG["possible_insert"];
        array_shift($col_clone);
        foreach ($CFG["possible_insert"] as $col)
            $data[$col] = isset($RAWDATA[$col]) ? $RAWDATA[$col] : '';
        if (is_array($data[$CFG["possible_insert"][0]])) {
            foreach ($data[$CFG["possible_insert"][0]] as $key => $value) {
                $single_value[$CFG["possible_insert"][0]] = $value;
                foreach ($col_clone as $col) {
                    $check = checkDbDefinedCol($col);
                    $single_value[$col] = $check ? $check : ( is_array($data[$col]) ? (!is_string($data[$col][$key]) ? $ci->db->escape($data[$col][$key]) : $data[$col][$key] ) : $data[$col] );
                }
                $values[] = $single_value;
            }
        } else {
            foreach ($data as $key => $value) {
                $check = checkDbDefinedCol($key);
                $single_value[$key] = $check ? $check : $value;
            }
            $values[] = $single_value;
        }
        return $values;
    }

}

/**
 * returnUpdateArray
 *
 * This function is very simple to create array of update query
 *
 * @param	array	raw data may be post or get or array
 * @param	array	configuration
 * @return	array	
 */
if (!function_exists('returnUpdateArray')) {

    function returnUpdateArray($RAWDATA, $CFG) {
        $ci = & get_instance();
        $values = array();
        $data = array();

        $col_clone = $CFG["possible_update"];
        array_shift($col_clone);
        $first_isset = 0;
        $l = 0;
        foreach ($CFG["possible_update"] as $index => $col) {
            if (isset($RAWDATA[$col])) {
                $data[$col] = $RAWDATA[$col];
                if ($l++ == 0)
                    $first_isset = $index;
            }
        }
        $data['row_id'] = $RAWDATA['row_id'];
        if (is_array($data[$CFG["possible_update"][$first_isset]])) {
            foreach ($data[$CFG["possible_update"][$first_isset]] as $key => $value) {
                $single_value[$CFG["ai_id"]] = $data['row_id'][$key];
                $single_value[$CFG["possible_update"][$first_isset]] = $value;
                foreach ($col_clone as $col)
                    $single_value[$col] = ( is_array($data[$col]) ? (!is_string($data[$col][$key]) ? $ci->db->escape($data[$col][$key]) : $data[$col][$key] ) : $data[$col] );
                $values[] = $single_value;
            }
        } else {
            foreach ($data as $key => $value) {
                $single_value[$key == 'row_id' ? $CFG["ai_id"] : $key] = $value;
            }
            $values[] = $single_value;
        }
        return $values;
    }

}

/**
 * createOrderByArray
 *
 * This function is appointed to create possible order by for sql query
 *
 * @param	array	raw data may be post or get or array
 * @param	array	configuration
 * @return	array	order by
 */
if (!function_exists('createOrderByArray')) {

    function createOrderByArray($RAWDATA, $CFG) {
        $ci = & get_instance();
        $get = $RAWDATA;
        $orderby = array();
        foreach ($get as $key => $value) {
            if (array_key_exists($key, $CFG['possible_orderby']))
                $orderby[] = (strpos($CFG['possible_orderby'][$key], '.') ? $CFG['possible_orderby'][$key] : $CFG['table_name'] . '.' . $CFG['possible_orderby'][$key]) . ' ' . $value;
        }
        return $orderby;
    }

}

/**
 * createSearchByArray
 *
 * This function is appointed to create possible like for sql query
 *
 * @param	array	raw data may be post or get or array
 * @param	array	configuration
 * @return	array	like
 */
if (!function_exists('createSearchByArray')) {

    function createSearchByArray($RAWDATA, $CFG) {
        $ci = & get_instance();
        $get = $RAWDATA;
        $searchby = array();
        foreach ($get as $key => $value) {
            if (array_key_exists($key, $CFG['possible_like']) && $value != '')
                $searchby[] = array((strpos($CFG['possible_like'][$key], '.') ? $CFG['possible_like'][$key] : $CFG['table_name'] . '.' . $CFG['possible_like'][$key]), $value);
        }
        return $searchby;
    }

}

/**
 * createWhereArray
 *
 * This function is appointed to create possible where for sql query
 *
 * @param	array	raw data may be post or get or array
 * @param	array	configuration
 * @return	array	where
 */
if (!function_exists('createWhereArray')) {

    function createWhereArray($RAWDATA, $CFG) {
        $ci = & get_instance();
        $get = $RAWDATA;
        $where = array();
        foreach ($get as $key => $value) {
            if (array_key_exists($key, $CFG['possible_where']) && $value != '') {
                if (strpos($CFG['possible_where'][$key], '.'))
                    $where[] = is_array($value) ? array($value[0]) : array($CFG['possible_where'][$key], $value);
                else
                    $where[] = is_array($value) ? array($value[0]) : array($CFG['table_name'] . '.' . $CFG['possible_where'][$key], $value);
            }
        }
        return $where;
    }

}

/**
 * cacheEnable
 *
 * This function is appointed to enable cache
 *
 * @param	empty
 * @return	void
 */
if (!function_exists('cacheEnable')) {

    function cacheEnable() {
        $ci = & get_instance();
        if ($ci->uri->segment(1) == 'admin')
            $ci->db->cache_off();
        else
            $ci->db->cache_on();
    }

}

/**
 * cacheDisable
 *
 * This function is appointed to disable cache
 *
 * @param	empty
 * @return	void
 */
if (!function_exists('cacheDisable')) {

    function cacheDisable() {
        $ci = & get_instance();
        $ci->db->cache_off();
    }

}

/**
 * lastInsertedId
 *
 * Return last inserted id 
 *
 * @param	array configuration
 * @return	int last_inserted_id
 */
if (!function_exists('lastInsertedId')) {

    function lastInsertedId($CFG) {
        $ci = & get_instance();
        $ci->db->cache_off();
        $ci->db->select($CFG['ai_id'])->from($CFG['table_name'])->where($CFG['soft_delete'], 0)->where($CFG['permanent_delete'], 0)->order_by($CFG['ai_id'] . ' desc')->limit(1);
        $query = $ci->db->get();
        $result = $query->result();
        return $result[0]->$CFG['ai_id'];
    }

}

/**
 * lastInsertedUserId
 *
 * Return last inserted user id 
 *
 * @param	array configuration
 * @return	int last_inserted_id
 */
if (!function_exists('lastInsertedUserId')) {

    function lastInsertedUserId($CFG) {
        $ci = & get_instance();
        $ci->db->cache_off();
        $ci->db->select($CFG['ai_id'])->from($CFG['table_name'])->where($CFG['permanent_delete'], 0)->order_by($CFG['ai_id'] . ' desc')->limit(1);
        $query = $ci->db->get();
        $result = $query->result();
        return $result[0]->$CFG['ai_id'];
    }

}

/**
 * lastInsertedIdByCurrentUserId
 *
 * Return last inserted id 
 * call only where userid exit in the table filed
 * @param	array configuration
 * @return	int last_inserted_id
 */
if (!function_exists('lastInsertedIdByCurrentUserId')) {

    function lastInsertedIdByCurrentUserId($CFG, $currentid) {
        $ci = & get_instance();
        $ci->db->cache_off();
        $ci->db->select($CFG['ai_id'])->from($CFG['table_name'])->where($CFG['soft_delete'], 0)->where($CFG['permanent_delete'], 0)->where($CFG['user_id'], $currentid)->order_by($CFG['ai_id'] . ' desc')->limit(1);
        $query = $ci->db->get();
        $result = $query->result();
        return $result[0]->$CFG['ai_id'];
    }

}


/**
 * simpleInsert
 *
 * This function simply inserted new row
 *
 * @param	array configuration
 * @param	array data
 * @return	boolean
 */
if (!function_exists('simpleInsert')) {

    function simpleInsert($CFG, $data) {
        $ci = & get_instance();
        $ci->db->insert($CFG['table_name'], $data);
        return $ci->db->affected_rows();
    }

}

// ------------------------------------------------------------------------
/* End of file query_helper.php */
/* Location: ./application/helpers/query_helper.php */