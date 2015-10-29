<script type="application/javascript">

var $form =  $( "#<?php echo isset($edit_id) ? 'user_category_edit_form' : 'user_category_add_form'?>" );
function afterValidCheck($this, errors, event)
{
	if (errors.length == 0)
	{
		var method = new Array("POST", "<?php echo site_url("admin/user_category/ajax") ?>", "method=<?php echo isset($edit_id) ? 'edit' : 'add'?>&" + $form.serialize(), "json", false);
		ajaxAction(method, usercategoryAfterAction);
	}
	return false;			
}

function usercategoryAfterAction(data)
{
	showMsg('div[msg="user_category"]', data.event, data.msg, '', true);
}
$form.validate( afterValidCheck );
</script>