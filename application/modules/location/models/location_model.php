<?php
// ------------------------------------------------------------------------

/**
 * Location Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Models
 * @category	Location
 * @author		Webzstore Solutions
 */
class Location_model extends MY_Model {
	protected $_configure = array();
	
	/**
	 * Constructor
	 */
	function __construct()
    {
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
	function initialize()
	{
		$this->_configure 	= $this->config->item('location_configure');
		//$this->_validation = $this->config->item('location_validation');
	}	
}
// END Location Model Class

/* End of file user_category_model.php */
/* Location: ./application/modules/user_category/models/user_category_model.php */