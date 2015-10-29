<?php
// ------------------------------------------------------------------------

/**
 * Popularlog Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Models
 * @category	Popularlog
 * @author		Webzstore Solutions
 */
class Popularlog_model extends MY_Model {
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
		$this->_configure 	= $this->config->item('popularlog_configure');
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
		$this->db->insert_batch($this->_configure['table_name'], $insertArr);
		//echo $this->db->last_query(); 
		return $this->db->affected_rows();				
	}
}
// END Popularlog Model Class

/* End of file popularlog_model.php */
/* Popular: ./application/modules/popularlog/models/popularlog_model.php */