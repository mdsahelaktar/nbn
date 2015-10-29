<script type="application/javascript">
function getCityByCounty(Elm)
{
	var county_id = $(Elm).val();
	var method = new Array("POST", "<?php  echo site_url("location/json") ?>", "method=citybycounty&county=" + county_id, "json", false);
	var data = ajaxAction(method, false, true);
	var city_selector = $(Elm).data('city-sel');	
	addToCitiesToSelectBox(city_selector, data);	
}

function addToCitiesToSelectBox(city_selector, data)
{
	var selecter = $(city_selector);
	var db = selecter.val();
	var cityHtml = '<option value=""><?php echo _e('Choose city');?></option>';
	$.each(data,function(city_id, city)
	{
		cityHtml += '<option value="'+city_id+'">'+city+'</option>';
	});	
	selecter.html(cityHtml);
	selecter.find('[value="'+db+'"]').attr('selected', true);
	selecter.attr("disabled", false);
}

function getZipByCity(Elm)
{
	var city = $(Elm).val();
	var method = new Array("POST", "<?php  echo site_url("location/json") ?>", "method=zipbycity&city=" + city, "json", false);	
	var data = ajaxAction(method, false, true);
	var zip_selector = $(Elm).data('zip-sel');	
	addToZipCodesToSelectBox(zip_selector, data);	
}

function addToZipCodesToSelectBox(zip_selector, data)
{
	var selecter = $(zip_selector);
	var db = selecter.val();
	var countyHtml = '<option value=""><?php echo _e('Choose zip');?></option>';
	$.each(data,function(zip_id, zip)
	{
		countyHtml += '<option value="'+zip_id+'">'+zip+'</option>';
	});
	selecter.html(countyHtml);
	selecter.find('[value="'+db+'"]').attr('selected', true);
	selecter.attr("disabled", false);
}

function autoSuggestCity(elm, callcback)
{
	var province_sel = $(elm).data('as-province-sel');	
	var county_sel = $(elm).data('as-county-sel');
	var province_id = $(province_sel).length > 0 ? $(province_sel).val() : 0;
	var county_id = $(county_sel).length > 0 ? $(county_sel).val() : 0;
	$( elm ).autocomplete({
		source: "<?php  echo site_url("location/getcitysuggt") ?>/?province_id="+province_id+"&county_id="+county_id,
		response: function(event, ui) {
			if(typeof callcback != "undefined")
				callcback(event, ui);
		}
	});
}

function autoSuggestZip(elm, callcback)
{	
	$( elm ).autocomplete({
		source: "<?php  echo site_url("location/getzip") ?>/",
		response: function(event, ui) {
			if(typeof callcback != "undefined")
				callcback(event, ui);
		}
	});
}

function autoSuggestProvince(elm, callcback)
{	
	$( elm ).autocomplete({
		source: function( request, response ) {
			var method = new Array("GET", "<?php  echo site_url("province/province_admin/getprovincesuggt") ?>/", "term=" + request.term, "json", false);
			ajaxAction(method, function(data){response($.map(data, function (value, key) {				
                return {
                    key : key,
					label: value,
					value : value
                };
            }))});		
		},
		select: function(event, ui) {
			event.preventDefault();
			$( elm ).val(ui.item.value);
			var province_elm = $( elm ).data('hidden-province-elm');				
			$( province_elm ).val(ui.item.key); 
		},
		response: function(event, ui) {
			if(typeof callcback != "undefined")
				callcback(event, ui);
		}
	});
}

function autoSuggestCounty(elm, callcback)
{	
	$( elm ).autocomplete({
		source: "<?php  echo site_url("county/county_admin/getcountysuggt") ?>/",
		select: function(event, ui) {
			event.preventDefault();
			$( elm ).val(ui.item.label);
			var county_elm = $( elm ).data('hidden-county-elm');
			$( county_elm ).val(ui.item.value); 
		},
		response: function(event, ui) {
			if(typeof callcback != "undefined")
				callcback(event, ui);
		}
	});
}
</script>


