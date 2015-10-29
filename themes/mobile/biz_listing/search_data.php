<?php 
if(!empty($data['records']))
{
	ob_start();
foreach($data['records'] as $record): 
?>

<div class="float-left width100 margin-top20">
  <div class="srp-details">
 <div class="srp-details-left">
 <img src="<?php echo $this->template->get_frontend_image(isset($record->image_information)? showImage($record->image_information, '1', '1','bizlisting/business4sale.png') : 'bizlisting/business4sale.png') ?>" alt="SRP dtaills" width="150px" height="100px">
 </div>
    <div class="srp-details-right"><strong><?php echo  $record->headline ?> </strong> <?php echo  ucfirst($record->city) ?>&nbsp;&nbsp; <?php echo  $record->province ?>&nbsp;&nbsp; <?php echo  $record->county ?>&nbsp;&nbsp; <?php echo  $record->country ?>&nbsp;&nbsp; <?php echo  $record->gross_revenue ?>
      <p><?php echo substr($record->description,0,75).'...' ?></p>
    </div>
    <div class="tools">
      <ul>
        <li><strong>$<?php echo $record->asking_price ?></strong></li>
        <li>|</li>
        <li><strong>$ <?php echo $record->cash_flow ?> </strong></li>
        <li class="margin-left50 last">
          <?php
            echo anchor( 'biz_listing/details?dtls=' . $record->ai_biz_listing_id . '',_e( 'Seller Financing' ), array( 'title' => _e( 'Seller Financing' ), 'id' => 'clickdtls', 'class' => 'global3 padding-bottom5 padding-top5 padding-left10 padding-right10 radius4 margin-left35' ) );
                ?>
        </li>
      </ul>
      <?php
            echo anchor( 'biz_listing/details?dtls=' . $record->ai_biz_listing_id . '',_e( 'View Details' ), array( 'title' => _e( 'View Details' ),'id' => 'clickdtls',  'class' => 'global4 font14 fntwt-bld padding-bottom5 padding-top5 padding-left20 padding-right20 radius4 float-left margin-left20' ) );
                ?>
    </div>
  </div>
  </div> 
<?php
				endforeach;
				echo $data['pagination'];
				echo ob_get_clean();
}
?>
