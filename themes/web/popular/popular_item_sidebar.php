 <?php
 if($condition == 1)
 {
	 ?>
     <h2> <?php echo _e($string) ?> </h2>
      <div class="datacont">
      <?php
	 if(empty($item))
	 {
		 ?>
		<span> <?php echo _e('No data found'); ?></span>
        <?php
	 }
 $i = 0;
    foreach($item as $biz):  
	 $pro = $biz->province.'('.$biz->abbre.')';
	 ?>
      <div class="business">
            <img src="<?php echo $this->template->get_frontend_image(isset($biz->image_information)? showImage($biz->image_information, '1', '1','bizlisting/business4sale.png') : 'bizlisting/business4sale.png') ?>" >
			 <p> <a href="biz_listing/details?dtls=<?php echo $biz->ai_biz_listing_id;?>" class="global" target="_self"><?php echo $biz->headline; ?></a></p>
			 <ul>
				<li> <a href="#" class="global" target="_self"><?php echo isset($biz->province)?$pro : _e('NA'); ?></a></li>
				<li> |</li>
				<li> $<?php echo $biz->asking_price; ?></li>
			 </ul>
       </div>
	 <?php
       $i++;
		 if($i == 10)
			break;
	endforeach; 
	?>
     </div>
     <?php
}
else
{
?>
 <ul>
      <li> <?php echo _e($string) ?> </li>
      <?php
        $i = 0;
		if(empty($item))
		{
		?>
			<li> <?php echo _e('No data found'); ?> </li>
		<?php
		}
        foreach($item as $biz):
		$i++;  
		?>
			<?php if($i > 1):?>
			<li>|</li>
			<?php endif;?>
			<li> <a href="biz_listing/search?province_id=<?php echo $biz->ai_province_id;?>"><?php echo $biz->province.' '._e('Businesses for Sale') ?></a></li>              
		<?php        
        if($i == 3)
            break;			
        endforeach; 
        ?>
              <li class="advancesearch"> <?php echo anchor( 'biz_listing/search', _e( 'Advance Search' ), array( 'title' => _e( 'Advance Search' ) ) )?> </li>
            </ul>
<?php
}
?>