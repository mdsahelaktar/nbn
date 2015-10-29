<script type="application/javascript">
var $form =  $( "#<?php echo isset($edit_id) ? 'default_permission_edit_form' : 'default_permission_add_form'?>" );
function afterValidCheck($this, errors, event)
{
	if (errors.length == 0)
	{
		var method = new Array("POST", "<?php echo site_url("admin/default_permission/ajax") ?>", "method=<?php echo isset($edit_id) ? 'edit' : 'add'?>&" + $form.serialize(), "json", false);
		ajaxAction(method, defaultPermissionAfterAction);
	}
	return false;			
}

function defaultPermissionAfterAction(data)
{
	showMsg('div[msg="default_permission"]', data.event, data.msg, '', true);
}

$form.validate( afterValidCheck );

$(document).ready(function()
{
	getUserRoleByUserCat('select#user_category');
	getPermissionByGroup('select#permission_group');
});
</script>