<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Common Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @common		Common
 * @author		Webzstore Solutions
 */
class Common_admin extends MX_Controller {

    /**
     * Autoload variable
     */
    public $autoload = array(
		'language' => array(
            'common'
        ),
		'helpers' => array(
           	'cookie'
        )
    );

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->setClientLocation();
        $this->setSomeCommonVar();
    }

    /**
     * ajax
     *
     * This function called when insert and update query called
     *
     * @param	empty
     * @return	json	response messages
     */
    function ajax() {

        $method = $this->input->post('method');
        switch ($method) {
            case "setclientcountry" :
                $country_id = $this->input->post('country_id');
                set_cookie('custom_country_id', $country_id, $this->config->item('cookie_expire'));
                break;
        }
    }

    /**
     * setClientLocation
     *
     * This function set client location
     *
     * @param	empty
     * @return	void
     */
    function setClientLocation() {

        $get_ip = getRealIpAddr();
        $take_dtls = ipDetails($get_ip); //27.34.240.0 india //143.54.0.0 brazil //23.15.255.255 us //14.102.240.0 hong kong // my 122.163.60.229
        $custom_country_id = get_cookie('custom_country_id');
        $custom_province_id = get_cookie('custom_province_id');
        if (!( $custom_country_id )) {            
            $default_country_id = Modules::run('country/country_admin/getCountryIdByAbbr', $take_dtls->country);
            set_cookie('default_country_id', $default_country_id, $this->config->item('cookie_expire'));
            set_cookie('custom_country_id', $default_country_id, $this->config->item('cookie_expire'));
        }        
    }

    /**
     * setSomeCommonVar
     *
     * This function set some common variable
     *
     * @param	empty
     * @return	void
     */
    function setSomeCommonVar() {
        $client_country_ids = getClientCountryIds();
		// When loading first on the browser
		if( empty($client_country_ids[0]) && empty($client_country_ids[1]) ){
			$get_ip = getRealIpAddr();
        	$take_dtls = ipDetails($get_ip);
			$default_country_id = Modules::run('country/country_admin/getCountryIdByAbbr', $take_dtls->country);
			$client_country_ids = array( $default_country_id, $default_country_id );
		}
        $biz_domain = Modules::run('biz_type/biz_type_admin/getBizDomain');
        $biz_domain_dd = array('' => _e('choose_biz_domain')) + $biz_domain;
        
        $biz_types_dd = array('' => _e('choose_biz_type'));

        $countries = Modules::run('country/country_admin/getCountries');
        $countries_dd = array('' => _e('choose_country')) + $countries;
        
        $provinces = Modules::run('province/province_admin/getProvincesByCountryId', $client_country_ids[0] );
        $provinces_dd = array('' => _e('choose_province')) + $provinces;
        
        $counties_dd = array('' => _e('choose_county'));
		
		$cities_dd = array('' => _e('choose_city'));
		
		$zipcodes_dd = array('' => _e('choose_zip'));
        
        $var = array( 'default_country_id' => $client_country_ids[1],
            'client_country_id' => $client_country_ids[0],
            'biz_domain_dd' => $biz_domain_dd,
            'biz_types_dd' => $biz_types_dd,
            'country_dd' => $countries_dd,
            'provinces_dd' => $provinces_dd,
            'counties_dd' => $counties_dd,
            'cities_dd' => $cities_dd,
            'zipcodes_dd' => $zipcodes_dd
                );
        $this->config->set_item('var', $var);
    }

}

// END Common_admin Class

/* End of file common_admin.php */
/* Location: ./application/modules/common/controllers/common_admin.php */