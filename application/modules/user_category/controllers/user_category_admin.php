<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * User Category Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	User Category
 * @author		Webzstore Solutions
 */
class User_category_admin extends MX_Controller {

    /**
     * 	Autoload varible.
     * 	Loads other accessories required for this model.
     */
    public $autoload = array(
        'language' => array('user_category'),
        'config' => array('user_category_configure', 'user_category_validation', 'pagination'),
        'libraries' => array('form_validation', 'pagination'),
        'helpers' => array('form')
    );

    /**
     * 	Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('user_category_model', 'ucat');
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
        echo 'Welcome to user category';
    }

    /**
     * add
     *
     * This function called to display user category add html form
     *
     * @param	empty
     * @return	web html
     */
    function add() {
        ## Load config and store
        $CFG = $this->config->item('user_category_configure');
        $data["title"] = _e("User Category");
        $data["response"] = addPermissionMsg($CFG["sector"]["add"]);
        $data["top"] = $this->template->admin_view("top", $data, true, "user_category");
        $data["content"] = $this->template->admin_view("user_category_add", $data, true, "user_category");
        $this->template->build_admin_output($data);
    }

    /**
     * edit
     *
     * This function called to display user category lists in html
     *
     * @param	empty
     * @return	web html
     */
    function edit() {
        ## Store Get ##
        $GET = $this->input->get() ? $this->input->get() : array();
        ## Load config and store
        $CFG = $this->config->item('user_category_configure');
        ## Can view child or all ##
        $GET["creator_id"] = viewScope($CFG["c_id"], $CFG["sector"]["view_all"], $CFG["sector"]["view_child"]);
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
        ## Orderby create ##		
        $order_by = createOrderByArray($GET, $CFG);

        ## Search by create ##
        $search_by = createSearchByArray($GET, $CFG);

        ## Choose action and perform that action ##						 
        $row_id = $this->input->get('row_id');
        $action = $this->input->get('action');
        doAction("ucat", $action, $row_id, true, '', $CFG);

        ## Fetch records ##				
        $results = $this->ucat->getRecordsNPagination($wheres, $order_by, $search_by, $limit);
        $data["title"] = _e("User Category");
        $data["results"] = $results;

        ## Other auxilary variable ##
        $data['var'] = array();
        $data['var']['CFG'] = $CFG;
        $data['var']['filter_status_dd'] = getFilterStatusDD();
        $data['var']['action_dd'] = getActionDD();

        $data["response"] = viewPermissionMsg($CFG["sector"]["view_all"], $CFG["sector"]["view_child"]);

        ## Load view ##
        $data["top"] = $this->template->admin_view("top", $data, true, "user_category");
        $data["content"] = $this->template->admin_view("user_category_list", $data, true, "user_category");
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
                $this->form_validation->set_rules($this->config->item('insert', 'user_category_validation'));
                if ($this->form_validation->run($this, 'insert') == FALSE)
                    echo json_encode(array("event" => "error", "msg" => validation_errors()));
                else {
                    $insertedrows = $this->ucat->insertInto($this->input->post());
                    if ($insertedrows)
                        echo json_encode(array("event" => "success", "msg" => _e('user_category added')));
                    else
                        echo json_encode(array("event" => "error", "msg" => _e('user_category add fail')));
                }
                break;
            case "edit" :
                $this->form_validation->set_rules($this->config->item('update', 'user_category_validation'));
                if ($this->form_validation->run($this, 'update') == FALSE)
                    echo json_encode(array("event" => "error", "msg" => validation_errors()));
                else {
                    $row_id = $this->input->post('row_id');
                    ## Load config and store
                    $CFG = $this->config->item('user_category_configure');
                    echo json_encode(doAction('ucat', 'update', $row_id, false, $this->input->post(), $CFG));
                }
                break;
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
    function check_unique($input, $action) {
        switch ($action) {
            case 'add' :
                if ($this->ucat->ifExists($input)) {
                    $this->form_validation->set_message('check_unique', _e('category_unique'));
                    return false;
                }
                break;
            case 'edit' :
                if ($this->ucat->ifExists($input, $this->input->post('row_id'))) {
                    $this->form_validation->set_message('check_unique', _e('category_unique'));
                    return false;
                }
                break;
        }
    }

    /**
     * check_permission
     *
     * This function called when callback validation required during add to check permission
     *
     * @param	empty
     * @return	boolean	
     */
    function check_permission() {
        ## Load config and store
        $CFG = $this->config->item('user_category_configure');
        if (!addPermission($CFG["sector"]["add"])) {
            $this->form_validation->set_message('check_permission', _e('access denied'));
            return false;
        }
    }

    /**
     * getActiveUserCategories
     *
     * This function return active user categories
     *     
     * @param	check_permission optional
     * @return	array	records
     */
    function getActiveUserCategories($check_permission = false) {
        $array = array();
        ## Load config and store
        $CFG = $this->config->item('user_category_configure');

        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['is_trashed'], 0);
        if ($check_permission) {
            $vp = viewPermission($CFG["sector"]["view_all"], $CFG["sector"]["view_child"]);
            if ($vp == 2)
                $where[] = viewScope($CFG['table_name'] . '.' . $CFG['possible_where']['creator_id'], $CFG["sector"]["view_all"], $CFG["sector"]["view_child"]);
            elseif (!$vp)
                $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['creator_id'], -1); // if not access            
        }
        $records = $this->ucat->getRecords($where);
        foreach ($records as $record)
            $array[$record->ai_user_category_id] = $record->user_category;
        return $array;
    }

}

// END User Category Admin Class

/* End of file user_category_admin.php */
/* Location: ./application/modules/user_category/controllers/user_category_admin.php */