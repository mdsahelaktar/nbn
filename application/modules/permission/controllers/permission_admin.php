<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Permission Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Permission
 * @author		Webzstore Solutions
 */
class Permission_admin extends MX_Controller 
{	
	/**
	 *	Autoload varible.
	 *	Loads other accessories required for this model.
	 */
	public $autoload = array(
        		'language'   => array(
								'permission'
								),
        		'config'     => array(
								'permission_configure',
								'permission_validation',
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
		$this->load->model('permission_model', 'permission');						
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
		echo 'Welcome to Permission';
	}
	
	/**
	 * add
	 *
	 * This function called to display permission add html form
	 *
	 * @param	empty
	 * @return	web html
	 */
	function add()
	{
		$CFG = $this->config->item('permission_configure');
		$data["title"] = _e("Permission");	
		
		## for check admin or not ##		
		$data["response"] = addPermissionMsg( $CFG["sector"]["add"] );			
			
		## Other auxilary variable ##
		$data['var'] = array();
		## Load permission_group admin module ##
		$this->load->module('permission_group/permission_group_admin');
		$permission_group = $this->permission_group_admin->getActivePermissionGroups();	
		
		$data['var']['permissions_dd'] = $permission_group;
		$data["top"] = $this->template->admin_view("top", $data, true, "permission");	
		$data["content"] = $this->template->admin_view("permission_add", $data, true, "permission");
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
		$CFG = $this->config->item('permission_configure');
		
		## Where create ##
		$wheres = createWhereArray($GET, $CFG);
		
		## Orderby create ##		
		$order_by = createOrderByArray($GET, $CFG);
		
		## Search by create ##
		$search_by = createSearchByArray($GET, $CFG);
		
		## Choose action and perform that action ##						 
		$row_id = $this->input->get('row_id');
		$action = $this->input->get('action');
		doAction('permission', $action, $row_id, true);
		
		## Fetch records ##		
		$results = $this->permission->getRecordsNPagination($wheres, $order_by, $search_by, $limit);
		$data["title"] = _e("Permission");
		$data["results"] = $results;
		
		## Other auxilary variable ##
		$data['var'] = array();
		
		## Load permission_group admin module ##
		$this->load->module('permission_group/permission_group_admin');
		$permission_group = $this->permission_group_admin->getActivePermissionGroups();			
		$data['var']['permissions_dd'] = (array('' => _e('Choose permission group') ) + $permission_group);
		
		$data['var']['CFG'] = $CFG;
		$data['var']['filter_status_dd'] = getFilterStatusDD();
		$data['var']['action_dd'] = getActionDD(); 
		
		## for check admin or not ##		
		$data["response"] = viewPermissionMsg( $CFG["sector"]["view_all"], $CFG["sector"]["view_child"] );

		## Load view ##
		$data["top"] = $this->template->admin_view("top", $data, true, "permission");	
		$data["content"] = $this->template->admin_view("permission_list", $data, true, "permission");
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
				$this->form_validation->set_rules($this->config->item('insert', 'permission_validation'));
				if($this->form_validation->run($this, 'insert') == FALSE)
					echo json_encode( array("event" => "error", "msg" => validation_errors() ) );
				else
				{
					$insertedrows = $this->permission->insertInto($this->input->post());
					if($insertedrows)
						echo json_encode( array("event" => "success", "msg" => _e('permission added')) );
					else
						echo json_encode( array("event" => "error", "msg" => _e('permission add fail')) );					
				}
				break;
			case "edit" :
				$this->form_validation->set_rules($this->config->item('update', 'permission_validation'));
				if($this->form_validation->run($this, 'update') == FALSE)
					echo json_encode( array("event" => "error", "msg" => validation_errors()) );
				else
				{
					$row_id = $this->input->post('row_id');
					echo json_encode( doAction('permission', 'update', $row_id, false, $this->input->post()) );					
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
	function check_unique_self($input, $action)
	{
		$elm_val = $this->input->post( 'group_id' );
		switch($action)
		{
			case 'add' :
				if( $this->permission->ifExists( $input, $elm_val ) )
				{
					$this->form_validation->set_message('check_unique_self', _e('permission should unique'));
					return false;
				}
				break;
			case 'edit' :
				if( $this->permission->ifExists( $input, $elm_val, $this->input->post('row_id') ) )
				{
					$this->form_validation->set_message('check_unique_self', _e('permission should unique'));
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
	function json()
	{
		if( isAjax() )
		{
			## Load config and store ##
			$CFG = $this->config->item('permission_configure');
			
			$method = $this->input->post('method');
			switch( $method )
			{
				case	'getpermission'	:
						$where = createWhereArray($this->input->post(), $CFG);
						$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['is_trashed'], 0);
						$permissions = array();
						$records = $this->permission->getRecords($where);
						foreach($records as $record)
							$permissions[$record->ai_permission_id] = $record->permission;
						echo json_encode($permissions);						
						break;
			}
		}
	}
	
	function check_permission()
	{
		## Load config and store ##
		$CFG = $this->config->item('permission_configure');
		if( ! addPermission( $CFG["sector"]["add"] ) )
		{
			$this->form_validation->set_message('check_permission', _e('access denied'));
			return false;				
		}
	}	
}
/* End of file permission_admin.php */
/* Location: ./application/modules/permission/controllers/permission_admin.php */