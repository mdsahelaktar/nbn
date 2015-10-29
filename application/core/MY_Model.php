<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * insertInto
     *
     * This method called during insert into db table
     *
     * @param	array	data set may be $_GET, $_POST	
     * @return	integer	affected rows count
     */
    function insertInto($VAR) {
        $insertArr = returnInsertArray($VAR, $this->_configure);
        $this->db->insert_batch($this->_configure['table_name'], $insertArr);
        //echo $this->db->last_query(); 
        return $this->db->affected_rows();
    }

    /**
     * getRecords
     *
     * This method called when record fetches from db table
     *
     * @param	array	sql where in array format	 Optional
     * @param	array	sql orderby in array format	 Optional
     * @param	array	sql like in array format	 Optional
     * @param	array	sql limit in array format	 Optional
     * @return	array	record sets
     */
    function getRecords($wheres = '', $orderby = '', $searchby = '', $limit = '') {
        $this->db->select($this->_configure['table_name'] . '.*');
        $this->db->from($this->_configure['table_name']);
        $wheres[] = array($this->_configure['table_name'] . '.' . $this->_configure['permanent_delete'], 0);
        foreach ($wheres as $key => $where) {
            if (is_array($where))
                $this->db->where($where[0], $where[1]);
            else
                $this->db->where($where);
        }

        ## For left join ##
        if (isset($this->_configure['dependent_on'])) {
            foreach ($this->_configure['dependent_on'] as $table => $details) {
                $this->db->join($table, $details['on'], $details['type']);
                foreach ($details['where'] as $w => $v) {
                    if (is_array($v))
                        $this->db->where($v[0], $v[1]);
                    else
                        $this->db->where($v);
                }
                foreach ($details["fetch"] as $column)
                    $this->db->select($table . '.' . $column);
            }
        }
        if (is_array($orderby)) {
            foreach ($orderby as $order)
                $this->db->order_by($order);
        }

        if (is_array($searchby)) {
            foreach ($searchby as $sitem)
                $this->db->like($sitem[0], $sitem[1]);
        }

        if (is_array($limit))
            $this->db->limit($limit[1], $limit[0]);
        $query = $this->db->get();
        //echo $this->db->last_query();								
        return $query->result();
    }

    /**
     * getNumRecordsPagination
     *
     * This method called to calculate record number in pagination
     *
     * @param	array	sql where in array format	 Optional
     * @param	array	sql like in array format	 Optional	 
     * @return	integer	count
     */
    function getNumRecordsPagination($wheres = '', $searchby = '') {
        $this->db->from($this->_configure['table_name']);
        $wheres[] = array($this->_configure['table_name'] . '.' . $this->_configure['permanent_delete'], 0);
        foreach ($wheres as $key => $where) {
            if (is_array($where))
                $this->db->where($where[0], $where[1]);
            else
                $this->db->where($where);
        }
        ## For left join ##
        foreach ($this->_configure['pagination_unset_tables'] as $table_unset) {
            unset($this->_configure['dependent_on'][$table_unset]);
        }

        if (isset($this->_configure['dependent_on'])) {
            foreach ($this->_configure['dependent_on'] as $table => $details) {
                $this->db->join($table, $details['on'], $details['type']);
                foreach ($details['where'] as $w => $v) {
                    if (is_array($v))
                        $this->db->where($v[0], $v[1]);
                    else
                        $this->db->where($v);
                }
                foreach ($details["fetch"] as $column)
                    $this->db->select($table . '.' . $column);
            }
        }
        if (is_array($searchby)) {
            foreach ($searchby as $sitem)
                $this->db->like($sitem[0], $sitem[1]);
        }
        $count = $this->db->count_all_results();
        //echo $this->db->last_query();
        return $count;
    }

    /**
     * getRecordsNPagination
     *
     * This function called to get records as well as pagination string
     *
     * @param	array	sql where in array format	 Optional
     * @param	array	sql orderby in array format	 Optional
     * @param	array	sql like in array format	 Optional
     * @param	array	sql limit in array format	 Optional
     * @return	array	record sets and pagination string
     */
    function getRecordsNPagination($wheres = '', $orderby = '', $searchby = '', $limit = '') {
        $records = $this->getRecords($wheres, $orderby, $searchby, $limit);
        //echo $this->db->last_query();
        $total_rows = $this->getNumRecordsPagination($wheres, $searchby);
        $pagination_str = $this->getPaginationString($total_rows, $limit);
        //echo $this->db->last_query();	
        return array('records' => $records, 'pagination' => $pagination_str);
    }

    /**
     * getPaginationString
     *
     * This function called to get pagination string
     *
     * @param	integer	rows number
     * @param	array	sql limit in array format	 Optional	
     * @return	html	pagination string
     */
    function getPaginationString($totalrows, $limit = '') {
        $modified_array = array_merge(
                $this->_pagination, array('total_rows' => $totalrows), array('base_url' => paginationBaseUrl($this->_pagination)), array('per_page' => (is_array($limit) and $limit[1]) ? $limit[1] : $this->_pagination['default_per_page'])
        );

        $this->config->set_item('pagination', $modified_array);
        $this->pagination->initialize($this->config->item('pagination'));
        //echo $this->db->last_query();
        return $this->pagination->create_links();
    }

    /**
     * ifExists
     *
     * This function called to rid of duplicate entries
     *
     * @param	string	data which not to be duplicate
     * @param	integer	edit id	Optional
     * @return	boolean
     */
    function ifExists($data, $edit_id = "") {
        if ($edit_id) {
            $this->db->where($this->_configure['ai_id'] . ' !=', $edit_id);
            $query = $this->db->get_where($this->_configure['table_name'], array($this->_configure['main_col'] => $data, $this->_configure['permanent_delete'] => 0));
        } else
            $query = $this->db->get_where($this->_configure['table_name'], array($this->_configure['main_col'] => $data, $this->_configure['permanent_delete'] => 0));
        $total_rows = $query->num_rows();
        if ($total_rows)
            return true;
        else
            return false;
    }

    /**
     * dbUpdate
     *
     * This function called to update database tables
     *
     * @param	string			action name
     * @param	integer|arrays	row id or row_ids
     * @param	array			dataset	Optional
     * @return	integer			affected rows of table
     */
    function dbUpdate($action, $row_id, $VAR = '') {
        switch ($action) {
            case 'delete':
            case 'revert':
            case 'permanent_delete':
                if (is_array($row_id))
                    foreach ($row_id as $id)
                        $this->db->or_where($this->_configure['ai_id'], $id);
                else
                    $this->db->where($this->_configure['ai_id'], $row_id);
                break;
        }
        $set = array();
        switch ($action) {

            case 'delete' :
                $set = array($this->_configure['soft_delete'] => 1);
                $this->db->update($this->_configure['table_name'], $set);
                break;
            case 'revert' :
                $set = array($this->_configure['soft_delete'] => 0);
                $this->db->update($this->_configure['table_name'], $set);
                //echo $this->db->last_query();
                break;
            case 'permanent_delete' :
                $set = array($this->_configure['permanent_delete'] => 1);
                $this->db->update($this->_configure['table_name'], $set);
                //echo $this->db->last_query();	
                break;
            case 'update' :
                $set = returnUpdateArray($VAR, $this->_configure);
                $this->db->update_batch($this->_configure['table_name'], $set, $this->_configure['ai_id']);
                //echo $this->db->last_query();
                break;
        }
        return $this->db->affected_rows();
    }

}
