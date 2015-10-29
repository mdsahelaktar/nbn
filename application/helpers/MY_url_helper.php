<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * CodeIgniter My Url Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Webzstore Solutions
 */

// ------------------------------------------------------------------------

/**
 * paginationBaseUrl
 *
 * Outputs base url for pagination depend upon module
 *
 * @param	array	pagination config found in module
 * @return	string	link
 */
if( ! function_exists('paginationBaseUrl') )
{
	function paginationBaseUrl($paginationCFG)
	{
		$ci =& get_instance();
		$get = $ci->input->get() ? $ci->input->get() : array();
		unset($get[$paginationCFG['query_string_segment']]);
		return '?'.http_build_query($get, '', '&');
	}
}

/**
 * createEditUrl
 *
 * Outputs edit url
 *
 * @param	array	edit id
 * @param	array	if some customized data need to send from outside 
 * @return	string	link
 */
if( ! function_exists('createEditUrl') )
{
	function createEditUrl($edit_id, $data = "")
	{
		$ci =& get_instance();
		$get = is_array( $data ) ? $data : ( $ci->input->get() ? $ci->input->get() : array() );
		$get = array_merge( $get, array( "edit_id" => $edit_id ) );
		$edit_url = '?'.http_build_query($get, '', '&');		
		return $edit_url;
	}
}

/**
 * createRevertDeleteUrl
 *
 * Outputs delete or revert url
 *
 * @param	array	id
 * @param	int		status for delete and revert(undo)
 * @param	array	if some customized data need to send from outside 
 * @return	string	link
 */
if( ! function_exists('createRevertDeleteUrl') )
{
	function createRevertDeleteUrl($id, $status, $data = "")
	{
		$ci =& get_instance();
		$get = is_array( $data ) ? $data : ( $ci->input->get() ? $ci->input->get() : array() );
		switch($status)
		{
			case 0 :
				 $get = array_merge($get, array( 'row_id' => $id, 'action' => 'delete' ));
				 break;
			case 1 :
				 $get = array_merge($get, array( 'row_id' => $id, 'action' => 'revert' ));	 
		}
		$revert_delete_url = '?'.http_build_query($get, '', '&');				
		return $revert_delete_url;
	}
}

/**
 * filterUrlByAction
 *
 * Outputs url filtered by action
 *
 * @param	empty
 * @param	array	if some customized data need to send from outside 
 * @return	string	link
 */
if( ! function_exists('filterUrlByAction') )
{
	function filterUrlByAction( $data = "" )
	{
		$ci =& get_instance();
		$get = is_array( $data ) ? $data : ( $ci->input->get() ? $ci->input->get() : array() );
		unset($get['action']);
		unset($get['row_id']);		
		$filter_url = current_url().(count( $get ) ? '?'.http_build_query($get, '', '&') : '');				
		return $filter_url;
	}
}

/**
 * getBackUrl
 *
 * Outputs previous url
 *
 * @param	empty
 * @param	array	if some customized data need to send from outside 
 * @return	string	link
 */
if( ! function_exists('getBackUrl') )
{
	function getBackUrl($unsetkey, $data = "")
	{
		$ci =& get_instance();
		$get = is_array( $data ) ? $data : ( $ci->input->get() ? $ci->input->get() : array() );
		unset($get[$unsetkey]);
		$back_url = current_url().(count( $get ) ? '?'.http_build_query($get, '', '&') : '');				
		return $back_url;
	}
}

/**
 * currentBrowserUrl
 *
 * return current browser url
 *
 * @param	empty
 * @return	string	link
 */
if( ! function_exists('currentBrowserUrl') )
{
	function currentBrowserUrl()
	{
		return isAjax() ? $_SERVER['HTTP_REFERER'] : current_url();
	}
}

// ------------------------------------------------------------------------
/* End of file MY_url_helper.php */
/* Location: ./application/helpers/MY_url_helper.php */