<!--body start-->
  <div id="body">
    <div class="wrapper">
      <div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
        <div class="width60 float-left">
        	<h2 class="helvetica float-left">Business Broker Directory</h2>
       		<p>Welcome to the BizQuest Business Broker Directory. <br /> Please enter your zip code or click on a state below for a listing of business user_categorys near you. </p>
            <div class="width95 bg-grey padding-bottom15 padding-left15 padding-right10 padding-top15 margin-top15 float-left">
            	<h2 class="helvetica18">Search Business Brokers By Postal Code</h2>
                <?php echo form_open( 'broker/searchbroker', array( 'name' => 'zip_search_form', 'id' => 'zip_search_form', 'class' => 'cont-biz-seller', 'method' => 'get') )?> 
                	<dfn class="float-left margin-right10">Enter Your Postal Code:</dfn> 
                    <?php echo form_input( array( 'name' => 'postalcode', 'id' => 'postalcode', 'placeholder' => 'Postal Code' , 'value' => $zip, 'onkeypress' =>'autodrop()') );?>
                    <input type="submit" name="search" value="Search" class="margin-left10 orange" />
                <?php echo form_close()?>
            </div>
            
            <?php echo $province_list; ?>
            <?php echo $country_list; ?>
            
            <p class="float-left margin-top40"><strong>Disclaimer:</strong> BizQuest provides this Business Broker Directory as a service to you, but that we do not make any claims or representations about any of these business user_categorys. <a href="#" target="_self" class="global">Read the full Disclaimer.</a></p>
            
         </div>
        <div class="width320 float-right">
         	<p class="bg-blue padding-bottom10 padding-left10 padding-right10 padding-top10 font16 white">Business Brokers: Get Listed Now</p>
            <div class="bg-lightbrown padding-bottom10 padding-left10 padding-right10 padding-top10 float-left ">
            	<p><strong>Reach millions of prospective buyers and sellers.</strong> Post your business for sale listings. Broker memberships start at only $49.95 a month. </p>
                <a href="user?ct=10&rl=1" target="_self" class="global4 font14 float-left margin-top20 padding-bottom5 padding-top5 padding-left20 padding-right20 margin-left45 margin-bottom10">Become a Broker Member</a>
            </div>
        </div>
      </div>
    </div>
  </div>
  <!--body end--> 
<?php
$biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);

$broker_js = $this->template->frontend_view( 'broker_js', '', true, "broker");
$this->template->embed_asset_code('frontend', 'js', 'broker-js', $broker_js);

$this->template->add_remove_frontend_css(array('jquery-ui.css'), 'add');
$this->template->add_remove_frontend_js(array('jquery-ui.js'), 'add');
?>
