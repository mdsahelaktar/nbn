  <div id="body">
    <div class="wrapper">
      <div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
        <div class="width60 float-left">
        
        <a href="javascript:history.back(-1)" class="btn-type1 margin-right10 margin-top10 float-left"><span class="ion-android-system-back"></span>Go Back</a> 
        
<div class="broker-list">    
	<h2 class="helvetica float-left"> <?php echo ucfirst($user_name[0]->first_name).' '.ucfirst($user_name[0]->middle_name).' '.ucfirst($user_name[0]->last_name) .','.$broker_details[0]->service_area ?> </h2>
    <ul>
    	<li><strong>Phone:</strong> <?php echo $user_name[0]->mobile_phone_no ?></li>
        <li><strong>Fax:</strong> <?php echo $user_name[0]->fax_num ?></li>
        <li><strong>Email:</strong> <a href="#collapse1" class="nav-toggle"> Contact <?php echo ucfirst($user_name[0]->first_name).' '.ucfirst($user_name[0]->middle_name).' '.ucfirst($user_name[0]->last_name) ?> by email</a></li>
        <li><strong>Website:</strong> <a href="<?php echo $listdtls[0]->biz_website ?>" target="_blank"><?php echo $listdtls[0]->biz_website ?></a></li>
    </ul> 
</div>

 
<div class="contact-broker"><div id="collapse1" style="display:none;width:100%;">
<div class="width95 bg-brown padding-bottom10 padding-left20 padding-right20 padding-top10 float-left">
<div msg="sent_respons"></div>	
<h2 class="helvetica float-left">Contact Business Broker</h2>
<div class="broker-list"><?php echo form_open( '', array( 'name' => 'details_mail_form', 'id' => 'details_mail_form', 'class' => 'cont-biz-seller', 'onsubmit' => 'afterValidCheck()') )?>
<?php echo form_hidden('user_id', $this->input->get('uid')); ?>
<p class="width50 float-left margin-right25 margin-bottom10"> <dfn class="float-left width20 font14">Name:</dfn>
<?php echo form_input( array( 'name' => 'name', 'id' => 'name', 'placeholder' => 'Name', 'class' => 'validate' ) );?>
</p>
<p class="width50 float-left margin-right25 margin-bottom10"> <dfn class="float-left width20 font14">Email:</dfn>
<?php echo form_input( array( 'name' => 'email', 'id' => 'email', 'placeholder' => 'Email', 'class' => 'validate' ) );?>
</p>
<p class="width50 float-left margin-right25 margin-bottom10"> <dfn class="float-left width20 font14">Phone:</dfn>
<?php echo form_input( array( 'name' => 'phone', 'id' => 'phone', 'placeholder' => 'Phone', 'class' => 'validate' ) );?>
</p>
<p class="float-left margin-bottom10 width45" style="margin-top: -120px;"> <dfn class="float-left width20 font14">Message:</dfn>
<?php echo form_textarea( array( 'name' => 'message', 'id' => 'message', 'placeholder' => 'Message', 'rows' => 5, 'class' => 'validate') );?>
</p>
<p class="width50 float-left margin-right25 margin-bottom10">
<?php echo form_submit( array( 'name' => 'details_frm', 'id' => 'details_frm', 'class' => 'margin-top10' ), _e( 'Contact Broker' ) );?>
</p>
<?php echo form_close()?>
</div></div>
</div></div>


 <div class="borkerlisting">
     <table cellpadding="0" cellspacing="0" class="borkerlisting">
       <tr id="button_section">
        <th>Most Recent Business For Sale Listings: </th>
        <th>Location </th>
        <th>Asking Price</th>
        <th>Revenue</th>
        <th>Cash Flow</th>
      </tr>
       <?php foreach($listdtls as $listingvalue):?>
      <tr id="caption_section">
        <td align="center"><?php echo $listingvalue->headline?></td>
        <td align="center"><?php echo $listingvalue->city?></td>
        <td align="center"><?php echo $listingvalue->asking_price?></td>
        <td align="center"><?php echo $listingvalue->gross_revenue?></td>
        <td align="center"><?php echo $listingvalue->cash_flow?></td>
      </tr>
      <?php
        endforeach; 
    ?>
    </table>
</div> 

          
        </div>
        <div class="width320 float-right">
         	<p class="bg-blue padding-bottom10 padding-left10 padding-right10 padding-top10 font16 white">Business Brokers: Get Listed Now</p>
            <div class="bg-lightbrown padding-bottom10 padding-left10 padding-right10 padding-top10 float-left ">
            	<p><strong>Reach millions of prospective buyers and sellers.</strong> Post your business for sale listings. Broker memberships start at only $49.95 a month. </p>
                <a href="<?php echo base_url()?>user?ct=10&rl=1"target="_self" class="global4 font14 float-left margin-top20 padding-bottom5 padding-top5 padding-left20 padding-right20 margin-left45 margin-bottom10">Become a Broker Member</a>
            </div>
        </div>
        
      </div>
    </div>
  </div>

<?php
$biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);

$js = $this->template->frontend_view( 'broker_listing_and_profile_js', '', true, "biz_listing");
$this->template->embed_asset_code('frontend', 'js', 'broker-listing-and-profile-js', $js);
?>
          
