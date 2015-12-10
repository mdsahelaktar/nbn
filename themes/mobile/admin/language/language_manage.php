<?php ### Top Section Begin ### ?>
<div msg="sent_respons"> </div>
<?php echo form_open( '', array( 'name' => 'lang_form', 'id' => 'lang_form', 'class' => 'width100 float-left margin-bottom30 margin-top10' ,'onsubmit' =>'return lanselect()' ))?>
<div class="clear"></div>
<div class="clear"></div>
<fieldset class="clonefieldset width25">
  <span class="otherbutton" ></span>
  <legend align="center" margin="auto"> <b>Select Language Option</b></legend>
  <div class="clear">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
  <?php echo form_label(_e( 'Domain' )) ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <select name="domain" onchange="getLanguage(this)">
    <option value="biz_listing"> Biz Listing </option>
    <option value="broker"> Broker </option>
    <option value="home"> Home </option>
    <option value="language"> language </option>
    <option value="user"> User </option>
    <option value="common"> Common </option>
  </select>
  <div class="clear">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
  <?php echo form_label(_e( 'Languages' ))?> &nbsp;&nbsp; <?php echo form_dropdown('language', $var['lang_dd'], '', 'id="language" onchange="showButton(this)" disabled="disabled" class="validate" data-display="'._e( 'Language' ).'" data-rules="required"');?>
  <div class="clear">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
  <div id="buttondiv" style="display:none"> <?php echo form_submit( array( 'name' => 'lang', 'id' => 'lang', 'class' => 'viewicon btn-type1 margin-right10 margin-top10 float-left' ), _e( 'View' ) );?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo anchor( 'javascript:void(0);', '<span class="ion-android-add"></span>'._e( 'Add' ), array( 'title' => _e( 'Add Language' ), 'class' => 'btn-type1 margin-right5 margin-top10 float-left', 'onclick'=>"return addLanguage();" ) )?> </div>
  <?php echo form_close()?>
</fieldset>
<div id="showsearch"></div>
<?php
$js = $this->template->admin_view( 'lang_js', '', true, "language");
$this->template->embed_asset_code('admin', 'js', 'lang-js', $js);

$this->template->add_remove_admin_css(array('jquery-ui.css'), 'add');
$this->template->add_remove_admin_js(array('jquery-ui.js'), 'add');
?>
