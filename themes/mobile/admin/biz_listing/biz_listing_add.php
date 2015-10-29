<?php ### Top Section Begin ### ?>
<?php echo $top ?>
<?php ### Top Section End ### ?>
<?php 
### If No Error Begin ###
if(!$response["event"]["error"]):?>
<?php echo form_open( '', array( 'name' => 'biz_listing_add_form', 'id' => 'biz_listing_add_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) )?> <?php echo form_label( '<p>'._e( 'Headline' ).'</p>', 'headline' )?> <?php echo form_input( array( 'name' => 'headline', 'id' => 'headline', 'placeholder' => 'add headline here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'Headline' ), 'data-rules' => 'required') );?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Tagline' ).'</p>', 'tagline' )?>
<?php echo form_input( array( 'name' => 'tagline', 'id' => 'tagline', 'placeholder' => 'add tagline here', 'class' => 'validate', 'data-display' =>  _e( 'Tagline' ), 'data-rules' => 'required') );?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Description' ).'</p>', 'description' )?>
<?php echo form_textarea( array( 'name' => 'description', 'id' => 'description', 'placeholder' => 'add description here', 'class' => 'validate', 'data-display' =>  _e( 'Description' ), 'rows' => 5, 'data-rules' => 'required') );?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Type of Business' ).'</p>', 'biz_type_id' )?>
<?php echo form_dropdown('biz_type_id', $var['biz_types_dd'], $this->input->get('biz_type_id'), 'id="biz_type_id" class="validate" data-display="'._e( 'Type of Business' ).'" data-rules="required"');?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Other Business type' ).'</p>', 'other_biz_type_id' )?>
<?php echo form_dropdown('other_biz_type_id', $var['biz_types_dd'], $this->input->get('other_biz_type_id'), 'id="other_biz_type_id"');?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Country' ).'</p>', 'country_id' )?>
<?php echo form_dropdown('country_id', $var['countries_dd'], $this->input->get('country_id'), 'id="country_id" onchange="getProvinceByCountry(this)" data-province-sel="#province_id" class="validate" data-display="'._e( 'Country' ).'" data-rules="required"');?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'State/Province' ).'</p>', 'province_id' )?>
<?php echo form_dropdown('province_id', $var['provinces_dd'], '', 'id="province_id" disabled="disabled" onchange="getCountyByProvince(this)" data-county-sel="#county_id" class="validate" data-display="'._e( 'Province' ).'" data-rules="required"');?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'County' ).'</p>', 'county_id' )?>
<?php echo form_dropdown('county_id', $var['counties_dd'], '', 'id="county_id" disabled="disabled" class="validate" data-display="'._e( 'County' ).'" data-rules="required"');?>
<div class="clear"></div>
<?php echo form_checkbox('is_county_cnfdntl', 1, '', 'id="is_county_cnfdntl" disabled="disabled"');?>
<?php echo form_label( '<p>'._e( 'Keep the county information confidential' ).'</p>', 'is_county_cnfdntl' )?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'City' ).'</p>', 'city' )?>
<?php echo form_input( array( 'name' => 'city', 'id' => 'city', 'placeholder' => 'city' ) );?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Asking Price' ).'</p>', 'asking_price' )?>
<?php echo form_input( array( 'name' => 'asking_price', 'id' => 'asking_price', 'placeholder' => 'asking price' ) );?>
<div class="clear"></div>
<?php echo form_checkbox('is_fincng_avlble', 1, '', 'id="is_fincng_avlble"');?>
<?php echo form_label( '<p>'._e( 'Seller financing is available' ).'</p>', 'is_fincng_avlble' )?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Year Established' ).'</p>', 'year_established' )?>
<?php echo form_input( array( 'name' => 'year_established', 'id' => 'year_established', 'placeholder' => 'e.g. 1999' ) );?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Employees' ).'</p>', 'employees' )?>
<?php echo form_input( array( 'name' => 'employees', 'id' => 'employees', 'placeholder' => 'e.g. 8 FTE; 4 PTE' ) );?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Business Website' ).'</p>', 'biz_website' )?>
<?php echo form_input( array( 'name' => 'biz_website', 'id' => 'biz_website', 'placeholder' => 'add business website here' ) );?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Gross Revenue' ).'</p>', 'gross_revenue' )?>
<?php echo form_input( array( 'name' => 'gross_revenue', 'id' => 'gross_revenue', 'placeholder' => 'add gross revenue here' ) );?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Gross Revenue Comments' ).'</p>', 'gross_revenue_comments' )?>
<?php echo form_input( array( 'name' => 'gross_revenue_comments', 'id' => 'gross_revenue_comments', 'placeholder' => 'add gross revenue comments here' ) );?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Cash Flow' ).'</p>', 'cash_flow' )?>
<?php echo form_input( array( 'name' => 'cash_flow', 'id' => 'cash_flow', 'placeholder' => 'add cash flow here' ) );?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Cash Flow Comments' ).'</p>', 'cash_flow_comments' )?>
<?php echo form_input( array( 'name' => 'cash_flow_comments', 'id' => 'cash_flow_comments', 'placeholder' => 'add cash flow comments here' ) );?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Value of Inventory' ).'</p>', 'inv_value' )?>
<?php echo form_input( array( 'name' => 'inv_value', 'id' => 'inv_value', 'placeholder' => 'add value of inventory here' ) );?>
<div class="clear"></div>
<?php echo form_checkbox('is_inv_included', 1, '', 'id="is_inv_included"');?>
<?php echo form_label( '<p>'._e( 'Inventory is included in asking price.' ).'</p>', 'is_inv_included' )?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Value of FF&E' ).'</p>', 'ffe_value' )?>
<?php echo form_input( array( 'name' => 'ffe_value', 'id' => 'ffe_value', 'placeholder' => 'add Furniture, Fixtures, and Equipment price here' ) );?>
<div class="clear"></div>
<?php echo form_checkbox('is_ffe_included', 1, '', 'id="is_ffe_included"');?>
<?php echo form_label( '<p>'._e( 'Furniture, Fixtures, and Equipment included in asking price.' ).'</p>', 'is_ffe_included' )?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Value of Real Estate' ).'</p>', 'rs_value' )?>
<?php echo form_input( array( 'name' => 'rs_value', 'id' => 'rs_value', 'placeholder' => 'add real estate price here' ) );?>
<div class="clear"></div>
<?php echo form_checkbox('is_rs_included', 1, '', 'id="is_rs_included"');?>
<?php echo form_label( '<p>'._e( 'Real Estate included in asking price.' ).'</p>', 'is_rs_included' )?>
<div class="clear"></div>
<?php echo form_checkbox('is_biz_relctble', 1, '', 'id="is_biz_relctble"');?>
<?php echo form_label( '<p>'._e( 'Business is relocatable.' ).'</p>', 'is_biz_relctble' )?>
<div class="clear"></div>
<?php echo form_checkbox('is_biz_franchis', 1, '', 'id="is_biz_franchis"');?>
<?php echo form_label( '<p>'._e( 'Business is a franchise.' ).'</p>', 'is_biz_franchis' )?>
<div class="clear"></div>
<?php echo form_checkbox('is_biz_hb', 1, '', 'id="is_biz_hb"');?>
<?php echo form_label( '<p>'._e( 'Business is home based' ).'</p>', 'is_biz_hb' )?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Seller Financing Info.' ).'</p>', 'seller_fincng_info' )?>
<?php echo form_textarea( array( 'name' => 'seller_fincng_info', 'id' => 'seller_fincng_info', 'placeholder' => 'add seller financing info here', 'rows' => 5) );?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Training & Support' ).'</p>', 'training_support' )?>
<?php echo form_textarea( array( 'name' => 'training_support', 'id' => 'training_support', 'placeholder' => 'add training support info here', 'rows' => 5) );?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Reason for Selling' ).'</p>', 'selling_reason' )?>
<?php echo form_textarea( array( 'name' => 'selling_reason', 'id' => 'selling_reason', 'placeholder' => 'add reason for selling here', 'rows' => 5) );?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Facilities' ).'</p>', 'facilities' )?>
<?php echo form_textarea( array( 'name' => 'facilities', 'id' => 'facilities', 'placeholder' => 'add facilities here', 'rows' => 5) );?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Market Outlook/Competition' ).'</p>', 'mkt_outlook_cmp' )?>
<?php echo form_textarea( array( 'name' => 'mkt_outlook_cmp', 'id' => 'mkt_outlook_cmp', 'placeholder' => 'add about market outlook and competition info here', 'rows' => 5) );?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'Keywords' ).'</p>', 'keywords' )?>
<?php echo form_textarea( array( 'name' => 'keywords', 'id' => 'keywords', 'placeholder' => 'add about keywords here', 'rows' => 5) );?>
<?php echo form_label( '<p>'._e( 'Images' ).'</p>', 'images' )?>
<div id="imageUpload">
<div class="imageplacer"><span class="otherbutton"></span><?php echo form_upload( array( 'name' => 'images[]', 'placeholder' => 'add images' ) );?></div>
<a href="#" class="add_more_images" onclick="return addMoreElement('#imageUpload', '.otherbutton', '<div class=\'imageplacer\'>', '</div>', this)">Add more</a>
</div>
<div class="clear"></div>
<?php echo form_hidden('method', 'add'); ?>
<?php echo form_submit( array( 'name' => 'biz_listing_add', 'id' => 'biz_listing_add', 'class' => 'margin-top10' ), _e( 'Add' ) );?> <?php echo form_close()?>
<?php
$js = $this->template->admin_view( 'biz_listing_js', '', true, "biz_listing");
$this->template->embed_asset_code('admin', 'js', 'biz-listing-js', $js);

$province_js_function = $this->load->view("web/admin/province/province_js_function.php", '', true, "biz_listing");
$this->template->embed_asset_code('admin', 'js', 'province_js_function', $province_js_function);

$county_js_function = $this->load->view("web/admin/county/county_js_function.php", '', true, "biz_listing");
$this->template->embed_asset_code('admin', 'js', 'county_js_function', $county_js_function);
endif;
### If No Error End ###
?>
