<script type="application/javascript">
var $biz_seller_contact_form = $( "#details_mail_form" );
function afterValidCheck( $this, errors, event )
{
	if (errors.length == 0){
		var method = new Array("POST", "<?php  echo site_url("biz_listing/ajax") ?>", "method=detailsmail&" + $biz_seller_contact_form.serialize(), "json", false);
		ajaxAction( method, function(data){ showMsg('div[msg="sent_respons"]', data.event, data.msg, '', true); } );
	}
	return false;			
}

$biz_seller_contact_form.validate( afterValidCheck ); 

$(document).ready(function(){
	$("#box_0").css("display", "block");
	$('#slider1').tinycarousel({ pager: true, interval: true  })
	$("#clk, #frm .email a").click(function (){
		$('html, body').animate({
			scrollTop: $("#frm").offset().top
		}, 100);		
		$biz_seller_contact_form.submit();
		return false;
	});	
	
	var biz_listing_image = $("a#download_biz_listing_image").attr("href");
	$("#frm .save a").attr( "href", biz_listing_image );		
});

</script>


