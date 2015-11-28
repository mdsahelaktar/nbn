<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Biz Listing Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Biz Listing
 * @author		Webzstore Solutions
 */
class Biz_listing_admin extends MX_Controller {

    /**
     * 	Autoload varible.
     * 	Loads other accessories required for this model.
     */
    public $autoload = array(
        'language' => array('biz_listing'),
        'config' => array('biz_listing_configure', 'biz_listing_validation', 'pagination'),
        'libraries' => array('form_validation', 'pagination', 'upload'),
        'helpers' => array('form')
    );

    /**
     * 	Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('biz_listing_model', 'blist');
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
        echo 'Welcome to biz listing';
    }

    /**
     * add
     *
     * This function called to display biz listing add html form
     *
     * @param	empty
     * @return	web html
     */
    function add() {
        $data["title"] = _e("Biz Listing");
        ## Load config and store
        $CFG = $this->config->item('biz_listing_configure');
        $data["response"] = addPermissionMsg($CFG["sector"]["add"]);
        ## Other auxilary variable ##
        $data['var'] = array();
        ## Load country module ##
        $this->load->module('country/country_admin');
        $countries = $this->country_admin->getCountries();

        $data['var']['countries_dd'] = ( array('' => _e('Choose countries')) + $countries );
        $data['var']['provinces_dd'] = ( array('' => _e('Choose provinces')) );
        $data['var']['counties_dd'] = ( array('' => _e('Choose counties')) );

        ## Load biz_type module ##
        $this->load->module('biz_type/biz_type_admin');
        $biz_types = $this->biz_type_admin->getBizTypes();
        $data['var']['biz_types_dd'] = ( array('' => _e('Choose biz type')) + $biz_types );
        $data["top"] = $this->template->admin_view("top", $data, true, "biz_listing");
        $data["content"] = $this->template->admin_view("biz_listing_add", $data, true, "biz_listing");
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

        ## Load view ##
		$data = $this->list_records();
        $data["top"] = $this->template->admin_view("top", $data, true, "biz_listing");
        $data["content"] = $this->template->admin_view("biz_listing_list", $data, true, "biz_listing");
        $this->template->build_admin_output($data);
    }
	
	function list_records(){
		## Store Get ##
        $GET = $this->input->get() ? $this->input->get() : array();
        ## Load config and store
        $CFG = $this->config->item('biz_listing_configure');

        ## Can view child or all ##
        $GET["user_id"] = viewScope($CFG["c_id"], $CFG["sector"]["view_all"], $CFG["sector"]["view_child"]);
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
        doAction('blist', $action, $row_id, true, $CFG);
        $groupby = $CFG['ai_id'];
        $group_select[] = $CFG['groupby_select'];

        ## Fetch records ##				
        $results = $this->blist->getRecordsNPagination($wheres, $order_by, $search_by, $limit, $groupby, $group_select);
        $data["title"] = _e("Biz Listing");
        $data["results"] = $results;

        ## Other auxilary variable ##
        $data['var'] = array();
        $data['var']['CFG'] = $CFG;
        $data['var']['filter_status_dd'] = getFilterStatusDD();
        $data['var']['action_dd'] = getActionDD();

        ## Load country module ##
        $this->load->module('country/country_admin');
        $countries = $this->country_admin->getCountries();

        $data['var']['countries_dd'] = ( array('' => _e('Choose countries')) + $countries );
        $data['var']['provinces_dd'] = ( array('' => _e('Choose provinces')) );
        $data['var']['counties_dd'] = ( array('' => _e('Choose counties')) );

        ## Load biz_type module ##
        $this->load->module('biz_type/biz_type_admin');
        $biz_types = $this->biz_type_admin->getBizTypes();

        $data['var']['biz_types_dd'] = ( array('' => _e('Choose biz type')) + $biz_types );
        $data["response"] = viewPermissionMsg($CFG["sector"]["view_all"], $CFG["sector"]["view_child"]);
		return $data;
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
                $CFG = $this->config->item('biz_listing_configure');
                $this->form_validation->set_rules($this->config->item('insert', 'biz_listing_validation'));
                if ($this->form_validation->run($this, 'insert') == FALSE)
                    echo json_encode(array("event" => "error", "msg" => validation_errors()), JSON_HEX_QUOT | JSON_HEX_TAG);
                else {
                    $BIZ_POST = $this->input->post();
                    $BIZ_POST["user_id"] = $this->login["user_id"];                    
                    $insertedrows = $this->blist->insertInto( $BIZ_POST );
                    $image_value = $this->upload->get_multi_upload_data();
                    if( $image_value )
                    {
                        $relation_id_for_image = lastInsertedId($CFG);
                        $create_post = array( "context_id" => "1", "relation_id" => $relation_id_for_image, "is_main" => array( 1 ) );
                        $this->load->module('image/image_admin');
                        $this->image_admin->multipleDataInsert($create_post, $image_value);
                    }                    
                    if ($insertedrows == true)
                        echo json_encode(array("event" => "success", "msg" => _e('biz listing added')));
                    else
                        echo json_encode(array("event" => "error", "msg" => _e('biz listing add fail')));
                }
                break;

            case "edit" :
                $this->form_validation->set_rules($this->config->item('update', 'biz_listing_validation'));
                if ($this->form_validation->run($this, 'update') == FALSE)
                    echo json_encode(array("event" => "error", "msg" => validation_errors()), JSON_HEX_QUOT | JSON_HEX_TAG);
                else {
                    $row_id = $this->input->post('row_id');
                    ## Load config and store
                    $CFG = $this->config->item('biz_listing_configure');
					$image_value = $this->upload->get_multi_upload_data();
					$VAR = $this->input->post();
					if( $image_value )
                    {
						$relation_id_for_image = $row_id;
                        $create_post = array( "context_id" => "1", "relation_id" => $relation_id_for_image, "is_main" => array( 1 ) );
                        $this->load->module('image/image_admin');
                        $this->image_admin->multipleDataInsert($create_post, $image_value);
						$VAR["affected_from_outside"] = true;
                    }					
                    echo json_encode(doAction('blist', 'update', $row_id, false, $VAR, $CFG));
                }
                break;
        }
    }

    /**
     * upload_validation
     *
     * This function called when callback validation required during add and update for image upload
     *
     * @param	string	file_type name
     * @param	string	may be add, edit
     * @return	boolean	
     */
    function upload_validation($field, $action) {
        $config['upload_path'] = './themes/web/layout/assets/images/bizlisting/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

        $this->upload->initialize($config);
        if (count($_FILES["images"]["error"]) > 1 || (count($_FILES["images"]["error"]) == 1 && $_FILES["images"]["error"][0] != 4)) {
            switch ($action) {
                case 'add' :
                    if (!$this->upload->do_multi_upload('images')) {
                        $this->form_validation->set_message('upload_validation', $this->upload->display_errors('', ''));
                        return false;
                    }
                    break;
                case 'edit' :
                    break;
            }
        }
    }

    /**
     * check_permission
     *
     * This function called for check permission in admin panal
     *
     * @param	empty
     * @return	boolean	
     */
    function check_permission() {
        ## Load config and store
        $CFG = $this->config->item('biz_listing_configure');
        if (!addPermission($CFG["sector"]["add"])) {
            $this->form_validation->set_message('check_permission', _e('access denied'));
            return false;
        }
    }

    /**
     * getAskingPrice
     *
     * This function called for  Asking Price
     *
     * @param	empty
     * @return	array	
     */
    function getAskingPrice() {
        $array = array();
        ## Load config and store
        $CFG = $this->config->item('biz_listing_configure');
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['status'], 2);
        $sort = array($CFG['table_name'] . '.' . $CFG['possible_orderby']['sortbyasking_price']);
        $records = $this->blist->getRecords($where, $sort, '', '', '', '');
        foreach ($records as $record)
            $array[$record->asking_price] = $record->asking_price;
        return $array;
    }

    /**
     * getAskingPriceMax
     *
     * This function called for get Max Asking Price 
     *
     * @param	empty
     * @return	array	
     */
    function getAskingPriceMax() {
        $array = array();
        ## Load config and store
        $CFG = $this->config->item('biz_listing_configure');
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['status'], 2);
        $GET = array('sortbyasking_price' => 'desc');
        $order_by = createOrderByArray($GET, $CFG);
        $records = $this->blist->getRecords($where, $order_by, '', '', '', '');
        foreach ($records as $record)
            $array[$record->asking_price] = $record->asking_price;
        return $array;
    }

    /**
     * getRelation
     *
     * This function called for get Relation 
     *
     * @param	empty
     * @return	array	
     */
    function getRelation() {
        $array = array();
        ## Load config and store
        $CFG = $this->config->item('biz_listing_configure');
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['is_trashed'], 0);
        $records = $this->blist->getRecords($where);
        foreach ($records as $record)
            $array[$record->ai_biz_listing_id] = $record->headline;
        return $array;
    }

    /**
     * json
     *
     * This function called for get relation from ajax
     *
     * @case	relation
     * @return	user roles	
     */
    function json() {
        if (isAjax()) {
            ## Load config and store
            $CFG = $this->config->item('biz_listing_configure');
            $method = $this->input->post('method');
            switch ($method) {
                case 'relation' :
                    $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['is_trashed'], 0);
                    $user_roles = array();
                    $records = $this->blist->getRecords($where);
                    foreach ($records as $record)
                        $user_roles[$record->ai_biz_listing_id] = $record->headline;
                    echo json_encode($user_roles);
                    break;
            }
        }
    }

}

/* End of file biz_listing_admin.php */
/* Location: ./application/modules/biz_listing/controllers/biz_listing_admin.php */