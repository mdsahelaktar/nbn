<script type="application/javascript">

var $form =  $( "#<?php echo isset($edit_id) ? 'package_edit_form' : 'package_add_form'?>" );
function afterValidCheck($this, errors, event)
{
	if (errors.length == 0)
	{
		var method = new Array("POST", "<?php echo site_url("admin/package/ajax") ?>", "method=<?php echo isset($edit_id) ? 'edit' : 'add'?>&" + $form.serialize(), "json", false);
		ajaxAction(method, usercategoryAfterAction);
	}
	return false;			
}

function usercategoryAfterAction(data)
{
	showMsg('div[msg="package"]', data.event, data.msg, '', true);
}
$form.validate( afterValidCheck );
</script>