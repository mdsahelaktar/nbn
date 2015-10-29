<script type="application/javascript">
function getRelationByContext(Elm)
{
	var cantxId = $(Elm).val();
	if( !cantxId )
	{
		//$("select#context_id").attr("disabled", true);
		return;
	}
	
	var method1 = new Array("POST", "<?php echo site_url("admin/context/contextidchk") ?>", "method=permissionchk&ai_context_id=" + cantxId, "json", false);
	if(!method1)
	{
		alert('no data found');
	}
	else
	{
		if(cantxId==1) //blizelist
		{
			var method = new Array("POST", "<?php echo site_url("admin/biz_listing/json") ?>", "method=relation&context_id=" + cantxId, "json", false);
			ajaxAction(method, relationShow);	
		}
		if(cantxId==2) //broker
		{
			var method = new Array("POST", "<?php echo site_url("broker/json") ?>", "method=relation&context_id=" + cantxId, "json", false);
			ajaxAction(method, brokerrelationShow);	
		}
	}
}

function relationShow(data)
{
	var selecter = $("select#relation_id");
	var db = selecter.data('selected');
	var roleHtml = '<option value=""><?php echo _e('Choose relation');?></option>';
	$.each(data,function(ai_biz_listing_id, headline)
	{
		roleHtml += '<option value="'+ai_biz_listing_id+'">'+headline+'</option>';
	});
	selecter.html(roleHtml);
	selecter.find('[value="'+db+'"]').attr('selected', true);
	selecter.attr("disabled", false);
}

function brokerrelationShow(data)
{
	var selecter = $("select#relation_id");
	var db = selecter.data('selected');
	var roleHtml = '<option value=""><?php echo _e('Choose relation');?></option>';
	$.each(data,function(ai_broker_id,user_name)
	{
		roleHtml += '<option value="'+ai_broker_id+'">'+user_name+'</option>';
	});
	selecter.html(roleHtml);
	selecter.find('[value="'+db+'"]').attr('selected', true);
	selecter.attr("disabled", false);
}

</script>