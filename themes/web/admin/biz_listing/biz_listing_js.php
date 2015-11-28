<script type="application/javascript">
var $form =  $( "#<?php echo isset($edit_id) ? 'biz_listing_edit_form' : 'biz_listing_add_form'?>" );
function afterValidCheck($this, errors, event)
{
	if (errors.length == 0)
	{
		iframeAjax($form[0], "<?php echo site_url("admin/biz_listing/ajax") ?>", bizlistingAfterAction)
	}
	return false;			
}

function bizlistingAfterAction(data)
{
	console.log(data);
	var data = $.parseJSON(data);	
	showMsg('div[msg="biz_listing"]', data.event, data.msg, '', true);	
}

$form.validate( afterValidCheck );
</script>