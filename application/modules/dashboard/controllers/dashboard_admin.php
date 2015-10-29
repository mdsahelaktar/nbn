<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Dashboard_admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Dashboard
 * @author		Webzstore Solutions
 */
class Dashboard_admin extends MX_Controller 
{
	/**
	 * Constructor
	 */		
	public function __construct()
	{
		parent::__construct();				
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
		$data["title"] = "DashBoard";
		$data["content"] = "Welcome to dashboard";
		$this->template->build_admin_output($data);					
	}
}
// END Cms Class

/* End of file cms.php */
/* Location: ./application/modules/cms/controllers/cms.php */