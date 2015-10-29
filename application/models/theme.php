<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Theme Class
 *
 * @package		CodeIgniter
 * @subpackage	Models
 * @category	Theme
 * @author		Webzstore Solutions
 */
class Theme extends CI_Model 
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * getCurrentTheme
	 *
	 * Return current theme
	 *
	 * @param	empty
	 * @return	theme
	 */
	function getCurrentTheme()
	{
		return false;
	}	
}
// END Theme Class

/* End of file theme.php */
/* Location: ./application/models/theme.php */
?>