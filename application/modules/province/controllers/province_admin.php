<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Province Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Province
 * @author		Webzstore Solutions
 */
class Province_admin extends MX_Controller {

    /**
     * 	Autoload varible.
     * 	Loads other accessories required for this model.
     */
    public $autoload = array(
        'language' => array(
            'province'
        ),
        'config' => array(
            'province_configure',
            'province_validation',
            'pagination'
        ),
        'libraries' => array(
            'form_validation',
            'pagination'
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
        $this->load->model('province_model', 'province');
		$this->load->module('common/common_admin');
    }

    /**
     * json
     *
     * This function called during ajax only
     *
     * @param	empty
     * @return	json	records
     */
    function json() {
        if (isAjax()) {
            ## Load config and store
            $CFG = $this->config->item('province_configure');

            $method = $this->input->post('method');
            switch ($method) {
                case 'getprovinces' :
                case 'getprovincesforhome' :
                case 'getAllProvincesForBroker' :
                    if ($this->input->post("country") != 1)
                        echo json_encode(array());
                    else {
                        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['is_trashed'], 0);
                        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['country_id'], $this->input->post("country"));
                        $provinces = array();
                        $records = $this->province->getRecords($where);
                        foreach ($records as $record)
                            $provinces[$record->ai_province_id] = $record->province;
                        echo json_encode($provinces);
                    }
                    break;
            }
        }
    }

    /**
     * getProvinces
     *
     * get all id & name Provinces list
     *
     * @param	empty
     * @return	array id and name
     */
    function getProvinces() {
        $array = array();
        ## Load config and store
        $CFG = $this->config->item('province_configure');

        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['is_trashed'], 0);
        $records = $this->province->getRecords($where);
        foreach ($records as $record)
            $array[$record->ai_province_id] = $record->province;
        return $array;
    }

    /**
     * getprovincesuggt
     *
     * get Provinces for autocomplite
     *
     * @param	empty
     * @return	province
     */
    function getprovincesuggt() {
        $array = array();
        ## Load config and store
        $CFG = $this->config->item('province_configure');
		$VAR = $this->config->item('var');		
        $qry = $_GET['term'];
        $where[] = array("(" . $CFG['province'] . " like '$qry%')");
		
		$if_not_country = $_GET['not_check_country'];
		$country_id = placeCountryId( 0, $VAR['client_country_id'], $VAR['default_country_id'] );
		if( !$if_not_country )
			$where[] = array($CFG['country_id'], $country_id);
		
        $records = $this->province->getRecords($where);
        foreach ($records as $record)
            $array[$record->ai_province_id] = $record->province;
        $province = json_encode($array);
        echo $province;
    }

    /**
     * getProvinceNameById
     *
     * get Provinces by id
     *
     * @param	id
     * @return	province
     */
    function getProvinceNameById($id) {
        ## Load config and store
        $CFG = $this->config->item('province_configure');
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['edit_id'], $id);
        $records = $this->province->getRecords($where);
        $province_name = $records[0]->province;
        return $province_name;
    }

    /**
     * getAllProvinces
     *
     * get all Provinces list
     *
     * @param	empty
     * @return	record 
     */
    function getAllProvinces() {
        $array = array();

        ## Load config and store
        $CFG = $this->config->item('province_configure');

        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['is_trashed'], 0);
        $records = $this->province->getRecords($where);
        return $records;
    }

    /**
     * getAllProvincesForBroker
     *
     * get all Provinces for broker
     *
     * @param	empty
     * @return	province 
     */
    function getAllProvincesForBroker() {
        $array = array();

        ## Load config and store
        $CFG = $this->config->item('province_configure');

        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['is_trashed'], 0);
        $records = $this->province->getRecords($where);
        foreach ($records as $record) {
            $array[] = array("label" => $record->province, "value" => $record->ai_province_id);
        }
        $province = json_encode($array);
        echo $province;
    }

    /**
     * getProvincesByCountryId
     *
     * get all Provinces by country id
     *
     * @param	country_id
     * @return	array 
     */
    function getProvincesByCountryId($country_id) {
        ## Load config and store
        $array = array();
        $CFG = $this->config->item('province_configure');
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['country_id'], $country_id);
        $records = $this->province->getRecords($where);
        foreach ($records as $record)
            $array[$record->ai_province_id] = $record->province;
        return $array;
    }

    /**
     * getProvincesIdByName
     *
     * get all Provinces id by name
     *
     * @param	name
     * @return	province id 
     */
    function getProvincesIdByName($name) {
        ## Load config and store
        $CFG = $this->config->item('province_configure');
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['province'], $name);
        $records = $this->province->getRecords($where);
        $province_id = $records[0]->ai_province_id;
        return $province_id;
    }

    /**
     * getCountryIdByProvinceId
     *
     * get all Countries id by province id
     *
     * @param	province id
     * @return	country id 
     */
    function getCountryIdByProvinceId($province_id) {
        ## Load config and store
        $CFG = $this->config->item('province_configure');
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['edit_id'], $province_id);
        $records = $this->province->getRecords($where);
        $country_id = $records[0]->country_id;
        return $country_id;
    }

}

// END Province Admin Class

/* End of file province_admin.php */
/* Province: ./application/modules/province/controllers/province_admin.php */