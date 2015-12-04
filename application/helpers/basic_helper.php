<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * CodeIgniter Basic Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Webzstore Solutions
 */
// ------------------------------------------------------------------------

/**
 * sortBy
 *
 * Create sort by url and returns that
 *
 * @param	array	configuration	
 * @param	string	desired link
 * @param	array	if some customized data need to send from outside 
 * @return	string	link
 */
if (!function_exists('sortBy')) {

    function sortBy($CFG, $element, $data = "") {
        $sort_vice_verca = array('asc' => 'desc', 'desc' => 'asc');
        $ci = & get_instance();
        $uria = array();
        $get = is_array($data) ? $data : ( $ci->input->get() ? $ci->input->get() : array() );
        unset($CFG['possible_orderby'][$element]);
        $get = array_diff_key($get, $CFG['possible_orderby']);
        foreach ($get as $key => $value) {
            $loopuri = '';
            if ($key == $element)
                $loopuri = $element . '=' . $sort_vice_verca[( in_array(strtolower($value), $sort_vice_verca) ? strtolower($value) : 'asc' )];
            else
                $loopuri = $key . '=' . $value;
            $uria[] = $loopuri;
        }
        if (!array_key_exists($element, $get))
            $uria[] = $element . '=asc';
        $uri = '?' . implode('&', $uria);
        return $uri;
    }

}

/**
 * sortClass
 *
 * Return css class name depending upon link sortby status
 *
 * @param	array	configuration	
 * @param	string	desired link
 * @param	array	if some customized data need to send from outside  
 * @return	string	class or false
 */
if (!function_exists('sortClass')) {

    function sortClass($CFG, $element, $data = "") {
        $sort_vice_verca = array('asc' => 'desc', 'desc' => 'asc');
        $ci = & get_instance();
        $uria = array();
        $get = is_array($data) ? $data : ( $ci->input->get() ? $ci->input->get() : array() );
        if (array_key_exists($element, $get))
            return !in_array(strtolower($get[$element]), $sort_vice_verca) ? 'asc' : strtolower($get[$element]);
        return false;
    }

}

/**
 * isAdminArea
 *
 * Return if current area is admin or frontend
 *
 * @param	empty
 * @return	boolean
 */
if (!function_exists('isAdminArea')) {

    function isAdminArea() {
        $ci = & get_instance();
        $browser_url = currentBrowserUrl();
        if (strpos($browser_url, 'admin') === false)
            return false;
        else
            return true;
    }

}

/**
 * isLoggedIn
 *
 * Return if the user is logged in or not
 *
 * @param	empty	
 * @return	array	login details stored in session
 */
if (!function_exists('isLoggedIn')) {

    function isLoggedIn() {
        $ci = & get_instance();
        $login_details = $ci->session->userdata('login');
        if (!$login_details) {
            $login_details = unserialize(get_cookie('login'));
            if ($login_details)
                set_cookie('login', serialize($login_details), $ci->config->item('cookie_expire'));
        }
        $ci->login = $login_details;
        return $ci->login;
    }

}

/**
 * loginRedirect
 *
 * Redirect to passed url if not logged in
 *
 * @param	string		redirect url	
 * @return	redirect	redirect to passed url
 */
if (!function_exists('loginRedirect')) {

    function loginRedirect($redirect) {
        $ci = & get_instance();
        $redirect_url = $redirect;
        if (site_url() != currentBrowserUrl() && site_url() . "admin" != currentBrowserUrl())
            $redirect_url .= "?next=" . currentBrowserUrl();
        if (!isLoggedIn()) {
            $ci->session->set_flashdata(array('event' => 'error', 'msg' => _e('access_denied_login')));
            $redirect_url = site_url() . $redirect_url;
            if (!isAjax())
                redirect($redirect_url);
            else {
                echo json_encode(array("event" => "no-authentication", "redirect" => $redirect_url, "msg" => _e('access_denied_login')));
                die();
            }
        } elseif (site_url() . "admin" == currentBrowserUrl())
            redirect(site_url() . "admin/dashboard");
        else
            return true;
    }

}

/**
 * isAjax
 *
 * Return if current flow is under ajax or not
 *
 * @param	empty
 * @return	boolean
 */
if (!function_exists('isAjax')) {

    function isAjax() {
        return ( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" );
    }

}

/**
 * getFilterStatusDD
 *
 * Return array of filter status
 *
 * @param	empty
 * @return	array
 */
if (!function_exists('getFilterStatusDD')) {

    function getFilterStatusDD() {
        return array('' => _e('choose'), _e("active"), _e("inactive"));
    }

}

/**
 * getActionDD
 *
 * Return array of actions
 *
 * @param	empty
 * @return	array
 */
if (!function_exists('getActionDD')) {

    function getActionDD() {
        return array('' => _e('choose'), 'delete' => _e('trash'), 'revert' => _e('revert'), 'permanent_delete' => _e('permanent_delete'));
    }

}

/**
 * getAllUpdateActions
 *
 * Return array of all updateable actions
 *
 * @param	empty
 * @return	array
 */
if (!function_exists('getAllUpdateActions')) {

    function getAllUpdateActions() {
        return array('delete', 'revert', 'permanent_delete', 'update');
    }

}

/**
 * renderResposeMessage
 *
 * Outputs html of flash message
 *
 * @param	string	msg attribute name
 * @param	array	passed attribute array
 * @return	html
 */
if (!function_exists('renderResposeMessage')) {

    function renderResposeMessage($msg_element, $pmsg = "") {
        $ci = & get_instance();
        ob_start();
        ?><div msg="<?php echo $msg_element; ?>">
            <div class="<?php echo $ci->session->flashdata('event') ? $ci->session->flashdata('event') : $pmsg["event"]; ?>"><?php echo $ci->session->flashdata('msg') ? $ci->session->flashdata('msg') : $pmsg["msg"]; ?></div>
        </div><?php
        return ob_get_clean();
    }

}

/**
 * afterLoginAdmin
 *
 * Return default url after login in admin
 *
 * @param	empty
 * @return	url
 */
if (!function_exists('afterLoginAdmin')) {

    function afterLoginAdmin() {
        return site_url() . 'admin/dashboard';
    }

}

/**
 * afterLoginFront
 *
 * Return default url after login in front end
 *
 * @param	empty
 * @return	url
 */
if (!function_exists('afterLoginFront')) {

    function afterLoginFront() {
        return site_url();
    }

}


/**
 * hasAccess
 *
 * Checks if any kind of access is there for a permission_id
 *
 * @param	int	permission id
 * @return	boolean	
 */
if (!function_exists('hasAccess')) {

    function hasAccess($permission_id) {
        $ci = & get_instance();
        return !$ci->login['parent'] or in_array($permission_id, $ci->login['grantedpermission']);
    }

}

/**
 * ifNotHasAccess
 *
 * If not has access then after event
 *
 * @param	int		permission id
 * @param	string	notification msg
 * @return	json	
 */
if (!function_exists('ifNotHasAccess')) {

    function ifNotHasAccess($permission_id, $msg) {
        if (!hasAccess($permission_id)) {
            echo json_encode(array("event" => "error", "msg" => $msg));
            exit();
        }
    }

}

/**
 * addPermission
 *
 * Check if add permission is there
 *
 * @param	int sector
 * @return	boolean	
 */
if (!function_exists('addPermission')) {

    function addPermission($sector) {
        if (hasAccess($sector))
            return true;
        else
            return false;
    }

}

/**
 * addPermissionMsg
 *
 * Check if add permission is there deal with msg
 *
 * @param	int sector
 * @param	string message optional
 * @return	true or error array	
 */
if (!function_exists('addPermissionMsg')) {

    function addPermissionMsg($sector, $msg = '') {
        if (!addPermission($sector))
            return array('event' => 'error', 'msg' => _e('access_denied'));
        else
            return true;
    }

}

/**
 * viewPermission
 *
 * Check if view permission is there
 *
 * @param	int all sector
 * @param	int child sector
 * @return	false/1/2	
 */
if (!function_exists('viewPermission')) {

    function viewPermission($allsector, $childsector) {
        if (hasAccess($allsector))
            return 1;
        elseif (hasAccess($childsector))
            return 2;
        else
            return false;
    }

}

/**
 * viewPermissionMsg
 *
 * Check if view permission is there
 *
 * @param	int all sector
 * @param	int child sector
 * @param	string message optional 
 * @return	false/array	
 */
if (!function_exists('viewPermissionMsg')) {

    function viewPermissionMsg($allsector, $childsector, $msg = "") {
        if (!viewPermission($allsector, $childsector))
            return array('event' => 'error', 'msg' => _e('access_denied'));
        else
            return true;
    }

}

/**
 * viewScope
 *
 * generate creator ids where have scope
 *
 * @param	int all sector
 * @param	int child sector
 * @return	false/query string in array	
 */
if (!function_exists('viewScope')) {

    function viewScope($column, $allsector, $childsector) {
        $vp = viewPermission($allsector, $childsector);
        if ($vp == 2) { // if child
            $ci = & get_instance();
            $allowed_user_id = array_merge(array($ci->login["user_id"]), $ci->login["childs"] ? $ci->login["childs"]["active"] : array() );
            return array($column . " IN ( " . implode(",", $allowed_user_id) . " )");
        }
        return false;
    }

}

/**
 * updatePermission
 *
 * Check if update/delete permission is there
 *
 * @param	int all sector
 * @param	int child sector
 * @return	false/1/2	
 */
if (!function_exists('updatePermission')) {

    function updatePermission($allsector, $childsector) {
        if (hasAccess($allsector))
            return 1;
        elseif (hasAccess($childsector))
            return 2;
        else
            return false;
    }

}

/**
 * updatePermissionMsg
 *
 * Check if update/delete permission is there and return message
 *
 * @param	int all sector
 * @param	int child sector
 * @param	string message optional 
 * @return	boolean	
 */
if (!function_exists('updatePermissionMsg')) {

    function updatePermissionMsg($allsector, $childsector, $msg = "") {
        if (!updatePermissionMsg($allsector, $childsector))
            return array('event' => 'error', 'msg' => _e('access_denied'));
        else
            return true;
    }

}

/**
 * getBizDomainHelper
 *
 * load biz domain module
 * @param	empty
 * @return	array
 */
if (!function_exists('getBizDomainHelper')) {

    function getBizDomainHelper() {
        $ci = & get_instance();
        $ci->load->module('biz_type/biz_type_admin');
        $biz_domain = $ci->biz_type_admin->getBizDomain();
        return array('' => _e('choose_biz_domain')) + $biz_domain;
    }

}

/**
 * getBizTypeHelper
 *
 * load biz type module
 *
 * @param	empty
 * @return	array
 */
if (!function_exists('getBizTypeHelper')) {

    function getBizTypeHelper($biz_domain_id = '') {
        $ci = & get_instance();
        $ci->load->module('biz_type/biz_type_admin');
        $biz_type = $ci->biz_type_admin->getBizTypesByDomain($biz_domain_id);
        return array('' => _e('choose_biz_type')) + $biz_type;
    }

}

/**
 * getCountryHelper
 *
 * load country module
 *
 * @param	empty
 * @return	array
 */
if (!function_exists('getCountryHelper')) {

    function getCountryHelper() {
        $ci = & get_instance();
        $ci->load->module('country/country_admin');
        $country = $ci->country_admin->getCountries();
        return array('' => _e('choose_country')) + $country;
    }

}

/**
 * showImage
 *
 * get image
 *
 * @param	image_data, con ; image_data = (image, is_trust, is_delete,is_main) , con = ( 1 = single image retrive 2 = multiple image retrive )  
 * @return	image
 */
if (!function_exists('showImage')) {

    function showImage($img_data, $con, $type, $noimage) {
        $ci = & get_instance();
        $image = explode('[@]', $img_data);
        foreach ($image as $data):
            $img = explode(',', $data);
            if ($con == '1' && $img[1] == $type) {
                if ($img[2] == 0 && $img[3] == 0 && $img[4] == 1)
                    return $img[0];
                else
                    $imgdata = $noimage;
            }
            elseif ($con == '2' && $img[1] == $type) {
                if ($img[2] == 0 && $img[3] == 0) // this section till now not use for multiple image
                    $re_img[] = $img[0];
                else
                    $re_img[] = $noimage;
                $imgdata = $re_img;
            } else
                $imgdata = $noimage;
        endforeach;
        return $imgdata;
    }

}



/**
 * showBiz
 *
 * get Biz
 *
 * @param	data set, return ; 
 * @return	which requer
 */
if (!function_exists('showBiz')) {

    function showBiz($biz_data, $return) {
        $ci = & get_instance();
        $biz = explode(',', $biz_data);
        if ($return == '0')
            $bizreturn[$return] = $biz[0];
        if ($return == '2')
            $bizreturn[$return] = $biz[2];
        if ($return == '1')
            $bizreturn[$return] = $biz[1];
        if ($return == '3')
            $bizreturn[$return] = $biz[3];
        return $bizreturn[$return];
    }

}


/**
 * showImageBroker
 *
 * get Biz image
 *
 * @param	id ; 
 * @return	image
 */
if (!function_exists('showImageBroker')) {

    function showImageBroker($id) {
        $ci = & get_instance();
        $ci->load->module('image/image_admin');
        $bizimg = $ci->image_admin->getBizImageById($id);
        if ($bizimg == '')
            return 'bizlisting/business4sale.png';
        else
            return $bizimg;
    }

}

/**
 * getRealIpAddr
 *
 * get user ip address
 *
 * @param	empty
 * @return	ip address
 */
function getRealIpAddr() {
	if( $_SERVER['HTTP_HOST'] == "localhost" ){
	    $ip = "122.163.86.27";	
	} elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

/**
 * ipDetails
 *
 * get user ip details
 *
 * @param	ip
 * @return	ip details
 */
function ipDetails($IPaddress) {
    $json = file_get_contents("http://ipinfo.io/{$IPaddress}/geo");
    $details = json_decode($json);
    return $details;
}

/**
 * doAction
 *
 * This function called when updateable sql query called
 *
 * @param	string	may be delete, revert, permanent_delete, update
 * @param	integer|array	may be single or multiple id
 * @param	boolean	if redirection required or not
 * @param	array	data set
 * @param	array	config value
 * @return	array	response message or redirection
 */
if (!function_exists('doAction')) {

    function doAction($model, $action, $row_id, $redirect = false, $DATAVAR = '', $CFG = '') {
        if (in_array($action, getAllUpdateActions())) {
            $ci = & get_instance();
            $return = false;
            if (is_array($CFG)) {
                $has_permission = updatePermission($CFG['sector']['edit_all'], $CFG['sector']['edit_child']);
                if (!$has_permission)
                    $return = array("event" => "error", "msg" => _e('access_denied'));
                elseif ($has_permission == 2) {
                    $records = "";
                    if (is_array($row_id)) {
                        foreach ($row_id as $id) {
                            $where[] = $CFG['table_name'] . '.' . $CFG['ai_id'] . " = " . $id;
                        }
                        $where = array('( ' . implode(" or ", $where) . ' )');
                    } else
                        $where[] = array($CFG['table_name'] . '.' . $CFG['ai_id'], $row_id);
                    $records = $ci->$model->getRecords($where);
                    $creator_ids = returnCreatorIDs($records);
                    if (!$creator_ids)
                        $return = array("event" => "error", "msg" => _e('no_record_found'));
                    $scope_on_user = array_merge(array($ci->login["user_id"]), $ci->login["childs"] ? $ci->login["childs"]["active"] : array());
                    $user_diff = array_diff($creator_ids, $scope_on_user);
                    if ($user_diff)
                        $return = array("event" => "error", "msg" => _e('access_denied'));
                }
            }
            if (!$return) {
                $affected = $ci->$model->dbUpdate($action, $row_id, $DATAVAR);
				$affected = $DATAVAR["affected_from_outside"] ? true : $affected;
                $return = array("event" => ($affected ? 'success' : 'error'), "msg" => ($affected ? _e($action . 'successmsg') : _e($action . 'errormsg')));
            }

            ## incase of page reloading ##
            if (!$redirect)
                return $return;
            ##  incase of ajax ##
            if ($action == 'update')
                return $return;
            else {
                $ci->session->set_flashdata($return);
                redirect(filterUrlByAction($action));
            }
        }
    }

}

/**
 * returnCreatorIDs
 *
 * This function return creator ids from the array which is passed
 *
 * @param	array	recordsets
 * @return	array	creator ids
 */
if (!function_exists('returnCreatorIDs')) {

    function returnCreatorIDs($datas) {
        if (empty($datas))
            return false;
        $c_ids = array();
        foreach ($datas as $data)
            $c_ids[] = $data->creator_id;
        return $c_ids;
    }

}

/**
 *  $distance: 
 * 	 This routine calculates the distance between two points (given the      
 *   latitude/longitude of those points). It is being used to calculate     
 *   the distance between two locations                                     
 *                                                                         
 *   @Definitions:                                                          
 *     South latitudes are negative, east longitudes are positive           
 *                                                                         
 *   @Passed to function:                                                    
 *     lat1, lon1 = Latitude and Longitude of point 1 (in decimal degrees)  
 *     lat2, lon2 = Latitude and Longitude of point 2 (in decimal degrees)   
 *
 *   @return : 
 * 	   unit = the unit you desire for results                               
 *     where: 'M' is statute miles (default)                        
 *     'K' is kilometers                                     
 *     'N' is nautical miles                                  
 */
function distance($lat1, $lon1, $lat2, $lon2, $unit) {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        return sprintf("%.2f", ($miles * 1.609344)) . ' ' . 'Kilometer';
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles . ' ' . 'Miles';
    }
}

/**
 * getClientCountryIds
 *
 * This function return client country id
 *
 * @param	empty
 * @return	country id
 */
function getClientCountryIds() {
    return array(get_cookie('custom_country_id'), get_cookie('default_country_id'));
}

/**
 * placeCountryId
 * This function return the country id in the following order first url country id, next client country id, atlast default country id
 * 
 * @return suitable country id
*/
function placeCountryId( $country_id = "", $client_country_id = "", $default_country_id = "" ){		
	if( $country_id )
		return $country_id;
	elseif( $client_country_id )
		return $client_country_id;
	elseif( $default_country_id )	
		return $default_country_id;
	else	
		return 0;
		
}

/**
 * getClientProvinceId
 *
 * This function return client province id
 *
 * @param	empty
 * @return	province id
 */
function getClientProvinceId() {
    $ci = & get_instance();
    return get_cookie('custom_province_id');
}

/**
 * getRegisterParam
 *
 * This function return register param exist in url
 *
 * @param	empty
 * @return	array
 */
function getRegisterParam() {
    $ci = & get_instance();
	
    $user_category = $ci->input->get('ct');
	$user_role = $ci->input->get('rl');
	$register_param = array();
	if( $user_category )
		$register_param[] = "ct=".$user_category;
	if( $user_role )
		$register_param[] = "rl=".$user_role;
	return $register_param;
}

/**
 * setRegisterParam
 *
 * This function return register param to pass in url
 *
 * @param	user_category
 * @param	user_role
 * @return	array
 */
function setRegisterParam($user_category, $user_role) {
    $ci = & get_instance();
	$register_param = array();
	if( $user_category )
		$register_param[] = "ct=".$user_category;
	if( $user_role )
		$register_param[] = "rl=".$user_role;
	return $register_param;
}

/* End of file basic_helper.php */
/* Location: ./application/helpers/basic_helper.php */