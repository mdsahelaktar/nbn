<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * User Role Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	User Role
 * @author		Webzstore Solutions
 */
class User_role_admin extends MX_Controller {

    /**
     * 	Autoload varible.
     * 	Loads other accessories required for this model.
     */
    public $autoload = array(
        'language' => array(
            'user_role'
        ),
        'config' => array(
            'user_role_configure',
            'user_role_validation',
            'pagination'
        ),
        'libraries' => array(
            'form_validation',
            'pagination'
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
        $this->load->model('user_role_model', 'urole');
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
        
    }

    /**
     * add
     *
     * This function called to display user role add html form
     *
     * @param	empty
     * @return	web html
     */
    function add() {
        $CFG = $this->config->item('user_role_configure');
        $data["title"] = _e("User Role");

        ## for check admin or not	##	
        $data["response"] = addPermissionMsg($CFG["sector"]["add"]);

        ## Other auxilary variable ##
        $data['var'] = array();
        ## Load user_category admin module ##
        $this->load->module('user_category/user_category_admin');
        $user_categories = $this->user_category_admin->getActiveUserCategories(true);
        $data['var']['categories_dd'] = $user_categories;
        $data["top"] = $this->template->admin_view("top", $data, true, "user_role");
        $data["content"] = $this->template->admin_view("user_role_add", $data, true, "user_role");
        $this->template->build_admin_output($data);
    }

    /**
     * edit
     *
     * This function called to display user role lists in html
     *
     * @param	empty
     * @return	web html
     */
    function edit() {
        $CFG = $this->config->item('user_role_configure');
        ## Store Get ##
        $GET = $this->input->get() ? $this->input->get() : array();

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
        ## Load config and store ##
        $CFG = $this->config->item('user_role_configure');

        ## Load user_category admin module ##
        $this->load->module('user_category/user_category_admin');

        ## Where create ##
        $wheres = createWhereArray($GET, $CFG);

        ## Orderby create ##		
        $order_by = createOrderByArray($GET, $CFG);

        ## Search by create ##
        $search_by = createSearchByArray($GET, $CFG);

        ## Modified where as per permission ##
        $ucCFG = $this->config->item('user_category_configure');
        $vp = viewPermission($ucCFG["sector"]["view_all"], $ucCFG["sector"]["view_child"]);
        if ($vp == 2)
            $wheres[] = viewScope($ucCFG['table_name'] . '.' . $ucCFG['possible_where']['creator_id'], $ucCFG["sector"]["view_all"], $ucCFG["sector"]["view_child"]);
        elseif (!$vp)
            $wheres[] = array($ucCFG['table_name'] . '.' . $ucCFG['possible_where']['creator_id'], -1); // if not access


            
## Choose action and perform that action ##						 
        $row_id = $this->input->get('row_id');
        $action = $this->input->get('action');

        ## modified config created to pass ##
        $action_CFG = $CFG;
        $action_CFG['sector'] = $ucCFG['sector'];
        doAction('urole', $action, $row_id, true, '', $action_CFG);

        ## Fetch records ##		
        $results = $this->urole->getRecordsNPagination($wheres, $order_by, $search_by, $limit);
        $data["title"] = _e("User Role");
        $data["results"] = $results;

        ## Other auxilary variable ##
        $data['var'] = array();

        $user_categories = $this->user_category_admin->getActiveUserCategories(true);
        $data['var']['categories_dd'] = (array('' => _e('Choose user categories')) + $user_categories);

        $data['var']['CFG'] = $CFG;
        $data['var']['filter_status_dd'] = getFilterStatusDD();
        $data['var']['action_dd'] = getActionDD();

        ## for check admin or not ##		
        $data["response"] = viewPermissionMsg($CFG["sector"]["view_all"], $CFG["sector"]["view_child"]);
        ## Load view ##
        $data["top"] = $this->template->admin_view("top", $data, true, "user_role");
        $data["content"] = $this->template->admin_view("user_role_list", $data, true, "user_role");
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
        switch ($method) {
            case "add" :
                $this->form_validation->set_rules($this->config->item('insert', 'user_role_validation'));
                if ($this->form_validation->run($this, 'insert') == FALSE)
                    echo json_encode(array("event" => "error", "msg" => validation_errors()));
                else {
                    $insertedrows = $this->urole->insertInto($this->input->post());
                    if ($insertedrows)
                        echo json_encode(array("event" => "success", "msg" => _e('user role added')));
                    else
                        echo json_encode(array("event" => "error", "msg" => _e('user role add fail')));
                }
                break;
            case "edit" :
                $this->form_validation->set_rules($this->config->item('update', 'user_role_validation'));
                if ($this->form_validation->run($this, 'update') == FALSE)
                    echo json_encode(array("event" => "error", "msg" => validation_errors()));
                else {
                    $row_id = $this->input->post('row_id');
                    ## modified config created to pass ##
                    ## Load config and store ##
                    $CFG = $this->config->item('user_role_configure');

                    ## Load user_category admin module ##
                    $this->load->module('user_category/user_category_admin');

                    ## Modified where as per permission ##
                    $ucCFG = $this->config->item('user_category_configure');

                    $action_CFG = $CFG;
                    $action_CFG['sector'] = $ucCFG['sector'];
                    echo json_encode(doAction('urole', 'update', $row_id, false, $this->input->post(), $action_CFG));
                }
                break;
        }
    }

    /**
     * check_unique_self
     *
     * This function called when callback validation required during add and update
     *
     * @param	string	input which not to be duplicate
     * @param	string	may be add, edit
     * @return	boolean	
     */
    function check_unique_self($input, $action) {
        $elm_val = $this->input->post('user_category_id');
        switch ($action) {
            case 'add' :
                if ($this->urole->ifExists($input, $elm_val)) {
                    $this->form_validation->set_message('check_unique_self', _e('user role should unique'));
                    return false;
                }
                break;
            case 'edit' :
                if ($this->urole->ifExists($input, $elm_val, $this->input->post('row_id'))) {
                    $this->form_validation->set_message('check_unique_self', _e('user role should unique'));
                    return false;
                }
                break;
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
            ## Load config and store ##
            $CFG = $this->config->item('user_role_configure');

            $method = $this->input->post('method');
            switch ($method) {
                case 'getuserroles' :
                    $where = createWhereArray($this->input->post(), $CFG);
                    $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['is_trashed'], 0);
                    $user_roles = array();
                    $records = $this->urole->getRecords($where);
                    foreach ($records as $record)
                        $user_roles[$record->ai_user_role_id] = $record->user_role;
                    echo json_encode($user_roles);
                    break;
            }
        }
    }

    function check_permission() {
        ## Load config and store ##
        $CFG = $this->config->item('user_role_configure');
        if (!addPermission($CFG["sector"]["add"])) {
            $this->form_validation->set_message('check_permission', _e('access denied'));
            return false;
        }
    }

    /**
     * getActiveUserRoles
     *
     * This function return active user roles
     *
     * @param	empty
     * @return	array	records
     */
    function getActiveUserRoles() {
        $array = array();

        ## Load config and store ##
        $CFG = $this->config->item('user_role_configure');

        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['is_trashed'], 0);
        $records = $this->urole->getRecords($where);
        foreach ($records as $record)
            $array[$record->ai_user_role_id] = $record->user_role;
        return $array;
    }

}

// END User Role Admin Class

/* End of file user_role_admin.php */
/* Location: ./application/modules/user_role/controllers/user_role_admin.php */