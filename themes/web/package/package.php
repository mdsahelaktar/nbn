<!--body start-->
<div id="body">
  <div class="wrapper">
    <div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
    <?php if($response["event"] == "error"):?>
    	<?php echo renderResposeMessage( "package", $response);?>
    <?php else:?>
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
            <li><?php echo $package->description?>
              <div class="button-green"><a href="<?php echo base_url()."user?package_id=".$package->ai_package_id."&".implode( "&", getRegisterParam() )?>"> Choose <?php echo $package->package?></a></div>
            </li>
            <?php endforeach;?>
          </ul>
        </div>
      </div>
    <?php endif;?>      
    </div>
  </div>
</div>
