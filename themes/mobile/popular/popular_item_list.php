<h2> <?php echo $string; ?></h2>
<div class="listings">
  <h3> <?php echo $most; ?> </h3>
  <?php
     $i = 0;
     ?>
  <ul class="type7">
    <?php
	 if(empty($item))
	 {
		 ?>
    <h5> <?php echo _e('no_popular_item_found'); ?></h5>
    <?php
	 }
    foreach($item as $biz):   
        if ($i != 0 && $i%10 == 0)
         {   
         ?>
  </ul>
  <ul class="type8">
    <?php 
         }
	if($condition == 0) 
	 {?>
    <li> <?php echo sprintf($link_format, $biz->ai_biz_listing_id, ucfirst($biz->headline));  ?> </li>
    <?php
	}
	elseif($condition == 4) 
	 {?>
    <li> <?php echo sprintf($link_format, $biz->ai_biz_listing_id, ucfirst($biz->headline));  ?> </li>
    <?php
	}
	elseif($condition == 2) 
	 {?>
    <li> <?php echo sprintf($link_format, $biz->ai_province_id, $biz->province);  ?> </li>
    <?php
	}
	elseif($condition == 3) 
	 {?>
    <li> <?php echo sprintf($link_format, $biz->object, ucfirst($biz->object));  ?> </li>
    <?php
	}
	else
	{
	?>
    <li> <?php echo sprintf($link_format, $biz->ai_biz_type_id, $biz->domain_id, $biz->biz_type); ?> </li>
    <?php
	}
     $i++;
     if($i == $mod)
        break;
    endforeach; 
    ?>
  </ul>
</div>
