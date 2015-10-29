<script type="application/javascript">
function getDefaultPermissionsByUserRoleId(user_role_id)
{
	var method = new Array("POST", "<?php echo site_url("admin/default_permission/json") ?>", "method=getdefaultpermissions&role=" + user_role_id, "json", false);
	return ajaxAction(method, function(){}, true);
}
</script>