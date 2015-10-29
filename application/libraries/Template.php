<?php defined('BASEPATH') OR exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Template Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Theme
 * @author		Webzstore Solutions
 */
class Template{
	private $_ci;
	private $_default = array();
	private $_theme_location = "";	
	private $_theme_url = "";
	private $_cdn_url = "";
	private $_theme = "";
	private $_language = "";
	private $_frontend_layout = "";
	private $_admin_layout = "";	
	private $_frontend_layout_dir = "";
	private $_admin_layout_dir = "";
	private $_current_frontend_layout = "";
	private $_current_admin_layout = "";
	private $_frontend_js = array();
	private $_admin_js = array();
	private $_frontend_css = array();
	private $_admin_css = array();
	private $_frontend_embd_js = array();
	private $_admin_embd_js = array();
	private $_frontend_embd_css = array();
	private $_admin_embd_css = array();
	private $_module = "";
	private $_controller = "";
	private $_method = "";
	private $_script_pattern = '#<script(.*?)>(.*?)</script>#is';
	private $_style_pattern = '#<style(.*?)>(.*?)</style>#is';	
	private $_theme_hierarchy_abs = array();
	private $_theme_hierarchy_rel = array();
	
	/**
	 * Constructor
	 */
	function __construct()
	{
		$this->_ci =& get_instance();
		
		$this->_default	= $this->_ci->config->item("default");
		$this->_theme_location = FCPATH.$this->_default["theme_folder"];
		$this->_theme_url = $this->_ci->config->item("base_url").$this->_default["theme_folder"];
		$this->_cdn_url = $this->_default["cdn_url"].$this->_default["theme_folder"];
		$this->_current_frontend_layout = $this->_frontend_layout = $this->_default["layout"]["frontend"];	
		$this->_current_admin_layout = $this->_admin_layout = $this->_default["layout"]["admin"];
		$this->_frontend_layout_dir = $this->_default["layoutdir"]["frontend"];
		$this->_admin_layout_dir = $this->_default["layoutdir"]["admin"];
		
		if (method_exists( $this->_ci->router, 'fetch_module' ))
		{
			$this->_module 	= $this->_ci->router->fetch_module();
		}
		$this->_controller	= $this->_ci->router->fetch_class();
		$this->_method 		= $this->_ci->router->fetch_method();
		/**
		 * Set Current Theme
		 * &  Language
		 */
		$this->_ci->load->model('theme');
		$this->_ci->load->model('language');
		$current_theme = $this->_ci->theme->getCurrentTheme();// set theme
		$this->set_theme($current_theme);
		$current_language = $this->_ci->language->getCurrentLanguage();// set language
		$this->set_language($current_language);
		$this->load_settings();
	}
	
	/**
	 * get_action
	 *
	 * Return current function
	 *
	 * @param	empty
	 * @return	string
	 */
	function get_action()
	{
		return $this->_module .'_'. $this->_controller .'_'. $this->_method;
	}
	
	/**
	 * load_settings
	 *
	 * Include current settings
	 *
	 * @param	empty
	 * @return	void
	 */
	function load_settings()
	{
		$priority_loop = array_reverse($this->_hierarchy_theme_abs, true);		
		foreach($priority_loop as $key => $value)
		{
			if(file_exists($value.'/settings.php'))
				include_once( 'themes/'.$this->_hierarchy_theme_rel[$key].'/settings.php' );
		}		
	}
	
	/**
	 * set_theme
	 *
	 * Set current theme
	 *
	 * @param	string theme name [optional]
	 * @return	void
	 */
	function set_theme($theme = "")
	{
		if($this->_ci->agent->is_mobile())
			$this->_theme = "mobile";
		else
			$this->_theme = ($theme and is_dir($this->_theme_location.$theme)) ? $theme : $this->_default["theme"];
		$this->set_theme_hierarchy();	
	}
	
	/**
	 * set_language
	 *
	 * Set current language
	 *
	 * @param	string language name [optional]
	 * @return	void
	 */
	function set_language($language)
	{
		$this->_language = ($language && is_dir(APPPATH.'language/'.$language)) ? $language : $this->_ci->config->item("language");
	}
	
	/**
	 * current_language
	 *
	 * Return current language
	 *
	 * @param	empty
	 * @return	string
	 */
	function current_language()
	{
		return $this->_language;
	}
	
	/**
	 * set_theme_hierarchy
	 *
	 * This function set hierarchy of the theme absolute and relative both, need for bootstraping
	 *
	 * @param	empty
	 * @return	void
	 */
	function set_theme_hierarchy()
	{
		$this->_hierarchy_theme_abs = array_unique(array($this->_theme_location.$this->_theme, $this->_theme_location.$this->_default["theme"]));
		$this->_hierarchy_theme_rel = array_unique(array($this->_theme, $this->_default["theme"]));
	}
	
	/**
	 * frontend_view
	 *
	 * This function is parallel to VIEW, used in frontend area
	 *
	 * @param	string	file name without extension
	 * @param	array	carries required variable used in view file
	 * @param	boolean	view needed as variable or as loadable
	 * @return	loaded or returns
	 */
	function frontend_view($file ,$data ,$return = FALSE, $module = "")
	{
		foreach($this->_hierarchy_theme_abs as $key => $value)
		{
			if(file_exists($value.'/'.$module.'/'.$file.EXT))		
			{
				if($return)
					return $this->_ci->load->view($this->_hierarchy_theme_rel[$key].'/'.$module.'/'.$file, $data , TRUE);
				else
					$this->_ci->load->view($this->_hierarchy_theme_rel[$key].'/'.$module.'/'.$file, $data);
				return;	
			}
		}
	}
	
	/**
	 * admin_view
	 *
	 * This function is parallel to VIEW, used in admin area
	 *
	 * @param	string	file name without extension
	 * @param	array	carries required variable used in view file
	 * @param	boolean	view needed as variable or as loadable
	 * @return	loaded or returns
	 */
	function admin_view($file ,$data ,$return = FALSE, $module = "")
	{
		foreach($this->_hierarchy_theme_abs as $key => $value)
		{
			if(file_exists($value.'/admin/'.$module.'/'.$file.EXT))		
			{
				if($return)
					return $this->_ci->load->view($this->_hierarchy_theme_rel[$key].'/admin/'.$module.'/'.$file, $data , TRUE);
				else
					$this->_ci->load->view($this->_hierarchy_theme_rel[$key].'/admin/'.$module.'/'.$file, $data);
				return;	
			}
		}
	}
	
	/**
	 * set_frontend_layout
	 *
	 * This function set frontend layout where the main view will be rendered means template file
	 *
	 * @param	string	layout name
	 * @return	void
	 */
	function set_frontend_layout($layout)
	{
		$layout_hierarchy = array($layout, $this->_frontend_layout);
		foreach($layout_hierarchy as $lkey => $lvalue)
		{
			foreach($this->_hierarchy_theme_abs as $key => $value)
			{
				if(file_exists($value.'/'.$this->_frontend_layout_dir.$lvalue.EXT))
				{
					$this->_current_frontend_layout = $lvalue;
					return;
				}
			}
		}		
	}
	
	/**
	 * set_admin_layout
	 *
	 * This function set admin layout where the main view will be rendered means template file
	 *
	 * @param	string	layout name
	 * @return	void
	 */
	function set_admin_layout($layout)
	{
		$layout_hierarchy = array($layout, $this->_admin_layout);
		foreach($layout_hierarchy as $lkey => $lvalue)
		{
			foreach($this->_hierarchy_theme_abs as $key => $value)
			{
				if(file_exists($value.'/'.$this->_admin_layout_dir.$lvalue.EXT))
				{
					$this->_current_admin_layout = $lvalue;
					return;
				}
			}
		}		
	}
	
	/**
	 * build_frontend_output
	 *
	 * This function build the final output for frontend which is displayed as whole on browser
	 *
	 * @param	array	carries required variable used in layout/template file 
	 * @param	boolean	view needed as variable or as loadable 
	 * @return	loaded or returns
	 */
	function build_frontend_output($data ,$return = FALSE)
	{
		$data["title"] = $this->_default["title"]["frontend"].(!empty($data["title"]) ? $data["title"] : "");
		foreach($this->_hierarchy_theme_abs as $key => $value)
		{
			if(file_exists($value.'/'.$this->_frontend_layout_dir.$this->_current_frontend_layout.EXT))
			{
				if($return)
					return $this->_ci->load->view($this->_hierarchy_theme_rel[$key].'/'.$this->_frontend_layout_dir.$this->_current_frontend_layout, $data , TRUE);
				else
					$this->_ci->load->view($this->_hierarchy_theme_rel[$key].'/'.$this->_frontend_layout_dir.$this->_current_frontend_layout, $data);
				return;
			}
		}		
	}
	
	/**
	 * build_admin_output
	 *
	 * This function build the final output for admin which is displayed as whole on browser
	 *
	 * @param	array	carries required variable used in layout/template file 
	 * @param	boolean	view needed as variable or as loadable 
	 * @return	loaded or returns
	 */
	function build_admin_output($data ,$return = FALSE)
	{
		$data["title"] = $this->_default["title"]["admin"].(!empty($data["title"]) ? $data["title"] : "");
		foreach($this->_hierarchy_theme_abs as $key => $value)
		{
			if(file_exists($value.'/'.$this->_admin_layout_dir.$this->_current_admin_layout.EXT))
			{
				if($return)
					return $this->_ci->load->view($this->_hierarchy_theme_rel[$key].'/'.$this->_admin_layout_dir.$this->_current_admin_layout, $data , TRUE);
				else
					$this->_ci->load->view($this->_hierarchy_theme_rel[$key].'/'.$this->_admin_layout_dir.$this->_current_admin_layout, $data);
				return;
			}
		}		
	}
	
	/**
	 * load_frontend_shared_region
	 *
	 * This function loads the shared region like header,sidebar etc for frontend area
	 *
	 * @param	string file name without extension
	 * @return	void
	 */
	function load_frontend_shared_region($file)
	{
		foreach($this->_hierarchy_theme_abs as $key => $value)
		{
			if(file_exists($value.'/'.$this->_frontend_layout_dir."shared/".$file.EXT))
			{
				$this->_ci->load->view($this->_hierarchy_theme_rel[$key].'/'.$this->_frontend_layout_dir."shared/".$file);				
				return;
			}
		}
	}
	
	/**
	 * load_admin_shared_region
	 *
	 * This function loads the shared region like header,sidebar etc for admin area
	 *
	 * @param	string file name without extension
	 * @return	void
	 */
	function load_admin_shared_region($file)
	{
		foreach($this->_hierarchy_theme_abs as $key => $value)
		{
			if(file_exists($value.'/'.$this->_admin_layout_dir."shared/".$file.EXT))
			{
				$this->_ci->load->view($this->_hierarchy_theme_rel[$key].'/'.$this->_admin_layout_dir."shared/".$file);				
				return;
			}
		}
	}
	
	/**
	 * add_remove_frontend_js
	 *
	 * This function adds or removes js used in frontend
	 *
	 * @param	array	js file name 
	 * @param	string	for which action
	 * @return	void
	 */
	function add_remove_frontend_js($jsarray, $action)
	{
		if($action == "add")
			$this->_frontend_js = array_merge($this->_frontend_js, $jsarray);
		elseif($action == "remove")
			$this->_frontend_js = array_diff($this->_frontend_js, $jsarray);
		$this->_frontend_js = array_unique($this->_frontend_js);	
	}
	
	/**
	 * add_remove_frontend_css
	 *
	 * This function adds or removes css used in frontend
	 *
	 * @param	array	css file name 
	 * @param	string	for which action
	 * @return	void
	 */
	function add_remove_frontend_css($cssarray, $action)
	{
		if($action == "add")
			$this->_frontend_css = array_merge($this->_frontend_css, $cssarray);
		elseif($action == "remove")			
			$this->_frontend_css = array_diff($this->_frontend_css, $cssarray);
		$this->_frontend_css = array_unique($this->_frontend_css);	
	}
	
	/**
	 * add_remove_admin_js
	 *
	 * This function adds or removes js used in admin
	 *
	 * @param	array	js file name 
	 * @param	string	for which action
	 * @return	void
	 */
	function add_remove_admin_js($jsarray, $action)
	{
		if($action == "add")
			$this->_admin_js = array_merge($this->_admin_js, $jsarray);
		elseif($action == "remove")	
			$this->_admin_js = array_diff($this->_admin_js, $jsarray);
		$this->_admin_js = array_unique($this->_admin_js);
	}
	
	/**
	 * add_remove_admin_css
	 *
	 * This function adds or removes css used in admin
	 *
	 * @param	array	css file name 
	 * @param	string	for which action
	 * @return	void
	 */
	function add_remove_admin_css($cssarray, $action)
	{		
		if($action == "add")
			$this->_admin_css = array_merge($this->_admin_css, $cssarray);
		elseif($action == "remove")	
			$this->_admin_css = array_diff($this->_admin_css, $cssarray);
		$this->_admin_css = array_unique($this->_admin_css);		
	}
	
	/**
	 * embed_asset_code
	 *
	 * This function embed asset(js,css) code
	 *
	 * @param	string	frontend|admin
	 * @param	string	js|css
	 * @param	string	array key
	 * @param	string	scripts
	 * @return	void
	 */
	function embed_asset_code($end, $type, $unique_key, $data)	
	{
		if($type == "style")
		{
			if($end == "frontend")
				$this->_frontend_embd_css[$unique_key] = $data;
			else
				$this->_admin_embd_css[$unique_key] = $data;	
		}
		elseif($type == "js")
		{
			if($end == "frontend")
				$this->_frontend_embd_js[$unique_key] = $data;
			else
				$this->_admin_embd_js[$unique_key] = $data;	
		}
	}
	
	/**
	 * remove_asset_code
	 *
	 * This function remove embeded asset(js,css) code
	 *
	 * @param	string	frontend|admin
	 * @param	string	js|css
	 * @param	string	array key
	 * @return	void
	 */
	function remove_asset_code($end, $type, $unique_key)	
	{
		if($type == "style")
		{
			if($end == "frontend")
				unset($this->_frontend_embd_css[$unique_key]);
			else
				unset($this->_admin_embd_css[$unique_key]);	
		}
		elseif($type == "js")
		{
			if($end == "frontend")
				unset($this->_frontend_embd_js[$unique_key]);
			else
				unset($this->_admin_embd_js[$unique_key]);	
		}
	}
	
	/**
	 * get_frontend_js
	 *
	 * This function usually loads in frontend layout/template file to load js and embedded js scripts
	 *
	 * @param	empty
	 * @return	void
	 */
	function get_frontend_js()
	{
		$scripts = "";
		foreach($this->_frontend_js as $js)
		{
			foreach($this->_hierarchy_theme_abs as $key => $value)
			{
				if(file_exists($value.'/'.$this->_default["asset"]["frontend"]."js/".$js))
				{
					$scripts .= '<script type="application/javascript" src="'.$this->_cdn_url.$this->_hierarchy_theme_rel[$key].'/'.$this->_default["asset"]["frontend"].'js/'.$js.'"></script>';
					break; 
				}
			}			
		}
		foreach($this->_frontend_embd_js as $key => $value)
		{
			$scripts .= preg_match($this->_script_pattern, $value) ? $value : '<script type="application/javascript" id="'.$key.'">'.$value.'</script>';
		}
		echo $scripts;		
	}
	
	/**
	 * get_frontend_css
	 *
	 * This function usually loads in frontend layout/template file to load css and embedded css scripts
	 *
	 * @param	empty
	 * @return	void
	 */
	function get_frontend_css()
	{
		$csslinks = "";
		foreach($this->_frontend_css as $css)
		{
			foreach($this->_hierarchy_theme_abs as $key => $value)
			{
				if(file_exists($value.'/'.$this->_default["asset"]["frontend"]."css/".$css))
				{
					$csslinks .= '<link href="'.$this->_cdn_url.$this->_hierarchy_theme_rel[$key].'/'.$this->_default["asset"]["frontend"].'css/'.$css.'" rel="stylesheet"/>';
					break; 
				}
			}
		}
		foreach($this->_frontend_embd_css as $key => $value)
		{
			$csslinks .= preg_match($this->_style_pattern, $value) ? $value : '<style type="text/css" id="'.$key.'">'.$value.'</style>';
		}
		echo $csslinks;
	}
	
	/**
	 * get_frontend_image
	 *
	 * This function is used to get frontend image
	 *
	 * @param	string	image file
	 * @param	boolean	return or echo
	 * @return	returns or echoes
	 */
	function get_frontend_image($image, $return = FALSE)
	{
		foreach($this->_hierarchy_theme_abs as $key => $value)
		{
			if(file_exists($value.'/'.$this->_default["asset"]["frontend"]."images/".$image))
			{
				if(!$return)
					echo $this->_cdn_url.$this->_hierarchy_theme_rel[$key].'/'.$this->_default["asset"]["frontend"]."images/".$image;
				else
					return $this->_cdn_url.$this->_hierarchy_theme_rel[$key].'/'.$this->_default["asset"]["frontend"]."images/".$image;						
				break;
			}
		}
		
	}	
	
	/**
	 * get_admin_js
	 *
	 * This function usually loads in admin layout/template file to load js and embedded js scripts
	 *
	 * @param	empty
	 * @return	void
	 */
	function get_admin_js()
	{
		$scripts = "";
		foreach($this->_admin_js as $js)
		{
			foreach($this->_hierarchy_theme_abs as $key => $value)
			{
				if(file_exists($value.'/'.$this->_default["asset"]["admin"]."js/".$js))
				{
					$scripts .= '<script type="application/javascript" src="'.$this->_cdn_url.$this->_hierarchy_theme_rel[$key].'/'.$this->_default["asset"]["admin"].'js/'.$js.'"></script>';
					break; 
				}
			}
		}
		foreach($this->_admin_embd_js as $key => $value)
		{
			$scripts .= preg_match($this->_script_pattern, $value) ? $value : '<script type="application/javascript" id="'.$key.'">'.$value.'</script>';
		}
		echo $scripts;		
	}
	
	/**
	 * get_admin_css
	 *
	 * This function usually loads in admin layout/template file to load css and embedded css scripts
	 *
	 * @param	empty
	 * @return	void
	 */
	function get_admin_css()
	{
		$csslinks = "";
		foreach($this->_admin_css as $css)
		{
			foreach($this->_hierarchy_theme_abs as $key => $value)
			{
				if(file_exists($value.'/'.$this->_default["asset"]["admin"]."css/".$css))
				{
					$csslinks .= '<link href="'.$this->_cdn_url.$this->_hierarchy_theme_rel[$key].'/'.$this->_default["asset"]["admin"].'css/'.$css.'" rel="stylesheet"/>';
					break; 
				}
			}
		}
		foreach($this->_admin_embd_css as $key => $value)
		{
			$csslinks .= preg_match($this->_style_pattern, $value) ? $value : '<style type="text/css" id="'.$key.'">'.$value.'</style>';
		}
		echo $csslinks;
	}
	
	/**
	 * get_admin_image
	 *
	 * This function is used to get admin image
	 *
	 * @param	string	image file
	 * @param	boolean	return or echo
	 * @return	returns or echoes
	 */
	function get_admin_image($image, $return = FALSE)
	{
		foreach($this->_hierarchy_theme_abs as $key => $value)
		{
			if(file_exists($value.'/'.$this->_default["asset"]["admin"]."images/".$image))
			{
				if(!$return)
					echo $this->_cdn_url.$this->_hierarchy_theme_rel[$key].'/'.$this->_default["asset"]["admin"]."images/".$image;
				else
					return $this->_cdn_url.$this->_hierarchy_theme_rel[$key].'/'.$this->_default["asset"]["admin"]."images/".$image;						
				break;
			}
		}
	}
}
// END Template Class

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */