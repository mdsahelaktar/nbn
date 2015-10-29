<?php

// ------------------------------------------------------------------------

/**
 * User Category Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Models
 * @category	User Category
 * @author		Webzstore Solutions
 */
class User_category_model extends MY_Model {

    protected $_pagination = array();
    protected $_validation = array();
    protected $_configure = array();

    /**
     * Constructor
     */
    function __construct() {
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
    function initialize() {
        $this->_configure = $this->config->item('user_category_configure');
        $this->_pagination = $this->config->item('pagination');
        $this->_validation = $this->config->item('user_category_validation');
    }

}

// END User Category Model Class

/* End of file user_category_model.php */
/* Location: ./application/modules/user_category/models/user_category_model.php */