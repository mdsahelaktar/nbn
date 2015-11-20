<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Biz_listing Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Biz_listing
 * @author		Webzstore Solutions
 */
class Biz_listing extends MX_Controller {

    /**
     * Autoload variable
     */
    public $autoload = array(
        'language' => array(
            'biz_listing'
        ),
        'config' => array(
            'biz_listing_configure',
            'biz_listing_validation',
            'pagination'
        ),
        'libraries' => array(
            'form_validation',
            'pagination',
            'upload',
            'email'
        ),
        'helpers' => array(
            'form',
            'download'
        )
    );

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('biz_listing_model', 'bizlig');
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
        $data["title"] = _e("Biz Listing");
        ## Load config and store ##
        $CFG = $this->config->item('biz_listing_configure');

        if (isLoggedIn()) {
            $user = isLoggedIn();
            $user_id = $user['user_id'];
            $last_insert_id = lastInsertedIdByCurrentUserId($CFG, $user_id);
            if (empty($last_insert_id))
                $last_insert_id = 1;
            $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['edit_id'], $last_insert_id);
            $records = $this->bizlig->getRecords($where, '', '', '', '', '');
            if ($records[0]->status == '2') {
                $this->bizlig->insertInto(array('status' => 1, 'user_id' => $user_id));
            }
            redirect(base_url() . 'biz_listing/secondstep');
        }
        $data['var'] = array('biz_domain_dd' => getBizDomainHelper(), 'biz_types_dd' => getBizTypeHelper(), 'country_dd' => getCountryHelper());
        $data_top = $this->stepRelated('1 of 3', 'class1', '', '', 'style="display:none"', 'active');

        $data["top"] = $this->template->frontend_view("all_step_top", $data_top, true, "biz_listing");
        $data["footer"] = $this->template->frontend_view("all_step_footer", $data, true, "biz_listing");
        $data["login_html"] = Modules::run("login/login_admin/login_snippet");
		$data["register_link"] = "user?ct=2&rl=1";
        $data["content"] = $this->template->frontend_view("biz_listing", $data, true, "biz_listing");
        $this->template->build_frontend_output($data);
    }

    /**
     * secondstep
     *
     * for give information bizlisting
     *
     * @param	empty
     * @return	web html front
     */
    function secondstep() {
        $data["title"] = _e("Biz Listing");
        ## Load config and store ##
        $CFG = $this->config->item('biz_listing_configure');
        if (!isLoggedIn()) {
            redirect(base_url() . 'biz_listing');
        } else {
            $user = isLoggedIn();
            $user_id = $user['user_id'];
            $last_insert_id = lastInsertedIdByCurrentUserId($CFG, $user_id);
            if (empty($last_insert_id))
                $last_insert_id = 1;

            $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['edit_id'], $last_insert_id);
            $records = $this->bizlig->getRecords($where, '', '', '', '', '');

            if ($records[0]->status == '2' || $last_insert_id == 1)
                $this->bizlig->insertInto(array('status' => 1, 'user_id' => $user_id));
        }

        $data['var'] = array();
        ## Load country module ##
        $this->load->module('country/country_admin');
        $countries = $this->country_admin->getCountries();

        $user = isLoggedIn();
        $data["user_id"] = $user['user_id'];

        $this->load->module('biz_type/biz_type_admin');
        $biz_types = $this->biz_type_admin->getBizTypes();

        $this->load->module('county/county_admin');
        $all_county = $this->county_admin->getCounty();

        $this->load->module('province/province_admin');
        $all_province = $this->province_admin->getProvinces();

        ## Load biz_type module ##
        $data['var'] = array('biz_domain_dd' => getBizDomainHelper(), 'biz_types_dd' => getBizTypeHelper(), 'country_dd' => getCountryHelper(), 'countries_dd' => ( array('' => _e('Choose countries')) + $countries ), 'provinces_dd' => ( array('' => _e('Choose provinces')) + $all_province ), 'counties_dd' => ( array('' => _e('Choose counties')) + $all_county ), 'biz_types_dd_for_second' => ( array('' => _e('Choose biz type')) + $biz_types ));

        ## for input value ##
        $user = isLoggedIn();
        $user_id = $user['user_id'];
        $this->load->module('user/user_admin');
        $user_name = $this->user_admin->getUsernameByid($user_id);
        $data["name"] = $user_name;
        $last_insert_id = lastInsertedIdByCurrentUserId($CFG, $user_id);

        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['status'], '1');
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['user_id'], $user_id);
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['edit_id'], $last_insert_id);

        $results = $this->bizlig->getRecords($where, 'desc', '', 1);
        $data["results"] = $results;
        $data["row_id"] = $last_insert_id;
        $data_top = $this->stepRelated('2 of 3', 'class2', 'biz_listing_add_second', 'pri1', '', 'active');
        ## for input value ##

        $data["top"] = $this->template->frontend_view("all_step_top", $data_top, true, "biz_listing");
        $data["sidebar"] = $this->template->frontend_view("all_step_sidebar", $data, true, "biz_listing");
        $data["footer"] = $this->template->frontend_view("all_step_footer", $data, true, "biz_listing");
        $data["content"] = $this->template->frontend_view("secondstep", $data, true, "biz_listing");
        $this->template->build_frontend_output($data);
    }

    /**
     * thirdstep
     * for give information bizlisting
     *
     * @param	empty
     * @return	web html front
     */
    function thirdstep() {
        $data["title"] = _e("Biz Listing");
        ## Load config and store ##
        if (!isLoggedIn()) {
            redirect(base_url() . 'biz_listing');
        }
        $CFG = $this->config->item('biz_listing_configure');
        $user = isLoggedIn();
        $last_insert_id = lastInsertedIdByCurrentUserId($CFG, $user['user_id']);
        $data["user_id"] = $user['user_id'];
        $data["results"] = $last_insert_id;
        $data_top = $this->stepRelated('3 of 3', 'class3', 'biz_listing_add2', 'pri1', '', 'active');
        $data['var'] = array('biz_domain_dd' => getBizDomainHelper(), 'biz_types_dd' => getBizTypeHelper(), 'country_dd' => getCountryHelper());
        $data["top"] = $this->template->frontend_view("all_step_top", $data_top, true, "biz_listing");
        $data["sidebar"] = $this->template->frontend_view("all_step_sidebar", $data, true, "biz_listing");
        $data["footer"] = $this->template->frontend_view("all_step_footer", $data, true, "biz_listing");
        $data["content"] = $this->template->frontend_view("thirdstep", $data, true, "biz_listing");
        $this->template->build_frontend_output($data);
    }

    /**
     * stepRelated
     *
     * This function called when step page text or style change like step 1 of 3 class active
     *
     * @param	$step for identify the actualy step like 1 of 3
     * @param	$class for class like class1
     * @param	$idnamecon countune button id
     * @param	$idnamepri preview button id
     * @param	$style like display none
     * @param	$active for active class
     * @return	array response $data
     */
    function stepRelated($step = '', $class = '', $idnamecon = '', $idnamepri = '', $style = '', $active = '') {
        $data['step'] = $step;
        $data[$class] = $active;
        $data['idnamecon'] = $idnamecon;
        $data['idnamepri'] = $idnamepri;
        $data['style'] = $style;
        return $data;
    }

    /**
     * ajax
     * case use secondstepdata for add & update
     * case use therdstepdata for update
     * case use innersearch for inner search result 
     * This function called when insert and update query called
     *
     * @param	empty
     * @return	json	response messages
     */
    function ajax() {
        $method = $this->input->post('method');
        switch ($method) {
            case "secondstepdata" :
                $CFG = $this->config->item('biz_listing_configure');
                $this->form_validation->set_rules($this->config->item('insert', 'biz_listing_validation'));
                if ($this->form_validation->run($this, 'update') == FALSE)
                    echo json_encode(array("event" => "error", "msg" => _e('biz listing update fail')));
                else {
                    $row_id = $this->input->post('row_id');
                    $updaterows = doAction('bizlig', 'update', $row_id, false, $this->input->post());
                    if ($updaterows == true)
                        echo json_encode(array("event" => "success", "chk" => $this->input->post('saveandcontlet'), "msg" => _e('Your information is saved')));
                    else
                        echo json_encode(array("event" => "error", "msg" => _e('biz listing update fail')));
                }
                break;

            case "therdstepdata" :
                $row_id = $this->input->post('row_id');
                $updaterows = doAction('bizlig', 'update', $row_id, false, $this->input->post());
                if ($updaterows == true)
                    echo json_encode(array("event" => "success", "msg" => _e('Your information is saved')));
                else
                    echo json_encode(array("event" => "error", "msg" => _e('biz listing update fail')));
                break;

            case "innersearch" :
                $CFG = $this->config->item('biz_listing_configure');
                $POST = $this->input->post();
				if( ! $POST["province_id"] )
					unset($POST["province_id"]);
				if( ! $POST["biz_type_id"] )
					unset($POST["biz_type_id"]);
                $where = createWhereArray($POST, $CFG);

                $asking_price_min = $POST['asking_price_min'];
                $asking_price_max = $POST['asking_price_max'];
                if (!empty($asking_price_min))
                    $where[] = array($CFG['table_name'] . '.' . $CFG['asking_price'] . " >=", $asking_price_min);
                if (!empty($asking_price_max))
                    $where[] = array($CFG['table_name'] . '.' . $CFG['asking_price'] . " <=", $asking_price_max);

                $gross_rev_price_min = $POST['grl'];
                $gross_rev_price_max = $POST['grh'];
                if (!empty($gross_rev_price_min))
                    $where[] = array($CFG['table_name'] . '.' . $CFG['gr'] . " >=", $gross_rev_price_min);
                if (!empty($gross_rev_price_max))
                    $where[] = array($CFG['table_name'] . '.' . $CFG['gr'] . " <=", $gross_rev_price_max);

                $cassflow_price_min = $POST['cfl'];
                $cassflow_price_max = $POST['cfh'];
                if (!empty($cassflow_price_min))
                    $where[] = array($CFG['table_name'] . '.' . $CFG['cf'] . " >=", $cassflow_price_min);
                if (!empty($cassflow_price_max))
                    $where[] = array($CFG['table_name'] . '.' . $CFG['cf'] . " <=", $cassflow_price_max);

                $show_biz_list_bydate = $POST['show_biz_list_bydate'];
                if (!empty($show_biz_list_bydate)) {
                    $today = date("Y-m-d H:i:s");
                    $newdate = date('Y-m-d H:i:s', strtotime("-$show_biz_list_bydate days"));
                    $where[] = array($CFG['table_name'] . '.' . $CFG['creation_time'] . " <=", $today);
                    $where[] = array($CFG['table_name'] . '.' . $CFG['creation_time'] . " >=", $newdate);
                }
                $cklsearch = $POST['cklsearch'];
                if ( !empty($cklsearch) ){
					if( is_numeric( $cklsearch ) )
						$where[] = array($CFG['ai_id'], $cklsearch);
					else
						$where[] = array("(" . $CFG['keywords'] . " like '%$cklsearch%' or " . $CFG['main_col'] . " like '%$cklsearch%' or " . $CFG['city'] . " like '%$cklsearch%')");
				}

                $order_by = createOrderByArray($POST, $CFG);
                $search_by = createSearchByArray($POST, $CFG);
                $data = array();
                ## limit create ##	
                $limit[1] = $this->config->item('default_per_page', 'pagination');
                $page_no = $POST['page'];
                $page_no = !$page_no ? 1 : $page_no;
                $limit[0] = ($page_no * $limit[1]) - $limit[1];

                $groupby = $CFG['ai_id'];
                $group_select[] = $CFG['groupby_select'];
                ## limit create ##	
                $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['status'], 2);

                $records = $this->bizlig->getRecordsNPagination($where, $order_by, $search_by, $limit, $groupby, $group_select);

                ## this section use for insert popular list ##
                if ($this->input->post('biz_type_id') || $this->input->post('province_id') || !empty($cklsearch) || $this->input->post('county_id')) {
                    if (!empty($records['records'])) {
                        $this->load->module('popular/popular');
                        if ($this->input->post('biz_type_id'))
                            $this->popular->insertPopularItem(1, 'biz_type_id', $this->input->post('biz_type_id'));

                        if ($this->input->post('province_id'))
                            $this->popular->insertPopularItem(1, 'province_id', $this->input->post('province_id'));

                        if (!empty($cklsearch)) {
                            $con[] = array($CFG['possible_where']['city'], $cklsearch);
                            $res = $this->bizlig->getRecords($con);
                            if (!empty($res))
                                $this->popular->insertPopularItem(1, 'city', $res[0]->city);
                        }

                        if ($this->input->post('county_id'))
                            $this->popular->insertPopularItem(1, 'county_id', $this->input->post('county_id'));
                    }
                }
                ## this section use for insert popular lite ##
                $info['data'] = $records;

                $count_row = $this->bizlig->getNumRecordsPagination($where, '');
                if ($count_row > 1)
                    $esstr = _e('Businesses');
                else
                    $esstr = _e('Business');

                if (!empty($POST['country_id'])) {
                    $this->load->module('country/country_admin');
                    $loc_name = $this->country_admin->getCountriesNameById($POST['country_id']);
                }

                if (!empty($POST['province_id']) && empty($POST['county_id'])) {
                    $this->load->module('province/province_admin');
                    $loc_name = $this->province_admin->getProvinceNameById($POST['province_id']);
                }

                if (!empty($POST['province_id']) && !empty($POST['county_id'])) {
                    $this->load->module('county/county_admin');
                    $loc_name = $this->county_admin->getCountyNameById($POST['county_id']);
                }

                if (!empty($POST['county_id'])) {
                    $this->load->module('county/county_admin');
                    $loc_name = $this->county_admin->getCountyNameById($POST['county_id']);
                }

                if (!empty($POST['biz_type_id'])) {
                    $this->load->module('biz_type/biz_type_admin');
                    $loc_name = $this->biz_type_admin->getBizTypeByTypeId($POST['biz_type_id']);
                }

                if (!empty($POST['biz_type_id']) && !empty($POST['country_id'])) {
                    $this->load->module('biz_type/biz_type_admin');
                    $type_name = $this->biz_type_admin->getBizTypeByTypeId($POST['biz_type_id']);

                    $this->load->module('country/country_admin');
                    $country_name = $this->country_admin->getCountriesNameById($POST['country_id']);
                    $loc_name = $country_name . ' ' . $type_name;
                }

                if (!empty($POST['city']))
                    $loc_name = ucfirst($POST['city']);

                $count_row_string = "Browse $count_row $loc_name $esstr For Sale";
                $count_norow = "Browse 0 $loc_name Business For Sale";
                $string = "Need Biz Now has more $loc_name Businesses for sale listings than any other source. Whether you are looking to buy a $loc_name Businesses for sale or sell your $loc_name Businesses, Need Biz Now is the Internet's leading $loc_name Businesses for sale marketplace. Refine your search by location, industry or asking price using the filters below. ";
                $bizforsale = "$loc_name Businesses for Sale";

                $information = $this->template->frontend_view("search_data", $info, true, "biz_listing");
                if (!empty($info['data']['records']))
                    echo json_encode(array('event' => "success", 'html' => $information, 'total' => $count_row_string, 'string' => $string, 'bizforsale' => $bizforsale));
                else {                    
                    $include = renderResposeMessage('message', array('msg' => _e('Sorry, no business for sale listings were found matching your search criteria')));
                    echo json_encode(array('event' => "error", 'html' => $include, 'total' => $count_norow, 'string' => $string, 'bizforsale' => $bizforsale));
                }
                break;

            case "updatepopup" :
                $CFG = $this->config->item('biz_listing_configure');
                $row_id = $this->input->post('row_id');
                $post_val = $this->input->post();
                if (!$this->input->post('is_inv_included')) {
                    $is_inv_included = array('is_inv_included' => '');
                    $post_val = array_merge($is_inv_included, $post_val);
                }
                if (!$this->input->post('is_ffe_included')) {
                    $is_ffe_included = array('is_ffe_included' => '');
                    $post_val = array_merge($is_ffe_included, $post_val);
                }
                if (!$this->input->post('is_rs_included')) {
                    $is_rs_included = array('is_rs_included' => '');
                    $post_val = array_merge($is_rs_included, $post_val);
                }
                unset($post_val['status']);
                $updaterows = doAction('bizlig', 'update', $row_id, false, $post_val);
                if ($updaterows == true)
                    echo json_encode(array("event" => "success", "msg" => _e('Your information is saved')));
                else
                    echo json_encode(array("event" => "error", "msg" => _e('biz listing update fail')));
                break;

            case "detailsmail" :
                $post_data = $this->input->post();
                $user_id = $this->input->post('user_id');
                $this->load->module('user/user_admin');
                $user_dtls = $this->user_admin->getUsernameByid($user_id);

                $user_mail = $user_dtls[0]->email;
                $first_name = $user_dtls[0]->first_name;
                $middle_name = $user_dtls[0]->middle_name;
                $last_name = $user_dtls[0]->last_name;
                $name = $first_name . ' ' . $middle_name . ' ' . $last_name;

                $post_name = $this->input->post('name');
                $post_email = $this->input->post('email');
                $post_phone = $this->input->post('phone');
                $post_message = $this->input->post('message');
                $newsletter = $this->input->post('newsletter');
                $learnchk = $this->input->post('learnchk');
                if (empty($post_name) && empty($post_email) && empty($post_phone) && empty($post_message)) {
                    echo json_encode(array("event" => "error", "msg" => _e('You must fill in all of the fields.')));
                    break;
                } else {
                    ################## eNeedBizNow Contact Business Seller ##########################################
                    $this->load->library('email');                    
                    $this->email->initialize( array("mailtype" => "html") );
                    $to_email = $user_mail;
                    $name1 = 'NeedBizNow';
                    $email1 = 'noreply@needbiznow.com';
                    $this->email->from($email1, $name1);
                    $this->email->to($to_email);
                    $this->email->subject('NeedBizNow Contact Business Seller');
                    $mail_data['contactname'] = $post_name;
                    $mail_data['email'] = $post_email;
                    $mail_data['phone'] = $post_phone;
                    $mail_data['message'] = $post_message;
                    $mail_data['drname'] = $name;
                    $mail_data['newsletter'] = $newsletter;
                    $mail_data['learnchk'] = $learnchk;
                    $msg = $this->template->frontend_view("contact_seller_mail", $mail_data, true, "emailtemplate");
                    $this->email->message($msg);
                    $send_chk = $this->email->send();
                    ################## NeedBizNow Contact Business Seller ##########################################
                    if ($send_chk == true)
                        echo json_encode(array("event" => "success", "msg" => _e('message sent')));
                    else
                        echo json_encode(array("event" => "error", "msg" => _e('message not sent')));
                }
                break;
        }
    }

    /**
     * search
     * search frontend droupdown query result
     *
     * @param	empty
     * @return web html
     */
    function search() {
        $CFG = $this->config->item('biz_listing_configure');
		
        $data = array();
		$data = array_merge( $data, $this->input->get() );
		
		$data['var'] = array();
		
		if( $data["country_id"] ){
			$this->load->module('province/province_admin');
			$get_provinces = $this->province_admin->getProvincesByCountryId( $data["country_id"] );			
			$data['var']['provinces_dd'] = array("0" => _e("Choose province") ) + $get_provinces;			
		}
		
		if( $data["province_id"] ){
			$this->load->module('province/province_admin');
			$data["country_id"] = $this->province_admin->getCountryIdByProvinceId( $data["province_id"] );
			$get_provinces = $this->province_admin->getProvincesByCountryId( $data["country_id"] );			
			$data['var']['provinces_dd'] = array("0" => _e("Choose province") ) + $get_provinces;			
		}
		
		if( $data["county_id"] ){
			$this->load->module('county/county_admin');
			$data["province_id"] = $this->county_admin->getProvinceIdByCountyId( $data["county_id"] );
			$get_counties = $this->county_admin->getCountiesByProvinceId( $data["province_id"] );				
			$data['var']['counties_dd'] = array("0" => _e("Choose county")) + $get_counties;						
			
			$this->load->module('province/province_admin');
			$data["country_id"] = $this->province_admin->getCountryIdByProvinceId( $data["province_id"] );
			$get_provinces = $this->province_admin->getProvincesByCountryId( $data["country_id"] );			
			$data['var']['provinces_dd'] = array("0" => _e("Choose province") ) + $get_provinces;			
		}
		
		if( $data['biz_domain_id'] ){
			$this->load->module('biz_type/biz_type_admin');
			$get_biz_types = $this->biz_type_admin->getBizTypesByDomain( $data['biz_domain_id'] );
			$data['var']['biz_types_dd'] = array("0" => _e("Choose biz type") ) + $get_biz_types;			
		}
		
		if( $data['biz_type_id'] ){
			$this->load->module('biz_type/biz_type_admin');
			$data['biz_domain_id'] = $this->biz_type_admin->getBizDomainByTypeId( $data['biz_type_id'] ); 
			
			$get_biz_types = $this->biz_type_admin->getBizTypesByDomain( $data['biz_domain_id'] );
			$data['var']['biz_types_dd'] = array("0" => _e("Choose biz type") ) + $get_biz_types;
		}
		
		$this->load->module('biz_listing/biz_listing_admin');		
		$data['var']['askingprice_dd_min'] = array("0" => _e("Choose min asking price")) + $this->biz_listing_admin->getAskingPrice() ;
		$data['var']['askingprice_dd_max'] = array("0" => _e("Choose max asking price")) + $this->biz_listing_admin->getAskingPriceMax() ;				
        $data["title"] = _e("Search Result");
		
		//$data['cklsearch'] = $this->input->post('cklsearch') ? $this->input->post('cklsearch') : $this->input->get('city');        
		

        $this->load->module('popular/popular');
        $data['get_popular_search_sidebar'] = $this->popular->getPopularSearchSidebar('1', 'ai_bizlisting_id', 'Most Popular Searches on Need Biz Now');
        $data['get_popular_county_search_sidebar'] = $this->popular->getPopularSearchSidebar('1', 'county_id', 'Most Popular Searches on Need Biz Now by County');

        $data["content"] = $this->template->frontend_view("searchresult", $data, true, "biz_listing");
        $this->template->build_frontend_output($data);
    }

    /**
     * details
     * for search result details show
     *
     * @param	empty
     * @return	web html
     */
    function details() {
        $data["title"] = _e("Biz Details");
        $CFG = $this->config->item('biz_listing_configure');
        $dtls = $this->input->get('dtls');
        $groupby = $CFG['ai_id'];
        $group_select[] = $CFG['groupby_select'];
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['edit_id'], $dtls);
        $results = $this->bizlig->getRecords($where, '', '', '', $groupby, $group_select);
        $this->load->module('user_map/user_map_admin');
        $cat = $this->user_map_admin->chkUserBrokerOrNot($results[0]->user_id);
        if ($cat == 32) {
            $this->load->module('user/user_admin');
            $broker_name = $this->user_admin->getUsernameByid($results[0]->user_id);
            $broker_fullname = $broker_name[0]->first_name . ' ' . $broker_name[0]->middle_name . ' ' . $broker_name[0]->last_name;
            $info['broker_fullname'] = $broker_fullname;
            $this->load->module('broker/broker');
            $broker_images = $this->broker->getBrokerDetailsByid($results[0]->user_id);
            $info['broker_cimage'] = $broker_images;
        }

        ## this section use for insert popular item ##
        if (!empty($results)) {
            $this->load->module('popular/popular');
            $this->popular->insertPopularItem(1, 'ai_bizlisting_id', $dtls);
        }
        $where_qry[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['biz_type_id'], $results[0]->biz_type_id);
        $where_qry[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['edit_id'] . " !=", $dtls);
        $type_related = $this->bizlig->getRecords($where_qry, '', '', '', $groupby, $group_select);
        $info['data'] = $type_related;
        $data['details_slider'] = $this->template->frontend_view("details_slider", $info, true, "biz_listing");

        ## this section for insert popular item ##
        $data['var'] = array('biz_domain_dd' => getBizDomainHelper(), 'biz_types_dd' => getBizTypeHelper(), 'country_dd' => getCountryHelper());
        $data["results"] = $results;
        $this->load->module('popular/popular');
        $data['get_popular_search_sidebar'] = $this->popular->getPopularSearchSidebar('1', 'ai_bizlisting_id', 'Most Popular Searches on Need Biz Now');
        $data['get_popular_county_search_sidebar'] = $this->popular->getPopularSearchSidebar('1', 'county_id', 'Most Popular Searches on Need Biz Now by County');
        $data['biz_hit_count'] = $this->popular->bizHitCount($dtls);
        $data["head"] = $this->template->frontend_view("details", '', true, "biz_listing");
        $data["foot"] = $this->template->frontend_view("full_details", $data, true, "biz_listing");
        $data["content"] = $this->template->frontend_view("popup", $data, true, "biz_listing");
        $this->template->build_frontend_output($data);
    }

    function brokerlisting() {
        $data = array();
        $data["title"] = _e("Broker Listings");
        $CFG = $this->config->item('biz_listing_configure');
        $data['var'] = array('biz_domain_dd' => getBizDomainHelper(), 'biz_types_dd' => getBizTypeHelper(), 'country_dd' => getCountryHelper());

        $uid = $this->input->get('uid');
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['user_id'], $uid);
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['status'], 2);
        $groupby = $CFG['ai_id'];
        $group_select[] = $CFG['groupby_select'];
        $results = $this->bizlig->getRecords($where, '', '', '', $groupby, $group_select);
        $data['listdtls'] = $results;

        $this->load->module('broker/broker');
        $broker_details = $this->broker->getBrokerDetailsByid($uid);
        $data['broker_details'] = $broker_details;

        $this->load->module('user/user_admin');
        $user_name = $this->user_admin->getUsernameByid($uid);
        $data['user_name'] = $user_name;

        $data["content"] = $this->template->frontend_view("broker_listing_and_profile", $data, true, "biz_listing");
        $this->template->build_frontend_output($data);
    }

    /**
     * download
     * for image download in details page
     *
     * @param	empty
     * @return	empty
     */
    function download() {
        $down_img = $this->input->get('file');
        $file_name = 'needbiznow-seller.jpg';
        $file_path = $this->template->get_frontend_image($down_img, true);
        $mime = 'application/force-download';
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private', false);
        header('Content-Type: ' . $mime);
        header('Content-Disposition: attachment; filename="' . $file_name . '"');
        header('Content-Transfer-Encoding: binary');
        header('Connection: close');
        readfile($file_path); // relative path to file   
        exit();
    }

    /**
     * popup
     * for open preview popup 2nd and 3rd step
     *
     * @param	empty
     * @return	web html
     */
    function popup() {
        $data["title"] = _e("Preview");
        $CFG = $this->config->item('biz_listing_configure');
        $user = isLoggedIn();
        $user_id = $user['user_id'];
        $this->load->module('user/user_admin');
        $user_name = $this->user_admin->getUsernameByid($user_id);
        $data["name"] = $user_name;
        $last_insert_id = lastInsertedIdByCurrentUserId($CFG, $user_id);

        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['edit_id'], $last_insert_id);
        $records = $this->bizlig->getRecords($where, '', '', '', '', '');
        $last_status = $records[0]->status;
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['status'], $last_status);
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['user_id'], $user_id);
        $results = $this->bizlig->getRecords($where, '', '', '', '', '');
        $data["results"] = $results;
        $data["reload"] = '<body onLoad="if (location.href.indexOf(\'reload\')==-1) location.replace(location.href+\'?reload\');">';
        $data["body_end"] = '</body>';
        $data["content"] = $this->template->frontend_view("popup", $data, true, "biz_listing");
        $this->template->set_frontend_layout("popup");
        $this->template->build_frontend_output($data);
    }

    /**
     * commingsoon
     * for comming soon page
     *
     * @param	empty
     * @return	page comesoon
     */
    function commingsoon() {
        $data["title"] = _e("Comming Soon");
        $data['var'] = array('biz_domain_dd' => getBizDomainHelper(), 'biz_types_dd' => getBizTypeHelper(), 'country_dd' => getCountryHelper());
        $data["content"] = $this->template->frontend_view("comesoon", $data, true, "home");
        $this->template->build_frontend_output($data);
    }   

}

// END  bizlisting Class
/* End of file biz_listing.php */
/* Location: ./application/modules/biz_listing/controllers/biz_listing.php */