<?php
// ------------------------------------------------------------------------

/**
 * Theme Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Models
 * @category	Theme
 * @author		Webzstore Solutions
 */
class Theme_model extends MY_Model
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
		$this->_configure 	= $this->config->item('theme_configure');
		$this->_pagination 	= $this->config->item('pagination');
		$this->_validation 	= $this->config->item('theme_validation');
	}
	
	/**
	 * insertInto
	 *
	 * This method called during insert into db table
	 *
	 * @param	array	data set may be $_GET, $_POST	
	 * @return	integer	affected rows count
	 */
	function insertInto($VAR)
	{
		$insertArr = returnInsertArray($VAR, $this->_configure);
		$this->triggerIsCurrent();
		$this->db->insert_batch($this->_configure['table_name'], $insertArr);
		//$this->db->last_query();
		return $this->db->affected_rows();				
	}
	
	/**
	 * dbUpdate
	 *
	 * This function called to update database tables
	 *
	 * @param	string			action name
	 * @param	integer|arrays	row id or row_ids
	 * @param	array			dataset	Optional
	 * @return	integer			affected rows of table
	 */
	function dbUpdate($action, $row_id, $VAR = '')
	{
		switch($action)
		{
			case	'delete':
			case	'revert':
			case	'permanent_delete':
					if(is_array($row_id))
						foreach($row_id as $id)
							$this->db->or_where($this->_configure['ai_id'], $id);
					else
						$this->db->where($this->_configure['ai_id'], $row_id);
					break;	
		}		
		$set = array();	
		switch($action)
		{
			case	'delete' :
					$set = array($this->_configure['soft_delete'] => 1);
					$this->db->update($this->_configure['table_name'], $set);
					break;
			case	'revert' :
					$set = array($this->_configure['soft_delete'] => 0);
					$this->db->update($this->_configure['table_name'], $set);
					break;	
			case	'permanent_delete' :
					$set = array($this->_configure['permanent_delete'] => 1);
					$this->db->update($this->_configure['table_name'], $set);		
					break;
			case	'update' :					
					$set = returnUpdateArray($VAR, $this->_configure);
					$this->triggerIsCurrent();
					$this->db->update_batch($this->_configure['table_name'], $set, $this->_configure['ai_id']);		
					break;	
		}		
		return $this->db->affected_rows(); 
	}
	
	/**
	 * triggerIsCurrent
	 *
	 * This function called is_current checkbox checked
	 *
	 * @param	empty
	 * @return	void
	 */
	function triggerIsCurrent()
	{
		if( $this->input->post($this->_configure['is_current']) )
		{
			$data = array( $this->_configure['is_current'] => 0 );			
			$this->db->where( $this->_configure['is_current'], 1);
			$this->db->update( $this->_configure['table_name'], $data);
		}
	}
}
// END Theme Model Class

/* End of file theme_model.php */
/* Location: ./application/modules/theme/models/theme_model.php */