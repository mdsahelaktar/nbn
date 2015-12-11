<?php echo renderResposeMessage('biz_listing', $response) ?>
<?php
### Edit Section Begin ### 
### If No Error Begin ###
if ($response["event"] != "error"):
    ?>
<?php if ($edit_id): ?>
<?php echo anchor(getBackUrl('edit_id'), '<span class="ion-android-system-back"></span>' . _e('back'), array('title' => _e('back to List'), 'class' => 'btn-type1 margin-right10 margin-top10 float-left margin-bottom15 margin-left30')) ?>
<?php
        ### If Valid Edit Id Begin ###
        if (isset($results["records"][0]->ai_biz_listing_id)):
            ?>
<div class="fullwidthform-new">
  <ul>
    <?php
            echo form_open('', array('name' => 'biz_listing_edit_form', 'id' => 'biz_listing_edit_form', 'class' => 'width100 float-left margin-bottom30'));
            echo form_hidden('row_id', $results["records"][0]->ai_biz_listing_id);
            ?>
    <li> <?php echo form_label('<dfn>' . _e('headline') . '</dfn>', 'headline') ?> <?php echo form_input(array('name' => 'headline', 'id' => 'headline', 'size' => 30, 'value' => $results["records"][0]->headline, 'placeholder' => _e('add_headline'), 'class' => 'validate', 'data-display' => _e('headline'), 'data-rules' => 'required')); ?></li>
    <li> <?php echo form_label('<dfn>' . _e('tagline') . '</dfn>', 'tagline') ?> <?php echo form_input(array('name' => 'tagline', 'id' => 'tagline', 'size' => 30, 'value' => $results["records"][0]->tagline, 'placeholder' => _e('add_tagline'), 'class' => 'validate', 'data-display' => _e('tagline'), 'data-rules' => 'required')); ?></li>
    <li><?php echo form_label('<dfn>' . _e('description') . '</dfn>', 'description') ?> <?php echo form_textarea(array('name' => 'description', 'id' => 'description', 'value' => $results["records"][0]->description, 'placeholder' => _e('add_description'), 'class' => 'validate', 'data-display' => _e('description'), 'rows' => 5, 'data-rules' => 'required')); ?></li>
    <li> <?php echo form_label('<dfn>' . _e('type_of_business') . '</dfn>', 'biz_type_id') ?> <?php echo form_dropdown('biz_type_id', $var['biz_types_dd'], $results["records"][0]->biz_type_id, 'id="biz_type_id" class="validate" data-display="' . _e('type_of_business') . '" data-rules="required"'); ?></li>
    <li> <?php echo form_label('<dfn>' . _e('other_business_type') . '</dfn>', 'other_biz_type_id') ?> <?php echo form_dropdown('other_biz_type_id', $var['biz_types_dd'], $results["records"][0]->other_biz_type_id, 'id="other_biz_type_id"'); ?></li>
    <li> <?php echo form_label('<dfn>' . _e('country') . '</dfn>', 'country_id') ?> <?php echo form_dropdown('country_id', $var['countries_dd'], $results["records"][0]->country_id, 'id="country_id" onchange="getProvinceByCountry(this)" province_country_section="manage" data-province-sel="#province_id" class="validate" data-child-input-parent="#province_selector, #county_selector, #county_conf_selector" data-display="' . _e('country') . '" data-rules="required"'); ?></li>
    <li id="province_selector"> <?php echo form_label('<dfn>' . _e('state_province') . '</dfn>', 'province_id') ?> <?php echo form_dropdown('province_id', $var['provinces_dd'], $results["records"][0]->province_id, 'id="province_id" disabled="disabled" onchange="getCountyByProvince(this)" data-county-sel="#county_id" class="validate" data-display="' . _e('state_province') . '" data-rules="required"'); ?></li>
    <li id="county_selector"> <?php echo form_label('<dfn>' . _e('county') . '</dfn>', 'county_id') ?> <?php echo form_dropdown('county_id', $var['counties_dd'], $results["records"][0]->county_id, 'id="county_id" disabled="disabled" class="validate" data-display="' . _e('county') . '" data-rules="required"'); ?></li>
    <li id="county_conf_selector">
      <div class="margin-top35"><?php echo form_checkbox('is_county_cnfdntl', 1, $results["records"][0]->is_county_cnfdntl, 'id="is_county_cnfdntl"'); ?> <?php echo form_label('<p>' . _e('county_confidential') . '</p>', 'is_county_cnfdntl') ?></div>
    </li>
    <li> <?php echo form_label('<dfn>' . _e('city') . '</dfn>', 'city') ?> <?php echo form_input(array('name' => 'city', 'size' => 30, 'value' => $results["records"][0]->city, 'id' => 'city', 'placeholder' => _e('add_city'))); ?></li>
    <li> <?php echo form_label('<dfn>' . _e('asking_price') . '</dfn>', 'asking_price') ?> <?php echo form_input(array('name' => 'asking_price', 'size' => 30, 'value' => $results["records"][0]->asking_price == 0 ? '' : $results["records"][0]->asking_price, 'id' => 'asking_price', 'placeholder' => _e('enter_asking_price'))); ?></li>
    <li>
      <div class="margin-top35"> <?php echo form_checkbox('is_fincng_avlble', 1, $results["records"][0]->is_fincng_avlble, 'id="is_fincng_avlble"'); ?> <?php echo form_label('<p>' . _e('Seller financing is available') . '</p>', 'is_fincng_avlble') ?></div>
    </li>
    <li> <?php echo form_label('<dfn>' . _e('year') . '</dfn>', 'year_established') ?> <?php echo form_input(array('name' => 'year_established', 'id' => 'year_established', 'size' => 30, 'value' => $results["records"][0]->year_established == '0000' ? '' : $results["records"][0]->year_established, 'placeholder' => _e('year_plcholder'))); ?></li>
    <li> <?php echo form_label('<dfn>' . _e('employees') . '</dfn>', 'employees') ?> <?php echo form_input(array('name' => 'employees', 'id' => 'employees', 'size' => 30, 'value' => $results["records"][0]->employees, 'placeholder' => _e('employees_plcholder'))); ?></li>
    <li> <?php echo form_label('<dfn>' . _e('business_website') . '</dfn>', 'biz_website') ?> <?php echo form_input(array('name' => 'biz_website', 'id' => 'biz_website', 'size' => 30, 'value' => $results["records"][0]->biz_website, 'placeholder' => _e('business_plcholder'))); ?></li>
    <li><?php echo form_label('<dfn>' . _e( 'gross_revenue' ) . '</dfn>', 'gross_revenue') ?> <?php echo form_input(array('name' => 'gross_revenue', 'id' => 'gross_revenue', 'size' => 30, 'value' => $results["records"][0]->gross_revenue == 0 ? '' : $results["records"][0]->gross_revenue, 'placeholder' => _e('gross_revenue_plcholder'))); ?></li>
    <li> <?php echo form_label('<dfn>' . _e('gross_revenue_comments') . '</dfn>', 'gross_revenue_comments') ?> <?php echo form_input(array('name' => 'gross_revenue_comments', 'id' => 'gross_revenue_comments', 'size' => 30, 'value' => $results["records"][0]->gross_revenue_comments, 'placeholder' => _e('gross_revenue_comments_plcholder'))); ?></li>
    <li> <?php echo form_label('<dfn>' . _e('cash_flow') . '</dfn>', 'cash_flow') ?> <?php echo form_input(array('name' => 'cash_flow', 'id' => 'cash_flow', 'size' => 30, 'value' => $results["records"][0]->cash_flow == 0 ? '' : $results["records"][0]->cash_flow, 'placeholder' => _e('cash_flow_plcholder'))); ?></li>
    <li><?php echo form_label('<dfn>' . _e('cash_flow_comments') . '</dfn>', 'cash_flow_comments') ?> <?php echo form_input(array('name' => 'cash_flow_comments', 'id' => 'cash_flow_comments', 'size' => 30, 'value' => $results["records"][0]->cash_flow_comments, 'placeholder' => _e('cash_flow_comments_plcholder'))); ?></li>
    <li> <?php echo form_label('<dfn>' . _e('value_of_inventory') . '</dfn>', 'inv_value') ?> <?php echo form_input(array('name' => 'inv_value', 'id' => 'inv_value', 'size' => 30, 'value' => $results["records"][0]->inv_value == 0 ? '' : $results[0]->inv_value, 'placeholder' => _e('value_of_inventory_plcholder'))); ?></li>
    <li>
      <div class="margin-top35"> <?php echo form_checkbox('is_inv_included', 1, $results["records"][0]->is_inv_included, 'id="is_inv_included"'); ?> <?php echo form_label('<p>' . _e('inventory_is_included_in_asking_price') . '</p>', 'is_inv_included') ?></div>
    </li>
    <li> <?php echo form_label('<dfn>' . _e('value_ffe') . '</dfn>', 'ffe_value') ?> <?php echo form_input(array('name' => 'ffe_value', 'id' => 'ffe_value', 'size' => 30, 'value' => $results["records"][0]->ffe_value == 0 ? '' : $results["records"][0]->ffe_value, 'placeholder' => _e('value_ffe_plcholder'))); ?></li>
    <li>
      <div class="margin-top20"><?php echo form_checkbox('is_ffe_included', 1, $results["records"][0]->is_ffe_included, 'id="is_ffe_included"'); ?> <?php echo form_label('<p>' . _e('ffe_included_in_asking_price') . '</p>', 'is_ffe_included') ?></div>
    </li>
    <li> <?php echo form_label('<dfn>' . _e('value_real_estate') . '</dfn>', 'rs_value') ?> <?php echo form_input(array('name' => 'rs_value', 'class' => 'rs_value margin-bottom10', 'id' => 'rs_value', 'size' => 30, 'value' => $results["records"][0]->rs_value == 0 ? '' : $results["records"][0]->rs_value, 'placeholder' => _e('value_real_estate_plcholder'))); ?><br />
      <?php echo form_label('<p>' . _e('real_estate_included_in_asking_price') . '</p>', 'is_rs_included') ?><?php echo form_checkbox('is_rs_included', 1, $results["records"][0]->is_rs_included, 'id="is_rs_included"'); ?> <br />
      <?php echo form_label('<p>' . _e('business_is_relocatable') . '</p>', 'is_biz_relctble') ?> <?php echo form_checkbox('is_biz_relctble', 1, $results["records"][0]->is_biz_relctble, 'id="is_biz_relctble"'); ?> <br />
      <?php echo form_label('<p>' . _e('business_is_a_franchise') . '</p>', 'is_biz_franchis') ?> <?php echo form_checkbox('is_biz_franchis', 1, $results["records"][0]->is_biz_franchis, 'id="is_biz_franchis"'); ?> <br />
      <?php echo form_label('<p>' . _e('business_is_home_based') . '</p>', 'is_biz_hb') ?> <?php echo form_checkbox('is_biz_hb', 1, $results["records"][0]->is_biz_hb, 'id="is_biz_hb"'); ?> </li>
    <li> <?php echo form_label('<dfn>' . _e('seller_financing_info') . '</dfn>', 'seller_fincng_info') ?> <?php echo form_textarea(array('name' => 'seller_fincng_info', 'id' => 'seller_fincng_info', 'size' => 30, 'value' => $results["records"][0]->seller_fincng_info, 'placeholder' => _e('training_support_plcholder'), 'rows' => 5)); ?></li>
    <li><?php echo form_label('<dfn>' . _e('training_support') . '</dfn>', 'training_support') ?> <?php echo form_textarea(array('name' => 'training_support', 'id' => 'training_support', 'value' => $results["records"][0]->training_support, 'placeholder' => _e('training_support_plcholder'), 'rows' => 5)); ?></li>
    <li> <?php echo form_label('<dfn>' . _e('reason_for_selling') . '</dfn>', 'selling_reason') ?> <?php echo form_textarea(array('name' => 'selling_reason', 'id' => 'selling_reason', 'value' => $results["records"][0]->selling_reason, 'placeholder' => _e( 'reason_for_selling_plcholder' ), 'rows' => 5)); ?></li>
    <li> <?php echo form_label('<dfn>' . _e('facilities') . '</dfn>', 'facilities') ?> <?php echo form_textarea(array('name' => 'facilities', 'id' => 'facilities', 'value' => $results["records"][0]->facilities, 'placeholder' => _e('facilities_plcholder'), 'rows' => 5)); ?></li>
    <li> <?php echo form_label('<dfn>' . _e('market_outlook_competition') . '</dfn>', 'mkt_outlook_cmp') ?> <?php echo form_textarea(array('name' => 'mkt_outlook_cmp', 'id' => 'mkt_outlook_cmp', 'value' => $results["records"][0]->mkt_outlook_cmp, 'placeholder' => _e('market_outlook_competition_plcholder'), 'rows' => 5)); ?></li>
    <li> <?php echo form_label('<dfn>' . _e('keywords') . '</dfn>', 'keywords') ?> <?php echo form_textarea(array('name' => 'keywords', 'id' => 'keywords', 'value' => $results["records"][0]->keywords, 'placeholder' => _e('keywords_plcholder'), 'rows' => 5)); ?></li>
    <li><?php echo form_label('<dfn>' . _e('image') . '</dfn>', 'images') ?>
    	<img src="<?php echo $this->template->get_frontend_image( showImage( $results["records"][0]->image_information, '1', 'bizlisting/no.jpg' ) );?>" alt="<?php echo _e('biz_image_not_available') ?>"  width="30%" height="30%"/>
      <div id="imageUpload">
        <div class="imageplacer"><span class="otherbutton"></span><?php echo form_upload(array('name' => 'images[]', 'placeholder' => 'add images')); ?></div>
        <!--<a href="#" class="add_more_images" onclick="return addMoreElement('#imageUpload', '.otherbutton', '<div class=\'imageplacer\'>', '</div>', this)">Add more</a>                    --> 
      </div>
    </li>
    <li> <?php echo form_hidden('status', '2'); ?> <?php echo form_hidden('method', 'edit'); ?> <?php echo form_submit(array('name' => 'biz_listing_update', 'id' => 'biz_listing_update', 'class' => 'margin-top10'), _e('Update')); ?></li>
    <?php echo form_close() ?>
  </ul>
</div>
<?php
            $js = $this->template->admin_view('biz_listing_js', '', true, "biz_listing");
            $this->template->embed_asset_code('frontend', 'js', 'biz-listing-js', $js);

            $province_js_function = $this->load->view("web/admin/province/province_js_function.php", '', true);
            $this->template->embed_asset_code('frontend', 'js', 'province_js_function', $province_js_function);

            $county_js_function = $this->load->view("web/admin/county/county_js_function.php", '', true);
            $this->template->embed_asset_code('frontend', 'js', 'county_js_function', $county_js_function);
        ### If Valid Edit Id End ###
        else:
            ### If Invalid Edit Id Begin ###
            ?>
<div class="error">
  <p><?php echo _e('no_biz_listing_found') ?></p>
</div>
<?php
        ### If Invalid Edit Id End ###
        endif;
        ?>
<?php ### Edit Section End ####  ?>
<?php else: ?>
<?php ### List Section Begin ###  ?>
<div class="manage-biz-listing-search-cont"><?php echo form_open('', array('name' => 'biz_listing_search_form', 'id' => 'biz_listing_search_form', 'class' => 'width100 float-left margin-bottom30', 'method' => 'get')) ?>
  <table id="bizlist">
    <tr id="caption_section">
      <th class="headline"><a href="<?php echo sortBy($var['CFG'], 'sortbyheadline') ?>" class="<?php echo sortClass($var['CFG'], 'sortbyheadline') ?>"><?php echo _e('headline') ?></a></th>
      <th class="tagline"><a href="<?php echo sortBy($var['CFG'], 'sortbytagline') ?>" class="<?php echo sortClass($var['CFG'], 'sortbytagline') ?>"><?php echo _e('tagline') ?></a></th>
      <th class="imagecont"><?php echo _e('image') ?></a></th>
      <th class="time-created"><a href="<?php echo sortBy($var['CFG'], 'sortbytime') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbytime') ?>"><?php echo _e('time_created') ?></a></th>
      <th class="approve"><?php echo _e('biz_approve_status') ?></th>
      <th class="status"><a href="<?php echo sortBy($var['CFG'], 'sortbyactive') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbyactive') ?>"><?php echo _e('status') ?></a></th>
      <th class="actionth"><?php echo _e('action') ?></th>
    </tr>
    <tr id="blanktr">
      <td colspan="8">&nbsp;</td>
    </tr>
    <tr id="filter_section">
      <td><?php echo form_input(array('name' => 'headline', 'id' => 'headline', 'placeholder' => _e('search_by_headline'), 'size' => 20, 'value' => $this->input->get('headline'))); ?></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?php echo form_dropdown('is_trashed', $var['filter_status_dd'], $this->input->get('is_trashed') != '' ? $this->input->get('is_trashed') : '' );?></td>
      <td><div class="tooltip-cont margin-left30 float-left"> <div class="tooltip padding-right35">Reset</div> <a class="refresh-blue" title="" href="<?php echo site_url('biz_listing/manage')?>">&nbsp;</a> </div> <span class="line float-left"> &nbsp; | </span> <div class="tooltip-cont margin-left10 float-left"> <div class="tooltip padding-right30">Filter</div> <?php echo form_button(array('name' => 'search', 'id' => 'search', 'class' => 'filter-blue', 'onclick' => 'return goFilter(this)'), _e('filter')); ?></div></td>
    </tr>
    <tr id="blanktr">
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr id="multiple_action_section">
      <td colspan="6"><a onclick="return selectAll(this)" class="btn-type1 margin-right10 float-left" title="<?php echo _e('select_all') ?>" href="#"><span class="ion-checkmark-circled"></span><?php echo _e('select_all') ?></a> <a onclick="return unselectAll(this)" class="btn-type1 margin-right10 float-left" title="<?php echo _e('unselect_all') ?>" href="#"><span class="ion-close-circled"></span><?php echo _e('unselect_all') ?></a></td>
      <td><?php echo form_dropdown('action', $var['action_dd']); ?>
        <button onclick="return goAction(this)" class="margin-left5 go" id="go" type="button" name="go"><?php echo _e('go'); ?> <span class = "ion-play"></span></button></td>
    </tr>
    <tr id = "blanktr">
      <td colspan = "7">&nbsp;</td>
    </tr>
    <?php ### If Record Found Begin ### 
            ?>
    <?php
            if (count($results["records"])) {
                ?>
    <?php foreach ($results["records"] as $value): ?>
    <tr id="oddeven">
      <td><label><?php echo form_checkbox('row_id[]', $value->ai_biz_listing_id); ?><?php echo $value->headline ?></label></td>
      <td align="center"><?php echo $value->tagline ?></td>
      <td align="center"><img src="<?php echo $this->template->get_frontend_image(showImage($value->image_information, '1', 'bizlisting/no.jpg'));?>" alt="<?php echo _e('biz_image_not_available') ?>"  width="30%" height="30%"/></td>
      <td align="center"><?php echo $value->creation_time ?></td>
      <td align="center"><?php echo $value->active ? _e("approved") : _e("suspended") ?></td>
      <td align="center"><?php echo $value->is_trashed ? _e("inactive") : _e("active") ?></td>
      <td align="center"><a href="<?php echo createEditUrl($value->ai_biz_listing_id) ?>" class="ion-edit"></a> | &nbsp;<a href="<?php echo createRevertDeleteUrl($value->ai_biz_listing_id, $value->is_trashed) ?>" class="editrevert<?php echo $value->is_trashed ?>"></a></td>
    </tr>
    <?php endforeach; ?>
    <tr>
      <td colspan="7"><?php echo $results["pagination"] ?></td>
    </tr>
    <script type="text/javascript">
                    var deleteconformstring = '<?php echo _e('confirm_del_biz_listing') ?>';
                    var pdeleteconformstring = '<?php echo _e('confirm_p_del_biz_listing') ?>';
                </script>
    <?php ### If Record Found End ###   ?>
    <?php
            }
            else {
                ?>
    <?php ### If No Record Found Begin ### ?>
    <tr>
      <td colspan="7"><div class="error">
          <p><?php echo _e('no_biz_listing_found') ?></p>
        </div></td>
    </tr>
    <?php ### If No Record Found Ends ###  ?>
    <?php }
            ?>
  </table>
  <?php echo form_close() ?></div>
<?php ### List Section Ends ###  ?>
<?php
    endif;
endif;
### If No Error End ###
?>
