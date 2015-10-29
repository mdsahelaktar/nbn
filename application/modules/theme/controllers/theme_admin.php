<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Theme Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Theme
 * @author		Webzstore Solutions
 */
class Theme_admin extends MX_Controller
{
	/**
	 *	Autoload varible.
	 *	Loads other accessories required for this model.
	 */	
	public $autoload = array(
        		'language'   => array(
								'theme'
								),
        		'config'     => array(
								'theme_configure',
								'theme_validation',
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
		$this->load->model('theme_model', 'thm');						
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
		echo "Welcome to Theme settings";
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
		$data["title"] = _e("Theme");	
		$CFG = $this->config->item('theme_configure');
		
		## for check admin or not	##	
		$data["response"] = addPermissionMsg( $CFG["sector"]["add"] );
					
		## Other auxilary variable ##
		$data['var'] = array();				
		$data["top"] = $this->template->admin_view("top", $data, true, "theme");	
		$data["content"] = $this->template->admin_view("theme_add", $data, true, "theme");
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
		$CFG = $this->config->item('theme_configure');
		
		## Where create ##
		$wheres = createWhereArray($GET, $CFG);
		
		## Orderby create ##		
		$order_by = createOrderByArray($GET, $CFG);
		
		## Search by create ##
		$search_by = createSearchByArray($GET, $CFG);
		
		## Choose action and perform that action ##						 
		$row_id = $this->input->get('row_id');
		$action = $this->input->get('action');
		doAction('thm', $action, $row_id, true);
		
		## Fetch records ##		
		$results = $this->thm->getRecordsNPagination($wheres, $order_by, $search_by, $limit);
		$data["title"] = _e("Theme");
		$data["results"] = $results;
		
		## Other auxilary variable ##
		$data['var'] = array();		
		
		$data['var']['CFG'] = $CFG;
		$data['var']['theme_status_dd'] = array('' => 'choose', 0 => 'Except current', 1=> 'Current');
		$data['var']['filter_status_dd'] = getFilterStatusDD();
		$data['var']['action_dd'] = getActionDD(); 
		
		## for check admin or not ##		
		$data["response"] = viewPermissionMsg( $CFG["sector"]["view_all"], $CFG["sector"]["view_child"] );

		## Load view ##
		$data["top"] = $this->template->admin_view("top", $data, true, "theme");	
		$data["content"] = $this->template->admin_view("theme_list", $data, true, "theme");
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
				$this->form_validation->set_rules($this->config->item('insert', 'theme_validation'));
				if($this->form_validation->run($this, 'insert') == FALSE)
					echo json_encode( array("event" => "error", "msg" => validation_errors() ) );
				else
				{
					$insertedrows = $this->thm->insertInto($this->input->post());
					if($insertedrows)
						echo json_encode( array("event" => "success", "msg" => _e('theme added')) );
					else
						echo json_encode( array("event" => "error", "msg" => _e('theme add fail')) );					
				}
				break;
			case "edit" :
				$this->form_validation->set_rules($this->config->item('update', 'theme_validation'));
				if($this->form_validation->run($this, 'update') == FALSE)
					echo json_encode( array( "error" => array('msg' => validation_errors() ) ) );
				else
				{
					$row_id = $this->input->post('row_id');
					echo json_encode( doAction('thm', 'update', $row_id, false, $this->input->post()) );					
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
				if( $this->thm->ifExists( $input ) )
				{
					$this->form_validation->set_message('check_unique', _e('theme should unique'));
					return false;
				}
				break;
			case 'edit' :
				if( $this->thm->ifExists( $input, $this->input->post('row_id') ) )
				{
					$this->form_validation->set_message('check_unique', _e('theme should unique'));
					return false;
				}
				break;
		}				
	}		
	
	function check_permission()
	{
		## Load config and store ##
		$CFG = $this->config->item('theme_configure');
		if( ! addPermission( $CFG["sector"]["add"] ) )
		{
			$this->form_validation->set_message('check_permission', _e('access denied'));
			return false;				
		}
	}
}


	
/* End of file theme_admin.php */
/* Location: ./application/modules/theme/controllers/theme_admin.php */