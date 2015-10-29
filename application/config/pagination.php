<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['pagination']['default_per_page']		= 5;
$config['pagination']['num_links'] 				= 9;
$config['pagination']['use_page_numbers'] 		= TRUE;
$config['pagination']['page_query_string'] 		= TRUE;
$config['pagination']['query_string_segment'] 	= 'page';

$config['pagination']['full_tag_open'] 			= '<div class="pagination"><ul>';
$config['pagination']['full_tag_close'] 		= '</ul></div><!--pagination-->';

$config['pagination']['first_link'] 			= '&laquo; First';
$config['pagination']['first_tag_open'] 		= '<li class="prev page">';
$config['pagination']['first_tag_close'] 		= '</li>';

$config['pagination']['last_link'] 				= 'Last &raquo;';
$config['pagination']['last_tag_open'] 			= '<li class="next page">';
$config['pagination']['last_tag_close'] 		= '</li>';

$config['pagination']['next_link'] 				= 'Next &rarr;';
$config['pagination']['next_tag_open'] 			= '<li class="next page">';
$config['pagination']['next_tag_close'] 		= '</li>';

$config['pagination']['prev_link'] 				= '&larr; Previous';
$config['pagination']['prev_tag_open'] 			= '<li class="prev page">';
$config['pagination']['prev_tag_close'] 		= '</li>';

$config['pagination']['cur_tag_open'] 			= '<li class="active"><a href="">';
$config['pagination']['cur_tag_close'] 			= '</a></li>';

$config['pagination']['num_tag_open'] 			= '<li class="page">';
$config['pagination']['num_tag_close'] 			= '</li>';

$config['pagination']['anchor_class'] 			= 'class="pagintn"';