<script type="application/javascript">
function getCountyByProvince(Elm)
{
	var provinceId = $(Elm).val();
	if( !provinceId )
	{
		$(":input#county_id, :input#is_county_cnfdntl").attr("disabled", true);
		return;
	}
	var method = new Array("POST", "<?php echo site_url("admin/county/json") ?>", "method=getcounties&province=" + provinceId, "json", false);		
        var data = ajaxAction(method, false, true);
        var county_selector = $(Elm).data('county-sel');
        addCountiesToSelectBox(county_selector, data);
}

function addCountiesToSelectBox(county_selector, data)
{
	var selecter = $(county_selector);
	var db = selecter.val();
	var countyHtml = '<option value=""><?php echo _e('Choose county');?></option>';
	$.each(data,function(county_id, county)
	{
		countyHtml += '<option value="'+county_id+'">'+county+'</option>';
	});
	selecter.html(countyHtml);
	selecter.find('[value="'+db+'"]').attr('selected', true);
	selecter.attr("disabled", false);
	$(":input#is_county_cnfdntl").attr("disabled", false);
}
</script>