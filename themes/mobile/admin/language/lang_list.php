<?php 
ob_start();  
 $path =  APPPATH.'modules/'.$domain.'/language/'.$language.'/'.$domain.'_lang.php';

$langdata = include(APPPATH.'/modules/'.$domain.'/language/'.$language.'/'.$domain.'_lang.php');
if($langdata == 1)
	$chos_lang = $lang;
	
$eng_langdata = include(APPPATH.'/modules/'.$domain.'/language/english/'.$domain.'_lang.php');
if($eng_langdata == 1)
	$english_lang = $lang;
?>
<br>
 <table border="0" cellpadding="0" cellspacing="0" bordercolor="#999999" id="list">
   <tr id="button_section"> 
    <th width="40%"> English </th>
    <th width="40%"><?php echo ucfirst($language) ?></th>
    <th>Action</th>
  </tr>
   <?php
   $i = 0;
	   foreach($english_lang as $eng_key => $eng_text) { ?>
  <tr>
    <td align="justify" valign="top"><?php echo $eng_key?></td>
    <td align="justify" valign="top" id="tr<?php echo $i; ?>"><?php echo $chos_lang[$eng_key]?></td>
    <td align="center" valign="top"><a onclick="languageEdit(this,'<?php echo $path;?>','<?php echo $eng_key;?>','<?php echo $language;?>','<?php echo $domain;?>')"  href="#" class="ion-settings modify-permission" id="create-user" languagekey="<?php echo $chos_lang[$eng_key] ?>"></a>     | &nbsp;<a onclick="languageDelete(this,'<?php echo $path;?>','<?php echo $eng_key;?>','<?php echo $language;?>','<?php echo $domain;?>')" href="#" id = "del<?php echo $i; ?>" class="editrevert0 margin-left5"></a>
</td>
  </tr>

  <?php
    $i++;
   }  ?>
</table> 

</div>
<?php
echo ob_get_clean(); 

$js = $this->template->admin_view( 'lang_js', '', true, "language");
$this->template->embed_asset_code('admin', 'js', 'lang-js', $js);

$this->template->add_remove_admin_css(array('jquery-ui.css'), 'add');
$this->template->add_remove_admin_js(array('jquery-ui.js'), 'add');
?>

  
   