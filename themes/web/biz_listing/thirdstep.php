<?php echo $top ?>
<div class="slide-controller">
<div id="stepsform">
  <div msg="biz_listing"></div>
  <div class="width100 float-left"><a href="<?php echo site_url("biz_listing/secondstep");?>" class="btn-type1 margin-right10 margin-top10 float-left"><span class="ion-android-system-back"></span><?php echo _e( 'back' ); ?></a></div>
  <div msg="biz_listing_third"></div>
  <div class="form_three-forth">
    <ul>
      <?php echo form_open( '', array( 'name' => 'biz_listing_edit_form', 'id' => 'biz_listing_edit_form', 'class' => 'width100 float-left margin-top10' ) )?> <?php echo form_hidden('row_id', $row_id); ?> <?php echo form_hidden('status', '2'); ?> <?php echo form_hidden('user_id',$user_id); ?>
      <li> <?php echo form_label( '<dfn>'._e( 'year' ).'</dfn>', 'year_established' )?> <?php echo form_input( array( 'name' => 'year_established', 'id' => 'year_established', 'placeholder' => _e('year_plcholder'), 'value' => $results[0]->year_established == '0000' ? '' : $results[0]->year_established ) );?> </li>
      <li><?php echo form_label( '<dfn>'._e( 'employees' ).'</dfn>', 'employees' )?> <?php echo form_input( array( 'name' => 'employees', 'id' => 'employees', 'placeholder' => _e('employees_plcholder'), 'value' => $results[0]->employees ) );?></li>
      <li><?php echo form_label( '<dfn>'._e( 'business_website' ).'</dfn>', 'biz_website' )?> <?php echo form_input( array( 'name' => 'biz_website', 'id' => 'biz_website', 'placeholder' => _e('business_plcholder'), 'value' => $results[0]->biz_website ) );?></li>
      <li><?php echo form_label( '<dfn>'._e( 'gross_revenue' ).'</dfn>', 'gross_revenue' )?> <?php echo form_input( array( 'name' => 'gross_revenue', 'id' => 'gross_revenue', 'placeholder' => _e('gross_revenue_plcholder'), 'value' => $results[0]->gross_revenue == 0 ? '' : $results[0]->gross_revenue ) );?></li>
      <li><?php echo form_label( '<dfn>'._e( 'gross_revenue_comments' ).'</dfn>', 'gross_revenue_comments' )?> <?php echo form_input( array( 'name' => 'gross_revenue_comments', 'id' => 'gross_revenue_comments', 'placeholder' => _e('gross_revenue_comments_plcholder'), 'value' => $results[0]->gross_revenue_comments ) );?></li>
      <li><?php echo form_label( '<dfn>'._e( 'cash_flow' ).'</dfn>', 'cash_flow' )?> <?php echo form_input( array( 'name' => 'cash_flow', 'id' => 'cash_flow', 'placeholder' => _e('cash_flow_plcholder'), 'value' => $results[0]->cash_flow == 0 ? '' : $results[0]->cash_flow ) );?></li>
      <li> <?php echo form_label( '<dfn>'._e( 'cash_flow_comments' ).'</dfn>', 'cash_flow_comments' )?> <?php echo form_input( array( 'name' => 'cash_flow_comments', 'id' => 'cash_flow_comments', 'placeholder' => _e('cash_flow_comments_plcholder'), 'value' => $results[0]->cash_flow_comments ) );?> </li>
      <li><?php echo form_label( '<dfn>'._e( 'value_of_inventory' ).'</dfn>', 'inv_value' )?> <?php echo form_input( array( 'name' => 'inv_value', 'id' => 'inv_value', 'placeholder' => _e('value_of_inventory_plcholder'), 'value' => $results[0]->inv_value == 0 ? '' : $results[0]->inv_value ) );?><br />
        <label><?php echo form_checkbox('is_inv_included', 1, $results[0]->is_inv_included, 'id="is_inv_included"');?> <span class="font11"><?php echo _e('inventory_is_included_in_asking_price' )?></span></label>
      </li>
      <li><?php echo form_label( '<dfn>'._e( 'value_ffe' ).'</dfn>', 'ffe_value' )?> <?php echo form_input( array( 'name' => 'ffe_value', 'id' => 'ffe_value', 'placeholder' => _e('value_ffe_plcholder'), 'value' => $results[0]->ffe_value == 0 ? '' : $results[0]->ffe_value ) );?><br />
        <label><?php echo form_checkbox('is_ffe_included', 1, $results[0]->is_ffe_included, 'id="is_ffe_included"');?> <span class="font11"><?php echo _e('ffe_included_in_asking_price' )?></span></label>
      </li>
      <li><?php echo form_label( '<dfn>'._e( 'value_real_estate' ).'</dfn>', 'rs_value' )?> <?php echo form_input( array( 'name' => 'rs_value', 'id' => 'rs_value', 'placeholder' => _e('value_real_estate_plcholder'), 'value' => $results[0]->rs_value == 0 ? '' : $results[0]->rs_value ) );?><br />
        <label><?php echo form_checkbox('is_rs_included', 1, $results[0]->is_rs_included, 'id="is_rs_included"');?> <span class="font11"><?php echo _e('real_estate_included_in_asking_price' )?></span></label>
        <br />
        <label><?php echo form_checkbox('is_biz_relctble', 1, $results[0]->is_biz_relctble, 'id="is_biz_relctble"');?> <span class="font11"><?php echo _e('business_is_relocatable' )?></span> </label>
        <br />
        <label><?php echo form_checkbox('is_biz_franchis', 1, $results[0]->is_biz_franchis, 'id="is_biz_franchis"');?> <span class="font11"><?php echo _e('business_is_a_franchise' )?></span></label>
        <br />
        <label><?php echo form_checkbox('is_biz_hb', 1, $results[0]->is_biz_hb, 'id="is_biz_hb"');?> <span class="font11"><?php echo _e('business_is_home_based' )?></span></label>
      </li>
      <li> <?php echo form_label( '<dfn>'._e( 'seller_financing_info' ).'</dfn>', 'seller_fincng_info' )?> <?php echo form_textarea( array( 'name' => 'seller_fincng_info', 'id' => 'seller_fincng_info', 'placeholder' => _e('training_support_plcholder'), 'rows' => 5, 'value' => $results[0]->seller_fincng_info) );?></li>
      <li><?php echo form_label( '<dfn>'._e( 'training_support' ).'</dfn>', 'training_support' )?> <?php echo form_textarea( array( 'name' => 'training_support', 'id' => 'training_support', 'placeholder' => _e('training_support_plcholder'), 'rows' => 5, 'value' => $results[0]->training_support) );?></li>
      <li><?php echo form_label( '<dfn>'._e( 'reason_for_selling' ).'</dfn>', 'selling_reason' )?> <?php echo form_textarea( array( 'name' => 'selling_reason', 'id' => 'selling_reason', 'placeholder' => _e( 'reason_for_selling_plcholder' ), 'rows' => 5, 'value' => $results[0]->selling_reason) );?></li>
      <li><?php echo form_label( '<dfn>'._e( 'facilities' ).'</dfn>', 'facilities' )?> <?php echo form_textarea( array( 'name' => 'facilities', 'id' => 'facilities', 'placeholder' => _e('facilities_plcholder'), 'rows' => 5, 'value' => $results[0]->facilities) );?></li>
      <li><?php echo form_label( '<dfn>'._e( 'market_outlook_competition' ).'</dfn>', 'mkt_outlook_cmp' )?> <?php echo form_textarea( array( 'name' => 'mkt_outlook_cmp', 'id' => 'mkt_outlook_cmp', 'placeholder' => _e('market_outlook_competition_plcholder'), 'rows' => 5, 'value' => $results[0]->mkt_outlook_cmp) );?></li>
      <li> <?php echo form_label( '<dfn>'._e( 'keywords' ).'</dfn>', 'keywords' )?> <?php echo form_textarea( array( 'name' => 'keywords', 'id' => 'keywords', 'placeholder' => _e('keywords_plcholder'), 'rows' => 5, 'value' => $results[0]->keywords) );?></li>
    </ul>
  </div>
  <?php  echo $sidebar; ?>
  <div class="float-left margin-left355 margin-top20"> <?php echo form_submit( array( 'name' => 'biz_listing_update', 'id' => 'biz_listing_update', 'class' => 'float-right blue margin-left10 margin-top10' ), _e( 'continue' ) );?> &nbsp;&nbsp;
    <input type="button" value="<?php echo _e('preview_arrow')?>" class="float-right orange margin-top10"  id = "pri" name = "pri"/>
    <?php echo form_close()?></div>
  <?php
$js = $this->template->frontend_view( 'biz_listing_js_third', '', true, "biz_listing");
$this->template->embed_asset_code('frontend', 'js', 'biz_listing_js_third', $js);

$province_js_function = $this->load->view("web/admin/province/province_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'province_js_function', $province_js_function);

$county_js_function = $this->load->view("web/admin/county/county_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'county_js_function', $county_js_function);
?>
</div>
<?php echo $footer; 
$biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'biz_type_js_function', $biz_type_js);
?>