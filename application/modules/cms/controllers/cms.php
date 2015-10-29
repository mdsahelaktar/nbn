<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Cms Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Cms
 * @author		Webzstore Solutions
 */
class Cms extends MX_Controller 
{
	/**
	 * Constructor
	 */	
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('cms', $this->template->current_language());		
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
		$data["content"] = $this->template->frontend_view("cms", $data, true, "cms");	
		$this->template->build_frontend_output($data);
	}	
}
// END Cms Class

/* End of file cms.php */
/* Location: ./application/modules/cms/controllers/cms.php */