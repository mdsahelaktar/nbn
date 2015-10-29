<script type="application/javascript">
function getBizTypeByBizDomain(Elm)
{
	var bizdomainId = $(Elm).val();
        var biztype_selector = $(Elm).data('biztype-sel');
	if( !bizdomainId )
	{
		$(biztype_selector).append(new Option("Choose biz type", "" ,"selected"));
		$(biztype_selector).prop('disabled', true);
		return;
	}
	var method = new Array("POST", "<?php echo site_url("admin/biz_type/json") ?>", "method=gettype&domain_id=" + bizdomainId, "json", false);
        var data = ajaxAction(method, false, true);
        addBizTypeToSelectBox(biztype_selector, data);		
}

function addBizTypeToSelectBox(biztype_selector, data)
{
	var selecter = $(biztype_selector);
	var db = selecter.val();
	//var biz_typeHtml = '<option value=""><?php echo _e('Choose segment');?></option>';
	var biz_typeHtml;
	$.each(data,function(biz_type_id, biz_type)
	{
		 biz_typeHtml += '<option value="'+biz_type_id+'">'+biz_type+'</option>';
	});
	selecter.html(biz_typeHtml);
	selecter.find('[value="'+db+'"]').attr('selected', true);
	selecter.attr("disabled", false);
}
</script>