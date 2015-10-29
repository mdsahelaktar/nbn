<script type="application/javascript">
function autoSuggestUser(selecter, callback)
{
	$(selecter).autocomplete(
	{
		source: function (request, response)
		{
			var method = new Array("POST", "<?php echo site_url("admin/user/json") ?>", "method=autosuggestuser&term=" + request.term, "json", false);
			ajaxAction(method, response);			
		},
		minLength: 2,
		select: function (event, ui)
		{
			callback(event, ui);			
		}		
	});
}

</script>