<script type="application/javascript">
$('.nav-toggle').click(function(){
	 $('#collapse1').slideToggle("slow");
});

var $form = $( "#details_mail_form" );
function afterValidCheck()
{
	var method = new Array("POST", "<?php  echo site_url("biz_listing/ajax") ?>", "method=detailsmail&" + $form.serialize(), "json", false);
	ajaxAction(method, detailsAction);
	return false;			
}

function detailsAction(data)
{
	showMsg('div[msg="sent_respons"]', data.event, data.msg, '', true);
}	
$form.validate( afterValidCheck ); 
</script>