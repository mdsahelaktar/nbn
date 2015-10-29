<?php
// ------------------------------------------------------------------------

/**
 * Popular Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Models
 * @category	Popular
 * @author		Webzstore Solutions
 */
class Popular_model extends MY_Model {
	protected $_configure = array();
	
	/**
	 * Constructor
	 */
	function __construct()
    {
    	parent::__construct();
		$this->initialize();
    }
	
	/**
	 * initialize
	 *
	 * This method call during constructing this class
	 *
	 * @param	empty
	 * @return	void
	 */
	function initialize()
	{
		$this->_configure 	= $this->config->item('popular_configure');
	}	
	
	/**
	 * getRecords
	 *
	 * This method called when record fetches from db table
	 *
	 * @param	array	sql where in array format	 Optional
	 * @param	array	sql orderby in array format	 Optional
	 * @param	array	sql like in array format	 Optional
	 * @param	array	sql limit in array format	 Optional
	 * @return	array	record sets
	 */
	function getRecords($wheres = '', $orderby = '', $searchby = '', $limit = '', $groupby = '', $select = '', $child_type = '')
	{
		if( ! $groupby )
		$this->db->select($this->_configure['table_name'].'.*');
		$this->db->from($this->_configure['table_name']);
		$wheres[] = array($this->_configure['table_name'].'.'.$this->_configure['permanent_delete'] , 0);	
		foreach($wheres as $key => $where)
		{
		if(is_array($where))
			$this->db->where($where[0], $where[1]); 
		else
			$this->db->where($where); 
		}
		
		## For left join ##
		if(isset( $this->_configure['dependent_on'][$child_type] ))
		{
		foreach($this->_configure['dependent_on'][$child_type] as $table => $details)
		{
			$this->db->join($table, $details['on'], $details['type']);
			foreach($details['where'] as $w => $v)
			{
				if(is_array($v))
					$this->db->where($v[0], $v[1]);				
				else
					$this->db->where($v);			
			}
			if( ! $groupby )
			{					
				foreach($details["fetch"] as $column)
					$this->db->select($table.'.'.$column);
			}
		}
		}
		if(is_array($orderby))
		{
		foreach($orderby as $order)
			$this->db->order_by($order);
		}	
		
		if(is_array( $searchby ))		
		{
		foreach($searchby as $sitem) 
			$this->db->like($sitem[0], $sitem[1]);
		}
		
		if(is_array($limit))
		$this->db->limit($limit[1], $limit[0]);	
		
		if($groupby)
		{
			$this->db->group_by($groupby); 				
		if( is_array( $select ) )
		{
			foreach($select as $column)
					$this->db->select($column);
		}
		}
		$query = $this->db->get();	
		//echo $this->db->last_query();								
		return $query->result();
	}
	
}
// END Popular Model Class

/* End of file popular_model.php */
/* Popular: ./application/modules/popular/models/popular_model.php */