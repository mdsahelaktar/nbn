<div class="bg-grey float-left">
    <h2 class="bg-seperator helvetica14 text-center padding-bottom5"><?php echo $string ?></h2>
    <div class="right-listing-type1 float-left">
      <ul>
        <?php
	 if(empty($item))
	 {
		 ?>
		<h5> <?php echo 'No data found'; ?></h5>
        <?php
	 }
        $i = 0;
        foreach($item as $biz):  
        
        	if($condition == 1)
			{
			?>
            <li> <a href="details?dtls=<?php echo $biz->ai_biz_listing_id;?>" class="global"><?php echo $biz->headline; ?></a></li>
            <?php
			}
			if($condition == 2)
			{
				$county_str = explode(';', $biz->county_str);
				$c = 0;
				foreach($county_str as $data):
		  			 $count = explode('_', $data);
					$c++;
		 		endforeach;
				
			?>
            <li> <a href="search?county_id=<?php echo $biz->ai_county_id;?>" class="global"><?php echo $biz->county.' '.'County Businesses for Sale'.'('.$c.')'; ?></a></li>
        <?php
			}
        $i++;
        if($i == 10)
            break;
        endforeach; 
        ?>
      </ul>
    </div>
</div>