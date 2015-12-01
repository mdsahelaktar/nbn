<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Broker Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Broker
 * @author		Webzstore Solutions
 */
class Broker extends MX_Controller {

    /**
     * 	Autoload varible.
     * 	Loads other accessories required for this model.
     */
    public $autoload = array(
        'language' => array(
            'broker'
        ),
        'config' => array(
            'broker_configure',
            'broker_validation'
        ),
        'libraries' => array(
            'form_validation',
            'upload'
        ),
        'helpers' => array(
            'form'
        )
    );

    /**
     * 	Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('broker_model', 'brokermod');
        $this->load->module('common/common_admin'); 
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
        $data = array();
        $data["title"] = _e("Find Broker");
        $CFG = $this->config->item('broker_configure');
        $zip = $this->input->get('zip');
        $data['zip'] = $zip;
        $this->load->module('province/province_admin');
        $itemtree = $this->province_admin->getAllProvinces();
        $item['item'] = $itemtree;
        $item['con'] = 1;
        $item['string'] = 'Browse Business Brokers By U.S. State';
        $data['province_list'] = $this->template->frontend_view("listing", $item, true, "broker");

        $this->load->module('country/country_admin');
        $country_listtree = $this->country_admin->getAllCountries();
        $country_list['item'] = $country_listtree;
        $country_list['con'] = 2;
        $country_list['string'] = 'Browse Business Brokers By Country';
        $data['country_list'] = $this->template->frontend_view("listing", $country_list, true, "broker");




        /*         * ********************************************************************|location start country improter|**************************************************************************
          $this->load->library('excel_reader');
          $CI =& get_instance();
          $this->excel_reader->read('example.xls'); //Start reading the XLS file
          $CI->data_array = $CI->excel_reader->sheets[1]; //This should return my XLS but only returns NULL

          $county = mysql_query("select * from county");
          while ($countyrow = mysql_fetch_array($county))
          {
          $county_db[] = $countyrow['county'];
          }
          foreach($CI->data_array['cells'] as $c)
          {
          $county_xl[] = $c['2'];
          }
          $result1 = array_diff($county_xl, $county_db);
          $result = array_unique($result1);

          $pabber = mysql_query("select ai_province_id from province where abber = $pabber");
          while ($inspro = mysql_fetch_array($pabber))
          {
          $ai_pro = $inspro['ai_province_id'];
          $county_name = '';
          $country_id = '';
          mysql_query("INSERT INTO county "."(province_id, country_id, county, is_trashed, is_deleted, creation_time, update_time) "."VALUES "."('$ai_pro', '$country_id','$county_name','','','now()','')");
          }
          /*********************************************************************|location end country improter|******************************************************************************

          /********************************************************************|location start province improter|*****************************************************************************
          $this->load->library('excel_reader');
          $CI =& get_instance();
          $this->excel_reader->read('example.xls'); //Start reading the XLS file
          $CI->data_array = $CI->excel_reader->sheets[1]; //This should return my XLS but only returns NULL

          $province = mysql_query("select abber from province");
          while ($provincerow = mysql_fetch_array($province))
          {
          $province_db[] = $provincerow['abber'];
          }
          foreach($CI->data_array['cells'] as $p)
          {
          $province_xl[] = $p['1'];
          }
          $result_pro = array_diff($province_xl, $province_db);
          $result = array_unique($result_pro);

          foreach($result as $proab_name)
          {
          $province_name = '';
          $abbre_pro = $proab_name;
          $country_id = '';
          mysql_query("INSERT INTO county "."(province, abbre, country_id, is_trashed, is_deleted, creation_time, update_time) "."VALUES "."('$province_name','$country_id','','','now()','')");
          }
          /***************************************************************************location end province improter**************************************************************************
          /***************************************************************************location table improter**************************************************************************

          /*************************************************
          $rr = mysql_query("select * from location");
          while ($row = mysql_fetch_array($rr))
          {
          $zip_db[$row['zipcode']] = array();

          /*************************************************
          $county = mysql_query("select * from county");
          while ($countyrow = mysql_fetch_array($county))
          {
          $county_db[strtolower($countyrow['county'])] = $countyrow['ai_county_id'];
          }
          /*************************************************
          foreach($CI->data_array['cells'] as $c)
          {
          if(array_key_exists($c['1'],$zip_db))
          $zip_db[$c['1']] = $county_db[strtolower($c['2'])];
          }
          /*************************************************
          foreach($zip_db as $zip_key => $coun_val)
          {
          if(is_array($coun_val))
          $coun_val = '';
          $upd_str[] = "WHEN {$zip_key} THEN ".$coun_val;
          $upd_str[] = '<br>';
          }
          $update_query = "UPDATE location SET `county` = CASE zipcode ".implode(" ",$upd_str)." END";
          mysql_query($update_query);
          /***************************************************************************location end province improter************************************************************************* */


        //die();	        
        $data["content"] = $this->template->frontend_view("find_broker", $data, true, "broker");
        $this->template->build_frontend_output($data);
    }

    /**
     * profileinfo
     *
     * Default action method
     * view broker_profile_info page
     * @param	empty
     * @return	*****
     */
    function profileinfo() {
        $data = array();
        $data["title"] = _e("Profile Information");
        $CFG = $this->config->item('broker_configure');
        $login_info = isLoggedIn();
        $data['user_id'] = $login_info["user_id"];
		$profile = $this->getBrokerDetailsByid( $login_info["user_id"] );		
		$data = array_merge( $data , (array)$profile[0] );
		
		if( $profile[0]->country_id )
			$data["provinces_dd"] = modules::run('province/province_admin/getProvincesByCountryId', $profile[0]->country_id );
		else
			$data["provinces_dd"] = array('' => _e("choose_provice"));
		
		if( $profile[0]->province_id )
			$data["counties_dd"] = modules::run('county/county_admin/getCountiesByProvinceId', $profile[0]->province_id );
		else
			$data["counties_dd"] = array('' => _e("choose_counties"));
		
		if( $profile[0]->county_id )
			$data["cities_dd"] = modules::run('location/location/getCityByCountyId', $profile[0]->county_id );
		else
			$data["cities_dd"] = array('' => _e("choose_counties"));	
		
		if( !$profile[0]->city )	
			$data["zipcodes_dd"] = array('' => _e("choose_zipcodes"));	
		
        $data["content"] = $this->template->frontend_view("broker_profile_info", $data, true, "broker");
        $this->template->build_frontend_output($data);
    }

    /**
     * getBrokerDetailsByid
     *
     * Default action method
     *  
     * @param	id
     * @return	broker details
     */
    function getBrokerDetailsByid($id) {
        $CFG = $this->config->item('broker_configure');
        $groupby = $CFG['ai_id'];
        $group_select[] = $CFG['groupby_select'];
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['user_id'], $id);
        $results = $this->brokermod->getRecords($where, '', '', '', $groupby, $group_select);
        return $results;
    }

    /**
     * searchbroker
     *
     * Default action method
     * view search_by_zip
     * @param	empty
     * @return	*****
     */
    function searchbroker() {
        $data = array();
        $data["title"] = _e("Broker Serch");
        $CFG = $this->config->item('broker_configure');
        
        $postalcode = $this->input->get('postalcode');        
        $province_id = $this->input->get('province_id');
		$county_id = $this->input->get('county_id');
        $city = $this->input->get('city');
        
        $groupby = $CFG['ai_id'];
        $group_select[] = $CFG['groupby_select'];
		
        if ($postalcode)
            $where[] = array($CFG['possible_where']['zipcode'], $postalcode);

        
		if ($province_id) {            
			$data['p_name'] = $this->input->get('province');
			$where[] = array($CFG['possible_where']['province_id'], $province_id);            
        }
		
		if ($county_id) {   
			$data['p_name'] = $county_name;
            $where[] = array($CFG['possible_where']['county_id'], $county_id);            
        }
		
        if ($city) {
            $where[] = array($CFG['possible_where']['city'], $city);
            $data['p_name'] = $city;
        }        
        
        $results = $this->brokermod->getRecords($where, '', '', '', $groupby, $group_select);
        if (empty($results))
            $data["null"] = 'No results found that match your search criteria';
        $data["results"] = $results;
        $get_ip = getRealIpAddr();
        $take_dtls = ipDetails($get_ip);
        $lat_long = explode(",", $take_dtls->loc);
        $data["lat"] = $lat_long[0];
        $data["long"] = $lat_long[1];
        $data['postalcode'] = $postalcode;
        $data["content"] = $this->template->frontend_view("search_by_zip", $data, true, "broker");
        $this->template->build_frontend_output($data);
    }

    /**
     * brokerdetails
     *
     * Default action method
     * view broker_details page 
     * @param	empty
     * @return	*****
     */
    function brokerdetails() {
        $data = array();
        $data["title"] = _e("Broker Serch");
        $CFG = $this->config->item('broker_configure');
        $data['var'] = array('biz_domain_dd' => getBizDomainHelper(), 'biz_types_dd' => getBizTypeHelper(), 'country_dd' => getCountryHelper());

        $broker = $this->input->get('broker');
        $groupby = $CFG['ai_id'];
        $group_select[] = $CFG['groupby_select'];
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['edit_id'], $broker);
        $results = $this->brokermod->getRecords($where, '', '', '', $groupby, $group_select);
        $data['results'] = $results;

        $where_qry[] = array($CFG['possible_where']['status'], 2);
        $res = $this->brokermod->getRecords($where_qry, '', '', '', $groupby, $group_select);
        $allinfo["resultsdataslider"] = $res;

        $data["details_slider"] = $this->template->frontend_view("details_slider", $allinfo, true, "broker");
        $data["content"] = $this->template->frontend_view("broker_details", $data, true, "broker");
        $this->template->build_frontend_output($data);
    }

    /**
     * ajax
     *
     * Default action method
     * get profile information of broker
     * @case	profileinfo
     * @return	*****
     */
    function ajax() {
        $method = $this->input->post('method');
        switch ($method) {
            case "profileinfo" :
                $CFG = $this->config->item('broker_configure');
                $this->form_validation->set_rules($this->config->item('insert', 'broker_validation'));
                if ($this->form_validation->run($this, 'insert') == FALSE)
                    echo json_encode(array("event" => "error", "msg" => validation_errors()), JSON_HEX_QUOT | JSON_HEX_TAG);
                else {
                    $this->load->module('location/location');
                    $results = $this->location->getLocationId($this->input->post('country_id'), $this->input->post('province_id'), $this->input->post('county_id'), $this->input->post('city_id'), $this->input->post('zipcode'));
                    if ($results != 0) {
                        $post_var = $this->input->post();
                        unset($post_var['country_id']);
                        unset($post_var['province_id']);
                        unset($post_var['county_id']);
                        unset($post_var['city_id']);
                        unset($post_var['zipcode']);
						
						$login_info = isLoggedIn();
						$data['user_id'] = $login_info["user_id"];
						$profile = $this->getBrokerDetailsByid( $login_info["user_id"] );
						
						$loc_push = array('location_id' => $results);
                        $post_val = array_merge($loc_push, $post_var);
						
						if( !empty( $profile ) ){
							$post_val["row_id"] = $profile[0]->ai_broker_id;
							$this->brokermod->dbUpdate('update', '',$post_val);
							$rows_updated = true;
							$relation_id_for_image = $profile[0]->ai_broker_id;
						}else{                        
                        	$insertedrows = $this->brokermod->insertInto($post_val);
							$relation_id_for_image = lastInsertedId($CFG);
						}
                        $image_value = $this->upload->get_multi_upload_data();
						
						if( $image_value ){
							$create_post = array("context_id" => "2", "relation_id" => $relation_id_for_image);
							$this->load->module('image/image_admin');
							$img_insert = $this->image_admin->multipleDataInsert($create_post, $image_value);
						}

                        if ($insertedrows or $rows_updated)
                            echo json_encode(array("event" => "success", "msg" => _e('broker information added')));
                        else
                            echo json_encode(array("event" => "error", "msg" => _e('broker information add fail')));
                    }
                    else {
                        echo json_encode(array("event" => "error", "msg" => _e('broker information add fail')));
                    }
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
     * @param	string	may be add
     * @return	boolean	
     */
    function upload_validation($field, $action) {
        $config['upload_path'] = './themes/web/layout/assets/images/broker/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->upload->initialize($config);
        if (count($_FILES["images"]["error"]) > 1 || (count($_FILES["images"]["error"]) == 1 && $_FILES["images"]["error"][0] != 4)) {
            switch ($action) {
                case 'add' :
                    if (!$this->upload->do_multi_upload('images')) {
                        $this->form_validation->set_message('upload_validation', $this->upload->display_errors());
                        return false;
                    }
                    break;
            }
        }
    }

    function getRelation() {
        $array = array();
        ## Load config and store
        $CFG = $this->config->item('broker_configure');
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['is_trashed'], 0);
        $records = $this->brokermod->getRecords($where);
        foreach ($records as $record)
            $array[$record->ai_broker_id] = $record->user_name;
        return $array;
    }

    function json() {
        if (isAjax()) {
            ## Load config and store
            $CFG = $this->config->item('broker_configure');
            $method = $this->input->post('method');
            switch ($method) {
                case 'relation' :
                    $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['is_trashed'], 0);  // chk for broker image 
                    $broker_dtls = array();
                    $records = $this->brokermod->getRecords($where);
                    foreach ($records as $record)
                        $broker_dtls[$record->ai_broker_id] = $record->user_name;
                    echo json_encode($broker_dtls);
                    break;
            }
        }
    }

}

// END Broker Class

/* End of file broker.php */
/* Broker: ./application/modules/broker/controllers/broker.php */