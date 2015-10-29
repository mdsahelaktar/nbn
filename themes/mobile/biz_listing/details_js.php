<script type="application/javascript">
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

$(document).ready(function(){
	$("#box_0").css("display", "block");
	$('#slider1').tinycarousel({ pager: true, interval: true  })
	$("#clk").click(function ()
	{
		$('html, body').animate(
		{
			scrollTop: $("#frm").offset().top
		}, 2000);
	});
});

</script>


