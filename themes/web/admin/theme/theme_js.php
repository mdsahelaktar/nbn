<script type="application/javascript">

var $form =  $( "#<?php echo isset($edit_id) ? 'theme_edit_form' : 'theme_add_form'?>" );
function afterValidCheck($this, errors, event)
{
	if (errors.length == 0)
	{
		var method = new Array("POST", "<?php echo site_url("admin/theme/ajax") ?>", "method=<?php echo isset($edit_id) ? 'edit' : 'add'?>&" + $form.serialize(), "json", false);
		ajaxAction(method, themeAfterAction);
	}
	return false;			
}

function themeAfterAction(data)
{
	showMsg('div[msg="theme"]', data.event, data.msg, '', true);
}

$form.validate( afterValidCheck );
</script>