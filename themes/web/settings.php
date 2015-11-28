<?php
$action = $this->get_action();
## Language activate
$this->_ci->config->set_item("language", $this->current_language());
if (!isAdminArea()) {
    ## This is frontend area where we can add css and js ##
    $default_frontend_js = array();
    $default_frontend_css = array("styles.css", "ionic.css", "slimbox2.css");

    $this->add_remove_frontend_js($default_frontend_js, "add");
    $this->add_remove_frontend_css($default_frontend_css, "add");

    ## Fetch JS from admin ##
    $default_admin_js = array("jquery.min.js", "custom.js", "cbpAnimatedHeader.js", "cbpAnimatedHeader.min.js", "jquery.tinycarousel.min.js", "jquery.idTabs.min.js", "modernizr.custom.js", "classie.js", "slimbox2.js");
    $this->add_remove_admin_js($default_admin_js, "add");
} else {
    ## This is admin area where we can add css and js
    $default_admin_js = array("jquery.min.js", "custom.js", "ddaccordion.js", "slimbox2.js");
    $default_admin_css = array("styles.css", "ionic.css", "slimbox2.css");

    $this->add_remove_admin_js($default_admin_js, "add");
    $this->add_remove_admin_css($default_admin_css, "add");
    $leftmenujs = $this->_ci->load->view("web/admin/layout/assets/js/leftmenu.js.php", '', true);
    $this->embed_asset_code('admin', 'js', 'leftmenu', $leftmenujs);
}
## This is simply a type of hooks[ Add or Remove css/js at particular url]
switch ($action) {
    case "permission_modify_permission_modify_admin_add" :
    case "permission_modify_permission_modify_admin_edit" :
    case "user_map_user_map_admin_add" :
    case "user_map_user_map_admin_edit" :
    case "user_user_admin_add" :
    case "user_user_admin_edit" :
    case "default_permission_default_permission_admin_add" :
    case "default_permission_default_permission_admin_edit" :
    case "language_language_admin_add" :
    case "language_language_admin_edit" :
    case "theme_theme_admin_add" :
    case "theme_theme_admin_edit" :
    case "permission_permission_admin_add" :
    case "permission_permission_admin_edit" :
    case "permission_group_permission_group_admin_add" :
    case "permission_group_permission_group_admin_edit" :
    case "user_role_user_role_admin_add" :
    case "user_role_user_role_admin_edit" :
    case "user_category_user_category_admin_add" :
    case "user_category_user_category_admin_edit" :
    case "login_login_admin_index" :
    case "biz_listing_biz_listing_admin_add" :
    case "biz_listing_biz_listing_admin_edit" :
    case "context_context_admin_add" :
    case "context_context_admin_edit" :
    case "image_image_admin_add" :
    case "image_image_admin_edit" :
	case "package_package_admin_add" :
	case "package_package_admin_edit" :

    case "biz_listing_biz_listing_thirdstep" :
    case "biz_listing_biz_listing_secondstep" :
    case "biz_listing_biz_listing_index" :
	case "biz_listing_biz_listing_manage" :
    case "home_home_index" :
    case "biz_listing_biz_listing_search" :
    case "biz_listing_biz_listing_brokerlisting" :
    case "user_user_index" :
	case "user_user_edit_profile" :
	case "user_user_change_password" :
	case "user_user_forgot_password" :
	case "user_user_reset_password" :
    case "login_login_index" :
    case "biz_listing_biz_listing_details" :
    case "broker_broker_profileinfo" :
    case "broker_broker_index" :
    case "broker_broker_popup" :
    case "broker_broker_brokerdetails" :	

        $this->_ci->lang->load('form_validation');
        $validation_js = $this->_ci->load->view("web/admin/layout/assets/js/validate.js.php", '', true);
        $this->embed_asset_code('admin', 'js', 'validate', $validation_js);
        $this->add_remove_admin_js(array('validate_helper.js'), "add");
}
?>