<?php
// ------------------------------------------------------------------------

/**
 * User context Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Models
 * @context	User context
 * @author		Webzstore Solutions
 */ 
class Context_model extends MY_Model
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
		$this->_configure = $this->config->item('context_configure');
		$this->_pagination = $this->config->item('pagination');
		$this->_validation = $this->config->item('context_validation');
	}
	
}
// END User context Model Class

/* End of file user_context_model.php */
/* Location: ./application/modules/user_context/models/user_context_model.php */