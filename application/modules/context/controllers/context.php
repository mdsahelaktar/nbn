<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Context Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @context		Context
 * @author		Webzstore Solutions
 */
class Context extends MX_Controller
{
	/**
	 * Autoload variable
	 */	
	public $autoload = array(
        		'language'   => array(
									'context'
								),
        		'config'     => array(
									'context_configure',
									'context_validation',
									'context_pagination'
								),
        		'libraries'  => array(
									'form_validation',
									'pagination'
								),
				'helpers' 	 => array(
									'form'
								)
    );
	
	/**
	 * Constructor
	 */	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('context_model', 'ucat');				
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
	}
}
// END Context Class

/* End of file context.php */
/* Location: ./application/modules/context/controllers/context.php */