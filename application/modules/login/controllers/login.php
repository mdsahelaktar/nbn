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
		$data["login_html"] = Modules::run("login/login_admin/login_snippet");
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
						$user_details = $this->user_admin->getUserDetailsByLogin( $this->input->post() );
						if( ! $user_details )
							echo json_encode( array("event" => "error", "msg" => 'wrong credential') );
						else
						{
							if( $user_details[0]->disable ){
								if( $user_details[0]->activation_key )
									echo json_encode( array("event" => "error", "msg" => 'user not activated') ); 
								else
									echo json_encode( array("event" => "error", "msg" => 'user disabled') ); 
							}
							else
							{
									$this->session->set_userdata( array( 'login' => $details ) );
									if( $this->input->post('remember') )
										set_cookie( 'login', serialize($details), $this->config->item('cookie_expire') );
									else
										set_cookie( 'login', serialize($details) );
									
									## check if next url exist or not ##
									$next = $this->input->post('next');
									$next = $next ? $next : ( isAdminArea() ? afterLoginAdmin() : afterLoginFront() );											
									echo json_encode( array("event" => "success", "msg" => _e('login success'), 'redirect' => $next) );
																
							}
						}
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