<?php
// ------------------------------------------------------------------------

/**
 * Permission Modify Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Models
 * @category	Permission Modify
 * @author		Webzstore Solutions
 */
class Permission_modify_model extends MY_Model {
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
		$this->_configure = $this->config->item('permission_modify_configure');
		$this->_pagination = $this->config->item('pagination');
		$this->_validation = $this->config->item('permission_modify_validation');
	}
	
	
	/**
	 * dbUpdate
	 *
	 * This function called to update database tables
	 *
	 * @param	string		action name
	 * @param	integer		user map id
	 * @param	array		permission ids	Optional
	 * @return	integer		affected rows of table
	 */
	function dbUpdate($action, $where_id, $permission_ids = '')
	{
		$case_str = "";
		switch($action)
		{
			case 'mixupdate' :
					foreach($permission_ids as $permission_id)
						$case[] = 'WHEN '.$this->_configure['per_id'].' = '.$permission_id.' THEN 0';
					$case_str = 'CASE '.implode(' ',$case).' ELSE 1 END';
					break;
			case 'delete' :
					$case_str = 1;
					break;
			
		}			
		$query = 'Update '.$this->_configure['table_name'].' set '.$this->_configure['soft_delete'].' = '.$case_str.' where '.$this->_configure['umap_id'].' = '.$where_id;
		$this->db->query($query);	
		//echo $this->db->last_query();			
		return $this->db->affected_rows(); 
	}
}
// END Permission Modify Model Class

/* End of file permission_modify_model.php */
/* Location: ./application/modules/permission_modify/models/permission_modify_model.php */