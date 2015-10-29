<div id="body">
  <div class="wrapper">
    <div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
      <div class="float-left padding-bottom20 margin-bottom20">
        <div class="width725 float-left"> <?php echo renderResposeMessage('massage', $response) ?>
          <h2 class="helvetica float-left" id="upperstring"><?php echo $country; ?> Businesses for Sale</h2>
          <p id="change">Need Biz Now has more <?php echo $country; ?> Businesses for sale listings than any other source. Whether you are looking to buy a <?php echo $country; ?> Businesses for sale or sell your <?php echo $country; ?> Businesses, Need Biz Now is the Internet's leading <?php echo $country; ?> Businesses for sale marketplace. Refine your search by location, industry or asking price using the filters below. </p>
          <div class="width95 float-left bg-blue padding-top10 padding-bottom10 padding-left20 padding-right20 margin-top20 radius4">
            <p class="float-left white" id="remv">Browse <?php echo $count_row; ?>&nbsp; <?php echo $country; ?> Businesses For Sale</p>
            <ul class="float-right">
              <li class="float-left margin-right25"><a href="#" target="_self" class="savesearch global">Save this search</a></li>
              <li class="float-left"><?php echo anchor( 'user?ct=8&rl=1', _e( 'Create an Email Alert' ), array( 'class' => 'email-alert global' ) )?></li>
            </ul>
          </div>
          <div class="width95 bg-grey padding-bottom10 padding-left20 padding-right20 padding-top10 float-left margin-top20">
            <p class="font14">Refine Your Search Here or go to <a href="#" target="_self" class="global">Advanced Search for More Options</a></p>
            <?php echo form_open( '', array( 'name' => 'inner_search_form', 'id' => 'srpform', 'class' => 'margin-top15', 'method' => 'post' ,'onsubmit' => 'return submitFunction()') )?>
            <div class="customeselect"> <?php echo form_label( '<dfn>'._e( 'Country' ).'</dfn>', 'province_id' )?>
         <?php echo form_dropdown('country_id', $var['country_dd'],$country_id, 'id="country_id" onchange="getProvinceByCountry(this)" data-province-sel="#province_id" data-display="'._e( 'Location' ).'" data-rules="required"'); ?>
             </div>
            <div class="customeselect"> <?php echo form_label( '<dfn>'._e( 'Location' ).'</dfn>', 'province_id' )?> <?php echo form_dropdown('province_id', $var['provinces_dd'], $province, 'id="province_id"  onchange="getCountyByProvince(this)" data-county-sel="#county_id" data-display="'._e( 'Province' ).'" data-rules="required"');?> </div>
            
            <div class="customeselect"> <?php echo form_label( '<dfn>'._e( 'County' ).'</dfn>', 'county_id' )?> <?php echo form_dropdown('county_id', $var['counties_dd'], $county,'id="county_id" disabled="disabled" class="validate" data-display="'._e( 'County' ).'" data-rules="required"');?> </div>
           
           
           
            <div class="customeselect" style="width: 130px; margin: 0 5px 20px 0;"> <dfn>Price:</dfn>
              <select name="asking_price_min" id="asking_price_min" style = "width: 91px">
                <?php 
                        foreach($var['askingprice_dd_min'] as $category => $value) 
                        {
                           echo '<option value="'. $category .'">'. $value .'</option>';
                        }
                    ?>
              </select>
            </div>
            <div class="customeselect" style="width: 115px; margin:0 0 20px 0;"> <dfn style="width:auto;">&nbsp;</dfn>
              <select name="asking_price_max" id="asking_price_max" style = "width: 91px">
                <?php 
                        foreach($var['askingprice_dd_max'] as $category => $value) 
                        {
                           echo '<option value="'. $category .'">'. $value .'</option>';
                        }
                    ?>
              </select>
            </div>

            <div class="customeselect"> <dfn>Industry:</dfn> <?php echo form_dropdown('biz_domain_id', $var['biz_domain_dd'], $bd, 'id="biz_domain_id"  data-display="'._e( 'Type of Business' ).'" data-rules="required" onchange="getBizTypeByBizDomain(this)"'); ?> </div>
            
            <div class="customeselect"> <dfn>Segment:</dfn> <?php echo form_dropdown('biz_type_id', $var['biz_types_dd'], $bt,'id="biz_type_id"  data-display="'._e( 'Type of Business' ).'" data-rules="required"');?> </div>
            

                    <div class="customeselect">
                    <input type="text" name="grh" value="" id="grh" placeholder="Gross Revenue High" style="width: 130px;"/>
                    </div>
                    
                    <div class="customeselect">
                    <input type="text" name="grl" value="" id="grl" placeholder="Gross Revenue Low" style="width: 130px;"/>
                    </div>
                    
                    <div class="customeselect">
                    <input type="text" name="cfh" value="" id="cfh" placeholder="Cash Flow High" style="width: 130px;"/>
                    </div>
                    
                    <div class="customeselect">
                    <input type="text" name="cfl" value="" id="cfl" placeholder="Cash Flow Low" style="width: 130px;"/>
                    </div>
                    
                     <div class="customeselect"><strong class="float-left margin-top5">Show Businesses Listed:</strong>
					  <select name="show_biz_list_bydate" id="show_biz_list_bydate">
                      <option value = "">Anytime</option>
                      <option value = "3">last 3 days</option>
                      <option value = "7">last 7 days</option>
                      <option value = "30">last 30 days</option>
                      </select>
                     </div>
                     
                     <div class="customeselect">
                     <input type="text" name="cklsearch" value="<?php echo $cklsearch; ?>" id="cklsearch"  placeholder="City, Keyword or Listing ID" style="width: 150px;"/>
                     </div>
                     
                     <div class="customeselect">
                     <input type="checkbox" name="is_fincng_avlble" id="is_fincng_avlble" value="1">Only show listings with Seller Financing
                     </div>
            
            <?php echo form_submit( array( 'name' => 'inner_search', 'id' => 'inner_search', 'class' => 'orange radius4' , 'style' => 'padding: 9px 22px'), _e( 'Search' ) );?> <?php echo form_close()?> </div>
            
            <div class="width100 float-left" id="srpdetails">
              <div class="width100 float-left" id="stop">
                <div class="float-left width20 margin-top20">
                  <!--<p class="float-left"><strong>Page 1 of 1</strong></p>
                  <a href="#" target="_self" class="back float-left margin-left10">&nbsp;</a> <a href="#" target="_self" class="foreward float-left margin-left5">&nbsp;</a>--> </div>
                <div id="show"></div>
                <div id="sortby">
                  <div class="customeselect"> <strong class="float-left margin-top5">Sort by:</strong>
                    <select name="sortbyopt" id="sortbyopt" onchange="sortResult(this.value)">
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
                  <li class="float-left margin-right10"> <a href="javascript:void(0)" sort=''  id = "askp" class="global font14 fntwt-bld">Asking Price</a></li>
                  <li class="float-left margin-right10">|</li>
                  <li class="float-left margin-right10"> <a href="javascript:void(0)" sort_cf='' id = "cashf" class="global font14 fntwt-bld">Cash Flow</a></li>
                  <li class="float-left margin-right10">|</li>
                  <li class="float-left margin-right10"> <a href="javascript:void(0)" sort_l='' id = "loc" class="global font14 fntwt-bld">Location</a></li>
                </ul>
                </div>
              </div>


				
              <div id ="showsearch">
              <?php echo $information; ?> 
             </div>
            <div msg="massage"></div>
            <div class="width100 float-left">
              <div class="float-left width20 margin-top20">

              </div>
              <div class="float-right margin-top20"><a href="#" class="global font14 fntwt-bld underline padding-bottom5 float-left">Back to Top</a></div>
            </div>
         </div>
        </div>
        <div class="width206 float-right margin-left25">

          <?php echo $get_popular_search_sidebar; ?>

          <?php echo $get_popular_county_search_sidebar; ?>
          
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
