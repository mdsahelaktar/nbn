<?php
if(empty($data))
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
<h2 class="helvetica18 brdr-bot-dot padding-bottom5"><?php echo _e( 'other_tech' ); ?></h2>
<div id="slider1"> <a class="buttons prev" href="#">left</a>
<div class="viewport">
<ul class="overview">
<?php
    foreach($data as $details): 
?>
	 <li> 
      <img alt="Business" src="<?php echo $this->template->get_frontend_image(isset($details->image_information)? showImage($details->image_information, '1', 'bizlisting/business4sale.png') : 'bizlisting/business4sale.png') ?>" width="160px" height="100px"/>
      <p class="theme-blue"><?php echo $details->headline ?></p>
      <p class="theme-blue margin-top15"><?php echo $details->province ?></p>
      <p><strong><?php echo _e( 'price' ); ?>:</strong> $<?php echo $details->asking_price ?></p>
      <?php
      echo anchor( 'biz_listing/details?dtls=' . $details->ai_biz_listing_id . '',_e( 'More info' ), array( 'title' => _e( 'More info' ),  'class' => 'global3 padding-bottom5 padding-top5 padding-left20 padding-right20 margin-top20 float-left' ) );
	  ?>
     </li> 
<?php
	endforeach; 
?>
     </ul> 
       </div>
    <a class="buttons next" href="#"><?php echo _e( 'right' ); ?></a> </div>
    <?php
}
?>