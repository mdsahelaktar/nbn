<?php
// ------------------------------------------------------------------------

/**
 * Default Permission Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Models
 * @category	default_permission
 * @author		Webzstore Solutions
 */
class Default_permission_model extends MY_Model 
{
	protected $_pagination = array();
	protected $_validation = array();
	protected $_configure = array();
	
	/**
	 * Constructor
	 */	
	function __construct()
    {
    	parent::__construct();
		$this->initialize();
		//cacheEnable();
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
		$this->_configure = $this->config->item('default_permission_configure');
		$this->_pagination = $this->config->item('pagination');
		$this->_validation = $this->config->item('default_permission_validation');
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
	 * @param	array	sql groupby in string format Optional
	 * @param	array	sql select in array format 	 Optional
	 * @return	array	record sets
	 */
	function getRecords( $wheres = '', $orderby = '', $searchby = '', $limit = '', $groupby = '', $select = '' )
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
		if(isset( $this->_configure['dependent_on'] ))
		{
			foreach($this->_configure['dependent_on'] as $table => $details)
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
	
	
	/**
	 * ifExists
	 *
	 * This function called to rid of duplicate entries
	 *
	 * @param	integer	data id which not to be duplicate
	 * @param	integer	on which respect need to check
	 * @param	integer	edit id	Optional
	 * @return	boolean
	 */
	function ifExists($data, $elm_val, $edit_id = "")
	{
		if($edit_id)
		{
			$this->db->where($this->_configure['ai_id'].' !=' , $edit_id);
			$query = $this->db->get_where($this->_configure['table_name'], array( $this->_configure['user_role_id'] => $elm_val, $this->_configure['ap_id'] => $data, $this->_configure['permanent_delete'] => 0 ));
		}
		else
			$query = $this->db->get_where($this->_configure['table_name'], array($this->_configure['user_role_id'] => $elm_val, $this->_configure['ap_id'] => $data, $this->_configure['permanent_delete'] => 0 ));
		$total_rows = $query->num_rows();		
		//echo $this->db->last_query();
		if($total_rows)
			return true;
		else
			return false;	
	}
	
}
// END Default Permission Model Class

/* End of file default_permission_model.php */
/* Location: ./application/modules/default_permission/models/default_permission_model.php */