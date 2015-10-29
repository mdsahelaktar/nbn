    <div class="bg-banner width100 padding-top25 padding-bottom25 float-left">
      <div class="midalign">
        <div id="banner-wrap">
         <?php echo form_open( 'biz_listing/search', array( 'name' => 'search_form', 'id' => 'search_form', 'method' => 'post') )?>
            <h2 class="helvetica18 text-center white margin-bottom20">Mobile Search businesses for sale or new franchise opportunities.</h2>
            <div class="customeselect blue">
              <select class="blue">
                <option selected="selected">Business For Sale</option>
                <option>Short Option</option>
                <option>This Is A Longer Option</option>
              </select>
            </div>
            <div class="customeselect">
                 <?php echo form_dropdown('biz_domain_id', $var['biz_domain_dd'], $this->input->get('biz_domain_id'), 'id="biz_domain_id" class="validate" data-display="'._e( 'Type of Business' ).'" onchange="getBizTypeByBizDomain(this)"'); ?>
                  </div>
            <div class="customeselect">
              <?php echo form_dropdown('biz_type_id', $var['biz_types_dd'],'', 'id="biz_type_id" disabled="disabled" class="validate" data-display="'._e( 'Type of Business' ).'" data-rules="required"');?>
            </div>
             <?php if(empty($chk_cookie))
			  {
			?>
            <div class="customeselect">
                <?php echo form_dropdown('province_id', $var['provinces_dd'], $province_id, 'id="province_id" data-display="'._e( 'Province' ).'" data-rules="required"'); ?>
            </div>
             <?php
			  }
			  else
			  {
			   ?>
               <div class="customeselect">
               <?php echo form_dropdown('country_id', $var['country_dd'], $_COOKIE["country"], 'id="country_id_for_home" data-display="'._e( 'Location' ).'"'); ?>
            </div>
             <?php
			  }
			  ?>
              </div>
            <p class="float-left"><a href="#" target="_self" class="global white underline margin-top10 float-left font14">Advance Search</a></p>
            <p class="float-right">
              <?php //echo form_submit( array( 'name' => 'search', 'class' => 'submitquery' ), _e( 'Search' ) );?>
              <input type="submit" value="" name="submit" class="submitquery">
            </p>
          <?php echo form_close()?>
        </div>
      </div>
    </div>
    <div class="float-left width100">
    	<div class="midalign margin-top10">
        	<div class="float-left bg-grey padding-top10 padding-bottom10 width98 padding-left10 radius4">
            	<p class="float-left font16 theme-blue">Find a Local Business Broker</p>
                <form action="#" method="post" class="search float-left margin-top10 width100">
                  <input id="search" name="seaech" placeholder="Enter Your Zip" type="text" class="zip" />
                  <input class="search" name="submit" type="submit" value="" />
        		</form>
                <p class="float-left brdr-top padding-top10 width98 margin-top15"><a href="#" target="_self" class="global">Brokers, get listed today!</a></p>
                </div>
        </div>
    </div>
    <?php 
	 $biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
	 $this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);
	 
	 $province_js_function = $this->load->view("web/admin/province/province_js_function.php", '', true);
	 $this->template->embed_asset_code('frontend', 'js', 'province_js_function', $province_js_function);
	 
	 $county_js_function = $this->load->view("web/admin/county/county_js_function.php", '', true);
	 $this->template->embed_asset_code('frontend', 'js', 'county_js_function', $county_js_function);
?>