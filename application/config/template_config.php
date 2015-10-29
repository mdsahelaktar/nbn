<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Global Theme Setting
|--------------------------------------------------------------------------
| This file lets you set various details and settings of theme
| 	- Webzstore Solutions
|
*/

$config["default"]["theme_folder"] 			= "themes/"; 				// Theme root folder 
$config["default"]["theme"] 				= "web"; 					// default theme
$config["default"]["layout"]["frontend"] 	= "main"; 					// default frontend layout
$config["default"]["layout"]["admin"] 		= "main"; 					// default admin layout
$config["default"]["layoutdir"]["frontend"] = "layout/"; 				// default frontend layout directory
$config["default"]["layoutdir"]["admin"] 	= "admin/layout/"; 			// default admin layout directory
$config["default"]["title"]["frontend"] 	= "Needbiznow | "; 			// default frontend title
$config["default"]["title"]["admin"] 		= "Needbiznow Admin | "; 	// default admin title
$config["default"]["asset"]["frontend"] 	= "layout/assets/"; 		// frontend asset directory
$config["default"]["asset"]["admin"] 		= "admin/layout/assets/"; 	// admin asset directory
if($_SERVER['HTTP_HOST'] == "localhost")								// set cdn url
	$config["default"]["cdn_url"] = "http://localhost/nbn/";
else
	$config["default"]["cdn_url"] = "http://www.needbiznow.com/";

/* End of file template_config.php */
/* Location: ./application/config/template_config.php */		