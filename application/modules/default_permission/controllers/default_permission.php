<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Permission Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Permission
 * @author		Webzstore Solutions
 */
class Permission extends MX_Controller 
{
	/**
	 * Autoload variable
	 */
	public $autoload = array(
        		'language'   => array(
								'permission'
								),
        		'config'     => array(
								'permission_configure',
								'permission_validation',
								'permission_pagination'
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
		echo 'Welcome to permission section Front End';
	}
}
// END Cms Class

/* End of file default_permission.php */
/* Location: ./application/modules/default_permission/controllers/default_permission.php */