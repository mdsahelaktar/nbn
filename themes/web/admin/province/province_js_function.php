<script type="application/javascript">
function getProvinceByCountry(Elm)
{
	var child_input_parent_selector = $(Elm).data('child-input-parent');
	var child_input_selector = $(Elm).data('child-input');
	child_input_parent_selector = child_input_parent_selector ? child_input_parent_selector : "label[for='province_id'], label[for='county_id'], label[for='is_county_cnfdntl']";	
	child_input_selector = child_input_selector ? child_input_selector : ":input#province_id, :input#county_id, :input#is_county_cnfdntl";
	
	$(child_input_parent_selector).show();
	$(child_input_selector).show().attr("disabled", false);		
	var countryId = $(Elm).val();
	if( !countryId )
	{
		$(child_input_selector).attr("disabled", true);
		return;
	}
	if( countryId != 1 )
	{
		$(child_input_parent_selector).hide();
		$(child_input_selector).hide().attr("disabled", true);
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
	var provinceHtml = '<option value=""><?php echo _e('choose_province');?></option>';
	$.each(data,function(province_id, province){
		provinceHtml += '<option value="'+province_id+'">'+province+'</option>';
	});
	selecter.html(provinceHtml);
	selecter.find('[value="'+db+'"]').attr('selected', true);
	selecter.attr("disabled", false);
	getCountyByProvince(province_selector);
}

</script>