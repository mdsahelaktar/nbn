<?php
if(empty($resultsdataslider))
{
?>
	<h4> <?php echo _e( 'not_found' ); ?> </h4>
    <br />
    <br />
<?php
}
else
{
?>
<h2 class="helvetica18 brdr-bot-dot padding-bottom5"><?php echo 'Our Most Recent Business For Sale Listings'; ?></h2>
<div id="slider1"> <a class="buttons prev" href="#">left</a>
<div class="viewport">
<ul class="overview">
<?php
    foreach($resultsdataslider as $details): 
			$biz = explode('[@]', $details->biz_information);
	foreach($biz as $bizinfo):
?>
	 <li> 
    <img alt="Business" src="<?php echo $this->template->get_frontend_image(showImageBroker(showBiz($bizinfo, '3')))?>" width="160px" height="100px"/> 
      <p class="theme-blue"><?php echo showBiz($bizinfo, '0') ?></p>
      <p class="theme-blue margin-top15"><?php showBiz($bizinfo, '2') ?></p>
      <p><strong><?php echo _e( 'price' ); ?>:</strong> $<?php echo showBiz($bizinfo, '1') ?></p>
      <?php
      echo anchor( 'biz_listing/details?dtls=' . showBiz($bizinfo, '3') . '',_e( 'More info' ), array( 'title' => _e( 'More info' ),  'class' => 'global3 padding-bottom5 padding-top5 padding-left20 padding-right20 margin-top20 float-left' ) );
	  ?>
     </li> 
     <?php
	 endforeach; 
	endforeach; 
?>
     </ul> 
       </div>
    <a class="buttons next" href="#"><?php echo _e( 'right' ); ?></a> </div>
    <?php
}
?>