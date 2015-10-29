<script type="application/javascript">

var $form =  $( "#<?php echo isset($edit_id) ? 'language_edit_form' : 'language_add_form'?>" );
function afterValidCheck($this, errors, event)
{
	if (errors.length == 0)
	{
		var method = new Array("POST", "<?php echo site_url("admin/language/ajax") ?>", "method=<?php echo isset($edit_id) ? 'edit' : 'add'?>&" + $form.serialize(), "json", false);
		ajaxAction(method, languageAfterAction);
	}
	return false;			
}

function languageAfterAction(data)
{
	showMsg('div[msg="language"]', data.event, data.msg, '', true);
}
$form.validate( afterValidCheck );
</script>