<script type="application/javascript">
var $lang_form = $( "#lang_form" );
function lanselect()
{
	var method = new Array("POST", "<?php echo site_url("admin/language/ajax") ?>", "method=langedit&" + $lang_form.serialize(), "json", false);
	ajaxAction(method, languageAfterAction);
	return false;
}

function languageAfterAction(data)
{
	$("#showsearch").html(data.data);
	if(data.lang == 'english')
		$('.editrevert0').remove();
	showMsg('div[msg="sent_respons"]', data.event, data.msg, '', true);
	return false;
}	

function languageEdit(elm,file,key,lan,domain)
{
	var lan_val = $(elm).attr("languagekey");
	var dialog_html = '';
	dialog_html += '<dt><label for="permission_parent_id"><strong>Edit Language:-</strong></label><textarea rows="3" cols="32" id="langchng" name="langchng" style="background:#728ca3;">'+lan_val+' </textarea></dt>';
	dialog_html = '<dl>'+dialog_html+'</dl>';
	var dialog = $('<div id="dia" style="display:none" title="<?php echo _e('Language Modify')?>"><?php renderResposeMessage('Language') ?><form name="permission_modify" id="permission_modify" onsubmit="return save_content_to_file('+file+')"><input type="hidden" name="user_map_id"></div></form>').appendTo('body');
	
	dialog.dialog({
		open: function ()
		{
			$(this).find('form').append(dialog_html);
		},
		close: function(event, ui) {
			dialog.remove();
		},
		modal: true,
		height: 'auto',
		buttons: {
          '<?php echo _e('Modify')?>': function() {
			  save_content_to_file(file,key,lan,domain);
          }
		  ,
         '<?php echo _e('Cancel')?>': function() {
            $(this).dialog('close');
         }
       }
	});
	
}


function save_content_to_file(filename,key,lan,domain)
{
	var containt = $( "#langchng" ).val();
    var method = new Array("POST", "<?php echo site_url("admin/language/ajax") ?>", "method=change&" + "&content=" +containt+ '&' +"&filename=" +filename+ '&' +"&key=" +key+ '&' +"&lan=" +lan+ '&' +"&domain=" +domain, "json", false);
	ajaxAction(method, languageAfterEdit);
	return false;
}

function languageAfterEdit(data)
{
$("#dia").remove();
	lanselect();
	return false;
}



/*delete*/
function languageDelete(elm,filename,key,lan,domain)
{
	 var id = $(elm).attr("id");
	if (confirm("Confirm delete this language") == true) 
		{	
		var containt = '';
		var method = new Array("POST", "<?php echo site_url("admin/language/ajax") ?>", "method=delete&" + "content=" +containt+ '&' +"&filename=" +filename+ '&' +"&key=" +key+ '&' +"&lan=" +lan+ '&' +"&domain=" +domain+ '&' +"&id=" +id, "json", false);
		ajaxAction(method, languageAfterDelete);
		return false;
		}
}


function languageAfterDelete(data)
{
	lanselect();
	return false;
}

/*delete*/

function getLanguage()
{
	 $("#language").removeAttr("disabled");
}

function showButton(data)
{
	$("#buttondiv").css("display", "block");
}

function addLanguage()
{
	var method = new Array("POST", "<?php echo site_url("admin/language/ajax") ?>", "method=langadd", "json", false);
	ajaxAction(method, languageAfterAdd);
	return false;
}

function languageAfterAdd(data)
{
	$("#showsearch").html(data.data);
	showMsg('div[msg="sent_respons"]', data.event, data.msg, '', true);
	return false;
}

function addLanguageFormVal()
{
	var containt = $( "#language_val" ).val();
    var method = new Array("POST", "<?php echo site_url("admin/language/ajax") ?>", "method=add_language_key&" + "content=" +containt+ '&' + $lang_form.serialize(), "json", false);
	ajaxAction(method, languageAfterAction);
	return false;
}
</script>


