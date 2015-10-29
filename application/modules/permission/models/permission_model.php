<?php
// ------------------------------------------------------------------------

/**
 * Permission Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Models
 * @category	Permission
 * @author		Webzstore Solutions
 */
class Permission_model extends MY_Model {
	protected $_pagination = array();
	protected $_validation = array();
	protected $_configure = array();
	
	/**
	 * Constructor
	 */	
	function __construct()
    {
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
	function initialize()
	{
		$this->_configure = $this->config->item('permission_configure');
		$this->_pagination = $this->config->item('pagination');
		$this->_validation = $this->config->item('permission_validation');
	}
	
	/**
	 * ifExists
	 *
	 * This function called to rid of duplicate entries
	 *
	 * @param	string	data which not to be duplicate
	 * @param	integer	on which respect need to check
	 * @param	integer	edit id	Optional
	 * @return	boolean
	 */
	function ifExists($data, $elm_val, $edit_id = "")
	{
		if($edit_id)
		{
			$this->db->where($this->_configure['ai_id'].' !=' , $edit_id);
			$query = $this->db->get_where($this->_configure['table_name'], array( $this->_configure['gr_id'] => $elm_val, $this->_configure['main_col'] => $data, $this->_configure['permanent_delete'] => 0 ));
		}
		else
			$query = $this->db->get_where($this->_configure['table_name'], array($this->_configure['gr_id'] => $elm_val, $this->_configure['main_col'] => $data, $this->_configure['permanent_delete'] => 0 ));
		$total_rows = $query->num_rows();		
		if($total_rows)
			return true;
		else
			return false;	
	}
	
}
// END Permission Model Class

/* End of file permission_model.php */
/* Location: ./application/modules/permission/models/permission_model.php */