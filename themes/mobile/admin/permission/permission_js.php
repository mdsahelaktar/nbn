<script type="application/javascript">

var $form =  $( "#<?php echo isset($edit_id) ? 'permission_edit_form' : 'permission_add_form'?>" );
function afterValidCheck($this, errors, event)
{
	if (errors.length == 0)
	{
		var method = new Array("POST", "<?php echo site_url("admin/permission/ajax") ?>", "method=<?php echo isset($edit_id) ? 'edit' : 'add'?>&" + $form.serialize(), "json", false);
		ajaxAction(method, permissionAfterAction);
	}
	return false;			
}

function permissionAfterAction(data)
{
	showMsg('div[msg="permission"]', data.event, data.msg, '', true);
}
$form.validate( afterValidCheck );
</script>