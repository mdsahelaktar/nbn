<!--body start-->
  <div id="body">
    <div class="wrapper">
      <div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
      	<div class="float-left padding-bottom20 margin-bottom20">
        	<div class="width725 float-left">
            	 <h2 class="helvetica float-left"><?php echo ucfirst($results[0]->salutation).' '.ucfirst($results[0]->first_name).' '.ucfirst($results[0]->middle_name).' '. ucfirst($results[0]->last_name)?>,  <?php echo ucfirst($results[0]->service_area)?></h2>
                 <div class="width95 bg-grey padding-bottom5 padding-left20 padding-right20 padding-top5 float-left">
                 	<h2 class="helvetica16 brdr-bot-dot padding-bottom5">Christopher Tallino</h2>
                    <ul class="iconset">
                    	<li class="address"><?php echo $results[0]->service_area ?></li>
                        <li class="call"><?php echo $results[0]->mobile_phone_no ?></li>
                        <li class="fax"><?php echo $results[0]->fax_num ?></li>
                        <li class="email"><?php echo $results[0]->email ?>  </li>
                        <li class="restaurant">Visit HRI Restaurant Brokers Website</li>
                        <li class="map"><a href="#" onclick="initialize(<?php echo $results[0]->latitude?> , <?php echo $results[0]->longitude ?>)" class="global fntwt-bld">View Map</a></li>
                        <li>
                            <div id="map" style="width:600px; height:200px; display:none">
                            <div id="map_canvas" style="width:100%; height:200px"></div>
                            <div id="crosshair"></div>
                            </div>
                        </li>
                    </ul>
                 </div>

                 
                  <h2 class="helvetica18 float-left margin-top20" >Company Information</h2>
                  <p class="margin-bottom10"> <?php echo $results[0]->company_details ?></p>

			<h2 class="helvetica18 float-left margin-top20" >Broker Biography: <?php echo ucfirst($results[0]->salutation).' '.ucfirst($results[0]->first_name).' '.ucfirst($results[0]->middle_name).' '. ucfirst($results[0]->last_name)?></h2>
            <p><span class="light-black fntwt-bld">Phone:</span> <?php echo $results[0]->mobile_phone_no ?>  <span class="light-black fntwt-bld margin-left10">Fax:</span> <?php echo $results[0]->fax_num ?></p>
            <strong class="margin-top10 float-left width100"><?php echo ucfirst($results[0]->salutation).' '.ucfirst($results[0]->first_name).' '.ucfirst($results[0]->middle_name).' '. ucfirst($results[0]->last_name)?></strong>
            <p class="margin-top10 float-left"> <?php echo $results[0]->bio ?></p>
            
            <div class="float-left margin-top25 pos-rel broker-not-found">
            	
    <?php echo $details_slider ?>
    		<p>The information on this listing has been provided by either the seller or a business broker representing the seller. BizQuest has no interest or stake in the sale of this business and has not verified any of the information and assumes no responsibility for its accuracy, veracity, or completeness.Please review our full Terms & Conditions here.</p>
            </div>
            </div>
            <div class="float-left margin-left35"><a href="#" target="_self"><img src="<?php echo $this->template->get_frontend_image()?>24v.png" /></a></div>
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
?>
