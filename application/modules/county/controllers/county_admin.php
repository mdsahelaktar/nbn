<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * County Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	County
 * @author		Webzstore Solutions
 */
class County_admin extends MX_Controller
{
	/**
	 *	Autoload varible.
	 *	Loads other accessories required for this model.
	 */	
	public $autoload = array(
        		'language'   => array(
								'county'
								),
        		'config'     => array(
								'county_configure',
								'county_validation',
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
		$this->load->model('county_model', 'county');	
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
	 
	function json()
	{
		if( isAjax() )
		{
			## Load config and store
			$CFG = $this->config->item('county_configure');
			
			$method = $this->input->post('method');
			switch( $method )
			{
				case	'getcounties'	:
						$where = createWhereArray($this->input->post(), $CFG);
						$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['is_trashed'], 0);
						$counties = array();
						$records = $this->county->getRecords($where);
						foreach($records as $record)
							$counties[$record->ai_county_id] = $record->county;
						echo json_encode($counties);
						break;
				case	'getAllCountyForBroker'	:
						$where = createWhereArray($this->input->post(), $CFG);
						$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['is_trashed'], 0);
						$counties = array();
						$records = $this->county->getRecords($where);
						foreach($records as $record)
							$counties[$record->ai_county_id] = $record->county;
						echo json_encode($counties);
						break;		
						
			}
		}
	}	
	
	/**
	 * getCountyNameById
	 *
	 * This function for get County Name By Id
	 *
	 * @param	id
	 * @return	county name
	 */
	 
	function getCountyNameById($id)
	{
		## Load config and store
		$CFG = $this->config->item('county_configure');
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['edit_id'], $id);
		$records = $this->county->getRecords($where);
			$county_name = $records[0]->county;
		return $county_name;
	}	
	
	/**
	 * getCountgetCountiesByProvinceIdyNameById
	 *
	 * This function for get County By Provinces Id
	 *
	 * @param	id
	 * @return	array
	 */
	 
	function getCountiesByProvinceId($id)
	{
		## Load config and store
		$CFG = $this->config->item('county_configure');
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['province'], $id);
		$records = $this->county->getRecords($where);
		foreach($records as $record)
		{
			$array[$record->ai_county_id] = $record->county;
		}	
		return $array;
	}

	/**
	 * getcountysuggt
	 *
	 * This function for get county suggt for autocomplete
	 *
	 * @param	empty
	 * @return	country
	 */
	 
	function getcountysuggt()
	{
		$array = array();
		## Load config and store
		$CFG = $this->config->item('county_configure');
		$VAR = $this->config->item('var');		
		$qry = $_GET['term'];
		
		$if_not_country = $_GET['not_check_country'];
		$country_id = placeCountryId( 0, $VAR['client_country_id'], $VAR['default_country_id'] );
		if( !$if_not_country )
			$where[] = array($CFG['country_id'], $country_id);
		
		$this->load->module('province/province_admin');
		$all_province = $this->province_admin->getProvinces();
		
		$where[] = array("(".$CFG['main_col']." like '$qry%')");
		$records = $this->county->getRecords($where);
		foreach($records as $record)
		{
			$array[] = array( "label" => $record->county.' '.'('.$all_province[$record->province_id].')', "value" => $record->ai_county_id );
		}
		$county = json_encode($array);
		echo $county;
	}
	
	/**
	 * getCounty
	 *
	 * This function for get county id & name
	 *
	 * @param	empty
	 * @return	array
	 */
	 
	function getCounty()
	{
		$array = array();
		## Load config and store
		$CFG = $this->config->item('county_configure');
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['is_trashed'], 0);
		$records = $this->county->getRecords($where);
		foreach($records as $record)
		{
			$array[$record->ai_county_id] = $record->county;
		}	
		return $array;
	}
	
	/**
	 * getCountyByCountry
	 *
	 * This function for get County By Country
	 *
	 * @param	country
	 * @return	array
	 */
	 
	function getCountyByCountry($country)
	{
		$array = array();
		## Load config and store
		$CFG = $this->config->item('county_configure');
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['is_trashed'], 0);
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['country_id'], $country);
		$records = $this->county->getRecords($where);
		foreach($records as $record)
		{
			$array[$record->ai_county_id] = $record->county;
		}	
		return $array;
	}
	
	/**
	 * getProvinceIdByCountyId
	 *
	 * This function for get Provinces Id By County id
	 *
	 * @param	id
	 * @return	province id
	 */
	 
	function getProvinceIdByCountyId($id)
	{
		## Load config and store
		$CFG = $this->config->item('county_configure');
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['edit_id'], $id);
		$records = $this->county->getRecords($where);
		$province_id = $records[0]->province_id;
		return $province_id;
	}
	
	/**
	 * getIdByCountyName
	 *
	 * This function for get Id By County Name
	 *
	 * @param	county name
	 * @return	country name
	 */
	 
	function getIdByCountyName($county_name)
	{
		## Load config and store
		$CFG = $this->config->item('county_configure');
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['county'], $county_name);
		$records = $this->county->getRecords($where);
			$county_name = $records[0]->ai_county_id;
		return $county_name;
	}	
	
	/**
	 * getIdByCountyNameandprovince
	 *
	 * This function for get Id By County Name and province
	 *
	 * @param	county name and province name
	 * @return	country name
	 */
	 
	function getIdByCountyNameandprovince($county_name,$pro_name)
	{
		## Load config and store
		$this->load->module('province/province_admin');	
		$pro_id = $this->province_admin->getProvincesIdByName($pro_name);
		$CFG = $this->config->item('county_configure');
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['county'], $county_name);
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['province'], $pro_id);
		$records = $this->county->getRecords($where);
			$county_name = $records[0]->ai_county_id;
		return $county_name;
	}	
}
// END County Admin Class

/* End of file county_admin.php */
/* County: ./application/modules/county/controllers/county_admin.php */