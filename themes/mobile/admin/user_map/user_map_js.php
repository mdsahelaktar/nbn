<script type="application/javascript">

var $form =  $( "#<?php echo isset($edit_id) ? 'user_map_edit_form' : 'user_map_add_form'?>" );
function afterValidCheck($this, errors, event)
{
	if (errors.length == 0)
	{
		var method = new Array("POST", "<?php echo site_url("admin/user_map/ajax") ?>", "method=<?php echo isset($edit_id) ? 'edit' : 'add'?>&" + $form.serialize(), "json", false);
		ajaxAction(method, userMapAfterAction);
	}
	return false;			
}

function userMapAfterAction(data)
{
	showMsg('div[msg="user_map"]', data.event, data.msg, '', true);
}

$form.validate( afterValidCheck );
function afterSelect(event, ui)
{
	var user_id = ui.item ? ui.item.id : 0;
	if(user_id > 0)
		$('input[name="user_id"]').val(user_id);	
	else
		$('input[name="user_id"]').val('');
}
$(document).ready(function(){
	<?php
	if($this->router->fetch_method() == 'add'):
	?>
	getUserRoleByUserCat('select#user_category_id');
	autoSuggestUser('#user_name',afterSelect);	
	<?php 
	endif;
	?>	
});
</script>