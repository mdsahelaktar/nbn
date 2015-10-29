<script type="application/javascript">
function getDeniedPermissionsIndividualRole(user_map_id)
{
	var method = new Array("POST", "<?php echo site_url("admin/permission_modify/json") ?>", "method=deniedperissionbyumapid&user_map_id=" + user_map_id, "json", false);
	return ajaxAction(method, function(){}, true);
}

function permissionModify(elm)
{
	var user_map_id = $(elm).find('input[name="user_map_id"]').val();
	var permission_id_par = '';
	$(elm).find('input[name="permission_id[]"]:not(:checked)').each(function(){
		permission_id_par += '&permission_id[]='+$(this).val();
	});
	var method = new Array("POST", "<?php echo site_url("admin/permission_modify/ajax") ?>", "method=modify&user_map_id=" +user_map_id + permission_id_par, "json", false);
	ajaxAction(method, permissionModifyAfter);
}

function permissionModifyAfter(data)
{
	showMsg('div[msg="permission_modify"]', data.event, data.msg, '', true);
}

function showPermissionPopBox(elm)
{
	var user_map_id = $(elm).data('user_map_id');
	var user_role_id = $(elm).data('user_role_id');
	var default_permissions = getDefaultPermissionsByUserRoleId(user_role_id);
	var denied_permissions = getDeniedPermissionsIndividualRole(user_map_id);
	var dialog_html = '';
	$.each(default_permissions, function(i, v){
		dialog_html += '<dt><label for="permission_parent_id_'+i+'">'+v.group+'</label><input onclick="checkUncheck(this, \'input[childof='+i+']\')" type="checkbox" id="permission_parent_id_'+i+'"></dt>';
		$.each(v.permission_ids, function(pi, piv){
			var checked = $.inArray( piv, denied_permissions ) > -1 ? '' : 'checked="checked"';
			dialog_html += '<dd><label for="permission_id_'+piv+'">'+v.permissions[pi]+'</label><input '+checked+' type="checkbox" childof="'+i+'" name="permission_id[]" id="permission_id_'+piv+'" value="'+piv+'"></dd>';
		})
	})
	dialog_html = '<dl>'+dialog_html+'</dl>';
	var dialog = $('<div style="display:none" dialog="permission_modify" title="<?php echo _e('Permission Modify')?>"><?php renderResposeMessage('permission_modify') ?><form name="permission_modify" id="permission_modify" onsubmit="return permissionModify(this)"><input type="hidden" name="user_map_id" value="'+user_map_id+'"></div></form>').appendTo('body');
	dialog.dialog({
		open: function ()
		{
			$(this).find('form').append(dialog_html);
		},
		// add a close listener to prevent adding multiple divs to the document
		close: function(event, ui) {
			// remove div with all data and events
			dialog.remove();
		},
		modal: true,
		height: 'auto',
		buttons: {
          '<?php echo _e('Modify')?>': function() {
			  permissionModify('#permission_modify');
          }
		  ,
         '<?php echo _e('Cancel')?>': function() {
            $(this).dialog('close');
         }
       }
	});
}
//update the permission
</script>