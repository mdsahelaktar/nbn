<!--body start-->
  <div id="body">
    <div class="wrapper">
      <div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
        <div class="width60 float-left">
        <?php if($postalcode)
				$print_name = $postalcode;
			  elseif($p_name)
				$print_name = $p_name;
			  else
				$print_name = '';
		?>
        	<h2 class="helvetica float-left">Business Brokers Near <?php echo $print_name; ?></h2>
       		
            <?php if($null)
			{
				?>
              <p><b> <?php echo $null ?>. </b></p>
              <?php } else {?>
        <div class="width100 float-left">
        <table style="width:100%" >
            <tr id="button_section" bgcolor="#CCCCCC">
            <th>Broker Details</th>
            <th>Location </th>
            <th>Distance </th>
            </tr>
        <?php 
        foreach($results as $list):   
        ?>
            <tr id="caption_section">
            <td align="center"> <a href="<?php echo base_url()?>broker/brokerdetails?broker=<?php echo $list->ai_broker_id; ?>" class="global" target="_blank"><?php echo ucfirst($list->salutation).' '.ucfirst($list->first_name).' '.ucfirst($list->middle_name).' '. ucfirst($list->last_name)?>,  <?php echo ucfirst($list->service_area)?> </a></td>
            <td align="center"> <?php echo $list->city; ?> </td>
            <td align="center"> <?php echo distance($lat, $long, $list->latitude, $list->longitude, "K") ?> </td>
            </tr>
        <?php
        endforeach; 
        ?>  
        </table> 
        </div>
        <?php } ?>

            <p class="float-left margin-top40"><strong>Disclaimer:</strong> <?php echo _e('broker_disclaimer')?></p>
            
        </div>
        <div class="width320 float-right">
         	<p class="bg-blue padding-bottom10 padding-left10 padding-right10 padding-top10 font16 white">Business Brokers: Get Listed Now</p>
            <div class="bg-lightbrown padding-bottom10 padding-left10 padding-right10 padding-top10 float-left ">
            	<p><strong>Reach millions of prospective buyers and sellers.</strong> Post your business for sale listings. Broker memberships start at only $49.95 a month. </p>
                <a href="<?php echo base_url()?>user?<?php echo implode( "&", setRegisterParam(32, 7) )?>" target="_self" class="global4 font14 float-left margin-top20 padding-bottom5 padding-top5 padding-left20 padding-right20 margin-left45 margin-bottom10">Become a Broker Member</a>
            </div>
        </div>
      </div>
    </div>
  </div>
  <!--body end--> 
<?php
$biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);
?>
