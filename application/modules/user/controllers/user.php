<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * User Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	User
 * @author		Webzstore Solutions
 */
class User extends MX_Controller {

    /**
     * 	Autoload varible.
     * 	Loads other accessories required for this model.
     */
    public $autoload = array(
        'language' => array(
            'user', 'common/common'
        ),
        'config' => array(
            'user_configure',
            'user_validation',
            'pagination'
        ),
        'libraries' => array(
            'form_validation',
            'pagination',
			'email'
        ),
        'helpers' => array(
            'form'
        )
    );
	
	private $current_user = false;	
	private $allowed_register_categories_roles = array( 2 => array( 2 ), 4 => array( 3 ) );
	private $current_packages = array( 1, 2, 3, 4 );
    /**
     * 	Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'usermodel');	
		$this->load->module('user/user_admin');		
		$this->current_user = isLoggedIn();
    }

    /**
     * index
     *
     * Default action method
     *
     * @param	empty
     * @return	*****
     */
    function index() {
		if( $this->current_user )
			redirect( site_url('user/edit_profile') );
        $data = array();
        $data["title"] = _e("register_now");
        $CFG = $this->config->item('user_configure');
		$package_id = $_GET["package_id"];							
		$user_category = $_GET["ct"];
		$user_role = $_GET["rl"];
		
		if( !in_array( $package_id, $this->current_packages ) )
			$data["response"] = array( "event" => "error", "msg" => "Please choose package to register" );
		
		$data["user_category_id"] = !array_key_exists( $user_category, $this->allowed_register_categories_roles ) ? 2 : $user_category ;
		$data["user_role_id"] = !in_array( $user_role, $this->allowed_register_categories_roles[$data["user_category_id"]] ) ? $this->allowed_register_categories_roles[$data["user_category_id"]][0] : $user_role;				
		
		if( $data["user_category_id"] == 2 && $data["user_role_id"] == 2 ){
			$data["registration_title"] = _e('seller_registration');
		} else {
			$data["registration_title"] = _e('broker_registration');
		}
		
		$data["content"] = $this->template->frontend_view("registration", $data, true, "user");
        $this->template->build_frontend_output($data);
    }
	
	function activation(){
		$get_values = $this->input->get();
		$CFG = $this->config->item('user_configure');
		$data = array();
		$data["title"] = _e('activate_your_account');
		$results = $this->usermodel->getRecordsNPagination( array( 'activation_key = "'.$get_values["key"].'"' ) );				
		if( $results["records"][0]->activation_key ){			
			$this->usermodel->dbUpdate('update', '', array('activation_key' => '', 'disable' => 0, 'row_id' => $results["records"][0]->ai_user_id));
			$this->load->module( 'login/login_admin' );
			$login_response = $this->login_admin->logIn( array( "login_by_user_id" => true, "user_id" => $results["records"][0]->ai_user_id ) );
			
			$data["response"]["event"] = 'success';
			$data["response"]["msg"] = _e('account_activated');			
		}else{
			$data["response"]["event"] = 'error';
			$data["response"]["msg"] = _e('activation_key_not_found');				
		}		
		$data["content"] = $this->template->frontend_view("account_activation", $data, true, "user");
		$this->template->build_frontend_output( $data );			
	}
	
	function edit_profile(){
		if( !$this->current_user )
			loginRedirect( "login" );
		
		$data["title"] = _e('edit_profile');
		$user_details = $this->user_admin->getUserDetailsByLogin( array( "login_by_user_id" => true, "user_id" => $this->current_user["user_id"] ) );
		//var_dump( $user_details );
		$data["salutations"] = array_merge( array("" => "- Select Your Salutation -"), $this->user_admin->salutations );		
		$data["user_details"] = $user_details[0];
		//var_dump($data);
		$data["current_slug"] = "edit_profile";
		$data["current_profile_section_html"] = $this->template->frontend_view("edit_profile", $data, true, "user");
		$data["content"] = $this->template->frontend_view("account", $data, true, "user");
		$this->template->build_frontend_output( $data );
	}
	
	function change_password(){
		if( !$this->current_user )
			loginRedirect( "login" );
		
		$data["title"] = _e('change_password');
		$data["current_slug"] = "change_password";
		$data["current_profile_section_html"] = $this->template->frontend_view("change_password", $data, true, "user");
		$data["content"] = $this->template->frontend_view("account", $data, true, "user");
		$this->template->build_frontend_output( $data );
	}
	
	function forgot_password(){
		if( $this->current_user )
			redirect( site_url('user/edit_profile') );
		$data["title"] = _e('forgot_password');	
		$data["current_slug"] = "forgot_password";
		$data["content"] = $this->template->frontend_view("forgot_password", $data, true, "user");
		$this->template->build_frontend_output( $data );
	}
	
	function reset_password(){
		if( $this->current_user )
			redirect( site_url('user/edit_profile') );
		$data["title"] = _e('reset_password');	
		$data["current_slug"] = "reset_password";
		$reset_key = $this->input->get("key");
		if( !$reset_key ){
			$data["response"]["event"] = "error";
			$data["response"]["msg"] = _e("reset_key_not_found");
		}else{
			$wheres = array( "reset_key = '". $reset_key ."'");
			$results = $this->user_admin->userm->getRecords( $wheres );
			if( $results[0]->email ){
				if( $results[0]->disable ){
					$data["response"]["event"] = "error";
					$data["response"]["msg"] = _e("account_diabled");
				}
				else
					$data["user_id"] = $results[0]->ai_user_id;
			}else{
				$data["response"]["event"] = "error";
				$data["response"]["msg"] = _e("reset_key_not_matched");
			}
			
		}		
		$data["content"] = $this->template->frontend_view("reset_password", $data, true, "user");
		$this->template->build_frontend_output( $data );
	}
}
// END User user Class
/* End of file user.php */
/* Location: ./application/modules/user/controllers/user.php */