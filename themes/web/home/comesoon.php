<!--body start-->
  <div id="body">
    <div class="wrapper">
      <div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
        <div class="width60 float-left">
        	
             <div class="float-left margin-top30 margin-left5"><a href="#" target="_self"><img src="<?php echo $this->template->get_frontend_image()?>bizlisting/constr.gif"  width="124%"/></a>
             </div>
        </div>
        <div class="width320 float-right">
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
    <div class="float-left margin-top30 margin-left5"><a href="javascript:history.back()" class="btn-type1 margin-right10 margin-top10 float-left"><span class="ion-android-system-back"></span><strong>Please Go Back</strong></a> </div>
    
        </div>
      </div>
    </div>
  </div>
  <!--body end--> 
<?php
$biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);
?>
