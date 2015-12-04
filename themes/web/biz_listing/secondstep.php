<?php echo $top ?>
<div class="slide-controller">
<div id="stepsform">
  <div class="form_three-forth">
    <ul>
      <div msg="biz_listing"></div>
      <?php echo form_open('', array('name' => 'biz_listing_add_form', 'id' => 'biz_listing_add_form', 'class' => 'width100 float-left margin-bottom30 margin-top10')) ?> <?php echo form_hidden('row_id', $row_id); ?> <?php echo form_hidden('status', '1'); ?> <?php echo form_hidden('user_id', $user_id); ?> <?php echo form_input(array('name' => 'saveandcontlet', 'type' => 'hidden', 'id' => 'saveandcontlet', 'value' => false)); ?>
      <li> <?php echo form_label('<strong><dfn>' . _e('Headline: ') . '</dfn></strong>', 'headline') ?> <?php echo form_input(array('name' => 'headline', 'id' => 'headline', 'placeholder' => 'add headline here', 'class' => 'validate', 'data-display' => _e('Headline'), 'data-rules' => 'required', 'value' => $results[0]->headline)); ?></li>
      <li> <?php echo form_label('<strong><dfn>' . _e('Tagline') . '</dfn></strong>', 'tagline') ?> <?php echo form_input(array('name' => 'tagline', 'id' => 'tagline', 'placeholder' => 'add tagline here', 'class' => 'validate', 'data-display' => _e('Tagline'), 'data-rules' => 'required', 'value' => $results[0]->tagline)); ?></li>
      <li> <?php echo form_label('<strong><dfn>' . _e('Type of Business') . '</dfn></strong>', 'biz_type_id') ?> <?php echo form_dropdown('biz_type_id', $var['biz_types_dd_for_second'], $results[0]->biz_type_id, 'id="biz_type_id" class="validate" data-display="' . _e('Type of Business') . '" data-rules="required"'); ?></li>
      <li> <?php echo form_label('<dfn>' . _e('Other Business type') . '</dfn>', 'Business Sub-Type') ?> <?php echo form_dropdown('other_biz_type_id', $var['biz_types_dd_for_second'], $results[0]->other_biz_type_id, 'id="other_biz_type_id"'); ?></li>
      <li> <?php echo form_label('<strong><dfn>' . _e('Country') . '</dfn></strong>', 'country_id') ?> <?php echo form_dropdown('country_id', $var['countries_dd'], $results[0]->country_id, 'id="country_id" onchange="getProvinceByCountry(this)" data-province-sel="#province_id" class="validate" data-display="' . _e('Country') . '" data-rules="required"'); ?></li>
      <li> <?php echo form_label('<dfn>' . _e('State/Province') . '</dfn>', 'province_id', $location_dd_view_a) ?> <?php echo form_dropdown('province_id', $var['provinces_dd'], $results[0]->province_id, 'id="province_id" onchange="getCountyByProvince(this)" data-county-sel="#county_id" class="validate" data-display="' . _e('Province') . '" data-rules="required" '.$location_dd_status.' '.$location_dd_view); ?></li>
      <li> <?php echo form_label('<dfn>' . _e('County') . '</dfn>', 'county_id', $location_dd_view_a) ?> <?php echo form_dropdown('county_id', $var['counties_dd'], $results[0]->county_id, 'id="county_id" class="validate" data-display="' . _e('County') . '" data-rules="required" '.$location_dd_status.' '.$location_dd_view); ?> <br />
        <label for="is_county_cnfdntl" <?php echo $location_dd_view?>><?php echo form_checkbox('is_county_cnfdntl', 1, $results[0]->is_county_cnfdntl, 'id="is_county_cnfdntl" '.$location_dd_status ); ?><span class="font11"><?php echo _e(' Keep the County information confidential') ?></span></label>
      </li>
      <li> <?php echo form_label('<dfn>' . _e('City') . '</dfn>', 'city') ?> <?php echo form_input(array('name' => 'city', 'id' => 'city', 'placeholder' => 'city', 'value' => $results[0]->city)); ?></li>
      <li> <?php echo form_label('<dfn>' . _e('Asking Price') . '</dfn>', 'asking_price') ?> <?php echo form_input(array('name' => 'asking_price', 'id' => 'asking_price', 'placeholder' => 'asking price', 'value' => $results[0]->asking_price)); ?></li>
      <li> <?php echo form_label('<strong><dfn>' . _e('Description') . '</dfn></strong>', 'description') ?> <?php echo form_textarea(array('name' => 'description', 'id' => 'description', 'placeholder' => 'add description here', 'class' => 'validate', 'data-display' => _e('Description'), 'rows' => 5, 'data-rules' => 'required', 'value' => $results[0]->description)); ?> <br />
        <label><?php echo form_checkbox('is_fincng_avlble', 1, $results[0]->is_fincng_avlble, 'id="is_fincng_avlble"'); ?><span class="font11"><?php echo _e(' Yes! Seller Financing is available') ?></span></label>
      </li>
    </ul>
  </div>
</div>
<?php echo $sidebar; ?>
<div class="float-left margin-left355 margin-top20">
  <input type="button" value="Save and continue latter" class="float-right gray margin-top10 margin-left10"  id = "biz_listing_save" name = "biz_listing_save"/>
  <input type="submit" value="Continue &rarr;" class="float-right blue margin-left10 margin-top10"  id = "biz_listing_add" name = "biz_listing_add"/>
  <input type="button" value="Preview &rarr;" class="float-right orange margin-top10" id ="pri" name="pri"/>
  <?php echo form_close() ?>
  <?php
            $js = $this->template->frontend_view('biz_listing_js_second', '', true, "biz_listing");
            $this->template->embed_asset_code('frontend', 'js', 'biz-listing-js-second', $js);

            $province_js_function = $this->load->view("web/admin/province/province_js_function.php", '', true);
            $this->template->embed_asset_code('frontend', 'js', 'province_js_function', $province_js_function);

            $county_js_function = $this->load->view("web/admin/county/county_js_function.php", '', true);
            $this->template->embed_asset_code('frontend', 'js', 'county_js_function', $county_js_function);
        ?>
</div>
<?php
    echo $footer;
    $biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
    $this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);
?>
