<script type="application/javascript">
function getBizTypeByBizDomain(Elm)
{
	var bizdomainId = $(Elm).val();
	if( !bizdomainId )
	{
		$(":input#biz_type_id").append(new Option("Choose biz type", "" ,"selected"));
		$('#biz_type_id').prop('disabled', true);
		return;
	}
	var method = new Array("POST", "<?php echo site_url("admin/biz_type/json") ?>", "method=gettype&domain_id=" + bizdomainId, "json", false);
	ajaxAction(method, addToBizType);	
}

function addToBizType(data)
{
	var selecter = $("select#biz_type_id");
	var db = selecter.val();
	var biz_typeHtml;
	$.each(data,function(biz_type_id, biz_type)
	{
		 biz_typeHtml += '<option value="'+biz_type_id+'">'+biz_type+'</option>';
	});
	selecter.html(biz_typeHtml);
	selecter.find('[value="'+db+'"]').attr('selected', true);
	selecter.attr("disabled", false);
}


function getBizTypeByBizDomainForheader(Elm)
{
	var bizdomainId = $(Elm).val();
	if( !bizdomainId )
	{
		$(":input#biz_type_id_header").append(new Option("Choose biz type", "" ,"selected"));
		$('#biz_type_id_header').prop('disabled', true);
		return;
	}
	var method = new Array("POST", "<?php echo site_url("admin/biz_type/json") ?>", "method=gettype&domain_id=" + bizdomainId, "json", false);
	ajaxAction(method, addToBizTypeForheader);	
}

function addToBizTypeForheader(data)
{
	var selecter = $("select#biz_type_id_header");
	var db = selecter.val();
	var biz_typeHtml;
	$.each(data,function(biz_type_id, biz_type)
	{
		 biz_typeHtml += '<option value="'+biz_type_id+'">'+biz_type+'</option>';
	});
	selecter.html(biz_typeHtml);
	selecter.find('[value="'+db+'"]').attr('selected', true);
	selecter.attr("disabled", false);
}

function printthis()
{
 var w = window.open('', '', 'width=800,height=600,resizeable,scrollbars');
 w.document.write($("#printthis").html());
 w.document.close(); // needed for chrome and safari
 javascript:w.print();
 w.close();
 return false;
}
</script>