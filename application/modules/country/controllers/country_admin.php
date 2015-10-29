<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Country Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Country
 * @author		Webzstore Solutions
 */
class Country_admin extends MX_Controller {

    /**
     * 	Autoload varible.
     * 	Loads other accessories required for this model.
     */
    public $autoload = array(
        'language' => array(
            'country'
        ),
        'config' => array(
            'country_configure',
            'country_validation',
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
        $this->load->model('country_model', 'country');
    }

    function getCountries() {
        $array = array();

        ## Load config and store
        $CFG = $this->config->item('country_configure');

        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['is_trashed'], 0);
        $records = $this->country->getRecords($where);
        foreach ($records as $record)
            $array[$record->ai_country_id] = $record->country;
        return $array;
    }

    /**
     * getCountriesNameById
     *
     * This function called for get Countries Name By Id
     *
     * @param	id
     * @return	country name	
     */
    function getCountriesNameById($id) {
        ## Load config and store
        $CFG = $this->config->item('country_configure');
        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['edit_id'], $id);
        $records = $this->country->getRecords($where);
        $country_name = $records[0]->country;
        return $country_name;
    }

    /**
     * get All Countries
     *
     * This function called for get All Countries
     *
     * @param	empty
     * @return	record
     */
    function getAllCountries() {
        $array = array();

        ## Load config and store
        $CFG = $this->config->item('country_configure');

        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['is_trashed'], 0);
        $records = $this->country->getRecords($where);
        return $records;
    }

    /**
     * getCountryIdByAbbr
     *
     * This function called for get Country Id By province Abbr
     *
     * @param	countryname
     * @return	country id	
     */
    function getCountryIdByAbbr($countryname) {
        $array = array();

        ## Load config and store
        $CFG = $this->config->item('country_configure');

        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['abbre'], $countryname);
        $records = $this->country->getRecords($where);
        $country_id = $records[0]->ai_country_id;
        return $country_id;
    }

}

// END Country Admin Class

/* End of file country_admin.php */
/* Country: ./application/modules/country/controllers/country_admin.php */