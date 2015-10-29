<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Biz Type Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Biz Type
 * @author		Webzstore Solutions
 */
class User_role extends MX_Controller
{
	/**
	 * Autoload variable
	 */
	public $autoload = array(
        		'language'   => array(
								'biz_type'
								),
        		'config'     => array(
								'configure',
								'validation',
								'pagination'
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
		$this->load->model('biz_type_model', 'btype');						
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
		hojoborolo();
	}
}
// END Biz Type Class

/* End of file biz_type.php */
/* Location: ./application/modules/biz_type/controllers/biz_type.php */