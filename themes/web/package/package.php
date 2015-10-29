<!--body start-->
  <div id="body">
    <div class="wrapper">
      <div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
	  <div class="pricing">
        	<h1>3 Reasons to Sell a Business with Needbiznow</h1>
            <ul class="topheading">
            	<li>Create Your Ad in 5 Minutes</li>
                <li>Short 2-Month Terms</li>
                <li class="last">30-Day Guarantee</li>
            </ul>
            
            <div class="pricing-table">
            	<ul>             	
                <?php foreach( $packages as $package):?>
				<li><?php echo $package->description?><div class="button-green"><a href="<?php echo base_url()."user?package_id=".$package->ai_package_id."&".implode( "&", getRegisterParam() )?>"> Choose <?php echo $package->package?></a></div></li>
				<?php endforeach;?>                	
                </ul>
            </div>
        </div>
        
        <!-- <div class="sample-busine">
        	<a class="group1 sampleads" href="images/sample21.png">See Sample Business-for-Sale Ads</a>
           <div class="sample-busine-inner"> <ul>
                <li><a class="group1" href="images/sample21.png" title="Sample Business-for-Sale Ads">Sample 1</li></a>
                <li><a class="group1" href="images/sample11.png" title="Sample Business-for-Sale Ads">Sample 2</a></li>
                <li><a class="group1" href="images/sample31.png" title="Sample Business-for-Sale Ads">Sample 3</a></li>
            </ul>
</div>
            <p>Exposure for your business on  <a href="#" target="_blank">150+ partner websites</a>, including:</p>
            <img src="images/logos_partners-wide.png" alt="partners logo" />
        </div>
		-->
		</div>
    </div>
  </div>