<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * My Form Validation Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Validation
 * @author		Webzstore Solutions
 */
class MY_Form_validation extends CI_Form_validation
{
	function run($module = '', $group = '') 
	{
		(is_object($module)) AND $this->CI =& $module;
		return parent::run($group);
	}
}
// END My Form Validation Class

/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */
