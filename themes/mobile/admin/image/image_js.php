<script type="application/javascript">
var $form =  $( "#<?php echo isset($edit_id) ? 'image_edit_form' : 'image_add_form'?>" );
function afterValidCheck($this, errors, event)
{
	if (errors.length == 0)
	{
		iframeAjax($form[0], "<?php echo site_url("admin/image/ajax") ?>", imageAfterAction)
	}
	return false;			
}

function imageAfterAction(data)
{
	var data = $.parseJSON(data);
	showMsg('div[msg="image_url"]', data.event, data.msg, '', true);
}
$form.validate( afterValidCheck );

</script>