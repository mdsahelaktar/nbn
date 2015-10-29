<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="application/javascript">
var allprovince;
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
		source: "location/getzip",
		response: function(event, ui) {
		 if (ui.content.length === 0) 
		 {
				$("#results1").removeClass("ion-android-checkmark");
				$("#results1").addClass("ion-android-close");
				$('input[type="submit"]').attr('disabled','disabled');
				$('input[type="submit"]').removeClass("margin-left10 orange");
				$('input[type="submit"]').addClass("margin-left10 red");
          } 
		else 
		{
				$("#results1").removeClass("ion-android-close");
				$("#results1").addClass("ion-android-checkmark");
				$('input[type="submit"]').removeAttr('disabled');
				$('input[type="submit"]').removeClass("margin-left10 red");
				$('input[type="submit"]').addClass("margin-left10 orange");
            }
		}
	});
}

function autodropProvince()
{
	var pro = allprovince;
	$( "#province" ).autocomplete({
		source: "province/province_admin/getprovincesuggt",
		response: function(event, ui) 
		 {
            if (ui.content.length === 0) 
			{
				$("#results").removeClass("ion-android-checkmark");
				$("#results").addClass("ion-android-close");
				$('input[type="submit"]').attr('disabled','disabled');
				$('input[type="submit"]').removeClass("margin-left10 orange");
				$('input[type="submit"]').addClass("margin-left10 red");
            } 
			else 
			{
				$("#results").removeClass("ion-android-close");
				$("#results").addClass("ion-android-checkmark");
				$('input[type="submit"]').removeAttr('disabled');
				$('input[type="submit"]').removeClass("margin-left10 red");
				$('input[type="submit"]').addClass("margin-left10 orange");
            }
        }
});
}

function autodropCounty()
{
	$( "#county" ).autocomplete({
		source: "county/county_admin/getcountysuggt",
	    select: function(event, ui) {
			event.preventDefault();
			$("#county").val(ui.item.label);
			$("#c_id").val(ui.item.value) 
		},
	response: function(event, ui) 
	{
		 if (ui.content.length === 0) 
		 {
				$("#results2").removeClass("ion-android-checkmark");
				$("#results2").addClass("ion-android-close");
				$('input[type="submit"]').attr('disabled','disabled');
				$('input[type="submit"]').removeClass("margin-left10 orange");
				$('input[type="submit"]').addClass("margin-left10 red");
         } 
		else
		  {
				$("#results2").removeClass("ion-android-close");
				$("#results2").addClass("ion-android-checkmark");
				$('input[type="submit"]').removeAttr('disabled');
				$('input[type="submit"]').removeClass("margin-left10 red");
				$('input[type="submit"]').addClass("margin-left10 orange");
           }
		}
	});
}

$(document).ready(function(){
    $(".lettertyp").click(function(){
        $(".lettertyp").attr('checked',false);
        $(this).attr('checked', true);
    });
    	$('.tpy').hide();
		$('#sub2').hide();
		$('#sub3').hide();
		$('#sub4').hide();
		$('#sub1').show();
		$('#postalcode').show();
    
    $('#lettertyp1').click(function(){
        $('.tpy').hide();
		$('#sub2').hide();
		$('#sub3').hide();
		$('#sub4').hide();
		$('#sub1').show();
        $('#postalcode').show();
		
    }); 
	
   $('#lettertyp2').click(function(){
        $('.tpy').hide();
		$('#sub1').hide();
		$('#sub3').hide();
		$('#sub4').hide();
		$('#sub2').show();
        $('#province').show();
    }); 
	
    $('#lettertyp3').click(function(){
        $('.tpy').hide();
		$('#sub1').hide();
		$('#sub2').hide();
		$('#sub4').hide();
		$('#sub3').show();
        $('#county').show();
    }); 

    $('#lettertyp4').click(function(){
        $('.tpy').hide();
		$('#sub1').hide();
		$('#sub2').hide();
		$('#sub3').hide();
		$('#sub4').show();
        $('#city').show();
    }); 
});

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

 function initialize(lat,long) 
 {
	 $("#map").css("display", "block");
	var latlng = new google.maps.LatLng(lat,long);
	var myOptions = {
		zoom: 10,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	geocoder = new google.maps.Geocoder();

	var marker = new google.maps.Marker({
		position: latlng,
		map: map,
		title: ""
	});

  }
			
</script>