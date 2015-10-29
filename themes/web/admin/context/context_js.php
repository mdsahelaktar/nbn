<script type="application/javascript">
var $form =  $( "#<?php echo isset($edit_id) ? 'context_edit_form' : 'context_add_form'?>" );
function afterValidCheck($this, errors, event)
{
	if (errors.length == 0)
	{
		var method = new Array("POST", "<?php echo site_url("admin/context/ajax") ?>", "method=<?php echo isset($edit_id) ? 'edit' : 'add'?>&" + $form.serialize(), "json", false);
		ajaxAction(method, contextAfterAction);
	}
	return false;			
}

function contextAfterAction(data)
{
	showMsg('div[msg="context"]', data.event, data.msg, '', true);
}
$form.validate( afterValidCheck );

$(document).ready(function()
{
	getUserRelationByContext('select#context_id');
});
</script>