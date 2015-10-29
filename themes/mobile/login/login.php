             <div id="body">
    <div class="wrapper">
      <div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
        <div class="width60 float-left">
        	
             <div class="float-left margin-left355 margin-top20">
              <?php echo $login_html ?>
              Don't have an account? <?php echo anchor( 'user?ct=8&rl=1', _e( 'Register' ), array( 'title' => _e( 'Register' ) ) )?>
            </div>
        </div>
        <div class="width320 float-right">
    
    
        </div>
      </div>
    </div>
  </div>
            
            
<?php
	$biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
	$this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);
?>
            
