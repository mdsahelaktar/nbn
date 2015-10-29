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
class image_model extends MY_Model
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
		$this->_configure = $this->config->item('image_configure');
		$this->_pagination = $this->config->item('pagination');
		$this->_validation = $this->config->item('image_validation');
	}
	
}
// END Biz Listing Model Class

/* End of file image_model.php */
/* Location: ./application/modules/image/models/image_model.php */