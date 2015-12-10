<?php $var = $this->config->item('var'); ?>
<?php echo form_open('biz_listing/search', array('name' => 'home_search_form', 'autocomplete' => 'off', 'id' => 'home_search_form', 'class' => 'width100 float-left margin-bottom30 margin-top10', 'method' => 'get')) ?>
<div class="customeselect"> <?php echo form_dropdown('biz_domain_id', $var['biz_domain_dd'], $this->input->get('biz_domain_id'), 'id="biz_domain_id" class="validate" data-display="' . _e('type_of_business') . '" onchange="getBizTypeByBizDomain(this)" data-biztype-sel="#biz_type_id"'); ?> </div>
<div class="customeselect"> <?php echo form_dropdown('biz_type_id', $var['biz_types_dd'], '', 'id="biz_type_id" disabled="disabled" class="validate" data-display="' . _e('type_of_business') . '" data-rules="required"'); ?> </div>
<div class="customeselect width170" id ="count"> <?php echo form_dropdown('country_id', $var['country_dd'], placeCountryId( 0, $var['client_country_id'], $var['default_country_id'] ), 'id="country_id_for_home_search" class="width170" data-display="' . _e('location') . '"'); ?> </div>
<p> <?php echo form_submit(array('name' => 'search', 'id' => 'home_search', 'class' => 'submitquery'), _e('')); ?> </p>
<?php echo form_close() ?> 