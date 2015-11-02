<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Popular Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Popular
 * @author		Webzstore Solutions
 */
class Popular extends MX_Controller
{
	/**
	 *	Autoload varible.
	 *	Loads other accessories required for this model.
	 */	
	public $autoload = array(
        		'config'     => array(
								'popular_configure'
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
		$this->load->model('popular_model', 'popumod');		
		$this->load->module('common/common_admin');
	}
	
/**
 * insertPopular
 *
 * This function called to insert Popular item
 *
 * @param	main_cat_type and child_type_name object
 * @return	*****
 */
 
	function insertPopularItem($main_cat_type, $child_type_name, $object)
	{
		$CFG = $this->config->item('popular_configure');
		$ip = getRealIpAddr();
		$date = date("Y-m-d h:i:s");
		$object_dtls = array('ai_bizlisting_id' => 1, 'biz_type_id' => 2, 'province_id' => 3, 'city' =>4, 'county_id' =>5);
		
		$where[] = array($CFG['possible_where']['main_cat_type'], $main_cat_type);
		$where[] = array($CFG['possible_where']['object'], $object);
		$where[] = array($CFG['possible_where']['child_cat_type'], $object_dtls[$child_type_name]);
		$groupby = $CFG['ai_id'];
		$group_select[] = $CFG['groupby_select'];
		$records = $this->popumod->getRecords($where, '', '', '', $groupby, $group_select, $object_dtls[$child_type_name]);
		## first time if no record found ##
		if(empty($records))
		{
			if($object_dtls[$child_type_name] == 1 && is_numeric($object) || $object_dtls[$child_type_name] == 2 ||$object_dtls[$child_type_name] == 3 ||$object_dtls[$child_type_name] == 4||$object_dtls[$child_type_name] == 5)
			{
			$insert_popular_data = array('main_cat_type' => $main_cat_type, 'child_cat_type' => $object_dtls[$child_type_name],  'object' => $object);
			$insertedrows = $this->popumod->insertInto($insert_popular_data);
			$rerds = $this->popumod->getRecords($where, '', '', '', $groupby, $group_select, $object_dtls[$child_type_name]);
			$ai = $rerds[0]->ai_popular_id;
			$this->insertPopularLog($ai, $ip, $date);
			}
		}
		## chk if record exist with search triteria ##
		else
		{
			$ip_address = explode('[@]', $records[0]->ip_address);
			if (!in_array($ip, $ip_address))
			{
				$row_update = array("count" => $records[0]->count+1, "row_id" => $records[0]->ai_popular_id);
				$updt = doAction('popumod', 'update', '', false, $row_update);
				$this->insertPopularLog($records[0]->ai_popular_id, $ip, $date);
			}
		}
	}

/**
 * insertPopularLog
 *
 * This function called for insert popular log table data
 *
 * @param	ai_id,ip address, and cur date 
 * @return	true
 */
 
	function insertPopularLog($ai, $ip, $date)
	{
		$insert_popularlog_data = array('popular_id' => $ai, 'ip_address' => $ip, 'creation_time' => $date);
		$this->load->module('popularlog/popularlog');
		$insertlog = $this->populogmod->insertInto($insert_popularlog_data);
		return true;
	}	

/**
 * getPopularItem
 *
 * This function called to get Popular Item
 *
 * @param	empty
 * @return	records
 */
 
	function getPopularItem($main_type, $child_type)
	{
		$CFG = $this->config->item('popular_configure');
		$config_var = $this->config->item('var');
		$object_dtls = array('ai_bizlisting_id' => 1, 'biz_type_id' => 2, 'province_id' => 3, 'city' =>4, 'restaurant' =>1, 'county_id' =>5);
		$POST = array("count" => 'desc');
		$order_by = createOrderByArray($POST, $CFG);
		$where[] = array($CFG['possible_where']['main_cat_type'], $main_type);
		$where[] = array($CFG['possible_where']['child_cat_type'], $object_dtls[$child_type]);
		if($child_type == 'restaurant')
			$where[] = array($CFG['possible_where']['biz_type_id'], 68);
			
		if(!empty($_COOKIE["country"]))
			$country = $_COOKIE["country"];
		else
			$country = $_COOKIE["country_ip"];	
		
		$country = placeCountryId( 0, $config_var['client_country_id'], $config_var['default_country_id'] );
				
		if($country)
		    $where[] = array($CFG['possible_where']['country_id'], $country);	
			
		if(!empty($_COOKIE["province"]) || !empty($_COOKIE["country"]))
			$province = '';
		else
			$province = $_COOKIE["province_ip"];
				
		if($province)
		    $where[] = array($CFG['possible_where']['province_id'], $province);		
		$groupby = $CFG['ai_id'];
		$group_select[] = $CFG['groupby_select'][$object_dtls[$child_type]];
		$records = $this->popumod->getRecords($where, $order_by, '', '', $groupby, $group_select, $object_dtls[$child_type]);
		
		if(empty($records) && !empty($province))
		{
			array_pop($where);
			$records = $this->popumod->getRecords($where, $order_by, '', '', $groupby, $group_select, $object_dtls[$child_type]);	
			return $records;	
		}
		else
		{
			return $records;
		}

	}	

/**
 * getPopularItemList
 *
 * This function called to show home page popular list like popular serch by state etc
 *
 * @param	main_type child_type  string 
 * @return	popular_item_list view page
 */
 
	function getPopularItemList($main_type, $child_type, $string)
	{
		$get_popular_biz = $this->popular->getPopularItem($main_type, $child_type);
		$data['item'] = $get_popular_biz;
		$data['string'] = $string;
		$data['url_link'] = $url_link;
		$data['ahref_show'] = $ahref_show;
		$data['most'] = $most;
		if($main_type == 1 && $child_type == 'ai_bizlisting_id')
		{
			$data['link_format'] = '<a href="biz_listing/details?dtls=%s" class="global1">%s</a>';
			$data['condition'] = 0;
			$data['mod'] = 30;
		}
		if($main_type == 1 && $child_type == 'biz_type_id')
		{
			$data['link_format'] = '<a href="biz_listing/search?biz_type_id=%s&biz_domain_id=%s" class="global1">%s</a>';	
			$data['condition'] = 1;
			$data['mod'] = 30;
	    }
		if($main_type == 1 && $child_type == 'province_id')
		{
			$data['link_format'] = '<a href="biz_listing/search?province_id=%s" class="global1">%s</a>';	
			$data['condition'] = 2;
			$data['mod'] = 50;
		}
		if($main_type == 1 && $child_type == 'city')
		{
			$data['link_format'] = '<a href="biz_listing/search?city=%s" class="global1">%s</a>';	
			$data['condition'] = 3;
			$data['mod'] = 50;
		}
		if($main_type == 1 && $child_type == 'restaurant')
		{
			$data['link_format'] = '<a href="biz_listing/details?dtls=%s" class="global1">%s</a>';
			$data['condition'] = 4;
			$data['mod'] = 30;
		}
		$item_list = $this->template->frontend_view("popular_item_list", $data, true, "popular"); 
		return $item_list;
	}
	
/**
 * getPopularItemSidebar
 *
 * This function called to show home page popular list sidebar list
 *
 * @param	main_type child_type   
 * @return	popular_item_sidebar view page
 */
	function getPopularItemSidebar($main_type, $child_type , $string)
	{
		$get_popular_biz = $this->popular->getPopularItem($main_type, $child_type);
		$data['item'] = $get_popular_biz;
		if($main_type == 1 && $child_type == 'ai_bizlisting_id')
		{
			$data['condition'] = 1;
			$data['string'] = $string;
		}
		if($main_type == 1 && $child_type == 'province_id')
		{
			$data['condition'] = 2;
			$data['string'] = $string;
		}
		$item_list = $this->template->frontend_view("popular_item_sidebar", $data, true, "popular");
		return $item_list;
	}

/**
 * getPopularSearchSidebar
 *
 * This function called to show search page popular search sidebar list
 *
 * @param	main_type child_type   
 * @return	popular_search_sidebar view page
 */
	function getPopularSearchSidebar($main_type, $child_type, $string)
	{
		$get_popular_biz = $this->popular->getPopularItem($main_type, $child_type);
		$data['item'] = $get_popular_biz;
		if($main_type == 1 && $child_type == 'ai_bizlisting_id')
		{
			$data['condition'] = 1;
			$data['string'] = $string;
		}
		if($main_type == 1 && $child_type == 'county_id')
		{		
			$data['condition'] = 2;
			$data['string'] = $string;
		}
		$item_list = $this->template->frontend_view("popular_search_sidebar", $data, true, "popular");
		return $item_list;
	}
	
/**
 * bizHitCount
 *
 * @param	object   
 * @return	count
 */
	 
	function bizHitCount($obj)
	{
		$CFG = $this->config->item('popular_configure');
		$where[] = array($CFG['possible_where']['main_cat_type'], 1);
		$where[] = array($CFG['possible_where']['object'], $obj);
		$where[] = array($CFG['possible_where']['child_cat_type'], 1);
		$groupby = $CFG['ai_id'];
		$group_select[] = $CFG['groupby_select'];
		$records = $this->popumod->getRecords($where, '', '', '', $groupby, $group_select, 1);
		return $records[0]->count;
	}
}
// END Popular Class

/* End of file popular.php */
/* Popular: ./application/modules/popular/controllers/popular.php */