<script type="application/javascript">
var $form = $( "#user_add_form" );
function afterValidCheck($this, errors, event)
{
	if (errors.length == 0)
	{
		var method = new Array("POST", "<?php echo site_url("user/ajax") ?>", "method=registration&" + $form.serialize(), "json", false);
		ajaxAction(method, userAfterAction);
	}
	return false;			
}

function userAfterAction(data)
{
	showMsg('div[msg="user"]', data.event, data.msg, '', true);
	if(data.event != 'error' && data.cat == 10)
		setTimeout(function(){window.location = "<?php echo site_url("broker/profileinfo")?>"}, 2000);		
}
$form.validate( afterValidCheck );
</script>