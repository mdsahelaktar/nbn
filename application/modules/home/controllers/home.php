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
                    'pagination',
					'email'
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
        $data["title"] = _e("welcome");        
        ## for show popular search result section ## 
        $this->load->module('popular/popular');
        $data['get_popular'] = $this->popular->getPopularItemList('1', 'ai_bizlisting_id', _e('browse_more_popular_businesses_for_sale'));
        $data['get_popular_industry'] = $this->popular->getPopularItemList('1', 'biz_type_id', _e('browse_business_for_sale_listings_by_industry'));
        $data['get_popular_province'] = $this->popular->getPopularItemList('1', 'province_id', _e('browse_business_for_sale_listings_by_state'));
        $data['get_popular_city'] = $this->popular->getPopularItemList('1', 'city', _e('browse_business_for_sale_listings_by_top_cities'));
        $data['get_popular_restaurant'] = $this->popular->getPopularItemList('1', 'restaurant', _e('browse_popular_restaurants_for_sale'));

        $data['get_popular_side'] = $this->popular->getPopularItemSidebar('1', 'ai_bizlisting_id',_e('top_10_business_for_sale'));
        $data['get_top_search'] = $this->popular->getPopularItemSidebar('1', 'province_id',_e('top_searches'));
        ## for show popular search result section ## 
        $data["content"] = $this->template->frontend_view("home", $data, true, "home");	
        $this->template->build_frontend_output($data);
    }	
	
	function test(){
		## User activation email send begin ##
		$this->email->initialize(array("mailtype" => "html"));
		$this->email->from('noreply@needbiznow.com', 'Needbiznow');
		$this->email->to("sahel@webzstore.com"); 					
		$this->email->subject('Activate your account');
		$data["content"] = 'Hello email template test';
		$this->template->set_frontend_layout("email-template");
		$activation_msg = $this->template->build_frontend_output($data, true);
		$this->email->message($activation_msg);	
		$this->email->send();
		## User activation email send end ##
	}
	
}
// END home Class

/* End of file home.php */
/* Location: ./application/modules/cms/controllers/home.php */