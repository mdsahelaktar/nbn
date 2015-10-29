<?php
// ------------------------------------------------------------------------

/**
 * Province Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Models
 * @category	Province
 * @author		Webzstore Solutions
 */
class Province_model extends MY_Model {
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
		$this->_configure 	= $this->config->item('province_configure');
		$this->_pagination 	= $this->config->item('pagination');
		$this->_validation 	= $this->config->item('province_validation');
	}	
	
	
}
// END Province Model Class

/* End of file province_model.php */
/* Province: ./application/modules/province/models/province_model.php */