<script type="application/javascript">

var $form =  $( "#<?php echo isset($edit_id) ? 'permission_group_edit_form' : 'permission_group_add_form'?>" );
function afterValidCheck($this, errors, event)
{
	if (errors.length == 0)
	{
		var method = new Array("POST", "<?php echo site_url("admin/permission_group/ajax") ?>", "method=<?php echo isset($edit_id) ? 'edit' : 'add'?>&" + $form.serialize(), "json", false);
		ajaxAction(method, permissiongroupAfterAction);
	}
	return false;			
}

function permissiongroupAfterAction(data)
{
	showMsg('div[msg="permission_group"]', data.event, data.msg, '', true);
}
$form.validate( afterValidCheck );
</script>