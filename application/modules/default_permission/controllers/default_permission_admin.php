<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Default Permission Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Default Permission
 * @author		Webzstore Solutions
 */
class Default_permission_admin extends MX_Controller 
{
	/**
	 *	Autoload varible.
	 *	Loads other accessories required for this model.
	 */	 	
	public $autoload = array(
        		'language'   => array(
								'default_permission'
								),
        		'config'     => array(
								'default_permission_configure',
								'default_permission_validation',
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
		$this->load->model('default_permission_model', 'defp');						
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
	 * This function called to display default permission add html form
	 *
	 * @param	empty
	 * @return	web html
	 */
	function add()
	{
		$CFG = $this->config->item('default_permission_configure');
		$data["title"] = _e("Default Permission");		
		## Other auxilary variable ##
		$data['var'] = array();
		
		//for check admin or not		
		$data["response"] = addPermissionMsg( $CFG["sector"]["add"] );
				
		## Load user_category admin module ##
		$this->load->module('user_category/user_category_admin');
		$user_categories = $this->user_category_admin->getActiveUserCategories();	
		
		$data['var']['categories_dd'] = ( array('' => _e('Choose user category') ) + $user_categories );
		
		$data['var']['roles_dd'] = ( array('' => _e('Choose user role') ) );
		
		## Load permission_group admin module ##
		$this->load->module('permission_group/permission_group_admin');
		$permission_groups = $this->permission_group_admin->getActivePermissionGroups();
		
		$data['var']['permission_groups_dd'] = ( array('' => _e('Choose permission groups') ) +  $permission_groups);
		
		$data['var']['permissions_dd'] = ( array('' => _e('Choose permission') ) );
		$data["top"] = $this->template->admin_view("top", $data, true, "default_permission");	
		$data["content"] = $this->template->admin_view("default_permission_add", $data, true, "default_permission");
		$this->template->build_admin_output($data);
	}
	
	/**
	 * edit
	 *
	 * This function called to display default permission lists in html
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
		$CFG = $this->config->item('default_permission_configure');
		
		## Where create ##
		$wheres = createWhereArray($GET, $CFG);
		
		## Orderby create ##		
		$order_by = createOrderByArray($GET, $CFG);
		
		## Search by create ##
		$search_by = createSearchByArray($GET, $CFG);
		
		## Choose action and perform that action ##						 
		$row_id = $this->input->get('row_id');
		$action = $this->input->get('action');
		doAction('defp', $action, $row_id, true);
		
		## Fetch records ##		
		$results = $this->defp->getRecordsNPagination($wheres, $order_by, $search_by, $limit);
		$data["title"] = _e("Default Permission");
		$data["results"] = $results;
		
		## Other auxilary variable ##
		$data['var'] = array();
		
		## Load user_category admin module ##
		$this->load->module('user_category/user_category_admin');
		$user_categories = $this->user_category_admin->getActiveUserCategories();	
		
		$data['var']['categories_dd'] = ( array('' => _e('Choose user category') ) + $user_categories );
		
		## Load user_role admin module ##
		$this->load->module('user_role/user_role_admin');
		$user_roles = $this->user_role_admin->getActiveUserRoles();
		$data['var']['roles_dd'] = ( array('' => _e('Choose user role') ) + $user_roles );
		
		## Load permission_group admin module ##
		$this->load->module('permission_group/permission_group_admin');
		$permission_groups = $this->permission_group_admin->getActivePermissionGroups();
		
		$data['var']['permission_groups_dd'] = ( array('' => _e('Choose permission groups') ) +  $permission_groups);
		
		$data['var']['permissions_dd'] = ( array('' => _e('Choose permission') ) );
		
		$data['var']['CFG'] = $CFG;
		$data['var']['filter_status_dd'] = getFilterStatusDD();
		$data['var']['action_dd'] = getActionDD(); 
		
		//for check admin or not		
		$data["response"] = viewPermissionMsg( $CFG["sector"]["view_all"], $CFG["sector"]["view_child"] );

		## Load view ##
		$data["top"] = $this->template->admin_view("top", $data, true, "default_permission");	
		$data["content"] = $this->template->admin_view("default_permission_list", $data, true, "default_permission");
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
				$this->form_validation->set_rules($this->config->item('insert', 'default_permission_validation'));
				if($this->form_validation->run($this, 'insert') == FALSE)
					echo json_encode( array("event" => "error", "msg" => validation_errors() ) );
				else
				{
					$insertedrows = $this->defp->insertInto($this->input->post());
					if($insertedrows)
						echo json_encode( array("event" => "success", "msg" => _e('default permission added')) );
					else
						echo json_encode( array("event" => "error", "msg" => _e('default permission add fail')) );					
				}
				break;
			case "edit" :
				$this->form_validation->set_rules($this->config->item('update', 'default_permission_validation'));
				if($this->form_validation->run($this, 'update') == FALSE)
					echo json_encode( array("event" => "error", "msg" => validation_errors()) );
				else
				{
					$row_id = $this->input->post('row_id');
					echo json_encode( doAction('defp', 'update', $row_id, false, $this->input->post()) );					
				}
				break;					
		}
	}	
	
	/**
	 * check_unique_self
	 *
	 * This function called when callback validation required during add and update
	 *
	 * @param	integer	input id which not to be duplicate
	 * @param	string	may be add, edit
	 * @return	boolean	
	 */
	 
	function check_unique_self($input, $action)
	{
		$elm_val = $this->input->post( 'user_role_id' );
		switch($action)
		{
			case 'add' :
				if( $this->defp->ifExists( $input, $elm_val ) )
				{
					$this->form_validation->set_message('check_unique_self', _e('default permission should unique'));
					return false;
				}
				break;
			case 'edit' :
				if( $this->defp->ifExists( $input, $elm_val, $this->input->post('row_id') ) )
				{
					$this->form_validation->set_message('check_unique_self', _e('default permission should unique'));
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
			## Load config and store
			$CFG = $this->config->item('default_permission_configure');
			
			$method = $this->input->post('method');
			switch( $method )
			{
				case	'getdefaultpermissions'	:
						$where = createWhereArray($this->input->post(), $CFG);
						$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['is_trashed'], 0);
						$groupby = $CFG['possible_where']['group'];
						$group_select[] = $CFG['groupby_select'];
						$defaultpermissions = array();
						$records = $this->defp->getRecords($where, '', '', '', $groupby, $group_select);
						$count = 0;
						foreach($records as $record)
						{
							$defaultpermissions[$count] = array();
							$defaultpermissions[$count]['group'] = $record->group;
							$defaultpermissions[$count]['permission_ids'] = explode(',', $record->permission_ids);
							$defaultpermissions[$count++]['permissions'] = explode(',', $record->permissions);
						}						
						echo json_encode($defaultpermissions);						
						break;
			}
		}
	}
	
	/**
	 * getUserGrantedPermission
	 *
	 * This function called to fecth granted permission of particular user id in which role s/he logged in.
	 *
	 * @param	integer user_map_id means required_id : ai_id of (user_id, user_category_id, user_role_id)
	 * @param	integer user_roll_id
	 * @return	array	granted permissions
	 */
	 
	function getUserGrantedPermission($user_map_id, $user_roll_id)
	{
		## Load config and store
		$CFG = $this->config->item('default_permission_configure');
			
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['is_trashed'], 0);
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['role'], $user_roll_id);		
		$records = $this->defp->getRecords( $where );
		
		## check if modified permission are there or not ##
		## Load permission modify module ##
		$this->load->module('permission_modify/permission_modify_admin');
		$deniedpermissions = $this->permission_modify_admin->getDeniedPermissionByUserMapId( array('user_map_id' => $user_map_id) );
		$grantedpermissions = array();
		foreach($records as $record)
		{
			if( ! in_array( $record->allowed_permission_id, $deniedpermissions ) )
				$grantedpermissions[] = $record->allowed_permission_id;
		}
		return $grantedpermissions;
	}
		
	function check_permission()
	{
		## Load config and store
		$CFG = $this->config->item('default_permission_configure');
		if( ! addPermission( $CFG["sector"]["add"] ) )
		{
			$this->form_validation->set_message('check_permission', _e('access denied'));
			return false;				
		}
	}
	
}
/* End of file default_permission_admin.php */
/* Location: ./application/modules/default_permission/controllers/default_permission_admin.php */