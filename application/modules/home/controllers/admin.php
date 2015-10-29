<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Cms
 * @author		Webzstore Solutions
 */
class Admin extends MX_Controller 
{
	/**
	 * Constructor
	 */	
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('cms', 'fr');
	}
	
	/**
	 * index
	 *
	 * Default action method
	 *
	 * @param	empty
	 * @return	*****
	 */
	function index()
	{
		echo "Cms admin";
	}
}
// END Admin Class

/* End of file admin.php */
/* Location: ./application/modules/cms/controllers/admin.php */