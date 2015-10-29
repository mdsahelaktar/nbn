<?php

// ------------------------------------------------------------------------

/**
 * User Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Models
 * @category	User
 * @author		Webzstore Solutions
 */
class User_model extends MY_Model {

    protected $_pagination = array();
    protected $_validation = array();
    protected $_configure = array();

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        $this->initialize();
        //cacheEnable();
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
        $this->_configure = $this->config->item('user_configure');
        $this->_pagination = $this->config->item('pagination');
        $this->_validation = $this->config->item('user_validation');
    }

    /**
     * ifExists
     *
     * This function called to rid of duplicate entries
     *
     * @param	string	data which not to be duplicate
     * @param	string	column name
     * @param	integer	edit id	Optional
     * @return	boolean
     */
    function ifExists($data, $column, $edit_id = "") {
        if ($edit_id) {
            $this->db->where($this->_configure['ai_id'] . ' !=', $edit_id);
            $query = $this->db->get_where($this->_configure['table_name'], array($column => $data, $this->_configure['permanent_delete'] => 0));
        } else
            $query = $this->db->get_where($this->_configure['table_name'], array($column => $data, $this->_configure['permanent_delete'] => 0));
        $total_rows = $query->num_rows();
        if ($total_rows)
            return true;
        else
            return false;
    }

    /**
     * getUserDetailsByLogin
     *
     * This function return user details by user_name/email and password
     *
     * @param	array	dataset
     * @return	array	results
     */
    function getUserDetailsByLogin($VAR) {        
        $this->db->select($this->_configure['table_name'] . '.*');
        $this->db->from($this->_configure['table_name']);
		if( $VAR['login_by_user_id'] ){
			$this->db->where( $this->_configure['table_name'] . '.' . $this->_configure['ai_id'], $VAR['user_id'] )			
			->where( $this->_configure['table_name'] . '.' . $this->_configure['permanent_delete'], 0 );
		}
		else{
			$VAR['password'] = md5($VAR['password']);
			$this->db->where(' ( ' . $this->_configure['table_name'] . '.' . $this->_configure['uname'] . ' = ' . $this->db->escape($VAR['user_name']) . ' OR ' . $this->_configure['table_name'] . '.' . $this->_configure['email'] . ' = ' . $this->db->escape($VAR['user_name']) . ' ) ', NULL, FALSE)
                ->where($this->_configure['table_name'] . '.' . $this->_configure['permanent_delete'], 0)
                ->where($this->_configure['table_name'] . '.' . $this->_configure['password'], $VAR['password']);
		}
        $query = $this->db->get();
        //echo $this->db->last_query();								
        return $query->result();
    }

}

// END User Model Class

/* End of file user_model.php */
/* Location: ./application/modules/user/models/user_model.php */