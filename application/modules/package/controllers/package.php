<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Package Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Package
 * @author		Webzstore Solutions
 */
class Package extends MX_Controller {

    /**
     * Autoload variable
     */
    public $autoload = array(
        'language' => array(
            'package'
        ),
        'config' => array(
            'package_configure',
            'package_validation',
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
	
	private $user_category_context = array( 2 => 1 );
    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('package_model', 'pmodel');
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
    function index() {
        $data = array();
        $data["title"] = _e("Pcakages");
		## Load config and store ##
        $CFG = $this->config->item('package_configure');	
		## Load package against context_id and this context id genearted from user category id ##
		$wheres = createWhereArray( array( 'context_id' => $this->user_category_context[$_GET['ct']] ), $CFG );
		$records = $this->pmodel->getRecords( $wheres );
		$data["content"] = $this->template->frontend_view("package", array( "packages" => $records ), true, "package");
		$this->template->build_frontend_output($data);
		//var_dump($records);
    }

}

// END Package Class

/* End of file package.php */
/* Location: ./application/modules/package/controllers/package.php */