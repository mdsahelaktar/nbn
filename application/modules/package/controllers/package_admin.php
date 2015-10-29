<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Package Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Package
 * @author		Webzstore Solutions
 */
class Package_admin extends MX_Controller {

    /**
     * 	Autoload varible.
     * 	Loads other accessories required for this model.
     */
    public $autoload = array(
        'language' => array('package'),
        'config' => array('package_configure', 'package_validation', 'pagination'),
        'libraries' => array('form_validation', 'pagination'),
        'helpers' => array('form')
    );

    /**
     * 	Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('package_model', 'pmodel');
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
        echo 'Welcome to package';
    }

    /**
     * add
     *
     * This function called to display package add html form
     *
     * @param	empty
     * @return	web html
     */
    function add() {
        ## Load config and store
        $CFG = $this->config->item('package_configure');
        $data["title"] = _e("Package");
		## for check admin or not ##
        $data["response"] = addPermissionMsg($CFG["sector"]["add"]);
		## Other auxilary variable ##
		$data['var'] = array();		
		$this->load->module('context/context_admin');
		$user_context = $this->context_admin->getContext();
		$data['var']['context_dd'] = ( array('' => _e('Choose Context') ) + $user_context );
		
        $data["top"] = $this->template->admin_view("top", $data, true, "package");
        $data["content"] = $this->template->admin_view("package_add", $data, true, "package");
        $this->template->build_admin_output($data);
    }

    /**
     * edit
     *
     * This function called to display package lists in html
     *
     * @param	empty
     * @return	web html
     */
    function edit() {
        ## Store Get ##
        $GET = $this->input->get() ? $this->input->get() : array();
		
        ## Load config and store
        $CFG = $this->config->item('package_configure');
			
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
        doAction("pmodel", $action, $row_id, true, '', $CFG);

        ## Fetch records ##				
        $results = $this->pmodel->getRecordsNPagination($wheres, $order_by, $search_by, $limit);
        $data["title"] = _e("Package");
        $data["results"] = $results;

        ## Other auxilary variable ##
        $data['var'] = array();
        $data['var']['CFG'] = $CFG;
        $data['var']['filter_status_dd'] = getFilterStatusDD();
        $data['var']['action_dd'] = getActionDD();
		
		$this->load->module('context/context_admin');
		$user_context = $this->context_admin->getContext();
		$data['var']['context_dd'] = ( array('' => _e('Choose Context') ) + $user_context );

        $data["response"] = viewPermissionMsg($CFG["sector"]["view_all"], $CFG["sector"]["view_child"]);

        ## Load view ##
        $data["top"] = $this->template->admin_view("top", $data, true, "package");
        $data["content"] = $this->template->admin_view("package_list", $data, true, "package");
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
                $this->form_validation->set_rules($this->config->item('insert', 'package_validation'));
                if ($this->form_validation->run($this, 'insert') == FALSE)
                    echo json_encode(array("event" => "error", "msg" => validation_errors()));
                else {
                    $insertedrows = $this->pmodel->insertInto($this->input->post());
                    if ($insertedrows)
                        echo json_encode(array("event" => "success", "msg" => _e('package added')));
                    else
                        echo json_encode(array("event" => "error", "msg" => _e('package add fail')));
                }
                break;
            case "edit" :
                $this->form_validation->set_rules($this->config->item('update', 'package_validation'));
                if ($this->form_validation->run($this, 'update') == FALSE)
                    echo json_encode(array("event" => "error", "msg" => validation_errors()));
                else {
                    $row_id = $this->input->post('row_id');
                    ## Load config and store
                    $CFG = $this->config->item('package_configure');
                    echo json_encode(doAction('pmodel', 'update', $row_id, false, $this->input->post(), $CFG));
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
		$context_id = $this->input->post('context_id');
        switch ($action) {
            case 'add' :
                if ($this->pmodel->ifExists( $input, $context_id )) {
                    $this->form_validation->set_message('check_unique', _e('package_unique'));
                    return false;
                }
                break;
            case 'edit' :
                if ($this->pmodel->ifExists( $input, $context_id, $this->input->post('row_id') )) {
                    $this->form_validation->set_message('check_unique', _e('package_unique'));
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
        $CFG = $this->config->item('package_configure');
        if (!addPermission($CFG["sector"]["add"])) {
            $this->form_validation->set_message('check_permission', _e('access denied'));
            return false;
        }
    }    

}

// END Package Admin Class

/* End of file package_admin.php */
/* Location: ./application/modules/package/controllers/package_admin.php */