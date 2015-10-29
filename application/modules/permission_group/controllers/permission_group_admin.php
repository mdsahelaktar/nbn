<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Permission Group Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Permission Group
 * @author		Webzstore Solutions
 */
class Permission_group_admin extends MX_Controller
{
	/**
	 *	Autoload varible.
	 *	Loads other accessories required for this model.
	 */	
	public $autoload = array(
        		'language'   => array(
								'permission_group'
								),
        		'config'     => array(
								'permission_group_configure',
								'permission_group_validation',
								'pagination'
								),
        		'libraries'  => array(
								'form_validation',
								'pagination'
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
		$this->load->model('permission_group_model', 'pgrp');						
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
		echo "Welcome to Permission group";
	}
	
	/**
	 * add
	 *
	 * This function called to display permission group add html form
	 *
	 * @param	empty
	 * @return	web html
	 */
	function add()
	{
		$CFG = $this->config->item('permission_group_configure');
		$data["title"] = _e("Permission Group");		
		
		## for check admin or not	##	
		$data["response"] = addPermissionMsg( $CFG["sector"]["add"] );
		
		## Other auxilary variable ##
		$data['var'] = array();				
		$data["top"] = $this->template->admin_view("top", $data, true, "permission_group");	
		$data["content"] = $this->template->admin_view("permission_group_add", $data, true, "permission_group");
		$this->template->build_admin_output($data);
	}
	
	/**
	 * edit
	 *
	 * This function called to display permission group lists in html
	 *
	 * @param	empty
	 * @return	web html
	 */
	function edit()
	{

		## Store Get ##
		$GET = $this->input->get() ? $this->input->get() : array();
		
		## Check if edit ##
		$data["edit_id"] = $this->input->get('edit_id');
		
		## Limit create	##			
		if( $data["edit_id"] )
			$limit = 0;
		else
		{	
			$limit[1] = $this->config->item('default_per_page', 'pagination');
			$page_no = $this->input->get('page');
			$page_no = !$page_no ? 1 : $page_no;
			$limit[0] = ($page_no * $limit[1]) - $limit[1];
		}
		## Limit end ##
		
		## Load config and store
		$CFG = $this->config->item('permission_group_configure');
		
		## Where create ##
		$wheres = createWhereArray($GET, $CFG);
		
		## Orderby create ##		
		$order_by = createOrderByArray($GET, $CFG);
		
		## Search by create ##
		$search_by = createSearchByArray($GET, $CFG);
		
		## Choose action and perform that action ##						 
		$row_id = $this->input->get('row_id');
		$action = $this->input->get('action');
		doAction('pgrp', $action, $row_id, true);
		
		## Fetch records ##		
		$results = $this->pgrp->getRecordsNPagination($wheres, $order_by, $search_by, $limit);
		$data["title"] = _e("Permission Group");
		$data["results"] = $results;
		
		## Other auxilary variable ##
		$data['var'] = array();		
		
		$data['var']['CFG'] = $CFG;
		$data['var']['filter_status_dd'] = getFilterStatusDD();
		$data['var']['action_dd'] = getActionDD(); 
		
		## for check admin or not ##		
		$data["response"] = viewPermissionMsg( $CFG["sector"]["view_all"], $CFG["sector"]["view_child"] );

		## Load view ##
		$data["top"] = $this->template->admin_view("top", $data, true, "permission_group");	
		$data["content"] = $this->template->admin_view("permission_group_list", $data, true, "permission_group");
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
	function ajax()
	{
		$method = $this->input->post('method');
		switch( $method )
		{
			case "add" :
				$this->form_validation->set_rules($this->config->item('insert', 'permission_group_validation'));
				if($this->form_validation->run($this, 'insert') == FALSE)
					echo json_encode( array("event" => "error", "msg" => validation_errors() ) );
				else
				{
					$insertedrows = $this->pgrp->insertInto($this->input->post());
					if($insertedrows)
						echo json_encode( array("event" => "success", "msg" => _e('permission group added')) );
					else
						echo json_encode( array("event" => "error", "msg" => _e('permission group add fail')) );					
				}
				break;
			case "edit" :
				$this->form_validation->set_rules($this->config->item('update', 'permission_group_validation'));
				if($this->form_validation->run($this, 'update') == FALSE)
					echo json_encode( array("event" => "error", "msg" => validation_errors() ) );
				else
				{
					$row_id = $this->input->post('row_id');
					echo json_encode( doAction('pgrp', 'update', $row_id, false, $this->input->post()) );					
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
	function check_unique($input, $action)
	{
		switch($action)
		{
			case 'add' :
				if( $this->pgrp->ifExists( $input ) )
				{
					$this->form_validation->set_message('check_unique', _e('permission group should unique'));
					return false;
				}
				break;
			case 'edit' :
				if( $this->pgrp->ifExists( $input, $this->input->post('row_id') ) )
				{
					$this->form_validation->set_message('check_unique', _e('permission group should unique'));
					return false;
				}
				break;
		}				
	}
		
	function check_permission()
	{
		## Load config and store ##
		$CFG = $this->config->item('permission_group_configure');
		if( ! addPermission( $CFG["sector"]["add"] ) )
		{
			$this->form_validation->set_message('check_permission', _e('access denied'));
			return false;				
		}
	}
	
	
	/**
	 * getActivePermissionGroups
	 *
	 * This function return active permission group
	 *
	 * @param	empty
	 * @return	array	permission group/s
	 */
	function getActivePermissionGroups()
	{
		$array = array();
		
		## Load config and store ##
		$CFG = $this->config->item('permission_group_configure');
		
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['is_trashed'], 0);
		$records = $this->pgrp->getRecords($where);
		foreach($records as $record)
			$array[$record->ai_permission_group_id] = $record->group;
		return $array;	
	}	
}
// END Permission Group Admin Class

/* End of file permission_group_admin.php */
/* Location: ./application/modules/permission_group/controllers/permission_group_admin.php */