<?php if($response["event"] != "error"):?>
<?php echo $reload; ?><?php echo $head; ?>
<div class="popup">
  <h2 class="helvetica float-left uppercase"><?php echo $results[0]->headline?></h2>
  <p class="font14"><?php echo $results[0]->tagline?> </p>
  <div class="width95 bg-grey padding-bottom10 padding-left20 padding-right20 padding-top10 float-left margin-top20" id="printthis">
    <div class="width190 float-left">
      <h2 class="helvetica14 brdr-bot-dot light-black padding-bottom5"><?php echo _e( 'seller_financing_available' ); ?></h2>
      <ul class="float-left">
        
        <!-- asking_price -->
        <li class="float-left width120 colr999"><?php echo _e( 'asking_price' ); ?>:</li>
        <?php if(empty($results[0]->asking_price))
	  {
	  ?>
        <li class="float-right"><?php echo _e( 'na' ); ?></li>
        <?php
	  }
	  else
	  {
	  ?>
        <li class="float-right">$<?php echo $results[0]->asking_price?></li>
        <?php
	  }
	  ?>
        <!-- asking_price --> 
        
        <!-- gross_revenue -->
        <li class="float-left width120 colr999"><?php echo _e( 'gross_rev' ); ?>:</li>
        <?php if(empty($results[0]->gross_revenue))
	  {
	  ?>
        <li class="float-right"><?php echo _e( 'na' ); ?></li>
        <?php
	  }
	  else
	  {
	  ?>
        <li class="float-right"> $<?php echo $results[0]->gross_revenue?></li>
        <?php
	  }
	  ?>
        <!-- gross_revenue --> 
        
        <!-- cash_flow -->
        <li class="float-left width120 colr999"><?php echo _e( 'cash_flow' ); ?>:</li>
        <?php if(empty($results[0]->cash_flow))
	  {
	  ?>
        <li class="float-right"><?php echo _e( 'na' ); ?></li>
        <?php
	  }
	  else
	  {
	  ?>
        <li class="float-right">$<?php echo $results[0]->cash_flow?></li>
        <?php
	  }
	  ?>
        <!-- cash_flow --> 
        
        <!-- Inventory -->
        <li class="float-left width120 colr999"><?php echo _e( 'inventory' ); ?>:</li>
        <?php if(empty($results[0]->inv_value))
	  {
	  ?>
        <li class="float-right"><?php echo _e( 'na' ); ?> **</li>
        <?php
	  }
	  else
	  {
			 if($results[0]->is_inv_included == 1)
			  {
			  ?>
        <li class="float-right">$<?php echo $results[0]->inv_value + $results[0]->asking_price?> ++</li>
        <?php
			  }
			  else
			  {
			  ?>
        <li class="float-right">$<?php echo $results[0]->inv_value?> **</li>
        <?php
			  }
	  }
          ?>
        
        <!-- Inventory --> 
        
        <!-- Real Estate -->
        <li class="float-left width120 colr999"><?php echo _e( 'real_estate' ); ?>:</li>
        <?php if(empty($results[0]->rs_value))
	  {
	  ?>
        <li class="float-right"><?php echo _e( 'na' ); ?> **</li>
        <?php
	  }
	  else
	  {
			 if($results[0]->is_rs_included == 1)
			  {
			  ?>
        <li class="float-right">$<?php echo $results[0]->rs_value + $results[0]->asking_price?> ++</li>
        <?php
			  }
			  else
			  {
			  ?>
        <li class="float-right">$<?php echo $results[0]->rs_value?> **</li>
        <?php
			  }
	  }
          ?>
        <!-- Real Estate --> 
        
        <!-- FF&E -->
        <li class="float-left width120 colr999"><?php echo _e( 'ffe' ); ?>:</li>
        <?php if(empty($results[0]->ffe_value))
	  {
	  ?>
        <li class="float-right"><?php echo _e( 'na' ); ?> **</li>
        <?php
	  }
	  else
	  {
			 if($results[0]->is_ffe_included == 1)
			  {
			  ?>
        <li class="float-right">$<?php echo $results[0]->ffe_value + $results[0]->asking_price?> ++</li>
        <?php
			  }
			  else
			  {
			  ?>
        <li class="float-right">$<?php echo $results[0]->ffe_value ?> **</li>
        <?php
			  }
	  }
          ?>
        <!-- FF&E -->
        
        <p class="colr999 float-left margin-top10">++ <?php echo _e( 'included_ask_price' ); ?> <br />
          ** <?php echo _e( 'not_included_ask_price' ); ?></p>
      </ul>
    </div>
    <div class="width440 float-right brdr-lft-dot padding-left20">
      <div class="width220 float-left">
        <h2 class="helvetica14 brdr-bot-dot light-black padding-bottom5"><?php echo _e( 'biss_list_bro' ); ?></h2>
        <p class="colr999">
          <?php if(!empty($broker_cimage[0]->service_area))
				{
				echo $broker_cimage[0]->service_area ?>
          <?php echo _e( 'biz_bro' ); ?></p>
        <?php  }?>
        <h2 class="helvetica14 brdr-bot-dot light-black padding-bottom5"><?php echo _e( 'cont_bro' ); ?></h2>
        <p class="colr999"><?php echo ucfirst($broker_fullname); ?> <br />
          <?php if(!empty($broker_cimage[0]->service_area))
				{
				echo $broker_cimage[0]->service_area ?>
          <?php echo _e( 'biss_list_bro' ); ?></p>
        <?php  }?>
        <?php if(!empty($broker_cimage))
				{
     echo anchor( 'biz_listing/brokerlisting?uid='.$broker_cimage[0]->user_id.'',_e( 'View All of My Listings' ), array( 'class'=>"global",'title' => _e( 'View All of My Listings' ) ) );
				}?>
        <h2 class="helvetica14 brdr-bot-dot light-black padding-bottom5"><?php echo _e( 'membership' ); ?></h2>
        <img src="<?php echo $this->template->get_frontend_image(showImage($broker_cimage[0]->image_information, '1', 'bizlisting/no.jpg'));?>" alt="certified image not available"  width="20%" height="20%"/>
        <h2 class="helvetica14 brdr-bot-dot light-black padding-bottom5"><?php echo _e( 'list_tool' ); ?></h2>
        <ul class="tools" id="frm">
          <li class="print"><a href="#" class="colr999"><?php echo _e( 'print' ); ?></a></li>
          <li class="email"><a href="#" class="colr999"><?php echo _e( 'email' ); ?></a></li>
          <li class="save"><a href="#" class="colr999"><?php echo _e( 'save' ); ?></a></li>
        </ul>
      </div>
      <img src="<?php echo $this->template->get_frontend_image(isset($results[0]->image_information)?showImage($results[0]->image_information, '1', 'bizlisting/business4sale.png') : 'bizlisting/business4sale.png')?>" alt="<?php echo _e( 'no_image' ); ?>" class="float-right brokerpic" /> </div>
  </div>
  <div class="width95 bg-brown padding-bottom10 padding-left20 padding-right20 padding-top10 float-left margin-top20 contactseller">
    <div msg="sent_respons"></div>
    <h2 class="helvetica18 brdr-bot-dot light-black padding-bottom5"><?php echo _e( 'contact_biz_seller' ); ?></h2>
    <?php echo form_open( '', array( 'name' => 'details_mail_form', 'id' => 'details_mail_form', 'class' => 'cont-biz-seller') )?> <?php echo form_hidden('user_id', $results[0]->user_id); ?>
    <p class="width50 float-left margin-bottom10"> <dfn class="float-left width20 font14"><?php echo _e( 'name' ); ?>:</dfn> <?php echo form_input( array( 'name' => 'name', 'id' => 'name', 'placeholder' => 'Name', 'class' => 'validate', 'data-rules' => 'required' ) );?> </p>
    <p class="width50 float-left margin-bottom10"> <dfn class="float-left width20 font14"><?php echo _e( 'email' ); ?>:</dfn> <?php echo form_input( array( 'name' => 'email', 'id' => 'email', 'placeholder' => 'Email', 'class' => 'validate', 'data-rules' => 'required' ) );?> </p>
    <p class="width50 float-left margin-bottom10"> <dfn class="float-left width20 font14"><?php echo _e( 'ph' ); ?>:</dfn> <?php echo form_input( array( 'name' => 'phone', 'id' => 'phone', 'placeholder' => 'Phone', 'class' => 'validate', 'data-rules' => 'required' ) );?> </p>
    <p class="float-left margin-bottom10 width45"> <dfn class="float-left width20 font14"><?php echo _e( 'msg' ); ?>:</dfn> <?php echo form_textarea( array( 'name' => 'message', 'id' => 'message', 'placeholder' => 'Message', 'rows' => 5, 'class' => 'validate', 'data-rules' => 'required') );?> </p>
    <p class="float-left margin-bottom10 width45" style="margin-top: -60px;">
      <label> <?php echo form_checkbox('newsletter', 1, '', 'id="newsletter"');?> <?php echo _e( 'like_buy' ); ?>.</label>
    </p>
    <p class="float-left margin-bottom10 width45" >
      <label> <?php echo form_checkbox('learnchk', 1, '', 'id="learnchk"');?> <?php echo _e( 'learn_to' ); ?></label>
    </p>
    <p class="width45 float-left margin-left35 margin-bottom10"> <?php echo form_submit( array( 'name' => 'details_frm', 'id' => 'details_frm', 'class' => 'margin-top10 float-right' ), _e( 'Contact Seller' ) );?> </p>
    <?php echo form_close()?> </div>
</div>
<?php echo $foot ;?> <?php echo $body_end; ?> 
<!--body end-->
<?php
    $biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
	$this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);
?>
<?php else:?>
	<!--body start-->
  <div id="body">
    <div class="wrapper">
      <div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
      		<?php echo renderResposeMessage("biz_details", $response)?>
      </div>
    </div>
  </div>
  <!--body end--> 	
<?php endif;?>
