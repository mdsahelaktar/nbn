<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Admin
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
	}
	
	/**
	 * index
	 *
	 * Default action method
	 *
	 * @param	empty
	 * @return	void	redirect to dashboard of admin
	 */
	function index()
	{
		redirect('admin/dashboard/');
	}
}
// END Admin Class

/* End of file admin.php */
/* Location: ./application/modules/admin/controllers/admin.php */