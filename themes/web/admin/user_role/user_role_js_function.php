<script type="application/javascript">
function getUserRoleByUserCat(Elm)
{
	var catId = $(Elm).val();
	if( !catId )
	{
		$("select#user_role_id").attr("disabled", true);
		return;
	}
	var method = new Array("POST", "<?php echo site_url("admin/user_role/json") ?>", "method=getuserroles&user_category=" + catId, "json", false);
	ajaxAction(method, addToRoleId);	
}

function addToRoleId(data)
{
	var selecter = $("select#user_role_id");
	var db = selecter.data('selected');
	var roleHtml = '<option value=""><?php echo _e('Choose user role');?></option>';
	$.each(data,function(user_role_id, role){
		roleHtml += '<option value="'+user_role_id+'">'+role+'</option>';
	});
	selecter.html(roleHtml);
	selecter.find('[value="'+db+'"]').attr('selected', true);
	selecter.attr("disabled", false);
}

function getPermissionByGroup(Elm)
{
	var groupId = $(Elm).val();
	if( !groupId )
	{
		$("select#allowed_permission_id").attr("disabled", true);
		return;
	}
	var method = new Array("POST", "<?php echo site_url("admin/permission/json") ?>", "method=getpermission&permission_group=" + groupId, "json", false);
	ajaxAction(method, addToPermissionId);	
}

function addToPermissionId(data)
{
	var selecter = $("select#allowed_permission_id");
	var db = selecter.data('selected');
	var permissionHtml = '<option value=""><?php echo _e('Choose permission');?></option>';
	$.each(data,function(permission_id, permission){
		permissionHtml += '<option value="'+permission_id+'">'+permission+'</option>';
	});
	selecter.html(permissionHtml);
	selecter.find('[value="'+db+'"]').attr('selected', true);
	selecter.attr("disabled", false);
}
</script>