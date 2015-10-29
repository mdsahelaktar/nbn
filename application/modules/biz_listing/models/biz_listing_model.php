<?php

// ------------------------------------------------------------------------

/**
 * Biz Listing Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Models
 * @category	Biz Listing
 * @author		Webzstore Solutions
 */
class Biz_listing_model extends MY_Model {

    protected $_pagination = array();
    protected $_validation = array();
    protected $_configure = array();

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        $this->initialize();
    }

    /**
     * initialize
     *
     * This method call during constructing this class
     *
     * @param	empty
     * @return	void
     */
    function initialize() {
        $this->_configure = $this->config->item('biz_listing_configure');
        $this->_pagination = $this->config->item('pagination');
        $this->_validation = $this->config->item('biz_listing_validation');
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
    function getRecords($wheres = '', $orderby = '', $searchby = '', $limit = '', $groupby = '', $select = '') {
        if (!$groupby)
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
                if (!$groupby) {
                    foreach ($details["fetch"] as $column)
                        $this->db->select($table . '.' . $column);
                }
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

        if ($groupby) {
            $this->db->group_by($groupby);
            if (is_array($select)) {
                foreach ($select as $column)
                    $this->db->select($column);
            }
        }
        $query = $this->db->get();
        //echo $this->db->last_query();								
        return $query->result();
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
    function getRecordsNPagination($wheres = '', $orderby = '', $searchby = '', $limit = '', $groupby = '', $select = '') {
        $records = $this->getRecords($wheres, $orderby, $searchby, $limit, $groupby, $select);
        //echo $this->db->last_query();
        $total_rows = $this->getNumRecordsPagination($wheres, $searchby);
        $pagination_str = $this->getPaginationString($total_rows, $limit);
        //echo $this->db->last_query();	
        return array('records' => $records, 'pagination' => $pagination_str);
    }

}

// END Biz Listing Model Class

/* End of file biz_listing_model.php */
/* Location: ./application/modules/biz_listing/models/biz_listing_model.php */