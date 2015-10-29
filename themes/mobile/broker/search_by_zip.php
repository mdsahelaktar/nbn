<!--body start-->
  <div id="body">
    <div class="wrapper">
      <div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
        <div class="width60 float-left">
        	<h2 class="helvetica float-left">Business Brokers Near <?php echo $postalcode; ?></h2>
       		
              <p><b> No results found that match your search criteria. </b></p>
            
            <p class="float-left margin-top40"><strong>Disclaimer:</strong> BizQuest provides this Business Broker Directory as a service to you, but that we do not make any claims or representations about any of these business user_categorys. <a href="#" target="_self" class="global">Read the full Disclaimer.</a></p>
            
        </div>
        <div class="width320 float-right">
         	<p class="bg-blue padding-bottom10 padding-left10 padding-right10 padding-top10 font16 white">Business Brokers: Get Listed Now</p>
            <div class="bg-lightbrown padding-bottom10 padding-left10 padding-right10 padding-top10 float-left ">
            	<p><strong>Reach millions of prospective buyers and sellers.</strong> Post your business for sale listings. Broker memberships start at only $49.95 a month. </p>
            </div>
        </div>
      </div>
    </div>
  </div>
  <!--body end--> 
<?php
$biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);
?>
