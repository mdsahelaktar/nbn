<?php
// ------------------------------------------------------------------------

/**
 * Country Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Models
 * @category	Country
 * @author		Webzstore Solutions
 */
class Country_model extends MY_Model {
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
		$this->_configure 	= $this->config->item('country_configure');
		$this->_pagination 	= $this->config->item('pagination');
		$this->_validation 	= $this->config->item('country_validation');
	}	
	
	
}
// END Country Model Class

/* End of file country_model.php */
/* Country: ./application/modules/country/models/country_model.php */