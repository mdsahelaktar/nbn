<script type="application/javascript">

var $form =  $( "#<?php echo isset($edit_id) ? 'user_role_edit_form' : 'user_role_add_form'?>" );
function afterValidCheck($this, errors, event)
{
	if (errors.length == 0)
	{
		var method = new Array("POST", "<?php echo site_url("admin/user_role/ajax") ?>", "method=<?php echo isset($edit_id) ? 'edit' : 'add'?>&" + $form.serialize(), "json", false);
		ajaxAction(method, userroleAfterAction);
	}
	return false;			
}

function userroleAfterAction(data)
{
	showMsg('div[msg="user_role"]', data.event, data.msg, '', true);
}
$form.validate( afterValidCheck );
</script>