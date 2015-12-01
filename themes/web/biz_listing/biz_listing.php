<?php echo $top ?>
<div class="slide-controller">
<div class="float-left margin-top20 loginform"> <?php echo $login_html ?> <?php echo _e( 'no_ac' ); ?>? <?php echo anchor( $register_link, _e( 'Register' ), array( 'title' => _e( 'Register' ) ) )?> </div>
<?php echo $footer; 
  $biz_type_js = $this->load->view("web/admin/biz_type/biz_type_js_function.php", '', true);
  $this->template->embed_asset_code('frontend', 'js', 'biz-type-js-function', $biz_type_js);
?>