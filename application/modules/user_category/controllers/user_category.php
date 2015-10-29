<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * User Category Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	User Category
 * @author		Webzstore Solutions
 */
class User_category extends MX_Controller {

    /**
     * Autoload variable
     */
    public $autoload = array(
        'language' => array(
            'user_category'
        ),
        'config' => array(
            'user_category_configure',
            'user_category_validation',
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

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('user_category_model', 'ucat');
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
        //var_dump($this->ucat->getRecords());
    }

}

// END User Category Class

/* End of file user_category.php */
/* Location: ./application/modules/user_category/controllers/user_category.php */