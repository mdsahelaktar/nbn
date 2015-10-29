<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Context Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @context		Context
 * @author		Webzstore Solutions
 */
class Context_admin extends MX_Controller
{
	/**
	 *	Autoload varible.
	 *	Loads other accessories required for this model.
	 */	
	public $autoload = array(
        'language'   => array('context'),
        'config'     => array('context_configure', 'context_validation', 'pagination'),
        'libraries'  => array('form_validation', 'pagination'),
		'helpers' 	 => array('form')
        );
	
		
	/**
	 *	Constructor
	 */	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('context_model', 'contx');
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
		echo 'Welcome to context';
	}
	
	/**
	 * add
	 *
	 * This function called to display context add html form
	 *
	 * @param	empty
	 * @return	web html
	 */
	 
	function add()
	{
		## Load config and store
		$CFG = $this->config->item('context_configure');
		$data["title"] = _e("Context");			
		$data["response"] = addPermissionMsg( $CFG["sector"]["add"] );			
		$data["top"] = $this->template->admin_view("top", $data, true ,"context");	
		$data["content"] = $this->template->admin_view("context_add", $data, true ,"context");
		$this->template->build_admin_output($data);
	}
	
	/**
	 * edit
	 *
	 * This function called to display  context lists and edit in html
	 *
	 * @param	empty
	 * @return	web html
	 */
	 
	function edit()
	{
		## Store Get ##
		$GET = $this->input->get() ? $this->input->get() : array();	
		## Load config and store
		$CFG = $this->config->item('context_configure');
		## Can view child or all ##
		$GET["creator_id"] = viewScope($CFG["c_id"], $CFG["sector"]["view_all"], $CFG["sector"]["view_child"]);			 
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
		
		## Where create ##
		$wheres = createWhereArray($GET, $CFG);
		## Orderby create ##		
		$order_by = createOrderByArray($GET, $CFG);
		
		## Search by create ##
		$search_by = createSearchByArray($GET, $CFG);
		
		## Choose action and perform that action ##						 
		$row_id = $this->input->get('row_id');
		$action = $this->input->get('action');
		doAction('contx', $action, $row_id, true);
		
		## Fetch records ##				
		$results = $this->contx->getRecordsNPagination($wheres, $order_by, $search_by, $limit);
		$data["title"] = _e("Context");
		$data["results"] = $results;
		
		## Other auxilary variable ##
		$data['var'] = array();
		$data['var']['CFG'] = $CFG;
		$data['var']['filter_status_dd'] = getFilterStatusDD();
		$data['var']['action_dd'] = getActionDD();
		
		$data["response"] = viewPermissionMsg( $CFG["sector"]["view_all"], $CFG["sector"]["view_child"] ); 
		
		## Load view ##
		$data["top"] = $this->template->admin_view("top", $data, true, "context");
		$data["content"] = $this->template->admin_view("context_list", $data, true, "context");
		$this->template->build_admin_output($data);
	}	
	
	/**
	 * contextidchk
	 *
	 * This function called to context id check
	 *
	 * @param	empty
	 * @return	true false
	 */
	 
	function contextidchk()
	{
	  	$a=json_encode($this->input->post());						
		$array = array();
		## Load config and store
		$CFG = $this->config->item('context_configure');
	    $where = createWhereArray($a, $CFG);
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['is_trashed'],0);
		$records = $this->contx->getRecords($where);
		if($records==true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * json
	 *
	 * This function called to switch depend on cash
	 *
	 * @param	empty
	 * @return	user role
	 */
	 
	function json()
	{
		if( isAjax() )
		{
			## Load config and store
			$CFG = $this->config->item('_configure');
			
			$method = $this->input->post('method');
			switch( $method )
			{
				case	'getrelation'	:
						$where = createWhereArray($this->input->post(), $CFG);
						$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['is_trashed'], 0);
						$user_roles = array();
						$records = $this->urole->getRecords($where);
						foreach($records as $record)
							$user_roles[$record->ai_user_role_id] = $record->user_role;
						echo json_encode($user_roles);						
						break;
			}
		}
	}		
	
	/**
	 * getContext
	 *
	 * This function called to get Context
	 *
	 * @param	empty
	 * @return	array
	 */	
	 
	function getContext()
	{
		$array = array();
		## Load config and store
		$CFG = $this->config->item('context_configure');
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['is_trashed'], 0);
		$records = $this->contx->getRecords($where);
		foreach($records as $record)
			$array[$record->ai_context_id] = $record->context;
		return $array;	
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
				$this->form_validation->set_rules($this->config->item('insert', 'context_validation'));
				if($this->form_validation->run($this, 'insert') == FALSE)
					echo json_encode( array("event" => "error", "msg" => validation_errors() ) );
				else
				{
					$insertedrows = $this->contx->insertInto($this->input->post());
					if($insertedrows)
						echo json_encode( array("event" => "success", "msg" => _e('context added')) );
					else
						echo json_encode( array("event" => "error", "msg" => _e('context add fail')) );					
				}
				break;
			case "edit" :
				$this->form_validation->set_rules($this->config->item('update', 'context_validation'));
				if($this->form_validation->run($this, 'update') == FALSE)
					echo json_encode( array("event" => "error", "msg" => validation_errors() ) );
				else
				{
					$row_id = $this->input->post('row_id');
					echo json_encode( doAction('contx', 'update', $row_id, false, $this->input->post()) );					
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
				if( $this->contx->ifExists( $input ) )
				{
					$this->form_validation->set_message('check_unique', _e('context_unique'));
					return false;
				}
				break;
			case 'edit' :
				if( $this->contx->ifExists( $input, $this->input->post('row_id') ) )
				{
					$this->form_validation->set_message('check_unique', _e('context_unique'));
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
	 
	function check_permission()
	{
		## Load config and store
		$CFG = $this->config->item('context_configure');
		if( ! addPermission( $CFG["sector"]["add"] ) )
		{
			$this->form_validation->set_message('check_permission', _e('access denied'));
			return false;				
		}
	}
	
	/**
	 * getContexNameByContexId
	 *
	 * This function called for get Contex Name By Contex Id
	 *
	 * @param	id
	 * @return	context name	
	 */

	function getContexNameByContexId($id)
	{
		## Load config and store
		$CFG = $this->config->item('context_configure');
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['edit_id'], $id);
		$records = $this->contx->getRecords($where);
			$context_name = $records[0]->context;
		return $context_name;
	}	
}
// END context Admin Class

/* End of file context_admin.php */
/* Location: ./application/modules/context/controllers/context_admin.php */