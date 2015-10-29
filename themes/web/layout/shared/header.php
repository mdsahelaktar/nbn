<?php
$config_var = $this->config->item('var');
$var = array_merge( $config_var, ( is_array( $var ) ? $var : array() ) );
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
                <?php if (isLoggedIn()) : ?>
                    <div id="loggedin_cont" class="login"><a href="#" onclick="logOut(afterLogOut)" target="_self"?><?php echo _e('Logout') ?></a></div>
                <?php else : ?>
                    <div id="loggedin_cont" class="login"><?php echo anchor('login/', _e('Login')) ?></div>
                <?php endif; ?>
                <?php $this->template->frontend_view('quick_search', '', FALSE, "biz_listing"); ?>
                <ul>
                    <li> <?php echo anchor('user', _e('Sign Up'), array('title' => _e('Sign Up'))) ?> </li>
                    <li> <?php echo anchor('broker', _e('Find a Broker'), array('title' => _e('Find a Broker'))) ?> </li>
                    <li> <?php echo anchor('biz_listing', _e('Sell a Business'), array('title' => _e('Sell a Business'))) ?></li>
                    <li> <?php echo anchor('franchise', _e('Buy a Franchise'), array('title' => _e('Buy a Franchise'))) ?></li>
                    <li> <?php echo anchor('biz_listing', _e('Buy a Business'), array('title' => _e('Buy a Business'))) ?> </li>
                </ul>
            </div>
            <!--big header right head end--> 

            <!--small header right head start-->
            <div class="slide-menu_outer">
                <div class="slide-menu">
                    <p><a href="#" target="_self"><?php echo _e('Browse'); ?></a></p>
                    <ul>

                        <li> <?php echo anchor('biz_listing', _e('Buy a Business'), array('title' => _e('Buy a Business'))) ?> </li>
                        <li> <?php echo anchor('franchise', _e('Buy a Franchise'), array('title' => _e('Buy a Franchise'))) ?> </li>
                        <li> <?php echo anchor('biz_listing', _e('Sell a Business'), array('title' => _e('Sell a Business'))) ?> </li>
                        <li> <?php echo anchor('broker', _e('Find a Broker'), array('title' => _e('Find a Broker'))) ?></li>
                        <li> <?php echo anchor('user', _e('Sign Up'), array('title' => _e('Sign Up'))) ?></li>
                    </ul>
                </div>               
            </div>
            <div class="search-form"> <?php echo form_open('biz_listing/search', array('name' => 'liquid_search_form', 'id' => 'liquid_search_form', 'method' => 'get')) ?>
    <div class="customeselect">
        <select>
            <option selected="selected"><?php echo _e('Business For Sale') ?></option>            
        </select>
    </div>
    <div class="customeselect"> <?php echo form_dropdown('biz_domain_id', $var['biz_domain_dd'], $biz_domain_id, 'id="header_biz_domain_id" data-display="' . _e('Type of Business') . '" data-biztype-sel="#header_biz_type_id" onchange="getBizTypeByBizDomain(this)"'); ?> </div>
    <div class="customeselect"> <?php echo form_dropdown('biz_type_id', $var['biz_types_dd'], $biz_type_id, 'id="header_biz_type_id" disabled="disabled" data-display="' . _e('Type of Business') . '"'); ?> </div>
    <div class="customeselect"> <?php echo form_dropdown('country_id', $var['country_dd'], placeCountryId( $country_id, $var['client_country_id'], $var['default_country_id'] ), 'id="liquid_form_country_id" class="width170" data-display="' . _e('Location') . '"'); ?> </div>
    <?php echo form_submit(array('name' => 'search', 'id' => 'liquid_search_form', 'class' => 'submit1'), _e('')); ?> <?php echo form_close() ?> </div>
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
            	<div class="choose">
            	<?php echo form_dropdown('choose_default_country', $var['country_dd'], $var['client_country_id'], 'id="choose_default_country" onchange="setClientCountry(this)"'); ?><p><?php _e('Choose your default country') ?></p>
            <?php if($var['default_country_id'] != $var['client_country_id']):?>
            <p><a href="javascript:void(0)" onclick="setDefaultCountry('<?php echo $var['default_country_id'] ?>')"><?php _e('Or Set as default') ?></a></p>
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