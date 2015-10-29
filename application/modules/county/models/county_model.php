<?php
// ------------------------------------------------------------------------

/**
 * County Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Models
 * @category	County
 * @author		Webzstore Solutions
 */
class County_model extends MY_Model {
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
		$this->_configure 	= $this->config->item('county_configure');
		$this->_pagination 	= $this->config->item('pagination');
		$this->_validation 	= $this->config->item('county_validation');
	}			
}
// END County Model Class

/* End of file county_model.php */
/* County: ./application/modules/county/models/county_model.php */