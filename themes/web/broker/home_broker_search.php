<?php $var = $this->config->item('var'); ?>
<?php echo form_open('broker/searchbroker', array('name' => 'broker_search_form', 'id' => 'broker_search_form', 'class' => 'cont-biz-seller', 'method' => 'get')) ?>
<div class="customeselect">
    <?php echo form_dropdown('province_id', $var['provinces_dd'], '', 'id="home_broker_province_id" onchange="getCountyByProvince(this)" data-display="' . _e('Province') . '" data-county-sel="#home_broker_county_id"'); ?>
</div>
<div class="customeselect">
    <?php echo form_dropdown('county_id', $var['counties_dd'], '', 'id="home_broker_county_id" disabled="disabled" class="validate" data-display="' . _e('County') . '"'); ?> 
</div>
<div class="float-left margin-right10">
    <?php echo form_input(array('name' => 'city', 'data-as-province-sel' => '#home_broker_province_id', 'data-as-county-sel' => '#home_broker_county_id', 'style' => 'width: 130px; height: 28px;', 'class' => 'tpy', 'id' => 'city', 'placeholder' => 'Enter City', 'onkeypress' => 'autoSuggestCity(this)')); ?>
</div>
<p>
    <input class="submitquery"  type="submit" value="" />
</p>
<?php echo form_close() ?>
<?php		
	$location_js = $this->template->frontend_view( 'location_js', '', true, "location");
	$this->template->embed_asset_code('frontend', 'js', 'location-js', $location_js);
?>