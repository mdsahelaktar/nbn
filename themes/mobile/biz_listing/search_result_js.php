<script type="application/javascript">
var val = ["sortbycreation_time=desc", "sortbycreation_time=asc", "sortbyasking_price=asc", "sortbyasking_price=desc","sortbycash_flow=asc", "sortbycash_flow=desc","sortbyprovince_id=asc", "sortbyprovince_id=desc","sortbycounty_id=asc", "sortbycounty_id=desc","sortbycity=asc", "sortbycity=desc"];

function searchBiz(param){	
	var method = new Array("POST", "<?php  echo site_url("biz_listing/ajax") ?>", "method=innersearch&" + param, "json", false);
	ajaxAction(method, bizlistingAfterInner);
	return false;
}

function searchBizForm(elm){	
	var param = $(elm).serialize();
	unsetAnchorSorting();
	unsetDropDownSorting();
	return searchBiz(param);
}

function sortBiz(sortId)
{	
	var $form = $("#srpform");
	var param = $form.serialize()+ '&' +val[sortId];
	searchBiz(param);
}

function sortBizChange(elm){
	unsetAnchorSorting();
	var sortId = $(elm).val();
	if( sortId != ""){
		$('[sort-active="true"]').attr('sort-active', false);
		$(elm).attr('sort-active', true);
	}
	sortBiz(sortId);
	return false;
}
function sortBizToggle(elm)
{
	unsetDropDownSorting();
	unsetAnchorSorting(elm);
	var sortId = $(elm).data('sort-val');		
	if( sortId != ""){
		$('[sort-active="true"]').attr('sort-active', false);
		$(elm).attr('sort-active', true);
	}
	var viceversa = $(elm).data('sort-viceversa-'+sortId);		
	$(elm).data('sort-val', viceversa);
	sortBiz(sortId);
	return false;
}

function unsetAnchorSorting(current_elm){
	$("#ident a").each(function(){
		if(current_elm && current_elm.id == this.id)
			return;
			var default_sort = $(this).data('sort-default');
			$(this).data('sort-val', default_sort);
	});	
}

function unsetDropDownSorting(){
	$("#sortbyopt").val('');	
}

function bizlistingAfterInner(data)
{
	if(data.event == "success")	
		$("#stop").show();
	else	
		$("#stop").hide();		 
	$("#remv").text(data.total);
	$("#showsearch").html(data.html);
	$("#change").text(data.string);
	$("#upperstring").text(data.bizforsale);
}	

$( document ).ready(function()
 {
	var param = '';
	<?php   if($_REQUEST["biz_domain_id"]){ ?>
			param += "biz_domain_id=<?php echo $_REQUEST["biz_domain_id"]?>&";
	<?php } if($_REQUEST["biz_type_id"] ){ ?>		  
			param += "biz_type_id=<?php echo $_REQUEST["biz_type_id"]?>&";				 
	<?php } if( $_REQUEST["province_id"] ){ ?>		  
			param += "province_id=<?php echo $_REQUEST["province_id"]?>&";			
	<?php } if($_REQUEST["cklsearch"] ){ ?>
	 			param += "cklsearch=<?php echo $_REQUEST["cklsearch"]?>&";
				$(".slidediv").slideToggle();
	<?php } if($_REQUEST["city"] ){ ?>
	 			param += "city=<?php echo $_REQUEST["city"]?>&";	
	<?php } if($_REQUEST["county_id"] ) { ?>
	 			param += "county_id=<?php echo $_REQUEST["county_id"]?>";
				$("#county_id").attr("disabled", false);
	<?php } if($_REQUEST["country_id"] ) { ?>
	 			param += "country_id=<?php echo $_REQUEST["country_id"]?>";		
				getProvinceByCountry('#country_selector #country_id');		
	<?php } ?>
								
	searchBiz(param);	

	$('.showhide').click(function() {		
		$(".slidediv").slideToggle();
		return false;
	});
	
	$("body").on('click','.pagination ul li a',function(ev)
	{
		ev.preventDefault();
		page = $(this).attr('href');
		pageind = page.indexOf('page=');
		pageno = page.substring((pageind+5));

		var sortId, sort_active = $('[sort-active="true"]');
		if( sort_active.is("select") )
			sortId = sort_active.val();
		else{
			var current_sortId = sort_active.data('sort-val');			
			sortId = sort_active.data('sort-viceversa-'+current_sortId);
		}
		var sort_param = sortId ? '&' + val[sortId] : '';
		var param = $('#srpform').serialize()+"&page=" +pageno+ '' +sort_param;
		searchBiz(param);	
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
				alert('<?php echo _e('min_asking_price_is_not_minimum')?>');
				$('#asking_price_max').val(0);
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
				alert('<?php echo _e('min_gross_revenue_is_not_minimum')?>');
				$('#grl').val('');
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
				alert('<?php echo _e('min_cash_flow_is_not_minimum')?>');
				$('#cfl').val('');
			}		
		}
	});
});
</script>