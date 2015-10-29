<script type="application/javascript">
function logIn($form, callback)
{
	var method = new Array("POST", "<?php echo site_url("admin/login/ajax") ?>", "method=login&" + $form.serialize(), "json", false);		
	ajaxAction(method, callback);
}

function afterLogIn(data)
{
	showMsg('div[msg="login"]', data.event, data.msg, '', true);
	if(typeof data.redirect != "undefined")
		setTimeout(function(){window.location = data.redirect}, 1500);
}

function logOut(callback)
{
	var method = new Array("POST", "<?php echo site_url("admin/login/ajax") ?>", "method=logout", "json", false);		
	ajaxAction(method, callback);
}

function afterLogOut(data)
{
	setTimeout(function(){window.location = data.redirect}, 500);
}
</script>