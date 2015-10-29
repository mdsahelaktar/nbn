<?php echo $reload; ?><?php echo $head; ?>

<h2 class="helvetica float-left"><?php echo $results[0]->headline?></h2>
<p class="font14"><?php echo $results[0]->tagline?> </p>
<div class="width95 bg-grey padding-bottom10 padding-left20 padding-right20 padding-top10 float-left margin-top20" id="printthis">
  <div class="width206 float-left">
    <h2 class="helvetica14 brdr-bot-dot light-black padding-bottom5">Seller Financing Available!</h2>
    <ul class="float-left">
    
      <!-- asking_price -->
      <li class="float-left width120 colr999">Asking Price:</li>
<?php if(empty($results[0]->asking_price))
	  {
	  ?>
           <li class="float-right">n/a</li>
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
      <li class="float-left width120 colr999">Gross Revenue:</li>
      <?php if(empty($results[0]->gross_revenue))
	  {
	  ?>
           <li class="float-right">n/a</li>
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
      <li class="float-left width120 colr999">Cash Flow:</li>
        <?php if(empty($results[0]->cash_flow))
	  {
	  ?>
           <li class="float-right">n/a</li>
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
      <li class="float-left width120 colr999">Inventory:</li>
<?php if(empty($results[0]->inv_value))
	  {
	  ?>
           <li class="float-right">n/a **</li>
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
      <li class="float-left width120 colr999">Real Estate:</li>
      
<?php if(empty($results[0]->rs_value))
	  {
	  ?>
           <li class="float-right">n/a **</li>
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
      <li class="float-left width120 colr999">FF&E:</li>
      
<?php if(empty($results[0]->ffe_value))
	  {
	  ?>
           <li class="float-right">n/a **</li>
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
      	
      <p class="colr999 float-left margin-top10">++ included in asking price<br />
        ** not included in asking price</p>
    </ul>
  </div>
  <div class="width440 float-right brdr-lft-dot padding-left20">
    <div class="width220 float-left">
      <h2 class="helvetica14 brdr-bot-dot light-black padding-bottom5">Business Listed by Listing Broker</h2>
      <p class="colr999">
	          <?php if(!empty($broker_cimage[0]->service_area))
				{
				echo $broker_cimage[0]->service_area ?> Business Brokers</p>
         <?php  }?>
      <h2 class="helvetica14 brdr-bot-dot light-black padding-bottom5">Contact Broker</h2>
      <p class="colr999"><?php echo ucfirst($broker_fullname); ?> <br />
      
        <?php if(!empty($broker_cimage[0]->service_area))
				{
				echo $broker_cimage[0]->service_area ?> Business Brokers</p>
         <?php  }?>
        
        <?php if(!empty($broker_cimage))
				{
     echo anchor( 'biz_listing/brokerlisting?uid='.$broker_cimage[0]->user_id.'',_e( 'View All of My Listings' ), array( 'class'=>"global",'title' => _e( 'View All of My Listings' ) ) );
				}?>
      
      <h2 class="helvetica14 brdr-bot-dot light-black padding-bottom5">Membership</h2>
      <img src="<?php echo $this->template->get_frontend_image(showImage($broker_cimage[0]->image_information, '1', '2', 'bizlisting/no.jpg'));?>" alt="certified image not available"  width="20%" height="20%"/> 
      
      <h2 class="helvetica14 brdr-bot-dot light-black padding-bottom5">Listing Tools</h2>
      <ul class="tools" id="frm">
        <li class="print"><a href="printpage" class="colr999" onClick="printthis(); return false;">Print</a></li>
        <li class="email"><a href="#" class="colr999">Email</a></li>
        <li class="save"><a href="#" class="colr999">Save</a></li>
      </ul>
    </div>
    <img src="<?php echo $this->template->get_frontend_image(isset($results[0]->image_information)?showImage($results[0]->image_information, '1', '1','bizlisting/business4sale.png') : 'bizlisting/business4sale.png')?>" alt="no image" class="float-right width206 margin-top50 margin-top90" /> </div>
</div>
			
<div class="width95 bg-brown padding-bottom10 padding-left20 padding-right20 padding-top10 float-left margin-top20">
<div msg="sent_respons"></div>	
  <h2 class="helvetica18 brdr-bot-dot light-black padding-bottom5">Contact Business Seller</h2>
  <?php echo form_open( '', array( 'name' => 'details_mail_form', 'id' => 'details_mail_form', 'class' => 'cont-biz-seller', 'onsubmit' => 'afterValidCheck()') )?>
  <?php echo form_hidden('user_id', $results[0]->user_id); ?>
    <p class="width50 float-left margin-right25 margin-bottom10"> <dfn class="float-left width20 font14">Name:</dfn>
      <?php echo form_input( array( 'name' => 'name', 'id' => 'name', 'placeholder' => 'Name', 'class' => 'validate' ) );?>
    </p>
    <p class="width50 float-left margin-right25 margin-bottom10"> <dfn class="float-left width20 font14">Email:</dfn>
      <?php echo form_input( array( 'name' => 'email', 'id' => 'email', 'placeholder' => 'Email', 'class' => 'validate' ) );?>
    </p>
    <p class="width50 float-left margin-right25 margin-bottom10"> <dfn class="float-left width20 font14">Phone:</dfn>
      <?php echo form_input( array( 'name' => 'phone', 'id' => 'phone', 'placeholder' => 'Phone', 'class' => 'validate' ) );?>
    </p>
    <p class="width50 float-left margin-right25 margin-bottom10"> <dfn class="float-left width20 font14">&nbsp;</dfn>
    </p>
    <p class="float-left margin-bottom10 width45" style="margin-top: -120px;"> <dfn class="float-left width20 font14">Message:</dfn>
       <?php echo form_textarea( array( 'name' => 'message', 'id' => 'message', 'placeholder' => 'Message', 'rows' => 5, 'class' => 'validate') );?>
    </p>
    <p class="float-left margin-bottom10 width45" style="margin-top: -25px;">
      <?php echo form_checkbox('newsletter', 1, '', 'id="newsletter"');?>
      Yes, I would like to receive the BizQuest Buyer's Newsletter. </p>
    <p class="float-right margin-bottom10 width45" >
      <?php echo form_checkbox('learnchk', 1, '', 'id="learnchk"');?>
      Learn to use your IRA/401K to buy a business: Guidant Financial (min. $50K needed in IRA/401K) </p>
        <p class="width50 float-left margin-right25 margin-bottom10"> <dfn class="float-left width20 font14">&nbsp;</dfn>
      <?php echo form_submit( array( 'name' => 'details_frm', 'id' => 'details_frm', 'class' => 'margin-top10' ), _e( 'Contact Seller' ) );?>
    </p>
<?php echo form_close()?>
   </div>
<?php echo $foot ;?> <?php echo $body_end; ?> 
<!--body end-->
<?php
    $biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
	$this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);
?>
