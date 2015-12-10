<?php $var = $this->config->item('var'); ?>
<!--body start-->
  <div id="body">
    <div class="wrapper">
      <div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
        <div class="width60 float-left">
        	<h2 class="helvetica float-left"><?php echo _e( 'biz_broker_dir' ); ?></h2>
       		<p><?php echo _e( 'welcome_bro' ); ?>. <br /> <?php echo _e( 'welcome_bro2' ); ?>. </p>
            <div class="width95 bg-grey padding-bottom15 padding-left15 padding-right10 padding-top15 margin-top15 float-left">
            	<h2 class="helvetica18"><?php echo _e('Search Business Brokers By Postal Code, Province, County, City'); ?></h2>
                
               	    <?php echo form_open( 'broker/searchbroker', array( 'name' => 'zip_broker_search_form', 'id' => 'zip_broker_search_form', 'class' => 'cont-biz-seller', 'method' => 'get') )?>
                  <label>  <dfn class="float-left margin-right10"> 
                    <input Type="checkbox" class="lettertyp" id="lettertyp1" name="lettertyp" value="Repeat Hotel Visit"/><?php echo _e('Search With Postalcode'); ?>:</dfn> </label>
                    <?php echo form_input( array( 'name' => 'postalcode', 'class' => 'tpy', 'id' => 'postalcode', 'placeholder' => _e('Enter Postal Code') , 'value' => $zip, 'onkeypress' =>'autoSuggestZip(this)') );?>
                    <span id="results1" style="float:left;  margin-left: 10px; margin-top: 10px;;"></span>
                    <input type="submit" name="search" value="Search" class="margin-left10 orange" id = "sub1"/>
              	    <?php echo form_close()?>
                    
                    
                    <?php echo form_open( 'broker/searchbroker', array( 'name' => 'province_broker_search_form', 'id' => 'province_broker_search_form', 'class' => 'cont-biz-seller', 'method' => 'get') )?>
                    <label><dfn class="float-left margin-right10">
                     <input Type="checkbox" class="lettertyp" id="lettertyp2" name="lettertyp" value="Repeat Hotel Visit"/>
					<?php echo _e('Search With Province'); ?>:</dfn> </label>
                    <?php echo form_input( array( 'name' => 'province', 'data-hidden-province-elm' => '#broker_search_by_province', 'class' => 'tpy', 'id' => 'province', 'placeholder' => _e('Enter Province') , 'value' => $zip, 'onkeypress' =>'autoSuggestProvince(this)') );?>
					<input type="hidden" name="province_id" id="broker_search_by_province" value="" />
                    <span id="results" style="float:left;  margin-left: 10px; margin-top: 10px;;"></span>
                    <input type="submit" name="search" value="Search" class="margin-left10 orange" id = "sub2"/>
              	    <?php echo form_close()?>
                    
                    
                     <?php echo form_open( 'broker/searchbroker', array( 'name' => 'county_broker_search_form', 'id' => 'county_broker_search_form', 'class' => 'cont-biz-seller', 'method' => 'get') )?>
                    <label><dfn class="float-left margin-right10">
                    <input Type="checkbox" class="lettertyp" id="lettertyp3" name="lettertyp" value="Repeat Hotel Visit"/>
					<?php echo _e('Search With County'); ?>:</dfn> </label>
                    <?php echo form_input( array( 'name' => 'county', 'data-hidden-county-elm' => '#broker_search_by_county', 'class' => 'tpy',  'id' => 'county', 'placeholder' => _e('Enter County') , 'value' => $zip, 'onkeypress' =>'autoSuggestCounty(this)') );?>    
					<input type="hidden" name="county_id" id="broker_search_by_county" value="" />
                    <span id="results2" style="float:left;  margin-left: 10px; margin-top: 10px;;"></span>
                    <input type="submit" name="search" value="Search" class="margin-left10 orange" id = "sub3"/>
              	    <?php echo form_close()?>

                    <?php echo form_open( 'broker/searchbroker', array( 'name' => 'city_broker_search_form', 'id' => 'city_broker_search_form', 'class' => 'cont-biz-seller', 'method' => 'get') )?>
                    <label><dfn class="float-left margin-right10">
                    <input Type="checkbox" class="lettertyp" id="lettertyp4" name="lettertyp" value="Repeat Hotel Visit"/>
					<?php echo _e('Search With City'); ?>:</dfn> </label>
                    <?php echo form_input( array( 'name' => 'city','class' => 'tpy', 'id' => 'city', 'placeholder' => _e('Enter City') , 'value' => $zip, 'onkeypress' =>'autoSuggestCity(this)') );?>
                    <span id="results3" style="float:left;  margin-left: 10px; margin-top: 10px;;"></span>
                    <input type="submit" name="search" value="Search" class="margin-left10 orange" id = "sub4"/>
              	    <?php echo form_close()?>
           		    </div>
                    
                    
            <?php echo $province_list; ?>
            <?php echo $country_list; ?>
            
            <p class="float-left margin-top40"><strong><?php echo _e( 'disclaimer' ); ?>:</strong> <?php echo _e( 'disclaimer_msg' ); ?>. <a href="#" target="_self" class="global"><?php echo _e( 'read_disclaimer' ); ?>.</a></p>
            
          
          
        </div>
        <div class="width320 float-right">
         	<p class="bg-blue padding-bottom10 padding-left10 padding-right10 padding-top10 font16 white"><?php echo _e( 'biz_bro_list_now' ); ?></p>
            <div class="bg-lightbrown padding-bottom10 padding-left10 padding-right10 padding-top10 float-left ">
            	<p><strong><?php echo _e( 'buyers_sellers_msg' ); ?>.</strong> <?php echo _e( 'post_biz' ); ?>. </p>
                <a href="<?php echo base_url()?>package?<?php echo implode( "&", setRegisterParam(4, 3) )?>" target="_self" class="global4 font14 float-left margin-top20 padding-bottom5 padding-top5 padding-left20 padding-right20 margin-left45 margin-bottom10"><?php echo _e( 'become_bro_mem' ); ?></a>
            </div>
        </div>
      </div>
    </div>
  </div>
  <!--body end--> 
<?php
$biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);

$location_js = $this->template->frontend_view( 'location_js', '', true, "location");
$this->template->embed_asset_code('frontend', 'js', 'location-js', $location_js);

$broker_js = $this->template->frontend_view( 'broker_js', '', true, "broker");
$this->template->embed_asset_code('frontend', 'js', 'broker-js', $broker_js);

$this->template->add_remove_frontend_css(array('jquery-ui.css'), 'add');
$this->template->add_remove_frontend_js(array('jquery-ui.js'), 'add');
?>
