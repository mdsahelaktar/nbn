<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Login Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Login
 * @author		Webzstore Solutions
 */
class Login extends MX_Controller 
{
	
	/**
	 *	Autoload varible.
	 *	Loads other accessories required for this model.
	 */	
	public $autoload = array(
        		'language'   => array(
								'login'
								),
				'config'     => array(
								'login_validation'
								),
        		'libraries'  => array(
								'form_validation'
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
		$this->load->module('common/common_admin');	
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
		$data["title"] = _e('Login');
		$data["register_link"] = "package?ct=2&rl=1";
		$data["next"] = $_GET["next"] ? $_GET["next"] : "user/edit_profile";				
		$data["content"] = $this->template->frontend_view("login", $data, true, "login");
		$this->template->build_frontend_output($data);	
	}	
	
	
	
	function ajax()
	{
		$method = $this->input->post('method');
		switch( $method )
		{
			case	"login"	:
					$this->form_validation->set_rules($this->config->item('check', 'login_validation'));
					if($this->form_validation->run($this, 'check') == FALSE)
						echo json_encode( array("event" => "error", "msg" => validation_errors() ) );
					else
					{
						## Load user admin module ##
						$this->load->module('user/user_admin');
						$user_details = $this->user_admin->logIn( $this->input->post() );
						echo json_encode( $user_details );						
					}
					break;
			case	"logout" :
					$this->session->unset_userdata('login');
					delete_cookie('login');							
					echo json_encode( array("event" => "error", 'redirect' => site_url() ) );
		}
	}
	
	
}
// END Login Class

/* End of file login.php */
/* Location: ./application/modules/login/controllers/login.php */ 