<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * User Map Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	User Map
 * @author		Webzstore Solutions
 */
class User_map_admin extends MX_Controller {

    /**
     * 	Autoload varible.
     * 	Loads other accessories required for this model.
     */
    public $autoload = array(
        'language' => array('user_map'),
        'config' => array('user_map_configure', 'user_map_validation', 'pagination'),
        'libraries' => array('form_validation', 'pagination'),
        'helpers' => array('form')
    );

    /**
     * 	Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('user_map_model', 'umap');
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
        echo 'Welcome to User Map';
    }

    /**
     * add
     *
     * This function called to display user map add html form
     *
     * @param	empty
     * @return	web html
     */
    function add() {
        $CFG = $this->config->item('user_map_configure');
        $data["title"] = _e("User Map");

        ## for check admin or not	##	
        $data["response"] = addPermissionMsg($CFG["sector"]["add"]);

        ## Other auxilary variable ##
        $data['var'] = array();
        ## Load user_category admin module ##
        $this->load->module('user_category/user_category_admin');
        $user_categories = $this->user_category_admin->getActiveUserCategories();
        $data['var']['categories_dd'] = ( array('' => _e('Choose user category')) + $user_categories );
        $data['var']['roles_dd'] = ( array('' => _e('Choose user role')) );
        $data["top"] = $this->template->admin_view("top", $data, true, "user_map");
        $data["content"] = $this->template->admin_view("user_map_add", $data, true, "user_map");
        $this->template->build_admin_output($data);
    }

    /**
     * edit
     *
     * This function called to display user map lists in html
     *
     * @param	empty
     * @return	web html
     */
    function edit() {
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
        ## Load config and store
        $CFG = $this->config->item('user_map_configure');

        ## Where create ##
        $wheres = createWhereArray($GET, $CFG);

        ## Orderby create ##		
        $order_by = createOrderByArray($GET, $CFG);

        ## Search by create ##
        $search_by = createSearchByArray($GET, $CFG);

        ## Choose action and perform that action ##						 
        $row_id = $this->input->get('row_id');
        $action = $this->input->get('action');
        doAction('umap', $action, $row_id, true);

        ## Fetch records ##		
        $results = $this->umap->getRecordsNPagination($wheres, $order_by, $search_by, $limit);
        $data["title"] = _e("User Map");
        $data["results"] = $results;

        ## Other auxilary variable ##
        $data['var'] = array();

        ## Load user_category admin module ##
        $this->load->module('user_category/user_category_admin');
        $user_categories = $this->user_category_admin->getActiveUserCategories();

        $data['var']['categories_dd'] = ( array('' => _e('Choose user category')) + $user_categories );

        ## Load user_role admin module ##
        $this->load->module('user_role/user_role_admin');
        $user_roles = $this->user_role_admin->getActiveUserRoles();
        $data['var']['roles_dd'] = ( array('' => _e('Choose user role')) + $user_roles );

        $data['var']['CFG'] = $CFG;
        $data['var']['filter_status_dd'] = getFilterStatusDD();
        $data['var']['action_dd'] = getActionDD();

        ## for check admin or not	##	
        $data["response"] = viewPermissionMsg($CFG["sector"]["view_all"], $CFG["sector"]["view_child"]);

        ## Load view ##
        $data["top"] = $this->template->admin_view("top", $data, true, "user_map");
        $data["content"] = $this->template->admin_view("user_map_list", $data, true, "user_map");
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
                $this->form_validation->set_rules($this->config->item('insert', 'user_map_validation'));
                if ($this->form_validation->run($this, 'insert') == FALSE)
                    echo json_encode(array("event" => "error", "msg" => validation_errors()));
                else {
                    $insertedrows = $this->umap->insertInto($this->input->post());
                    if ($insertedrows)
                        echo json_encode(array("event" => "success", "msg" => _e('user map added')));
                    else
                        echo json_encode(array("event" => "error", "msg" => _e('user map add fail')));
                }
                break;
        }
    }

    /**
     * check_unique_self
     *
     * This function called when callback validation required during add and update
     *
     * @param	integer	role id
     * @param	array carry three parameter representing three column
     * @return	boolean	
     */
    function check_unique_self($input, $param) {
        $param = explode(',', $param);
        $column1 = $param[0];
        $column2 = $param[1];
        $action = $param[2];
        switch ($action) {
            case 'add' :
                if ($this->umap->ifExists($input, $column1, $column2, '', $this->input->post())) {
                    $this->form_validation->set_message('check_unique_self', _e('already exist'));
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
            $CFG = $this->config->item('user_map_configure');
            $method = $this->input->post('method');
            switch ($method) {
                case 'userallroles' :
                    $where = createWhereArray($this->input->post(), $CFG);
                    $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['is_trashed'], 0);
                    $groupby = $CFG['uc_id'];
                    $group_select[] = $CFG['groupby_select'];
                    $userallroles = array();
                    $records = $this->umap->getRecords($where, '', '', '', $groupby, $group_select);
                    $count = 0;
                    foreach ($records as $record) {
                        $userallroles[$count] = array();
                        $userallroles[$count]['user_category_id'] = $record->user_category_id;
                        $userallroles[$count]['user_category'] = $record->user_category;
                        $userallroles[$count]['user_map_ids'] = explode(',', $record->ai_user_map_ids);
                        $userallroles[$count]['user_role_ids'] = explode(',', $record->user_role_ids);
                        $userallroles[$count++]['user_roles'] = explode(',', $record->user_roles);
                    }
                    echo json_encode($userallroles);
                    break;
            }
        }
    }

    function check_permission() {
        ## Load config and store ##
        $CFG = $this->config->item('user_map_configure');
        if (!addPermission($CFG["sector"]["add"])) {
            $this->form_validation->set_message('check_permission', _e('access denied'));
            return false;
        }
    }

    /**
     * getUserMapByUserId
     *
     * This function returns user map ids by user id
     *
     * @param	integer	user id
     * @param	boolean	required first item or all item 
     * @return	array|integer	user map id or user map ids	
     */
    function getUserMapByUserId($user_id, $all = true) {
        ## Load config and store ##
        $CFG = $this->config->item('user_map_configure');
        ## Where create ##
        $wheres = createWhereArray(array('user_id' => $user_id), $CFG);
        $wheres[] = array($CFG['table_name'] . '.' . $CFG['soft_delete'], 0);

        ## Orderby create ##		
        $order_by = createOrderByArray(array('sortbytime' => 'asc'), $CFG);

        $records = $this->umap->getRecords($wheres, $order_by);

        if ($all)
            return $records;
        else
            return $records ? $records[0] : $records;
    }

    function chkUserBrokerOrNot($user_id) {
        ## Load config and store ##
        $CFG = $this->config->item('user_map_configure');
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['user_id'], $user_id);
        $records = $this->umap->getRecords($where, '', '', '', '', '');
        return $records[0]->user_category_id;
    }

}

// END User Map Admin Class

/* End of file user_map_admin.php */
/* Location: ./application/modules/user_map/controllers/user_map_admin.php */