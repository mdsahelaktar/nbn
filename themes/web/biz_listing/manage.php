<div id="body">
  <div class="wrapper">
    <div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
      <?php
### Edit Section Begin ### 
### If No Error Begin ###
if ($response["event"] != "error"):
    ?>
      <?php if ($edit_id): ?>
      <?php echo anchor(getBackUrl('edit_id'), '<span class="ion-android-system-back"></span>' . _e('Back'), array('title' => _e('Back to List'), 'class' => 'btn-type1 margin-right10 margin-top10 float-left')) ?>
      <?php
        ### If Valid Edit Id Begin ###
        if (isset($results["records"][0]->ai_biz_listing_id)):
            ?>
            
      <div class="fullwidthform">
	  <?php echo renderResposeMessage('biz_listing', $response) ?>
        <ul>
          <?php
            echo form_open('', array('name' => 'biz_listing_edit_form', 'id' => 'biz_listing_edit_form', 'class' => 'width100 float-left margin-bottom30 margin-top10'));
            echo form_hidden('row_id', $results["records"][0]->ai_biz_listing_id);
            ?>
          <li> <?php echo form_label('<p>' . _e('Headline') . '</p>', 'headline') ?> <?php echo form_input(array('name' => 'headline', 'id' => 'headline', 'size' => 30, 'value' => $results["records"][0]->headline, 'placeholder' => 'add headline here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' => _e('Headline'), 'data-rules' => 'required')); ?></li>
          <li> <?php echo form_label('<p>' . _e('Tagline') . '</p>', 'tagline') ?> <?php echo form_input(array('name' => 'tagline', 'id' => 'tagline', 'size' => 30, 'value' => $results["records"][0]->tagline, 'placeholder' => 'add tagline here', 'class' => 'validate', 'data-display' => _e('Tagline'), 'data-rules' => 'required')); ?></li>
          <li><?php echo form_label('<p>' . _e('Description') . '</p>', 'description') ?> <?php echo form_textarea(array('name' => 'description', 'id' => 'description', 'value' => $results["records"][0]->description, 'placeholder' => 'add description here', 'class' => 'validate', 'data-display' => _e('Description'), 'rows' => 5, 'data-rules' => 'required')); ?></li>
          <li> <?php echo form_label('<p>' . _e('Type of Business') . '</p>', 'biz_type_id') ?> <?php echo form_dropdown('biz_type_id', $var['biz_types_dd'], $results["records"][0]->biz_type_id, 'id="biz_type_id" class="validate" data-display="' . _e('Type of Business') . '" data-rules="required"'); ?></li>
          <li> <?php echo form_label('<p>' . _e('Other Business type') . '</p>', 'other_biz_type_id') ?> <?php echo form_dropdown('other_biz_type_id', $var['biz_types_dd'], $results["records"][0]->other_biz_type_id, 'id="other_biz_type_id"'); ?></li>
          <li> <?php echo form_label('<p>' . _e('Country') . '</p>', 'country_id') ?> <?php echo form_dropdown('country_id', $var['countries_dd'], $results["records"][0]->country_id, 'id="country_id" onchange="getProvinceByCountry(this)" data-province-sel="#province_id" class="validate" data-display="' . _e('Country') . '" data-rules="required"'); ?></li>
          <li> <?php echo form_label('<p>' . _e('State/Province') . '</p>', 'province_id') ?> <?php echo form_dropdown('province_id', $var['provinces_dd'], $results["records"][0]->province_id, 'id="province_id" disabled="disabled" onchange="getCountyByProvince(this)" data-county-sel="#county_id" class="validate" data-display="' . _e('Province') . '" data-rules="required"'); ?></li>
          <li> <?php echo form_label('<p>' . _e('County') . '</p>', 'county_id') ?> <?php echo form_dropdown('county_id', $var['counties_dd'], $results["records"][0]->county_id, 'id="county_id" disabled="disabled" class="validate" data-display="' . _e('County') . '" data-rules="required"'); ?></li>
          <li>
            <div class="margin-top35"><?php echo form_checkbox('is_county_cnfdntl', 1, $results["records"][0]->is_county_cnfdntl, 'id="is_county_cnfdntl"'); ?> <?php echo form_label('<p>' . _e('Keep the county information confidential') . '</p>', 'is_county_cnfdntl') ?></div>
          </li>
          <li> <?php echo form_label('<p>' . _e('City') . '</p>', 'city') ?> <?php echo form_input(array('name' => 'city', 'size' => 30, 'value' => $results["records"][0]->city, 'id' => 'city', 'placeholder' => 'city')); ?></li>
          <li> <?php echo form_label('<p>' . _e('Asking Price') . '</p>', 'asking_price') ?> <?php echo form_input(array('name' => 'asking_price', 'size' => 30, 'value' => $results["records"][0]->asking_price, 'id' => 'asking_price', 'placeholder' => 'asking price')); ?></li>
          <li>
            <div class="margin-top35"> <?php echo form_checkbox('is_fincng_avlble', 1, $results["records"][0]->is_fincng_avlble, 'id="is_fincng_avlble"'); ?> <?php echo form_label('<p>' . _e('Seller financing is available') . '</p>', 'is_fincng_avlble') ?></div>
          </li>
          <li> <?php echo form_label('<p>' . _e('Year Established') . '</p>', 'year_established') ?> <?php echo form_input(array('name' => 'year_established', 'id' => 'year_established', 'size' => 30, 'value' => $results["records"][0]->year_established, 'placeholder' => 'e.g. 1999')); ?></li>
          <li> <?php echo form_label('<p>' . _e('Employees') . '</p>', 'employees') ?> <?php echo form_input(array('name' => 'employees', 'id' => 'employees', 'size' => 30, 'value' => $results["records"][0]->employees, 'placeholder' => 'e.g. 8 FTE; 4 PTE')); ?></li>
          <li> <?php echo form_label('<p>' . _e('Business Website') . '</p>', 'biz_website') ?> <?php echo form_input(array('name' => 'biz_website', 'id' => 'biz_website', 'size' => 30, 'value' => $results["records"][0]->biz_website, 'placeholder' => 'add business website here')); ?></li>
          <li><?php echo form_label('<p>' . _e('Gross Revenue') . '</p>', 'gross_revenue') ?> <?php echo form_input(array('name' => 'gross_revenue', 'id' => 'gross_revenue', 'size' => 30, 'value' => $results["records"][0]->gross_revenue, 'placeholder' => 'add gross revenue here')); ?></li>
          <li> <?php echo form_label('<p>' . _e('Gross Revenue Comments') . '</p>', 'gross_revenue_comments') ?> <?php echo form_input(array('name' => 'gross_revenue_comments', 'id' => 'gross_revenue_comments', 'size' => 30, 'value' => $results["records"][0]->gross_revenue_comments, 'placeholder' => 'add gross revenue comments here')); ?></li>
          <li> <?php echo form_label('<p>' . _e('Cash Flow') . '</p>', 'cash_flow') ?> <?php echo form_input(array('name' => 'cash_flow', 'id' => 'cash_flow', 'size' => 30, 'value' => $results["records"][0]->cash_flow, 'placeholder' => 'add cash flow here')); ?></li>
          <li><?php echo form_label('<p>' . _e('Cash Flow Comments') . '</p>', 'cash_flow_comments') ?> <?php echo form_input(array('name' => 'cash_flow_comments', 'id' => 'cash_flow_comments', 'size' => 30, 'value' => $results["records"][0]->cash_flow_comments, 'placeholder' => 'add cash flow comments here')); ?></li>
          <li> <?php echo form_label('<p>' . _e('Value of Inventory') . '</p>', 'inv_value') ?> <?php echo form_input(array('name' => 'inv_value', 'id' => 'inv_value', 'size' => 30, 'value' => $results["records"][0]->inv_value, 'placeholder' => 'add value of inventory here')); ?></li>
          <li>
            <div class="margin-top35"> <?php echo form_checkbox('is_inv_included', 1, $results["records"][0]->is_inv_included, 'id="is_inv_included"'); ?> <?php echo form_label('<p>' . _e('Inventory is included in asking price.') . '</p>', 'is_inv_included') ?></div>
          </li>
          <li> <?php echo form_label('<p>' . _e('Value of FF&E') . '</p>', 'ffe_value') ?> <?php echo form_input(array('name' => 'ffe_value', 'id' => 'ffe_value', 'size' => 30, 'value' => $results["records"][0]->ffe_value, 'placeholder' => 'add Furniture, Fixtures, and Equipment price here')); ?></li>
          <li>
            <div class="margin-top20"><?php echo form_checkbox('is_ffe_included', 1, $results["records"][0]->is_ffe_included, 'id="is_ffe_included"'); ?> <?php echo form_label('<p>' . _e('Furniture, Fixtures, and Equipment included in asking price.') . '</p>', 'is_ffe_included') ?></div>
          </li>
          <li> <?php echo form_label('<p>' . _e('Value of Real Estate') . '</p>', 'rs_value') ?> <?php echo form_input(array('name' => 'rs_value', 'class' => 'rs_value margin-bottom10', 'id' => 'rs_value', 'size' => 30, 'value' => $results["records"][0]->rs_value, 'placeholder' => 'add real estate price here')); ?><br />
            <?php echo form_label('<p>' . _e('Real Estate included in asking price.') . '</p>', 'is_rs_included') ?><?php echo form_checkbox('is_rs_included', 1, $results["records"][0]->is_rs_included, 'id="is_rs_included"'); ?>  <br />
           <?php echo form_label('<p>' . _e('Business is relocatable.') . '</p>', 'is_biz_relctble') ?> <?php echo form_checkbox('is_biz_relctble', 1, $results["records"][0]->is_biz_relctble, 'id="is_biz_relctble"'); ?>  <br />
           <?php echo form_label('<p>' . _e('Business is a franchise.') . '</p>', 'is_biz_franchis') ?>  <?php echo form_checkbox('is_biz_franchis', 1, $results["records"][0]->is_biz_franchis, 'id="is_biz_franchis"'); ?> <br />
            <?php echo form_label('<p>' . _e('Business is home based') . '</p>', 'is_biz_hb') ?> <?php echo form_checkbox('is_biz_hb', 1, $results["records"][0]->is_biz_hb, 'id="is_biz_hb"'); ?>  </li>
          <li> <?php echo form_label('<p>' . _e('Seller Financing Info.') . '</p>', 'seller_fincng_info') ?> <?php echo form_textarea(array('name' => 'seller_fincng_info', 'id' => 'seller_fincng_info', 'size' => 30, 'value' => $results["records"][0]->seller_fincng_info, 'placeholder' => 'add seller financing info here', 'rows' => 5)); ?></li>
          <li><?php echo form_label('<p>' . _e('Training & Support') . '</p>', 'training_support') ?> <?php echo form_textarea(array('name' => 'training_support', 'id' => 'training_support', 'value' => $results["records"][0]->training_support, 'placeholder' => 'add training support info here', 'rows' => 5)); ?></li>
          <li> <?php echo form_label('<p>' . _e('Reason for Selling') . '</p>', 'selling_reason') ?> <?php echo form_textarea(array('name' => 'selling_reason', 'id' => 'selling_reason', 'value' => $results["records"][0]->selling_reason, 'placeholder' => 'add reason for selling here', 'rows' => 5)); ?></li>
          <li> <?php echo form_label('<p>' . _e('Facilities') . '</p>', 'facilities') ?> <?php echo form_textarea(array('name' => 'facilities', 'id' => 'facilities', 'value' => $results["records"][0]->facilities, 'placeholder' => 'add facilities here', 'rows' => 5)); ?></li>
          <li> <?php echo form_label('<p>' . _e('Market Outlook/Competition') . '</p>', 'mkt_outlook_cmp') ?> <?php echo form_textarea(array('name' => 'mkt_outlook_cmp', 'id' => 'mkt_outlook_cmp', 'value' => $results["records"][0]->mkt_outlook_cmp, 'placeholder' => 'add about market outlook and competition info here', 'rows' => 5)); ?></li>
          <li> <?php echo form_label('<p>' . _e('Keywords') . '</p>', 'keywords') ?> <?php echo form_textarea(array('name' => 'keywords', 'id' => 'keywords', 'value' => $results["records"][0]->keywords, 'placeholder' => 'add about keywords here', 'rows' => 5)); ?></li>
          <li><?php echo form_label('<p>' . _e('Images') . '</p>', 'images') ?>          		
                <div id="imageUpload">
                    <div class="imageplacer"><span class="otherbutton"></span><?php echo form_upload(array('name' => 'images[]', 'placeholder' => 'add images')); ?></div>
                    <!--<a href="#" class="add_more_images" onclick="return addMoreElement('#imageUpload', '.otherbutton', '<div class=\'imageplacer\'>', '</div>', this)">Add more</a>                    -->
                </div></li>
          <li> <?php echo form_hidden('method', 'edit'); ?> <?php echo form_submit(array('name' => 'biz_listing_update', 'id' => 'biz_listing_update', 'class' => 'margin-top10'), _e('Update')); ?></li>
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
        <p><?php echo _e('No records found') ?></p>
      </div>
      <?php
        ### If Invalid Edit Id End ###
        endif;
        ?>
      <?php ### Edit Section End ####  ?>
      <?php else: ?>
      <?php ### List Section Begin ###  ?>
      <div class="manage-biz-listing-search-cont"><?php echo form_open('', array('name' => 'biz_listing_search_form', 'id' => 'biz_listing_search_form', 'class' => 'width100 float-left margin-bottom30 margin-top10', 'method' => 'get')) ?>
      <table id="bizlist">
        <tr id="caption_section">
          <th><a href="<?php echo sortBy($var['CFG'], 'sortbyheadline') ?>" class="<?php echo sortClass($var['CFG'], 'sortbyheadline') ?>"><?php echo _e('Headline') ?></a></th>
          <th><a href="<?php echo sortBy($var['CFG'], 'sortbytagline') ?>" class="<?php echo sortClass($var['CFG'], 'sortbytagline') ?>"><?php echo _e('Tagline') ?></a></th>         
          <th><?php echo _e('Images') ?></a></th>
          <th><a href="<?php echo sortBy($var['CFG'], 'sortbytime') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbytime') ?>"><?php echo _e('Time Created') ?></a></th>
          <th><a href="<?php echo sortBy($var['CFG'], 'sortbymfdtime') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbymfdtime') ?>"><?php echo _e('Modified time') ?></a></th>
          <th class="actionth"><?php echo _e('Approve Status') ?></th>
          <th><a href="<?php echo sortBy($var['CFG'], 'sortbyactive') ?>"  class="<?php echo sortClass($var['CFG'], 'sortbyactive') ?>"><?php echo _e('Status') ?></a></th>          
          <th class="actionth"><?php echo _e('Action') ?></th>
        </tr>
        <tr id="blanktr">
          <td colspan="8">&nbsp;</td>
        </tr>
        <tr id="filter_section">
          <td><?php echo form_input(array('name' => 'headline', 'id' => 'headline', 'placeholder' => 'search by headline', 'size' => 20, 'value' => $this->input->get('headline'))); ?></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td><?php echo form_dropdown('is_trashed', $var['filter_status_dd'], $this->input->get('is_trashed') != '' ? $this->input->get('is_trashed') : '' );?></td>          
          <td><?php echo anchor('biz_listing/manage', _e('Reset'), array('title' => _e('Reset'), 'class' => 'refresh btn-type1 margin-right10 margin-left20 float-left')) ?> <?php echo form_button(array('name' => 'search', 'id' => 'search', 'class' => 'filter', 'onclick' => 'return goFilter(this)'), _e('Filter')); ?></td>
        </tr>
        <tr id="blanktr">
          <td colspan="8">&nbsp;</td>
        </tr>
        <tr id="multiple_action_section">
          <td colspan="7"><a onclick="return selectAll(this)" class="btn-type1 margin-right10 float-left" title="<?php echo _e('Select All') ?>" href="#"><span class="ion-checkmark-circled"></span><?php echo _e('Select All') ?></a> <a onclick="return unselectAll(this)" class="btn-type1 margin-right10 float-left" title="<?php echo _e('Unselect All') ?>" href="#"><span class="ion-close-circled"></span><?php echo _e('Unselect All') ?></a></td>
          <td><?php echo form_dropdown('action', $var['action_dd']); ?>
            <button onclick="return goAction(this)" class="margin-left5 go" id="go" type="button" name="go"><?php echo _e('Go'); ?> <span class = "ion-play"></span></button></td>
        </tr>
        <tr id = "blanktr">
          <td colspan = "8">&nbsp;</td>
        </tr>
        <?php ### If Record Found Begin ### 
            ?>
        <?php
            if (count($results["records"])) {
                ?>
        <?php foreach ($results["records"] as $value): ?>
        <tr>
          <td><label><?php echo form_checkbox('row_id[]', $value->ai_biz_listing_id); ?><?php echo $value->headline ?></label></td>
          <td align="center"><?php echo $value->tagline ?></td>          
          <td align="center"><img src="<?php echo $this->template->get_frontend_image(showImage($value->image_information, '1', '1', 'bizlisting/no.jpg'));?>" alt="certified image not available"  width="20%" height="20%"/></td>
          <td align="center"><?php echo $value->creation_time ?></td>
          <td align="center"><?php echo $value->update_time ?></td>
          <td align="center"><?php echo $value->active ? _e("approved") : _e("suspended") ?></td>
          <td align="center"><?php echo $value->is_trashed ? _e("Inactive") : _e("Active") ?></td>          
          <td align="center"><a href="<?php echo createEditUrl($value->ai_biz_listing_id) ?>" class="ion-edit"></a> | &nbsp;<a href="<?php echo createRevertDeleteUrl($value->ai_biz_listing_id, $value->is_trashed) ?>" class="editrevert<?php echo $value->is_trashed ?>"></a></td>
        </tr>
        <tr id="blanktr">
          <td colspan="8">&nbsp;</td>
        </tr>
        <?php endforeach; ?>
        <tr>
          <td colspan="8"><?php echo $results["pagination"] ?></td>
        </tr>
        <script type="text/javascript">
                    var deleteconformstring = '<?php echo _e('Confirm delete biz listing') ?>';
                    var pdeleteconformstring = '<?php echo _e('Confirm permanent delete biz listing') ?>';
                </script>
        <?php ### If Record Found End ###   ?>
        <?php
            }
            else {
                ?>
        <?php ### If No Record Found Begin ### ?>
        <tr>
          <td colspan="8"><div class="error">
              <p><?php echo _e('No records found') ?></p>
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
    </div>
  </div>
</div>
