<script type="application/javascript">
function getUserAllRoles(userId, callback)
{
	var method = new Array("POST", "<?php echo site_url("admin/user_map/json") ?>", "method=userallroles&user_id=" + userId, "json", false);
	ajaxAction(method, callback);
}
function userRolesCallBack(data)
{
	$( "#tabs" ).remove();
	var html = $('<div id="tabs"></div>').appendTo('div#userallrolesplacer');
	var tabli = '';
	var tabcontent = '';
	$.each(data, function(i, value){
		tabli += '<li><a href="#tabs-'+value.user_category_id+'">'+value.user_category+'</a></li>';
		tabcontent += '<div id="tabs-'+value.user_category_id+'"><ul>';
		$.each(value.user_role_ids, function(ui, role){
			tabcontent += '<li rel="role" onClick="showPermissionPopBox(this)" data-user_map_id="'+value.user_map_ids[ui]+'" title="<?php echo _e('Click here to set permission for ')?>'+value.user_roles[ui]+' <?php echo _e('role')?>" data-user_role_id="'+value.user_role_ids[ui]+'">'+value.user_roles[ui]+'</li>';
		});
		tabcontent += '</ul></div>';
	});
	tabli = '<ul>'+tabli+'</ul>';
	html.append(tabli+tabcontent);
	$( '#tabs li[rel="role"]' ).button();
	$( "#tabs" ).tabs();
}
</script>