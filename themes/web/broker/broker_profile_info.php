<br>
<br>
<br>
<br>
<br>
<br>
<?php $var = $this->config->item('var'); ?>
<?php 
### If No Error Begin ###
if(!$response["event"]["error"]):?>
<div id="body">
  <div class="wrapper">
    <h2><?php echo _e( 'broker_pro_info' ); ?></h2>
    <div msg="brokermsg"></div>
    <?php echo form_open( '', array( 'name' => 'brokerinfo_add_form', 'id' => 'brokerinfo_add_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) )?>
    <fieldset class="clonefieldset">
      <span class="otherbutton"></span>
      <legend align="center" margin="auto"> <h2 class="helvetica">Basic Information</h2></legend>
      <div class="fullwith-fifty">
      	<ul>
		  <li><?php echo form_label( '<dfn>'._e( 'Service Area' ).'</dfn>', 'service_area' )?> <?php echo form_input( array( 'name' => 'service_area', 'value' => $service_area,'id' => 'service_area', 'placeholder' => 'add service area here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'Service Area' ), 'data-rules' => 'required') );?></li>
         <li> <?php echo form_label( '<dfn>'._e( 'Additional Services' ).'</dfn>', 'additional_services' )?> <?php echo form_input( array( 'name' => 'additional_services', 'value' => $additional_services, 'id' => 'additional_services', 'placeholder' => 'add additional services here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'Additional Services' ), 'data-rules' => 'required') );?></li>
         <li> <?php echo form_label( '<dfn>'._e( 'Company Details' ).'</dfn>', 'company_details' )?> <?php echo form_textarea( array( 'name' => 'company_details', 'value' => $company_details, 'id' => 'company_details', 'placeholder' => 'add company details here', 'rows' => 5, 'autofocus' => 'autofocus') );?></li>
          <li><?php echo form_label( '<dfn>'._e( 'Broker Bio' ).'</dfn>', 'bio' )?> <?php echo form_textarea( array( 'name' => 'bio', 'value' => $bio, 'id' => 'bio', 'placeholder' => 'add broker bio here', 'rows' => 5, 'autofocus' => 'autofocus') );?></li>
          <div class="clear"></div>
          <div class="clear"></div>
          </ul>
      </div>
    </fieldset>
    <fieldset class="clonefieldset">
      <span class="otherbutton"></span>
      <legend align="center" margin="auto"> <h2 class="helvetica">Location Information</h2></legend>
      <div class="clear"></div>
      <div class="fullwidthform">
      	<ul>
		 	 <?php $select = $_COOKIE["country_ip"]; ?>
             <li> <?php echo form_label( '<dfn>'._e( 'Country' ).'</dfn>', 'country_id_broker_profile' )?> <?php echo form_dropdown('country_id', $var['country_dd'], $country_id, 'id="country_id_broker_profile" onchange="getProvinceByCountry(this)" data-province-sel="#province_id_broker_profile" data-child-input-parent="label[for=\'province_id_broker_profile\'], label[for=\'county_id_broker_profile\'], label[for=\'city_id_broker_profile\'], label[for=\'zipcode_broker_profile\']" data-child-input=":input#province_id_broker_profile, :input#county_id_broker_profile, :input#city_id_broker_profile, :input#zipcode_broker_profile" data-display="'._e( 'Country' ).'" data-rules="required"'); ?></li>
            <li>  <?php echo form_label( '<dfn>'._e( 'Province' ).'</dfn>', 'province_id_broker_profile') ?> <?php echo form_dropdown('province_id', $provinces_dd, $province_id, 'id="province_id_broker_profile" data-county-sel="#county_id_broker_profile" onchange="getCountyByProvince(this)" class="validate" data-display="'._e( 'Province' ).'" data-rules="required"');?></li>
              <li><?php echo form_label( '<dfn>'._e( 'County' ).'</dfn>', 'county_id_broker_profile' )?> <?php echo form_dropdown('county_id', $counties_dd, $county_id, 'id="county_id_broker_profile" data-city-sel="#city_id_broker_profile" onchange="getCityByCounty(this)" class="validate" data-display="'._e( 'County' ).'" data-rules="required"');?></li>
              <li><?php echo form_label( '<dfn>'._e( 'City' ).'</dfn>', 'city_id_broker_profile' )?> <?php echo form_dropdown('city_id', $cities_dd, $city, 'id="city_id_broker_profile" data-zip-sel="#zipcode_broker_profile" onchange="getZipByCity(this)" class="validate" data-display="'._e( 'City' ).'" data-rules="required"');?></li>
             <li> <?php echo form_label( '<dfn>'._e( 'Zipcode' ).'</dfn>', 'zipcode_broker_profile' )?> <?php echo form_dropdown('zipcode', $zipcodes_dd, $zipcode, 'id="zipcode_broker_profile" class="validate" data-display="'._e( 'Zipcode' ).'" data-rules="required"');?></li>
          </ul>
      </div>
    </fieldset>
    <fieldset class="clonefieldset">
      <span class="otherbutton"></span>
      <legend align="center" margin="auto"> <h2 class="helvetica">Certified Image</h2></legend>
      <div class="fullwidthform">
        	<ul>
      <li><?php echo form_label( '<p>'._e( 'Images' ).'</p>', 'images' )?> <?php echo form_upload( array( 'name' => 'images[]', 'placeholder' => 'add images') );?>		</li>	</ul>
      <div class="fullwidthform">
    </fieldset>
    <?php echo form_hidden('user_id', $user_id); ?> <?php echo form_hidden('method', 'profileinfo'); ?> <?php echo form_submit( array( 'name' => 'brokerinfo_add_form', 'id' => 'brokerinfo_add_form', 'class' => 'margin-top10' ), _e( 'Add' ) );?> <?php echo form_close()?> </div>
</div>
<?php
$broker_js = $this->template->frontend_view( 'broker_js', '', true, "broker");
$this->template->embed_asset_code('frontend', 'js', 'broker-js', $broker_js);

$biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);

$province_js_function = $this->load->view("web/admin/province/province_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'province_js_function', $province_js_function);

$county_js_function = $this->load->view("web/admin/county/county_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'county_js_function', $county_js_function);

$location_js = $this->load->view("web/location/location_js.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'location_js', $location_js);
endif;
?>
