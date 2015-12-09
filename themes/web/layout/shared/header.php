<?php
$config_var = $this->config->item('var');
$var = array_merge( $config_var, ( is_array( $var ) ? $var : array() ) );
$current_user = isLoggedIn();
?>
<div class="cbp-af-header">
  <div class="cbp-af-inner">
    <div id="header-wrap">
      <div class="logo">
        <h1><a href="<?php echo site_url() ?>" title="<?php echo _e('Need Biz Now') ?>"><?php echo _e('Need Biz Now') ?></a></h1>
        <!-- This title will dynamic --> 
      </div>
      <!--big header right head start-->
      <div class="righthead">
        <div class="top">
          <?php if ( $current_user ) : ?>
          <div id="loggedin_cont" class="login"><a href="#" onclick="logOut(afterLogOut)" target="_self"?><?php echo _e('logout') ?></a></div>
          <?php else : ?>
          <div id="loggedin_cont" class="login"><?php echo anchor('login/', _e('login')) ?></div>
          <?php endif; ?>
        </div>
        <?php $this->template->frontend_view('quick_search', '', FALSE, "biz_listing"); ?>
        <ul>
          <?php if ( !$current_user ) : ?>
          <li> <?php echo anchor('package?ct=2&rl=2', _e('sign_up'), array('title' => _e('sign_up'))) ?> </li>
          <?php endif;?>
          <li> <?php echo anchor('broker', _e('find_a_broker'), array('title' => _e('find_a_broker'))) ?> </li>
          <li> <?php echo anchor('biz_listing', _e('sell_a_business'), array('title' => _e('sell_a_business'))) ?></li>
          <li> <?php echo anchor('franchise', _e('buy_a_franchise'), array('title' => _e('buy_a_franchise'))) ?></li>
          <li> <?php echo anchor('biz_listing/search', _e('buy_a_business'), array('title' => _e('buy_a_business'))) ?> </li>
          <?php if ( $current_user ) : ?>
          <li> <?php echo anchor('user/edit_profile', _e('my_account'), array( 'title' => _e('my_account') )) ?> </li>
          <?php endif;?>
        </ul>
      </div>
      <!--big header right head end--> 
      
      <!--small header right head start-->
      <div class="slide-menu_outer">
        <div class="slide-menu">
          <p><a href="#" target="_self"><?php echo _e('browse'); ?></a></p>
          <ul>
            <?php if ( $current_user ) : ?>
            <li> <?php echo anchor('user/edit_profile', _e('my_account'), array( 'title' => _e('my_account') )) ?> </li>
            <?php endif;?>
            <li> <?php echo anchor('biz_listing', _e('buy_a_business'), array('title' => _e('buy_a_business'))) ?> </li>
            <li> <?php echo anchor('franchise', _e('buy_a_franchise'), array('title' => _e('buy_a_franchise'))) ?> </li>
            <li> <?php echo anchor('biz_listing', _e('sell_a_business'), array('title' => _e('sell_a_business'))) ?> </li>
            <li> <?php echo anchor('broker', _e('find_a_broker'), array('title' => _e('find_a_broker'))) ?></li>
            <?php if ( !$current_user ) : ?>
            <li> <?php echo anchor('package?ct=2&rl=2', _e('sign_up'), array('title' => _e('sign_up'))) ?> </li>
            <?php endif;?>
          </ul>
        </div>
      </div>
      <div class="search-form"> <?php echo form_open('biz_listing/search', array('name' => 'liquid_search_form', 'id' => 'liquid_search_form', 'method' => 'get')) ?>
        <div class="customeselect">
          <select>
            <option selected="selected"><?php echo _e('business_for_sale') ?></option>
          </select>
        </div>
        <div class="customeselect"> <?php echo form_dropdown('biz_domain_id', $var['biz_domain_dd'], $biz_domain_id, 'id="header_biz_domain_id" data-display="' . _e('type_of_business') . '" data-biztype-sel="#header_biz_type_id" onchange="getBizTypeByBizDomain(this)"'); ?> </div>
        <div class="customeselect"> <?php echo form_dropdown('biz_type_id', $var['biz_types_dd'], $biz_type_id, 'id="header_biz_type_id" disabled="disabled" data-display="' . _e('type_of_business') . '"'); ?> </div>
        <div class="customeselect"> <?php echo form_dropdown('country_id', $var['country_dd'], placeCountryId( $country_id, $var['client_country_id'], $var['default_country_id'] ), 'id="liquid_form_country_id" class="width170" data-display="' . _e('location') . '"'); ?> </div>
        <?php echo form_submit(array('name' => 'search', 'id' => 'liquid_search_form', 'class' => 'submit1'), ''); ?> <?php echo form_close() ?> </div>
      <?php
		$biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
		$this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);
		$province_js_function = $this->load->view("web/admin/province/province_js_function.php", '', true);
		$this->template->embed_asset_code('frontend', 'js', 'province_js_function', $province_js_function);
		$county_js_function = $this->load->view("web/admin/county/county_js_function.php", '', true);
		$this->template->embed_asset_code('frontend', 'js', 'county_js_function', $county_js_function);
		?>
      <!--small header right head end-->
      <div class="defaultcountry">
        <div class="choose"> <?php echo form_dropdown('choose_default_country', $var['country_dd'], $var['client_country_id'], 'id="choose_default_country" onchange="setClientCountry(this)"'); ?>
          <p>
            <?php _e('choose_your_default_country') ?>
          </p>
          <?php if($var['default_country_id'] != $var['client_country_id']):?>
          <p><a href="javascript:void(0)" onclick="setDefaultCountry('<?php echo $var['default_country_id'] ?>')">
            <?php _e('or_set_as_default') ?>
            </a></p>
          <?php endif;?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$login_js = $this->template->admin_view('login_js_function', '', true, "login");
$this->template->embed_asset_code('frontend', 'js', 'login_js_function', $login_js);

$common_js = $this->template->admin_view('common_js_function', '', true, "common");
$this->template->embed_asset_code('frontend', 'js', 'common_js_function', $common_js);
?>
