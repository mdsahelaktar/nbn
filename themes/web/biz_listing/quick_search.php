<?php echo form_open('biz_listing/search', array('name' => 'quick_search_form', 'id' => 'quick_search_form', 'method' => 'get')) ?>
<input id="cklsearch" name="cklsearch" placeholder="Search Business" type="text" value="<?php echo $cklsearch; ?>"/>
<input class="search" name="submit" type="submit" value="" />
<?php echo form_close() ?>