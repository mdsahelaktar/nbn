<script type="application/javascript">
function autoSuggestUser(selecter, callback){
	$(selecter).autocomplete({
		source: function (request, response)
		{
			var method = new Array("POST", "<?php echo site_url("admin/user/json") ?>", "method=autosuggestuser&term=" + request.term, "json", false);
			ajaxAction(method, response);			
		},
		minLength: 2,
		select: function (event, ui){callback(event, ui);}		
	});
}

function afterValidCheck($this, errors, event){
	<?php if( isAdminArea() ):?>
		var action = '<?php echo isset($edit_id) ? 'edit' : 'add' ?>';
	<?php else:?>
		var action = '<?php echo isset($current_slug) ? $current_slug : 'add' ?>';
	<?php endif;?>
	if (errors.length == 0){
		var method = new Array("POST", "<?php echo site_url("admin/user/ajax") ?>", "method=" + action + "&" + $form.serialize(), "json", false);
		ajaxAction(method, userAfterAction);
	}
	return false;			
}

function userAfterAction(data)
{            
	showMsg('<?php echo isAdminArea() ? 'div[msg="user_list"]' : 'div[msg="user"]' ?>', data.event, data.msg, '', <?php echo isAdminArea() ? true : 120 ?>);
	if(data.event != 'error' && data.cat == 10)
		setTimeout(function(){window.location = "<?php echo site_url("broker/profileinfo") ?>"}, 2000);
}
</script>