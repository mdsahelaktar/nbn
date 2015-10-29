<script type="application/javascript">
var $form = $( "#brokerinfo_add_form" );
function afterValidCheck($this, errors, event)
{
	if (errors.length == 0)
	{
		iframeAjax($form[0], "<?php echo site_url("broker/ajax") ?>", brokerAfterAction)
	}
	return false;			
}

function brokerAfterAction(data)
{
	var data = $.parseJSON(data);
	showMsg('div[msg="brokermsg"]', data.event, data.msg, '', true);
}
$form.validate( afterValidCheck );

function autodrop()
{
	$( "#postalcode" ).autocomplete({
		source: "location/getzip"
	});
}
</script>