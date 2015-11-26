<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Login Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Login
 * @author		Webzstore Solutions
 */
class Login_admin extends MX_Controller 
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
	 *	Constructor
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
		
		$data["title"] = _e('Login');
		$data["top"] = $this->template->admin_view("top", $data, true, "login");	
		$data["content"] = $this->template->admin_view("login", $data, true, "login");
		$this->template->set_admin_layout("login");
		$this->template->build_admin_output($data);		
	}
	
	function login_snippet()
	{		
		return $this->template->admin_view("login_snippet", $data, true, "login");
	}
	
	function logIn( $args ){
		## Load user admin module ##
		$this->load->module('user/user_admin');
		$user_details = $this->user_admin->getUserDetailsByLogin( $args );
		if( ! $user_details )
			return array( "event" => "error", "msg" => 'wrong credential' );
		else
		{
			if( $user_details[0]->disable ){
				if( $user_details[0]->activation_key )
					return array( "event" => "error", "msg" => 'user not activated' ); 
				else
					return array( "event" => "error", "msg" => 'user disabled' ); 
			}
			else
			{
				## Check if parent is enable begin ##
				if( !$this->user_admin->checkUserEnable( $user_details[0]->parent_id ) )					
					return array( "event" => "error", "msg" => 'user parent disabled' );
				## Check if parent is enable end ##
				
				## Load user map module ##
				$this->load->module('user_map/user_map_admin');
				
				$first_user_map = $this->user_map_admin->getUserMapByUserId( $user_details[0]->ai_user_id, false );
				if( ! $first_user_map )
					return array( "event" => "error", "msg" => 'user disabled' );
				else
				{
					$this->load->module('default_permission/default_permission_admin');
					$grantedpermissions = $this->default_permission_admin->getUserGrantedPermission($first_user_map->ai_user_map_id, $first_user_map->user_role_id);
					
					## set the user details begin ##
					$details = array();									
					$details["user_id"]				= $first_user_map->user_id;
					$details["email"]				= $user_details[0]->email;
					$details["category_id"]			= $first_user_map->user_category_id;
					$details["role_id"]				= $first_user_map->user_role_id;
					$details["parent"] 				= $user_details[0]->parent_id;
					$details["childs"] 				= $this->user_admin->getAllChildUser( $user_details[0]->ai_user_id );
					$details["grantedpermission"] 	= $grantedpermissions;
					## set the user details end ##	
					
					$this->session->set_userdata( array( 'login' => $details ) );
					if( $args['remember'] )
						set_cookie( 'login', serialize($details), $this->config->item('cookie_expire') );
					else
						set_cookie( 'login', serialize($details) );
					
					
					## check if next url exist or not ##
					$next = $args['next'];
					$next = $next ? $next : ( isAdminArea() ? afterLoginAdmin() : afterLoginFront() );
					return array("event" => "success", "msg" => _e('login success'), 'redirect' => $next);
				}								
			}
		}
	}
	/**
	 * ajax
	 *
	 * This function called when insert and update query called
	 *
	 * @param	empty
	 * @return	json	response messages
	 */
	function ajax()
	{
		$method = $this->input->post('method');
		switch( $method )
		{
			case	"login"	:
					$POST = $this->input->post();
					$this->form_validation->set_rules( $this->config->item('check', 'login_validation') );
					if( $this->form_validation->run($this, 'check') == FALSE )
						echo json_encode( array( "event" => "error", "msg" => validation_errors() ) ) ;
					else					
						echo json_encode( $this->logIn( $POST ) );
					break;
			case	"logout" :
					$this->session->unset_userdata('login');
					delete_cookie('login');							
					$redirect = isAdminArea() ? site_url().'admin/login' : site_url('login');
					echo json_encode( array("event" => "success", 'redirect' => $redirect ) );
		}
	}	
}
// END Login Admin Class

/* End of file login_admin.php */
/* Location: ./application/modules/login/controllers/login_admin.php */