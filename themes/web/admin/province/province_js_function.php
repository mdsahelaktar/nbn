<script type="application/javascript">
function getProvinceByCountry(Elm)
{
	$("label[for='province_id'], label[for='county_id'], label[for='is_county_cnfdntl']").show();
	$(":input#province_id, :input#county_id, :input#is_county_cnfdntl").show().attr("disabled", false);		
	var countryId = $(Elm).val();
	if( !countryId )
	{
		$(":input#province_id, :input#county_id, :input#is_county_cnfdntl").attr("disabled", true);
		return;
	}
	if( countryId != 1 )
	{
		$("label[for='province_id'], label[for='county_id'], label[for='is_county_cnfdntl']").hide();
		$(":input#province_id, :input#county_id, :input#is_county_cnfdntl").hide().attr("disabled", true);
		return;
	}
	var method = new Array("POST", "<?php echo site_url("admin/province/json") ?>", "method=getprovinces&country=" + countryId, "json", false);
	var data = ajaxAction(method, false, true);
	var province_selector = $(Elm).data('province-sel');
	addProvincesToSelectBox(province_selector, data);
}

function addProvincesToSelectBox(province_selector, data)
{
	var selecter = $(province_selector);
	var db = selecter.val();
	var provinceHtml = '<option value=""><?php echo _e('Choose province');?></option>';
	$.each(data,function(province_id, province){
		provinceHtml += '<option value="'+province_id+'">'+province+'</option>';
	});
	selecter.html(provinceHtml);
	selecter.find('[value="'+db+'"]').attr('selected', true);
	selecter.attr("disabled", false);
	getCountyByProvince(province_selector);
}

</script>