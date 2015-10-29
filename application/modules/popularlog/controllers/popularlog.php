<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Popularlog Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Popularlog
 * @author		Webzstore Solutions
 */
class Popularlog extends MX_Controller
{
	/**
	 *	Autoload varible.
	 *	Loads other accessories required for this model.
	 */	
	public $autoload = array(
        		'config'     => array(
								'popularlog_configure'
								),
				'helpers' 	 => array(
								'form'
								)
    );
		
	/**
	 *	Constructor
	 */	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('popularlog_model', 'populogmod');						
	}
	
	

}
// END Popularlog Class

/* End of file popularlog.php */
/* Popularlog: ./application/modules/popularlog/controllers/popularlog.php */