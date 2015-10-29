<br />
<br />
<br />
<br />
<br />
<br />
<br />
<?php 
### If No Error Begin ###
if(!$response["event"]["error"]):?>
<div id="body">
  <div class="wrapper">
  		<h2>Broker Profile Information</h2>
    <div msg="brokermsg"></div>
    <?php echo form_open( '', array( 'name' => 'brokerinfo_add_form', 'id' => 'brokerinfo_add_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ) )?> 
	
	<?php echo form_label( '<p>'._e( 'Service Area' ).'</p>', 'service_area' )?> <?php echo form_input( array( 'name' => 'service_area', 'id' => 'service_area', 'placeholder' => 'add service area here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'Service Area' ), 'data-rules' => 'required') );?>
    <div class="clear"></div>
    
   	<?php echo form_label( '<p>'._e( 'Additional Services' ).'</p>', 'additional_services' )?> <?php echo form_input( array( 'name' => 'additional_services', 'id' => 'additional_services', 'placeholder' => 'add additional services here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'Additional Services' ), 'data-rules' => 'required') );?>
     <div class="clear"></div>
    
    <?php echo form_label( '<p>'._e( 'Company Details' ).'</p>', 'company_details' )?> <?php echo form_input( array( 'name' => 'company_details', 'id' => 'company_details', 'placeholder' => 'add company details here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'Company Details' ), 'data-rules' => 'required') );?>
     <div class="clear"></div>
    
    <?php echo form_label( '<p>'._e( 'Broker Bio' ).'</p>', 'bio' )?> <?php echo form_input( array( 'name' => 'bio', 'id' => 'bio', 'placeholder' => 'add broker bio here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'Broker Bio' ), 'data-rules' => 'required') );?>
    <div class="clear"></div>
    
    <?php echo form_label( '<p>'._e( 'Location' ).'</p>', 'location_id' )?> <?php echo form_input( array( 'name' => 'location_id', 'id' => 'location_id', 'placeholder' => 'add location here', 'autofocus' => 'autofocus', 'class' => 'validate', 'data-display' =>  _e( 'Location' ), 'data-rules' => 'required') );?>
    <div class="clear"></div>
    
<?php echo form_label( '<p>'._e( 'Images' ).'</p>', 'images' )?>    
<?php echo form_upload( array( 'name' => 'images[]', 'placeholder' => 'add images') );?>
   <div class="clear"></div>
     
		<?php echo form_hidden('user_id', $user_id); ?>
        <?php echo form_hidden('method', 'profileinfo'); ?>
        <?php echo form_submit( array( 'name' => 'brokerinfo_add_form', 'id' => 'brokerinfo_add_form', 'class' => 'margin-top10' ), _e( 'Add' ) );?>
        <?php echo form_close()?>
    <div id="loggedin_cont" class="login"><?php echo anchor('login/', _e('Log In'))?></div>
  </div>
</div>
<?php
$broker_js = $this->template->frontend_view( 'broker_js', '', true, "broker");
$this->template->embed_asset_code('frontend', 'js', 'broker-js', $broker_js);

$biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);
endif;
?>
