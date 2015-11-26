<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Language Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Langauge
 * @author		Webzstore Solutions
 */
class Language_admin extends MX_Controller 
{
	/**
	 *	Autoload varible.
	 *	Loads other accessories required for this model.
	 */	
	public $autoload = array(
        		'language'   => array(
								'language'
								),
        		'config'     => array(
								'language_configure',
								'language_validation',
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
		$this->load->model('language_model', 'lng');						
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
		echo "Welcome to Language settings";
	}
	
	/**
	 * add
	 *
	 * This function called to display language add html form
	 *
	 * @param	empty
	 * @return	web html
	 */
	 
	function add()
	{
		$data["title"] = _e("Language");	
		$CFG = $this->config->item('language_configure');
		
		 ## for check admin or not	 ##	
		$data["response"] = addPermissionMsg( $CFG["sector"]["add"] );			
					
		## Other auxilary variable ##
		$data['var'] = array();				
		$data["top"] = $this->template->admin_view("top", $data, true, "language");	
		$data["content"] = $this->template->admin_view("language_add", $data, true, "language");
		$this->template->build_admin_output($data);
	}
	
	/**
	 * edit
	 *
	 * This function called to display language lists in html
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
		$CFG = $this->config->item('language_configure');
		
		## Where create ##
		$wheres = createWhereArray($GET, $CFG);
		
		## Orderby create ##		
		$order_by = createOrderByArray($GET, $CFG);
		
		## Search by create ##
		$search_by = createSearchByArray($GET, $CFG);
		
		## Choose action and perform that action ##						 
		$row_id = $this->input->get('row_id');
		$action = $this->input->get('action');
		doAction('lng', $action, $row_id, true);
		
		## Fetch records ##		
		$results = $this->lng->getRecordsNPagination($wheres, $order_by, $search_by, $limit);
		$data["title"] = _e("Language");
		$data["results"] = $results;
		
		## Other auxilary variable ##
		$data['var'] = array();		
		
		$data['var']['CFG'] = $CFG;
		$data['var']['language_status_dd'] = array('' => 'choose', 0 => 'Except current', 1=> 'Current');
		$data['var']['filter_status_dd'] = getFilterStatusDD();
		$data['var']['action_dd'] = getActionDD(); 
		
		 ## for check admin or not	 ##	
		$data["response"] = viewPermissionMsg( $CFG["sector"]["view_all"], $CFG["sector"]["view_child"] );

		## Load view ##
		$data["top"] = $this->template->admin_view("top", $data, true, "language");	
		$data["content"] = $this->template->admin_view("language_list", $data, true, "language");
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
				$this->form_validation->set_rules($this->config->item('insert', 'language_validation'));
				if($this->form_validation->run($this, 'insert') == FALSE)
					echo json_encode( array("event" => "error", "msg" => validation_errors() ) );
				else
				{
					$insertedrows = $this->lng->insertInto($this->input->post());
					if($insertedrows)
						echo json_encode( array("event" => "success", "msg" => _e('language added')) );
					else
						echo json_encode( array("event" => "error", "msg" => _e('language add fail')) );					
				}
				break;
			case "edit" :
				$this->form_validation->set_rules($this->config->item('update', 'language_validation'));
				if($this->form_validation->run($this, 'update') == FALSE)
					echo json_encode( array("event" => "error", "msg" => validation_errors() ) );
				else
				{
					$row_id = $this->input->post('row_id');
					echo json_encode( doAction('lng', 'update', $row_id, false, $this->input->post()) );					
				}
				break;	
				
			case "langedit" :
				$data['language'] = $this->input->post('language');
				$data['domain'] = $this->input->post('domain');
				
				$information = $this->template->admin_view("lang_list", $data, true, "language");
				echo json_encode( array("event" => "success", "msg" => _e('success') , "data" => $information, "lang" => $data['language']));
				break;
				
			case "change":
				 $filename =  $this->input->post('filename');
				 $key =  $this->input->post('key');
				 $lan =  $this->input->post('lan');
				 $domain =  $this->input->post('domain'); 
				 $content =  $this->input->post('content');
				 $langdata = include(APPPATH.'/modules/'.$domain.'/language/'.$lan.'/'.$domain.'_lang.php');
				 if($langdata != 1)
				   {
					   $path = $_SERVER['SCRIPT_FILENAME'];
					   $path_done = str_replace('index.php', '', $path);
					   $folder = $path_done.APPPATH.'modules/'.$domain.'/language/';
					   mkdir("$folder/$lan");					   
					   $myFile = $path_done.APPPATH.'modules/'.$domain.'/language/'.$lan.'/'.$domain.'_lang.php';
					   $lang[$key] = $content;		
						 foreach($lang as $key => $value)
							{
								$php_start = '<?php';
								$total_language .= '$lang'."['".$key."'] = '".$value."';\n";
								$php_end = '?>';
							}
						file_put_contents($myFile, $php_start."\n".$total_language."\n".$php_end, FILE_APPEND);
				   }
				   else
				   {
						 $lang[$key] = $content;		
						 foreach($lang as $key => $value)
							{
								$php_start = '<?php';
								$total_language .= '$lang'."['".$key."'] = '".$value."';\n";
								$php_end = '?>';
							}				
						$data_to_write = $php_start."\n".$total_language."\n".$php_end;
						$file_path = $filename;
						$file_handle = fopen($file_path, 'w'); 
						fwrite($file_handle, $data_to_write);
						fclose($file_handle);
				   }
				echo json_encode( array("event" => "success", "msg" => _e('success')) );
				break;
				
			case "delete":
				 $filename =  $this->input->post('filename');
				 $key =  $this->input->post('key');
				 $lan =  $this->input->post('lan');
				 $domain =  $this->input->post('domain'); 
				 $content =  $this->input->post('content');
				 $langdata = include(APPPATH.'/modules/'.$domain.'/language/'.$lan.'/'.$domain.'_lang.php');
				 $lang[$key] = $content;		
				 foreach($lang as $key => $value)
					{
						$php_start = '<?php';
						$total_language .= '$lang'."['".$key."'] = '".$value."';\n";
						$php_end = '?>';
					}				
				$data_to_write = $php_start."\n".$total_language."\n".$php_end;
				$file_path = $filename;
				$file_handle = fopen($file_path, 'w'); 
				fwrite($file_handle, $data_to_write);
				fclose($file_handle);
				echo json_encode( array("event" => "success", "msg" => _e('success'), "id" => $this->input->post('id')) );
				break;
				
		  case 'getlanguage':
				$type = array();
				$lang = array('english'=>'English','hindi'=>'Hindi');
				echo json_encode($lang);	
				break;
				
		  case "langadd" :
				$information = $this->template->admin_view("lang_add", $data, true, "language");
				echo json_encode( array("event" => "success", "msg" => _e('language add bellow') , "data" => $information) );
				break;		
					
		  case "add_language_key":
				 $lan =  $this->input->post('lan');
				 $domain =  $this->input->post('domain'); 
				 $content =  $this->input->post('content');
				 $langdata = include(APPPATH.'/modules/'.$domain.'/language/english/'.$domain.'_lang.php');
				 $filename = APPPATH.'modules/'.$domain.'/language/english/'.$domain.'_lang.php';
				 $content_remov = strtolower(str_replace(' ', '_', $content));
        		 $lang[$content_remov] = $content;	
				 foreach($lang as $key => $value)
					{
						$php_start = '<?php';
						$total_language .= '$lang'."['".$key."'] = '".$value."';\n";
						$php_end = '?>';
					}	
				$data_to_write = $php_start."\n".$total_language."\n".$php_end;
				$file_path = $filename;
				$file_handle = fopen($file_path, 'w'); 
				fwrite($file_handle, $data_to_write);
				fclose($file_handle);
				echo json_encode( array("event" => "success", "msg" => _e('language update successful')) );
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
				if( $this->lng->ifExists( $input ) )
				{
					$this->form_validation->set_message('check_unique', _e('language should unique'));
					return false;
				}
				break;
			case 'edit' :
				if( $this->lng->ifExists( $input, $this->input->post('row_id') ) )
				{
					$this->form_validation->set_message('check_unique', _e('language should unique'));
					return false;
				}
				break;
		}				
	}
	
	function check_permission()
	{
		## Load config and store
		$CFG = $this->config->item('language_configure');
		if( ! addPermission( $CFG["sector"]["add"] ) )
		{
			$this->form_validation->set_message('check_permission', _e('access denied'));
			return false;				
		}
	}		
	
	function manage()
	{
		$data["title"] = _e("Manage Language");
		## Load config and store
		$CFG = $this->config->item('language_configure');
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['is_trashed'], 0);
		$records = $this->lng->getRecords($where);
		foreach($records as $record)
			$array[$record->language] = $record->language;
		$data['var']['lang_dd'] = ( array('' => _e('Choose language') ) + $array );
		$data["content"] = $this->template->admin_view("language_manage", $data, true, "language");
		$this->template->build_admin_output($data);
	}		
}
// END Language Admin Class
	
/* End of file language_admin.php */
/* Location: ./application/modules/language/controllers/language_admin.php */