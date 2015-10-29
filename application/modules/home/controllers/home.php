<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * home Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	home
 * @author		Webzstore Solutions
 */
class Home extends MX_Controller 
{
   /**
    *	Autoload varible.
    *	Loads other accessories required for this model.
    */
    public $autoload = array(
		'language'  => array(
                    'home'
		),
        	'config'    => array(
                    'pagination'
		),
        	'libraries' => array(
                    'form_validation',
                    'pagination'
		),
		'helpers'   => array(
                    'form',
                    'cookie'
                )
        );
    /**
     * Constructor
     */	
    public function __construct()
    {
	parent::__construct();
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
    function index()
    {
        $data["title"] = _e("Welcome");        
        ## for show popular search result section ## 
        $this->load->module('popular/popular');
        $data['get_popular'] = $this->popular->getPopularItemList('1', 'ai_bizlisting_id', 'Browse More Popular Businesses for Sale');
        $data['get_popular_industry'] = $this->popular->getPopularItemList('1', 'biz_type_id', 'Browse Business for Sale Listings by Industry');
        $data['get_popular_province'] = $this->popular->getPopularItemList('1', 'province_id', 'Browse Business for Sale Listings by State');
        $data['get_popular_city'] = $this->popular->getPopularItemList('1', 'city', 'Browse Business for Sale Listings by Top Cities');
        $data['get_popular_restaurant'] = $this->popular->getPopularItemList('1', 'restaurant', 'Browse Popular Restaurants for Sale');

        $data['get_popular_side'] = $this->popular->getPopularItemSidebar('1', 'ai_bizlisting_id','Top 10 Business For Sale');
        $data['get_top_search'] = $this->popular->getPopularItemSidebar('1', 'province_id','Top Searches:');
        ## for show popular search result section ## 
        $data["content"] = $this->template->frontend_view("home", $data, true, "home");	
        $this->template->build_frontend_output($data);
    }	
}
// END home Class

/* End of file home.php */
/* Location: ./application/modules/cms/controllers/home.php */