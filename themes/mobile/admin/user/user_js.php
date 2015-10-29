<script type="application/javascript">
var $form =  $( "#<?php echo isset($edit_id) ? 'user_edit_form' : 'user_add_form'?>" );
function afterValidCheck($this, errors, event)
{
	if (errors.length == 0)
	{
		var method = new Array("POST", "<?php echo site_url("admin/user/ajax") ?>", "method=<?php echo isset($edit_id) ? 'edit' : 'add'?>&" + $form.serialize(), "json", false);
		ajaxAction(method, userAfterAction);
	}
	return false;			
}

function userAfterAction(data)
{
	showMsg('div[msg="user"]', data.event, data.msg, '', true);
}
$form.validate( afterValidCheck );
</script>