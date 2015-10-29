<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Image Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	image
 * @author		Webzstore Solutions
 */
class Image_admin extends MX_Controller
{	
	/**
	 *	Autoload varible.
	 *	Loads other accessories required for this model.
	 */
	public $autoload = array(
        'language'   => array('image'),
        'config'     => array('image_configure', 'image_validation', 'pagination'),
        'libraries'  => array('form_validation', 'pagination', 'upload'),
		'helpers' 	 => array('form')
        );
		
	/**
	 *	Constructor
	 */	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('image_model', 'image');						
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
		echo 'Welcome to image';
	}
	
	/**
	 * add
	 *
	 * This function called to display image add html form
	 *
	 * @param	empty
	 * @return	web html
	 */
	function add()
	{
		$CFG = $this->config->item('image_configure');
		$data["title"] = _e("Image");
		## for check admin or not ##
		$data["response"] = addPermissionMsg( $CFG["sector"]["add"] );			
		## Other auxilary variable ##
		$data['var'] = array();		
		$this->load->module('context/context_admin');
		$user_context = $this->context_admin->getContext();
		$data['var']['context_dd'] = ( array('' => _e('Choose Context') ) + $user_context );
		$data['var']['relation_dd'] = ( array('' => _e('Choose Relation') ) );
		$data["top"] = $this->template->admin_view("top", $data, true, "image");	
		$data["content"] = $this->template->admin_view("image_add", $data, true, "image");
		$this->template->build_admin_output($data);
	}
	
	function edit()
	{
		## Store Get ##
		$GET = $this->input->get() ? $this->input->get() : array();

		## Load config and store
		$CFG = $this->config->item('image_configure');
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
		doAction('image', $action, $row_id, true);
		## Fetch records ##				
		$results = $this->image->getRecordsNPagination($wheres, $order_by, $search_by, $limit); 
		$data["title"] = _e("Image");
		$data["results"] = $results;
		## Other auxilary variable ##
		$data['var'] = array();
		$data['var']['CFG'] = $CFG;
		$data['var']['filter_status_dd'] = getFilterStatusDD();
		$data['var']['action_dd'] = getActionDD();
		## Load context module ##
		$this->load->module('context/context_admin');
		$user_context = $this->context_admin->getContext();
		$data['var']['context_dd'] = ( array('' => _e('Choose Context') ) + $user_context );
		
		if($results["records"][0]->context_id == 1)
		{	
			$this->load->module('biz_listing/biz_listing_admin');
			$user_relation = $this->biz_listing_admin->getRelation();
			$data['var']['relation_dd'] = ( array('' => _e('Choose Relation') ) + $user_relation );
			$data['user_relation'] = $user_relation;
		}
		if($results["records"][0]->context_id == 2)
		{
			$this->load->module('broker/broker');
			$user_relation = $this->broker->getRelation();
			$data['var']['relation_dd'] = ( array('' => _e('Choose Relation') ) + $user_relation );
			$data['user_relation'] = $user_relation;
		}
		
		$data["response"] = viewPermissionMsg( $CFG["sector"]["view_all"], $CFG["sector"]["view_child"] );
		## Load view ##
		$data["top"] = $this->template->admin_view("top", $data, true, "image");
		$data["content"] = $this->template->admin_view("image_list", $data, true, "image");
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
		$CFG = $this->config->item('image_configure');
		switch( $method )
		{
			case "add" :
			    $this->form_validation->set_rules($this->config->item('insert', 'image_validation'));
				if($this->form_validation->run($this, 'insert') == FALSE)
					echo json_encode( array("event" => "error", "msg" => validation_errors() ), JSON_HEX_QUOT | JSON_HEX_TAG );
				else
				{
					$post_data = $this->input->post();
					$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['context_id'], $post_data["context_id"]);
					$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['relation_id'], $post_data["relation_id"]);
					$records = $this->image->getRecords($where);
					foreach($records as $record)
					{
						$update_main = array('is_main' => 0,'row_id' => $record -> ai_image_id);
						doAction('image', 'update', '', false, $update_main);
					}
					
					if(!$this->input->post('is_main'))
					{
						$is_main['is_main'][0] = '1';
						$post_data = array_merge($is_main, $post_data);
					}
					$image_data = $this->upload->get_multi_upload_data();
					$insert = array();
					$insert["context_id"] = array();
					$insert["relation_id"] = array();
					$insert["caption"] = array();
					$insert["alt"] = array();
					$insert["is_main"] = array();
					$insert["image_url"] = array();
					foreach($image_data as $key => $value)
					{						
						$insert["context_id"][$key] = (int)$post_data["context_id"];
						$insert["relation_id"][$key] = (int)$post_data["relation_id"];						
						$insert["caption"][$key] = $post_data["caption"][$key];						
						$insert["alt"][$key] = $post_data["alt"][$key];						
						$insert["is_main"][$key] = $post_data["is_main"][$key];
						$image_path = explode('images/', $value['file_path']);						
						$insert["image_url"][$key] = $image_path[1].$value["file_name"];			
					}	
					
						$insertedrows = $this->image->insertInto($insert);
					if($insertedrows)
						echo json_encode( array("event" => "success", "msg" => _e('image added')) );
					else
						echo json_encode( array("event" => "error", "msg" => _e('image add fail')) );				
				}
				break;		
				
			case "edit" :
				$CFG = $this->config->item('image_configure');
				$this->form_validation->set_rules($this->config->item('update', 'image_validation'));
				if($this->form_validation->run($this, 'update') == FALSE)
					echo json_encode( array("event" => "error", "msg" => validation_errors() ), JSON_HEX_QUOT | JSON_HEX_TAG );
				else
				{
					$row_id = $this->input->post('row_id');
					$context_id = $this->input->post('context_id');
					$relation_id = $this->input->post('relation_id');
					$caption = $this->input->post('caption');
					$alt = $this->input->post('alt');
					$is_main = $this->input->post('is_main');
					
					$image_data = $this->upload->get_multi_upload_data();
					$image_path = explode('images/', $image_data[0]['file_path']);	
					
					if(empty($image_data))
					{
						$where_cls[] = array($CFG['table_name'].'.'.$CFG['possible_where']['edit_id'], $row_id);
						$records_data = $this->image->getRecords($where_cls);
						$img = $records_data[0]->image_url;
					}
					else
						$img = $image_path[1].$image_data[0]["file_name"];
					
					$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['context_id'], $context_id);
					$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['relation_id'], $relation_id);
					$records = $this->image->getRecords($where);
					foreach($records as $record)
					{
						$update_main = array('is_main' => 0,'row_id' => $record -> ai_image_id);
						doAction('image', 'update', '', false, $update_main);
					}
					$update_value = array('context_id' => $context_id, 'relation_id' => $relation_id, 'caption' => $caption, 'alt' => $alt, 'is_main' => $is_main, 'image_url' => $img, 'row_id' => $row_id);
					echo json_encode( doAction('image', 'update', '', false, $update_value) );					
				}
				break;	
				
		}
	}
	
	
	function getBizImageById($id)
	{
		$CFG = $this->config->item('image_configure');		
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['relation_id'], $id);
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['context_id'], 1);
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['is_main'], 1);
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['is_deleted'], 0);
		$results = $this->image->getRecords($where);
		return $results[0]->image_url;
     }
	
	
	
	
	
			## function for multiple data insert ##

	function multipleDataInsert($post_data, $image_data)
	{
		$insert = array();
		$insert["context_id"] = array();
		$insert["relation_id"] = array();
		$insert["caption"] = array();
		$insert["alt"] = array();
		$insert["is_main"] = array();
		$insert["image_url"] = array();
		foreach($image_data as $key => $value)
		{						
			$insert["context_id"][$key] = (int)$post_data["context_id"];
			$insert["relation_id"][$key] = (int)$post_data["relation_id"];						
			$insert["caption"][$key] = $post_data["caption"][$key];						
			$insert["alt"][$key] = $post_data["alt"][$key];						
			$insert["is_main"][$key] = $post_data["is_main"][$key];
			$image_path = explode('images/', $value['file_path']);						
			$insert["image_url"][$key] = $image_path[1].$value["file_name"];			
		}	
		
		$img_insrt = $this->image->insertInto($insert);
		if($img_insrt == true)
			return true;
		else
			return false;	

      }
			## function for multiple data insert ##

	/**
	 * upload_validation
	 *
	 * This function called when callback validation required during add and update for image upload
	 *
	 * @param	string	file_type name
	 * @param	string	may be add, edit
	 * @return	boolean	
	 */
	function upload_validation( $field, $action )
	{	
		$config['upload_path'] = './themes/web/layout/assets/images/bizlisting/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '1000';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';	
		$this->upload->initialize($config);
		if(count($_FILES["image_url"]["error"]) > 1 || (count($_FILES["image_url"]["error"]) == 1 && $_FILES["image_url"]["error"][0] != 4))
		{
			switch($action)
			{
				case 'add' :

					if( !$this->upload->do_multi_upload( 'image_url' ) )
					{
						$this->form_validation->set_message('upload_validation', $this->upload->display_errors());
						return false;
					}				
					break;
				case 'edit' :	
				
					if( !$this->upload->do_multi_upload( 'image_url' ) )
					{
						$this->form_validation->set_message('upload_validation', $this->upload->display_errors());
						return false;
					}						
					break;
			}				
		}
	}
	
}

/* End of file image_admin.php */
/* Location: ./application/modules/image/controllers/image_admin.php */