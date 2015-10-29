<?php echo $top ?>
<?php if(!$response["event"]["error"]):?>
<div class="slide-controller">
<div id="stepsform">
  <div msg="biz_listing"></div>
  <div class="width100 float-left"><a href="javascript:history.back()" class="btn-type1 margin-right10 margin-top10 float-left"><span class="ion-android-system-back"></span><?php echo _e( 'back' ); ?></a></div>
  <div msg="biz_listing_third"></div>
  <div class="form_three-forth"><ul>
<?php echo form_open( '', array( 'name' => 'biz_listing_edit_form', 'id' => 'biz_listing_edit_form', 'class' => 'width100 float-left margin-top10' ) )?> <?php echo form_hidden('row_id', $results); ?> <?php echo form_hidden('status', '2'); ?> <?php echo form_hidden('user_id',$user_id); ?>
<li> <?php echo form_label( '<dfn>'._e( 'Year Established' ).'</dfn>', 'year_established' )?> <?php echo form_input( array( 'name' => 'year_established', 'id' => 'year_established', 'placeholder' => 'e.g. 1999' ) );?> </li>

   <li><?php echo form_label( '<dfn>'._e( 'Employees' ).'</dfn>', 'employees' )?> <?php echo form_input( array( 'name' => 'employees', 'id' => 'employees', 'placeholder' => 'e.g. 8 FTE; 4 PTE' ) );?></li>
  <li><?php echo form_label( '<dfn>'._e( 'Business Website' ).'</dfn>', 'biz_website' )?> <?php echo form_input( array( 'name' => 'biz_website', 'id' => 'biz_website', 'placeholder' => 'add business website here' ) );?></li>
 <li><?php echo form_label( '<dfn>'._e( 'Gross Revenue' ).'</dfn>', 'gross_revenue' )?> <?php echo form_input( array( 'name' => 'gross_revenue', 'id' => 'gross_revenue', 'placeholder' => 'add gross revenue here' ) );?></li> 
 
 <li><?php echo form_label( '<dfn>'._e( 'Gross Revenue Comments' ).'</dfn>', 'gross_revenue_comments' )?> <?php echo form_input( array( 'name' => 'gross_revenue_comments', 'id' => 'gross_revenue_comments', 'placeholder' => 'add gross revenue comments here' ) );?></li>
 
 <li><?php echo form_label( '<dfn>'._e( 'Cash Flow' ).'</dfn>', 'cash_flow' )?> <?php echo form_input( array( 'name' => 'cash_flow', 'id' => 'cash_flow', 'placeholder' => 'add cash flow here' ) );?></li>
  <li> <?php echo form_label( '<dfn>'._e( 'Cash Flow Comments' ).'</dfn>', 'cash_flow_comments' )?> <?php echo form_input( array( 'name' => 'cash_flow_comments', 'id' => 'cash_flow_comments', 'placeholder' => 'add cash flow comments here' ) );?> </li>
   <li><?php echo form_label( '<dfn>'._e( 'Value of Inventory' ).'</dfn>', 'inv_value' )?> <?php echo form_input( array( 'name' => 'inv_value', 'id' => 'inv_value', 'placeholder' => 'add value of inventory here' ) );?><br /> <label><?php echo form_checkbox('is_inv_included', 1, '', 'id="is_inv_included"');?> <span class="font11"><?php echo _e(' Inventory is included in asking price.' )?></span></label></li>
   <li><?php echo form_label( '<dfn>'._e( 'Value of FF&E' ).'</dfn>', 'ffe_value' )?> <?php echo form_input( array( 'name' => 'ffe_value', 'id' => 'ffe_value', 'placeholder' => 'add Furniture, Fixtures, and Equipment price here' ) );?><br /> <label><?php echo form_checkbox('is_ffe_included', 1, '', 'id="is_ffe_included"');?> <span class="font11"><?php echo _e(' Furniture, Fixtures, and Equipment included in asking price.' )?></span></label></li>


 <li><?php echo form_label( '<dfn>'._e( 'Value of Real Estate' ).'</dfn>', 'rs_value' )?> <?php echo form_input( array( 'name' => 'rs_value', 'id' => 'rs_value', 'placeholder' => 'add real estate price here' ) );?><br /> <label><?php echo form_checkbox('is_rs_included', 1, '', 'id="is_rs_included"');?> <span class="font11"><?php echo _e(' Real Estate included in asking price.' )?></span></label><br /> <label><?php echo form_checkbox('is_biz_relctble', 1, '', 'id="is_biz_relctble"');?> <span class="font11"><?php echo _e(' Business is relocatable.' )?></span> </label><br /><label><?php echo form_checkbox('is_biz_franchis', 1, '', 'id="is_biz_franchis"');?> <span class="font11"><?php echo _e(' Business is a franchise.' )?></span></label> <br /> <label><?php echo form_checkbox('is_biz_hb', 1, '', 'id="is_biz_hb"');?> <span class="font11"><?php echo _e(' Business is home based' )?></span></label></li>

  <li> <?php echo form_label( '<dfn>'._e( 'Seller Financing Info.' ).'</dfn>', 'seller_fincng_info' )?> <?php echo form_textarea( array( 'name' => 'seller_fincng_info', 'id' => 'seller_fincng_info', 'placeholder' => 'add seller financing info here', 'rows' => 5) );?></li>
 <li><?php echo form_label( '<dfn>'._e( 'Training & Support' ).'</dfn>', 'training_support' )?> <?php echo form_textarea( array( 'name' => 'training_support', 'id' => 'training_support', 'placeholder' => 'add training support info here', 'rows' => 5) );?></li>
  <li><?php echo form_label( '<dfn>'._e( 'Reason for Selling' ).'</dfn>', 'selling_reason' )?> <?php echo form_textarea( array( 'name' => 'selling_reason', 'id' => 'selling_reason', 'placeholder' => 'add reason for selling here', 'rows' => 5) );?></li>
  <li><?php echo form_label( '<dfn>'._e( 'Facilities' ).'</dfn>', 'facilities' )?> <?php echo form_textarea( array( 'name' => 'facilities', 'id' => 'facilities', 'placeholder' => 'add facilities here', 'rows' => 5) );?></li>
  <li><?php echo form_label( '<dfn>'._e( 'Market Outlook/Competition' ).'</dfn>', 'mkt_outlook_cmp' )?> <?php echo form_textarea( array( 'name' => 'mkt_outlook_cmp', 'id' => 'mkt_outlook_cmp', 'placeholder' => 'add about market outlook and competition info here', 'rows' => 5) );?></li>
<li>  <?php echo form_label( '<dfn>'._e( 'Keywords' ).'</dfn>', 'keywords' )?> <?php echo form_textarea( array( 'name' => 'keywords', 'id' => 'keywords', 'placeholder' => 'add about keywords here', 'rows' => 5) );?></li>
</ul>
</div>
<?php  echo $sidebar; ?>
<div class="float-left margin-left355 margin-top20"> <?php echo form_submit( array( 'name' => 'biz_listing_update', 'id' => 'biz_listing_update', 'class' => 'float-right blue margin-left10 margin-top10' ), _e( 'Continue' ) );?> &nbsp;&nbsp;
  <input type="button" value="Preview &rarr;" class="float-right orange margin-top10"  id = "pri" name = "pri"/>
  <?php echo form_close()?></div>
  <?php
$js = $this->template->frontend_view( 'biz_listing_js_third', '', true, "biz_listing");
$this->template->embed_asset_code('frontend', 'js', 'biz-listing-js-third', $js);

$province_js_function = $this->load->view("web/admin/province/province_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'province_js_function', $province_js_function);

$county_js_function = $this->load->view("web/admin/county/county_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'county_js_function', $county_js_function);
endif;
### If No Error End ###
?>
</div>
<?php echo $footer; 
$biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);
?>