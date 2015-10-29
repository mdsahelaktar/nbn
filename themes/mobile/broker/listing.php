            <div class="width100 float-left margin-top30">
            	<h2 class="helvetica18 brdr-bot-dot padding-bottom5"><?php echo $string; ?></h2>
                <ul class="listing">
             <?php 
             foreach($item as $list):   
			 if($con == 1)
			 {
      		 ?>
                	<li><a href="broker/searchbroker?postalcode=<?php echo $list->province; ?>" class="global" target="_self"><?php echo $list->province; ?></a></li>
              <?php
			 }
             else
             {
				 ?>
                 <li><a href="broker/searchbroker?postalcode=<?php echo $list->country; ?>"" class="global" target="_self"><?php echo $list->country; ?></a></li>
                 <?php
			 }
				  endforeach; 
    			?>  
                </ul>
            </div>