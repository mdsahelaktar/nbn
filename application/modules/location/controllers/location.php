<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Location Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Location
 * @author		Webzstore Solutions
 */
class Location extends MX_Controller
{
	/**
	 *	Autoload varible.
	 *	Loads other accessories required for this model.
	 */	
	public $autoload = array(
        		'config'     => array(
								'location_configure'
								),
				'libraries'  => array(
								'form_validation',
								'upload'
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
		$this->load->model('location_model', 'locationmod');		
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
	function index()
	{
		
	}
	function getAllZip()
	{
		$array = array();
		$CFG = $this->config->item('location_configure');
		//$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['is_trashed'], 0);
		$records = $this->locationmod->getRecords();
		return $records;
	}
	
	function getAllCity()
	{
		$array = array();
		$CFG = $this->config->item('location_configure');
		//$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['is_trashed'], 0);
		$records = $this->locationmod->getRecords();
		return $records;
	}
	
	function getzip()
	{
		$array = array();
		## Load config and store
		$CFG = $this->config->item('location_configure');
		$VAR = $this->config->item('var');
		$qry = $_GET['term'];
		$where[] = array("(".$CFG['zipcode']." like '$qry%')");
		
		$if_not_country = $_GET['not_check_country'];
		$country_id = placeCountryId( 0, $VAR['client_country_id'], $VAR['default_country_id'] );
		if( !$if_not_country )
			$where[] = array($CFG['country_id'], $country_id);
		
		$records = $this->locationmod->getRecords($where);
		foreach($records as $record)
			$array[] = $record->zipcode;
		$postcode= json_encode($array);
		echo  $postcode;
	}
	
	function getcitysuggt()
	{
		$array = array();
		## Load config and store
		$CFG = $this->config->item('location_configure');
		$VAR = $this->config->item('var');
		$qry = $_GET['term'];
		$where[] = array("(".$CFG['main_col']." like '$qry%')");
		
		$if_not_country = $_GET['not_check_country'];
		$country_id = placeCountryId( 0, $VAR['client_country_id'], $VAR['default_country_id'] );
		if( !$if_not_country )
			$where[] = array($CFG['country_id'], $country_id);		
		$province_id = $_GET['province_id'];
		if( $province_id )
			$where[] = array($CFG['province_id'], $province_id);		
		$county_id = $_GET['county_id'];	
		if( $county_id )
			$where[] = array($CFG['county_id'], $county_id);
		
		$records = $this->locationmod->getRecords($where);
		foreach($records as $record)
			$array[] = ucfirst(strtolower($record->city));
		$postcode= json_encode(array_unique($array));
		echo  $postcode;
	}

   function getCountyIdByZip($zip)
	{
		## Load config and store
		$CFG = $this->config->item('location_configure');
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['zipcode'], $zip);
		$records = $this->locationmod->getRecords($where);
			$county_id = $records[0]->county;
		return $county_id;
	}	
	
	
	function getCityByCountyId($county_id)
	{
		## Load config and store
		$CFG = $this->config->item('location_configure');
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['county_id'], $county_id);
		$records = $this->locationmod->getRecords($where);
		foreach($records as $record)
			$array[ucfirst(strtolower($record->city))] = ucfirst(strtolower($record->city));
		return array_unique($array);
	}	
	
	function getZipByCountyId($county)
	{
		## Load config and store
		$CFG = $this->config->item('location_configure');
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['county_id'], $county);
		$records = $this->locationmod->getRecords($where);
		foreach($records as $record)
			$array[$record->zipcode] = $record->zipcode;
		return array_unique($array);
	}	
	
	function getLocationId($country,$province,$county,$city,$zip)
	{
		## Load config and store
		$CFG = $this->config->item('location_configure');
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['country_id'], $country);
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['province_id'], $province);
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['county_id'], $county);
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['city'], $city);
		$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['zipcode'], $zip);
		$records = $this->locationmod->getRecords($where);
		$ai_location_id = $records[0]->ai_location_id;
		return $ai_location_id;
	}	
	
	
	function json()
	{
		if( isAjax() )
		{
		$method = $this->input->post('method'); 
		$CFG = $this->config->item('location_configure');
		switch( $method )
		{
			case "citybycounty" :	
				$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['county_id'], $this->input->post('county'));
				$counties = array();
				$records = $this->locationmod->getRecords($where);
				foreach($records as $record)
					$counties[ucfirst(strtolower($record->city))] = ucfirst(strtolower($record->city));
				echo json_encode($counties);
			break;
			
			case "zipbycity" :	
				$where[] = array($CFG['table_name'].'.'.$CFG['possible_where']['city'], $this->input->post('city'));
				$counties = array();
				$records = $this->locationmod->getRecords($where);
				foreach($records as $record)
					$zips[$record->zipcode] = $record->zipcode;
				echo json_encode($zips);
			break;
		}
		}
	}
			
}
// END Location Class

/* End of file location.php */
/* Location: ./application/modules/location/controllers/location.php */