<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Permission Modify Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Permission Modify
 * @author		Webzstore Solutions
 */
class Permission_modify_admin extends MX_Controller {
	/**
	 *	Autoload varible.
	 *	Loads other accessories required for this model.
	 */
	public $autoload = array(
        		'language'   => array(
								'permission_modify'
								),
        		'config'     => array(
								'permission_modify_configure',
								'permission_modify_validation',
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
		$this->load->model('permission_modify_model', 'pmdf');						
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
		echo "Welcome to Permission modify";
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
		$data["title"] = _e("Permission Modify");	
		$CFG = $this->config->item('permission_modify_configure');
		## for check admin or not	##	
		$data["response"] = addPermissionMsg( $CFG["sector"]["add"] );
					
		## Other auxilary variable ##
		$data['var'] = array();				
		$data["top"] = $this->template->admin_view("top", $data, true, "permission_modify");	
		$data["content"] = $this->template->admin_view("permission_modify_add", $data, true, "permission_modify");
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
			case "modify" :
				$user_map_id = $this->input->post('user_map_id'); 
				$modified = false;
				$deniedpermissions = $this->getDeniedPermissionByUserMapId($this->input->post(), true);		
				$permission_ids = $this->input->post('permission_id');				
				if($deniedpermissions)	
				{
					if( ! $permission_ids )
						$modified = $this->pmdf->dbUpdate('delete', $user_map_id) ? true : false;
					else
					{	
						$should_update = array_values( array_intersect( $deniedpermissions, $permission_ids ) );
						if($should_update)		
							$modified = $this->pmdf->dbUpdate('mixupdate', $user_map_id, $should_update) ? true : false;					
						else
							$modified = $this->pmdf->dbUpdate('delete', $user_map_id) ? true : false;	
						$should_insert = array_values( array_diff( $permission_ids, $deniedpermissions ) );
						if($should_insert)
							$modified = $this->pmdf->insertInto(array('user_map_id' => $user_map_id, 'permission_id' => $should_insert)) ? true : ( $modified ? true : false );
					}
				}
				else
				{
					if( ! $permission_ids )
					{
						echo json_encode( array("event" => "error", "msg" => 'Please choose permission to deny' ) );
						exit;
					}
					$should_insert = $permission_ids;
					$modified = $this->pmdf->insertInto(array('user_map_id' => $user_map_id, 'permission_id' => $should_insert)) ? true : false;
				}
				if( $modified )
					echo json_encode( array("event" => "success", "msg" => _e('permission modified')) );
				else
					echo json_encode( array("event" => "error", "msg" => _e('permission unchanged')) );	
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
			$method = $this->input->post('method');
			switch( $method )
			{
				case	'deniedperissionbyumapid'	:
						$deniedpermissions = $this->getDeniedPermissionByUserMapId($this->input->post());
						echo json_encode($deniedpermissions);						
						break;
			}
		}
	}
	
	/**
	 * getDeniedPermissionByUserMapId
	 *
	 * This function returns denied permission of user id
	 *
	 * @param	array	dataset	may be $_GET,$_POST etc
	 * @param	boolean	include deleted permission or not
	 * @return	array	denied permissions
	 */
	function getDeniedPermissionByUserMapId($postval, $all = false)
	{
		## Load config and store ##
		$CFG = $this->config->item('permission_modify_configure');
		
		$where = createWhereArray($postval, $CFG);
		if( !$all )
			$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['is_trashed'], 0);
		$deniedpermissions = array();
		$records = $this->pmdf->getRecords( $where );
		foreach($records as $record)
			$deniedpermissions[] = $record->permission_id;
		return $deniedpermissions;	
	}
	
	function check_permission()
	{
		## Load config and store ##
		$CFG = $this->config->item('permission_modify_configure');
		if( ! addPermission( $CFG["sector"]["add"] ) )
		{
			$this->form_validation->set_message('check_permission', _e('access denied'));
			return false;				
		}
	}
	
}
/* End of file permission_modify_admin.php */
/* Location: ./application/modules/permission_modify/controllers/permission_modify_admin.php */