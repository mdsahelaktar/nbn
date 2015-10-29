<script type="application/javascript">
function searchFunction(param)
{
	var method = new Array("POST", "<?php  echo site_url("biz_listing/ajax") ?>", "method=innersearch&" + param, "json", false);
	ajaxAction(method, bizlistingAfterInner);
	return false;			
}

function bizlistingAfterInner(data)
{
	if(data.event == "success")
	{
		 $("#stop").show();
		 $("#showsearch").html(data.html);
		 $("#remv").text(data.total);
		 $("#change").text(data.string);
		 $("#upperstring").text(data.bizforsale);
	}
	else
	{
		 $("#stop").hide();
		 $("#remv").text(data.total);
		 $("#showsearch").html(data.html);
		 $("#change").text(data.string);
		 $("#upperstring").text(data.bizforsale);
	}
}	

$( document ).ready(function()
 {

	 var param = '';
	 <?php if($_POST["biz_domain_id"] != '') ?>
	 			param += "biz_domain_id=<?php echo $_POST["biz_domain_id"]?>&";
	 
	 <?php if($_POST["biz_type_id"] != '' || $_GET["ai_biz_type_id"] != '')
	 		 {?>
		  <?php if($_POST["biz_type_id"] != '')
				 {?>
					param += "biz_type_id=<?php echo $_POST["biz_type_id"]?>&";
				 <?php
				 } 
			    else 
				 {?>	
					param += "biz_type_id=<?php echo $_GET["ai_biz_type_id"]?>&";			
			 		<?php 
			 	 } 
	 		}
			?>
			
		 <?php if($_POST["province_id"] != '' || $_GET["province_id"] != '')
	 		 {?>
		  <?php if($_POST["province_id"] != '')
				 {?>
					param += "province_id=<?php echo $_POST["province_id"]?>&";
				 <?php
				 } 
			    else 
				 {?>	
					param += "province_id=<?php echo $_GET["province_id"]?>&";			
			 		<?php 
			 	 } 
	 		}
			?>	

	 <?php if($_COOKIE["country"] != '') 
	 {?>
	 			param += "country_id=<?php echo $_POST["country_id"]?>&";
	 <?php
	 }
		 else
	 { ?>			
	 			param += "country_id=<?php echo $_COOKIE["country_ip"]?>&";	
	 <?php
	 }
	 ?>
				
				
				
	 <?php if($_POST["cklsearch"] != '') ?>
	 			param += "cklsearch=<?php echo $_POST["cklsearch"]?>&";
							
	 <?php if($_GET["city"] != '') ?>
	 			param += "city=<?php echo $_GET["city"]?>&";
	
	<?php if($_GET["county_id"] != '') ?>
	 			param += "county_id=<?php echo $_GET["county_id"]?>";							
								
	searchFunction(param);
	return false;		
});

function submitFunction()
{
	var $form = $("#srpform");
	var param = $form.serialize();
	searchFunction(param);
	return false;
}

var val = ["sortbycreation_time=desc", "sortbycreation_time=asc", "sortbyasking_price=asc", "sortbyasking_price=desc","sortbycash_flow=asc", "sortbycash_flow=desc","sortbyprovince_id=asc", "sortbyprovince_id=desc","sortbycounty_id=asc", "sortbycounty_id=desc","sortbycity=asc", "sortbycity=desc"];

$(document).on('click','#ident ul li:nth-child(1) a',function()
{
	var get_sort = $(this).attr("sort");
	$("#cashf").attr("sort_cf","");
	$("#loc").attr("sort_l","");
    $("#sortbyopt").val("");
    if (get_sort == ''|| get_sort == 3)
	{
		sortResult(2);
		$(this).attr("sort", "2");
	}
    else
	{
		sortResult(3);
		$(this).attr("sort", "3");
	}
});

$(document).on('click','#ident ul li:nth-child(3) a',function()
{
	var get_sortcf = $(this).attr("sort_cf");
	 $("#askp").attr("sort","");
	 $("#loc").attr("sort_l","");
	 $("#sortbyopt").val("");
    if (get_sortcf == ''|| get_sortcf == 5)
	{
		sortResult(4);
		$(this).attr("sort_cf", "4");
	}
    else
	{
		sortResult(5);
		$(this).attr("sort_cf", "5");
	}
});

$(document).on('click','#ident ul li:nth-child(5) a',function()
{
	var get_sortl = $(this).attr("sort_l");
	 $("#askp").attr("sort","");
	 $("#cashf").attr("sort_cf","");
	 $("#sortbyopt").val("");
    if (get_sortl == ''|| get_sortl == 11)
	{
		sortResult(10);
		$(this).attr("sort_l", "10");
	}
    else
	{
		sortResult(11);
		$(this).attr("sort_l", "11");
	}
});

function sortResult(str)
{
	$("#askp").attr("sort","");
	$("#loc").attr("sort_l","");
	$("#cashf").attr("sort_cf","");

	var $form = $("#srpform");
	var param = $form.serialize()+ '&' +val[str];
	searchFunction(param);
}

$("body").on('click','.pagination ul li a',function(ev)
{
	  ev.preventDefault();
	  page = $(this).attr('href');
	  pageind = page.indexOf('page=');
	  pageno = page.substring((pageind+5));
	  var sortchk = '';
	  var valuesshort = $('select[name=sortbyopt]').val();
	  if(valuesshort != '')
	  	sortchk = val[valuesshort];
	  
	  var ask = document.getElementById("askp").getAttribute("sort");
	  if(ask != '')
	  	sortchk = val[ask];
	  
	  var cash = document.getElementById("cashf").getAttribute("sort_cf");
	  if(cash != '')
	 	 sortchk = val[cash];
	  
	  var loc = document.getElementById("loc").getAttribute("sort_l");
	  if(loc != '')
	  	sortchk = val[loc];
	  
	  var param = $('#srpform').serialize()+"&page=" +pageno+ '&' +sortchk;
	  searchFunction(param);
 });
 
var $min= $("#asking_price_min");
var $max = $("#asking_price_max");
$min.add($max).change(function () 
{
    var minVal = parseInt($min.val(),10);
    var maxVal = parseInt($max.val(),10)
    var bothHaveValues = !isNaN(minVal) && !isNaN(maxVal);
    if(bothHaveValues)
	{
		if(minVal > maxVal)
		{
			alert ('Minimum price cannot be greater than the maximum');
			$('#asking_price_max').val(0);
		}
		else if(maxVal < minVal)
		{
			alert ('Minimum price cannot be greater than the maximum');
			$('#asking_price_min').val(0);
		}
    }
});

var $mingr= $("#grl");
var $maxgr = $("#grh");
$mingr.add($maxgr).change(function () 
{
    var minVal = parseInt($mingr.val(),10);
    var maxVal = parseInt($maxgr.val(),10)
    var bothHaveValues = !isNaN(minVal) && !isNaN(maxVal);
    if(bothHaveValues)
	{
		if(minVal > maxVal)
		{
			alert ('Minimum Gross Revenue cannot be greater than the maximum');
			$('#grl').val('');
		}
		else if(maxVal < minVal)
		{
			alert ('Minimum Gross Revenue cannot be greater than the maximum');
			$('#grh').val('');
		}
    }
});

var $mincf= $("#cfl");
var $maxcf = $("#cfh");
$mincf.add($maxcf).change(function () 
{
    var minVal = parseInt($mincf.val(),10);
    var maxVal = parseInt($maxcf.val(),10)
    var bothHaveValues = !isNaN(minVal) && !isNaN(maxVal);
    if(bothHaveValues)
	{
		if(minVal > maxVal)
		{
			alert ('Minimum Cash Flow cannot be greater than the maximum');
			$('#cfl').val('');
		}
		else if(maxVal < minVal)
		{
			alert ('Minimum Cash Flow cannot be greater than the maximum');
			$('#cfh').val('');
		}
    }
});

</script>