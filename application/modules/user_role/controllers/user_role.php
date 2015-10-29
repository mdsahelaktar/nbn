<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * User Role Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	User Role
 * @author		Webzstore Solutions
 */
class User_role extends MX_Controller {

    /**
     * Autoload variable
     */
    public $autoload = array(
        'language' => array(
            'user_role'
        ),
        'config' => array(
            'configure',
            'validation',
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
        $this->load->model('user_role_model', 'urole');
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
        hojoborolo();
    }

}

// END User Role Class

/* End of file user_role.php */
/* Location: ./application/modules/user_role/controllers/user_role.php */