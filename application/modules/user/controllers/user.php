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
            'user'
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

    /**
     * 	Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'usermodel');
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
    function index() {
        $data = array();
        $data["title"] = _e("Biz Listing");
        $CFG = $this->config->item('user_configure');
		$package_id = $this->input->get('package_id');	
		$register_param = getRegisterParam();		
		if( !$package_id )
			redirect(base_url()."package/?".implode("&", $register_param));
        $data["content"] = $this->template->frontend_view("registration", $data, true, "user");
        $this->template->build_frontend_output($data);
    }
	
	function activation(){
		$get_values = $this->input->get();
		$CFG = $this->config->item('user_configure');
		$data = array();
		$data["title"] = _e('Activate Your Account');
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
}
// END User user Class
/* End of file user.php */
/* Location: ./application/modules/user/controllers/user.php */