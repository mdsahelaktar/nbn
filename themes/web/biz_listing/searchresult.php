<?php
$config_var = $this->config->item('var');
$var = array_merge( $config_var, $var );
?>
<div id="body">
  <div class="wrapper">
    <div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
      <div class="float-left padding-bottom20 margin-bottom20">
        <div class="width725 float-left">
          <h2 class="helvetica float-left" id="upperstring"></h2>
          <p id="change"> </p>
          <div class="width95 float-left bg-blue padding-top10 padding-bottom10 padding-left20 padding-right20 margin-top20 radius4">
            <p class="float-left white" id="remv"></p>
            <ul class="float-right">
              <li class="float-left margin-right25"><a href="#" target="_self" class="savesearch global"><?php echo _e('Save this search') ?></a></li>
              <li class="float-left"><?php echo anchor( 'user', _e( 'Create an Email Alert' ), array( 'class' => 'email-alert global' ) )?></li>
            </ul>
          </div>
          <div class="width95 bg-grey padding-bottom10 padding-left20 padding-right20 padding-top10 float-left margin-top20 margin-bottom15">
            <p class="font14"><?php echo _e('Refine Your Search Here or go to') ?> <a href="#" target="_self" class="global"><?php echo _e('Advanced Search for More Options')?></a></p>
            <div class="formwrap-searchresult"> <?php echo form_open( '', array( 'name' => 'inner_search_form', 'id' => 'srpform', 'class' => 'margin-top15', 'method' => 'post' ,'onsubmit' => 'return searchBizForm(this)') )?>
              <ul>
                <li>
                  <div class="customeselect"> <?php echo form_label( '<dfn>'._e( 'Country' ).'</dfn>', 'country_id' )?> <?php echo form_dropdown('country_id', $var['country_dd'], $country_id, 'id="country_id" onchange="getProvinceByCountry(this)" data-province-sel="#province_id" data-display="'._e( 'Location' ).'" data-rules="required"'); ?> </div>
                </li>
                <li>
                  <div class="customeselect"> <?php echo form_label( '<dfn>'._e( 'Location' ).'</dfn>', 'province_id' )?> <?php echo form_dropdown('province_id', $var['provinces_dd'], $province_id, 'id="province_id"  onchange="getCountyByProvince(this)" data-county-sel="#county_id" data-display="'._e( 'Province' ).'" data-rules="required"');?> </div>
                </li>
                <li>
                  <div class="customeselect"> <?php echo form_label( '<dfn>'._e( 'County' ).'</dfn>', 'county_id' )?> <?php echo form_dropdown('county_id', $var['counties_dd'], $county_id,'id="county_id" disabled="disabled" class="validate" data-display="'._e( 'County' ).'" data-rules="required"');?> </div>
                </li>
                <li>
                  <div class="customeselect"> <dfn>Min Price:</dfn> <?php echo form_dropdown('asking_price_min', $var['askingprice_dd_min'], $asking_price_min, 'id="asking_price_min"');?> </div></li>
                  <li><dfn>Max Price:</dfn><div class="customeselect"> <?php echo form_dropdown('asking_price_max', $var['askingprice_dd_max'], $asking_price_max, 'id="asking_price_max"');?> </div>
                </li>
                <li>
                  <div class="customeselect"> <dfn>Industry:</dfn> <?php echo form_dropdown('biz_domain_id', $var['biz_domain_dd'], $biz_domain_id, 'id="biz_domain_id" data-biztype-sel="#biz_type_id" data-display="'._e( 'Type of Business' ).'" data-rules="required" onchange="getBizTypeByBizDomain(this)"'); ?> </div>
                </li>
                <li>
                  <div class="customeselect"> <dfn>Segment:</dfn> <?php echo form_dropdown('biz_type_id', $var['biz_types_dd'], $biz_type_id, 'id="biz_type_id"  data-display="'._e( 'Type of Business' ).'"');?> </div>
                </li>
                <div class="slidediv">
                <li>
                    <div class="customeselect">
                      <dfn><?php echo _e('Show Businesses Listed:') ?>
                      </dfn>
                      <select name="show<strong></strong>_biz_list_bydate" id="show_biz_list_bydate">
                        <option value = "2">Anytime</option>
                        <option value = "3">last 3 days</option>
                        <option value = "7">last 7 days</option>
                        <option value = "30">last 30 days</option>
                      </select>
                    </div>
                  </li>
                  <li><dfn>&nbsp;</dfn>
                    <input type="text" name="grh" value="" id="grh" placeholder="<?php echo _e('Gross Revenue High') ?>">
                  </li>
                  <li><dfn>&nbsp;</dfn>
                    <input type="text" name="grl" value="" id="grl" placeholder="<?php echo _e('Gross Revenue Low') ?>">
                  </li>
                  <li><dfn>&nbsp;</dfn>
                    <input type="text" name="cfh" value="" id="cfh" placeholder="<?php echo _e('Cash Flow High') ?>">
                  </li>
                  <li><dfn>&nbsp;</dfn>
                    <input type="text" name="cfl" value="" id="cfl" placeholder="<?php echo _e('Cash Flow Low') ?>">
                  </li>
                  
                  <li><dfn>&nbsp;</dfn>
                    <input type="text" name="cklsearch" value="<?php echo $cklsearch; ?>" id="cklsearch"  placeholder="City, Keyword or Listing ID">
                  </li>
                  <li class="margin-top20">
                    <label>
                      <input type="checkbox" name="is_fincng_avlble" id="is_fincng_avlble" value="1">
                      Only show listings with Seller Financing</label>
                  </li>
                </div>
              </ul>
              <div class="buttonscont"> <?php echo form_submit( array( 'name' => 'inner_search', 'id' => 'inner_search', 'class' => 'orange radius4' , 'style' => 'padding: 9px 22px'), _e( 'Search' ) );?> <?php echo form_close()?> <a href="#" class="showhide"><?php echo _e('Advance Search') ?></a> </div>
            </div>
          </div>
          <div class="width100 float-left" id="srpdetails">
            <div class="width100 float-left" id="stop">
              <div class="float-left width20 margin-top20"> </div>
              <div id="show"></div>
              <div id="sortby">
                <div class="customeselect"> <strong class="float-left margin-top5">Sort by:</strong>
                  <select sort-active="false" name="sortbyopt" id="sortbyopt" onchange="sortBizChange(this)">
                    <option value = "">Select Option</option>
                    <option value = "0">Newest to Oldest</option>
                    <option value = "1">Oldest to Newest</option>
                    <option value = "2">Asking Price: Low to High</option>
                    <option value = "3">Asking Price: High to Low</option>
                    <option value = "4">Cash Flow: Low to High</option>
                    <option value = "5">Cash Flow: High to Low</option>
                    <option value = "6">State: A-Z</option>
                    <option value = "7">State: Z-A</option>
                    <option value = "8">County: A-Z</option>
                    <option value = "9">County: Z-A</option>
                    <option value = "10">City: A-Z</option>
                    <option value = "11">City: Z-A</option>
                  </select>
                </div>
              </div>
              <div id="ident">
                <ul class="float-left margin-top20 margin-left35">
                  <li class="float-left margin-right10"> <a sort-active="false" onclick="return sortBizToggle(this)" href="#" data-sort-default="2" data-sort-val="2" data-sort-viceversa-2="3" data-sort-viceversa-3="2" id="askp" class="global font14 fntwt-bld">Asking Price</a></li>
                  <li class="float-left margin-right10">|</li>
                  <li class="float-left margin-right10"> <a sort-active="false" onclick="return sortBizToggle(this)" href="#" data-sort-default="4" data-sort-val="4" data-sort-viceversa-4="5" data-sort-viceversa-5="4"  id="cashf" class="global font14 fntwt-bld">Cash Flow</a></li>
                  <li class="float-left margin-right10">|</li>
                  <li class="float-left margin-right10"> <a sort-active="false" onclick="return sortBizToggle(this)" href="#" data-sort-default="10" data-sort-val="10" data-sort-viceversa-10="11" data-sort-viceversa-11="10"  id="loc" class="global font14 fntwt-bld">Location</a></li>
                </ul>
              </div>
            </div>
            <div id ="showsearch"> </div>
            <div msg="massage"></div>
            <div class="width100 float-left">
              <div class="float-left width20 margin-top20"> </div>
              <div class="float-right margin-top20"><a href="#" class="global font14 fntwt-bld underline padding-bottom5 float-left">Back to Top</a></div>
            </div>
          </div>
        </div>
        <div class="width206 float-right margin-left25"> <?php echo $get_popular_search_sidebar; ?> <?php echo $get_popular_county_search_sidebar; ?>
          <div class="bg-grey float-left">
            <h2 class="bg-seperator helvetica14 text-center padding-bottom5">Search Florida Auto Dealers Sold or Off-Market Business</h2>
            <div class="right-listing-type1 float-left">
              <ul>
                <li>Florida Auto Dealers Off-Market Businesses</li>
              </ul>
            </div>
          </div>
          <div class="float-left margin-top30 margin-left5"><a href="#" target="_self"><img src="<?php echo $this->template->get_frontend_image()?>24v.png" /></a></div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--body end-->
<?php		
			$js = $this->template->frontend_view( 'search_result_js', '', true, "biz_listing");
			$this->template->embed_asset_code('frontend', 'js', 'search-result-js', $js);

			$county_js_function = $this->load->view("web/admin/county/county_js_function.php", '', true);
			$this->template->embed_asset_code('frontend', 'js', 'county_js_function', $county_js_function);
			
			$biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
		    $this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);
			
			$province_js_function = $this->load->view("web/admin/province/province_js_function.php", '', true);
	 		$this->template->embed_asset_code('frontend', 'js', 'province_js_function', $province_js_function);
?>
