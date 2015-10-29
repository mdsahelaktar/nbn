<script type="application/javascript">
var $form = $( "#biz_listing_add_form" );
function afterValidCheck($this, errors, event)
{
	if (errors.length == 0)
	{
		var method = new Array("POST", "<?php  echo site_url("biz_listing/ajax") ?>", "method=secondstepdata&" + $form.serialize(), "json", false);
		ajaxAction(method, bizlistingAfterAddfirst);
	}
	return false;			
}

function bizlistingAfterAddfirst(data)
{
	showMsg('div[msg="biz_listing"]', data.event, data.msg, '', true);
	if(data.event != 'error' && data.chk == '' || data.chk == 'false')
		setTimeout(function(){window.location = "<?php echo site_url("biz_listing/thirdstep")?>"}, 2000);		
}	
$form.validate( afterValidCheck ); 

function popitup(url)
{
	newwindow = window.open(url,'name','location=0, status=1,directories=1,toolbars=no, resizable=1, height=800,width=750,scrollbars=yes');
    if (window.focus) 
	{
		newwindow.focus()
	}
	return false;
}

$(function () 
{
	$('#pri').on('click', function (event) 
	{
		var method = new Array("POST", "<?php  echo site_url("biz_listing/ajax") ?>", "method=updatepopup&" + $form.serialize(), "json", false);
		ajaxAction(method,popitup('popup'));
	});

	$('#pri1').on('click', function (event) 
	{
		var method = new Array("POST", "<?php  echo site_url("biz_listing/ajax") ?>", "method=updatepopup&" + $form.serialize(), "json", false);
		ajaxAction(method,popitup('popup'));
	});

	$('#biz_listing_save').on('click', function (event) 
	{
		$("#saveandcontlet").attr("value", true);
		$form.submit();
	});

	$('#biz_listing_add_second').on('click', function (e) 
	{
		$("#saveandcontlet").attr("value", false);
		$form.submit();
	});
	
	$('#biz_listing_add').on('click', function (e) 
	{
		$("#saveandcontlet").attr("value", false);
	});
});	
</script>