<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * User Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	User
 * @author		Webzstore Solutions
 */
class User_admin extends MX_Controller {

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
	
	public $salutations = array("Mr." => "Mr.", "Mrs." => "Mrs.", "Miss" => "Miss", "Ms." => "Ms.", "Dr." => "Dr.", "Prof." => "Prof.", "Rev." => "Rev.", "Other" => "Other");
    /**
     * 	Constructor
     */
    public function __construct() {
        parent::__construct();
		$this->load->model('user_model', 'userm');		
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
        echo 'Welcome to user';
    }

    /**
     * add
     *
     * This function called to display permission add html form
     *
     * @param	empty
     * @return	web html
     */
    function add() {
        $data["title"] = _e("user");
        $CFG = $this->config->item('user_configure');

        //check if have add permission		
        $data["response"] = addPermissionMsg($CFG["sector"]["add"]);

        ## Other auxilary variable ##
        $data['var'] = array();

        ## Load user_category admin module ##
        $this->load->module('user_category/user_category_admin');
        $user_categories = $this->user_category_admin->getActiveUserCategories();        
        switch ($this->login['category_id']){
            case 30 : $user_categories = array( 30 => $user_categories[30] );  // if users are biz seller           
        }        
        $data['var']['categories_dd'] = ( array('' => _e('choose_user_category')) + $user_categories );
        $data['var']['roles_dd'] = ( array('' => _e('choose_user_role')) );
        $data["top"] = $this->template->admin_view("top", $data, true, "user");
        $data["content"] = $this->template->admin_view("user_add", $data, true, "user");
        $this->template->build_admin_output($data);
    }

    /**
     * edit
     *
     * This function called to display permission lists in html
     *
     * @param	empty
     * @return	web html
     */
    function edit() {
        ## Store Get ##
        $GET = $this->input->get() ? $this->input->get() : array();
        
        ## Load config and store
        $CFG = $this->config->item('user_configure');
        
        ## Check if edit ##
        $data["edit_id"] = $this->input->get('edit_id');        
               
        ## Limit create	##			
        if ($data["edit_id"])
            $limit = 0;
        else {
            $limit[1] = $this->config->item('default_per_page', 'pagination');
            $page_no = $this->input->get('page');
            $page_no = !$page_no ? 1 : $page_no;
            $limit[0] = ($page_no * $limit[1]) - $limit[1];
        }
        ## Limit end ##        

        ## Where create ##
        $wheres = createWhereArray($GET, $CFG);        
        $vp = viewPermission($CFG["sector"]["view_all"], $CFG["sector"]["view_child"]);        
        $customized_wheres = "";
        $user_IN = createWhereArray( array( 'parent_id' => viewScope( $CFG["p_id"], $CFG["sector"]["view_all"], $CFG["sector"]["view_child"] ) ), $CFG);        
        if ($vp == 2) {                                                
            $customized_wheres[] = $user_IN[0][0];
            $customized_wheres[] = $CFG['table_name'] . '.' . $CFG['ai_id'] . " = " . $this->login['user_id'];
            $wheres[] = '( ' . implode(" or ", $customized_wheres) . ' )';
        }
        elseif (!$vp)
            $wheres[] = array( $CFG['table_name'] . '.' . $CFG['ai_id'], -1); // if not access
        
        ## Orderby create ##		
        $order_by = createOrderByArray($GET, $CFG);

        ## Search by create ##
        $search_by = createSearchByArray($GET, $CFG);

        ## Choose action and perform that action ##						 
        $row_id = $this->input->get('row_id');
        $action = $this->input->get('action');
        doAction('userm', $action, $row_id, true, $CFG);

        ## Fetch records ##		
        $results = $this->userm->getRecordsNPagination($wheres, $order_by, $search_by, $limit);
        $data["title"] = _e("user_category");
        $data["results"] = $results;

        ## Other auxilary variable ##
        $data['var'] = array();
        $data['var']['CFG'] = $CFG;
        $data['var']['filter_status_dd'] = getFilterStatusDD();
        $data['var']['action_dd'] = getActionDD();

        //for check admin or not		
        $data["response"] = viewPermissionMsg($CFG["sector"]["view_all"], $CFG["sector"]["view_child"]);

        ## Load view ##
        $data["top"] = $this->template->admin_view("top", $data, true, "user");
        $data["content"] = $this->template->admin_view("user_list", $data, true, "user");
        $this->template->build_admin_output($data);
    }

    /**
     * ajax
     *
     * This function called when insert and update query called
     *
     * @param	empty
     * @return	json	response messages
     */
    function ajax() {
        $method = $this->input->post('method');

        ## Load config and store
        $CFG = $this->config->item('user_configure');

        switch ($method) {
            case "add" :
                $POSTDATA = $this->input->post();
                $response = $this->addUser( $POSTDATA ); 
                if( $response === 0 )
                    echo json_encode(array("event" => "error", "msg" => _e('user_add_fail')));
                elseif( $response === -1 )
                    echo json_encode(array("event" => "error", "msg" => validation_errors()));
                else
                    echo json_encode(array("event" => "success", "msg" => _e('user_regisrer_notice')));               
                break;
            case "edit" :
                $this->form_validation->set_rules($this->config->item('update', 'user_validation'));
                if ($this->form_validation->run($this, 'update') == FALSE)
                    echo json_encode(array("event" => "error", "msg" => validation_errors()));
                else {
                    $row_id = $this->input->post('row_id');
                    ## Load config and store
                    $CFG = $this->config->item('user_configure');
                    echo json_encode(doAction('userm', 'update', $row_id, false, $this->input->post(), $CFG));
                }
                break;
			case "edit_profile" :
                $this->form_validation->set_rules($this->config->item('frontend_update', 'user_validation'));
                if ($this->form_validation->run($this, 'frontend_update') == FALSE)
                    echo json_encode(array("event" => "error", "msg" => validation_errors()));
                else {
					$msg = array();
					$msg["success"] = _e('profile_updated');
					$msg["error"] = _e('profile_not_updated');
					$current_user = isLoggedIn();
                    $row_id = $current_user["user_id"];
					$VAR = $this->input->post();
					$VAR["row_id"] = $row_id;
                    ## Load config and store
                    $CFG = $this->config->item('user_configure');
                    $response = doAction('userm', 'update', $row_id, false, $VAR, $CFG);
					$response["msg"] = $msg[$response["event"]];
					echo json_encode( $response );
                }
                break;
			case "change_password" :
                $this->form_validation->set_rules($this->config->item('change_password', 'user_validation'));
                if ($this->form_validation->run($this, 'change_password') == FALSE)
                    echo json_encode(array("event" => "error", "msg" => validation_errors()));
                else {
					$msg = array();
					$msg["success"] = _e('password_change_success');
					$msg["error"] = _e('password_change_error');
					$current_user = isLoggedIn();
                    $row_id = $current_user["user_id"];
					$VAR = $this->input->post();
					$VAR["row_id"] = $row_id;
                    ## Load config and store
                    $CFG = $this->config->item('user_configure');
                    $response = doAction('userm', 'update', $row_id, false, $VAR, $CFG);
					$response["msg"] = $msg[$response["event"]];
					echo json_encode( $response );
                }
                break;
			case "forgot_password" :
                $this->form_validation->set_rules($this->config->item('forgot_password', 'user_validation'));
                if ($this->form_validation->run($this, 'forgot_password') == FALSE)
                    echo json_encode(array("event" => "error", "msg" => validation_errors()));
                else {
					## Load config and store
					$CFG = $this->config->item('user_configure');
					$VAR = $this->input->post();
					
					$wheres = array( "user_name = '". $VAR["user_name_email"] . "' or email = '". $VAR["user_name_email"] . "'" ) ;
					$results = $this->userm->getRecords( $wheres );
					
					$VAR["reset_key"] = md5( time() );
					$VAR["row_id"] = $results[0]->ai_user_id;
					$response = array();
					if( !$results[0]->disable ){
						$msg = array();
						$msg["success"] = _e('forgot_password_success');
						$msg["error"] = _e('forgot_password_error');
						$response = doAction('userm', 'update', $results[0]->ai_user_id, false, $VAR, $CFG);
						$response["msg"] = $msg[$response["event"]];
						
						$this->email->initialize(array("mailtype" => "html"));
						$this->email->from('noreply@needbiznow.com', 'Needbiznow');
						$this->email->to($results[0]->email); 					
						$this->email->subject('Reset your password');
						$activation_msg = 'Hello, Welcome to needbiznow, Please click the <a href="'.base_url().'user/reset_password?key='.$VAR['reset_key'].'">link</a> to reset your password';
						$this->email->message($activation_msg);	
						$this->email->send();
					}
					else{
						$response["event"] = "error";
						$response["msg"] = _e("account_disabled");
					}					
					echo json_encode( $response );
                }
                break;	
			case "reset_password" :
                $this->form_validation->set_rules($this->config->item('reset_password', 'user_validation'));
                if ($this->form_validation->run($this, 'reset_password') == FALSE)
                    echo json_encode(array("event" => "error", "msg" => validation_errors()));
                else {
                    $row_id = $this->input->post('row_id');
                    ## Load config and store
                    $CFG = $this->config->item('user_configure');
					$VAR = $this->input->post();
					$VAR["reset_key"] = "";
					$msg = array();
					$msg["success"] = _e('reset_password_success');
					$msg["error"] = _e('reset_password_error');
					
                    $response = doAction('userm', 'update', $row_id, false, $VAR, $CFG);
					$response["msg"] = $msg[$response["event"]];
					echo json_encode( $response );
                }
                break;			
        }
    }

    /**
     * addUser
     *
     * This function called to add user
     *
     * @param	array	$POSTDATA     
     * @return	-1,0,or user_id 	
     */

    function addUser( $POSTDATA ){
        
        ## Load config and store
        $CFG = $this->config->item('user_configure');
        
        $this->form_validation->set_rules($this->config->item('insert', 'user_validation'));
        if ($this->form_validation->run($this, 'insert') == FALSE)
            return -1;
        else {
            $POSTDATA['password'] = md5( $POSTDATA['password'] );
			$POSTDATA['disable'] = 1;
			$POSTDATA['activation_key'] = md5( time() );
            $insertedrows = $this->userm->insertInto($POSTDATA);
            if ($insertedrows) {
                ## Load user map admin module ##		
                $last_user_id = lastInsertedUserId($CFG);
                $POSTDATA['user_id'] = $last_user_id;
                $this->load->module('user_map/user_map_admin');

                if (!$this->user_map_admin->umap->ifExists($POSTDATA['user_role_id'], 'user_id', 'user_category_id', '', $POSTDATA)) {
                    $this->user_map_admin->umap->insertInto($POSTDATA);
					
					$this->email->initialize(array("mailtype" => "html"));
					$this->email->from('noreply@needbiznow.com', 'Needbiznow');
					$this->email->to($POSTDATA['email']); 					
					$this->email->subject('Activate your account');
					$activation_msg = 'Hello, Welcome to needbiznow, Please click the <a href="'.base_url().'user/activation?key='.$POSTDATA['activation_key'].'">link</a> to activate your account';
					$this->email->message($activation_msg);	
					$this->email->send();
                }
                return $last_user_id;
            } else
                return 0;
        }                
    }    
    /**
     * check_unique
     *
     * This function called when callback validation required during add and update
     *
     * @param	string	input which not to be duplicate
     * @param	string	may be add, edit
     * @return	boolean	
     */
    function check_unique($input, $param) {
        $param = explode(',', $param);
        $column = $param[0];
        $action = $param[1];
        switch ($action) {
            case 'add' :
                if ($this->userm->ifExists($input, $column)) {
                    $this->form_validation->set_message('check_unique', _e('already_exist'));
                    return false;
                }
                break;
            case 'edit' :
                if ($this->userm->ifExists($input, $column, $this->input->post('row_id'))) {
                    $this->form_validation->set_message('check_unique', _e('already_exist'));
                    return false;
                }
                break;
			case 'edit_profile' :
				$current_user = isLoggedIn();
                $row_id = $current_user["user_id"];
                if ($this->userm->ifExists($input, $column, $row_id)) {
                    $this->form_validation->set_message('check_unique', _e('already_exist'));
                    return false;
                }
                break;	
			case 'change_password' :
				$current_user = isLoggedIn();
                if ( !$this->userm->getUserDetailsByLogin( array( "user_name" => $current_user["email"], "password" => $input) ) ) {
                    $this->form_validation->set_message('check_unique', _e('please_enter_correct'));
                    return false;
                }
                break;
			case 'forgot_password' :
				$column = explode("*", $column);
				if( !$this->userm->ifExists($input, $column[0]) and !$this->userm->ifExists($input, $column[1]) ){
					 $this->form_validation->set_message('check_unique', _e('not_found'));
					 return false;
				}						
        }
    }

    /**
     * json
     *
     * This function called during ajax only
     *
     * @param	empty
     * @return	json	records
     */
    function json() {
        if (isAjax()) {
            ## Load config and store
            $CFG = $this->config->item('user_configure');

            $method = $this->input->post('method');
            switch ($method) {
                case 'autosuggestuser' :
                    $where = createWhereArray($this->input->post(), $CFG);
                    $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['is_trashed'], 0);
                    $searchby[] = array($CFG['table_name'] . '.' . $CFG['possible_like']['uname'], $this->input->post('term'));
                    $user_roles = array();
                    $records = $this->userm->getRecords($where, '', $searchby);
                    $count = 0;
                    foreach ($records as $record) {
                        $user_roles[$count] = array();
                        $user_roles[$count]['id'] = $record->ai_user_id;
                        $user_roles[$count++]['value'] = $record->user_name;
                    }
                    echo json_encode($user_roles);
                    break;
            }
        }
    }

    function check_permission() {
        ## Load config and store
        $CFG = $this->config->item('user_configure');
        if (!addPermission($CFG["sector"]["add"])) {
            $this->form_validation->set_message('check_permission', _e('access_denied'));
            return false;
        }
    }

    /**
     * getUserDetailsByLogin
     *
     * This function return user details by user_name/email and password
     *
     * @param	array	dataset
     * @return	array	results
     */
    function getUserDetailsByLogin($data) {
        return $this->userm->getUserDetailsByLogin($data);
    }

    /**
     * getUsernameByid
     *
     * This function return user details by user id
     *
     * @param	int	userid
     * @return	array	results
     */
    function getUsernameByid($id) {
        $CFG = $this->config->item('user_configure');
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['edit_id'], $id);
        $results = $this->userm->getRecords($where);
        return $results;
    }

    /**
     * checkUserEnable
     *
     * This function return if user is enable/active
     *
     * @param	int	userId
     * @return	boolean
     */
    function checkUserEnable($userId) {
        $CFG = $this->config->item('user_configure');
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['edit_id'], $userId);
        $results = $this->userm->getRecords($where);
        return !$results[0]->disable;
    }

    /**
     * getAllChildUser
     *
     * This function return all child user
     *
     * @param	int	userId
     * @return	false/ all child user(active/inactive)
     */
    function getAllChildUser($userId) {
        $users = array("active" => array(), "inactive" => array());
        $CFG = $this->config->item('user_configure');
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['parent_id'], $userId);
        $results = $this->userm->getRecords($where);
        if (empty($results))
            return false;
        foreach ($results as $result) {
            if (!$result->disable)
                $users["active"][] = $result->ai_user_id;
            else
                $users["inactive"][] = $result->ai_user_id;
        }
        return $users;
    }

}

// END User Admin Class

/* End of file user_admin.php */
/* Location: ./application/modules/user/controllers/user_admin.php */