<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Language Class
 *
 * @package		CodeIgniter
 * @subpackage	Models
 * @category	Language
 * @author		Webzstore Solutions
 */
class Language extends Ci_Model 
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * getCurrentLanguage
	 *
	 * Return current language
	 *
	 * @param	empty
	 * @return	language
	 */
	function getCurrentLanguage()
	{
		return "english";
	}	
}
// END Language Class

/* End of file language.php */
/* Location: ./application/models/language.php */
?>