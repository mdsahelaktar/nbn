<script type="application/javascript">
var $form = $( "#biz_listing_edit_form" );
function afterValidCheck($this, errors, event)
{
	if (errors.length == 0)
	{
		var method = new Array("POST", "<?php  echo site_url("biz_listing/ajax") ?>", "method=therdstepdata&" + $form.serialize(), "json", false);
		ajaxAction(method, bizlistingAfterAddsecond);
	}
	return false;			
}

function bizlistingAfterAddsecond(data)
{
	showMsg('div[msg="biz_listing_third"]', data.event, data.msg, '', 125);
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

	$('#biz_listing_add2').on('click', function (event) 
	{
		var method = new Array("POST", "<?php  echo site_url("biz_listing/ajax") ?>", "method=therdstepdata&" + $form.serialize(), "json", false);
		ajaxAction(method, bizlistingAfterAddsecond);
	});
});	

</script>