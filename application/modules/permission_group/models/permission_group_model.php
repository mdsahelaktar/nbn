<?php
// ------------------------------------------------------------------------

/**
 * Permission Group Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Models
 * @category	Permission Group
 * @author		Webzstore Solutions
 */
class Permission_group_model extends MY_Model
{
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
		$this->_configure = $this->config->item('permission_group_configure');
		$this->_pagination = $this->config->item('pagination');
		$this->_validation = $this->config->item('permission_group_validation');
	}
}
// END Permission Group Model Class

/* End of file permission_group_model.php */
/* Location: ./application/modules/permission_group/models/permission_group_model.php */