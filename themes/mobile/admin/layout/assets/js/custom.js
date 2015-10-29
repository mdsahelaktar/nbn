/*$(function(){
    jQuery.fn.center = function ()
    {
        this.css("position","fixed");
        this.css("top", ($(window).height() / 2) - (this.outerHeight() / 2));
        this.css("left", ($(window).width() / 2) - (this.outerWidth() / 2));
        return this;
    }       
});*/
$(document).ready(function(){
	<!--Overlay-->
	$('body').append('<div class="loader hide"></div><div class="overlay hide"></div>');
	<!--Delete Confirmation-->
	$('.editrevert0').click(function(){
		if(confirm(deleteconformstring))
			return true;
		else	
			return false;					
	});
	<!--Jquery ui Tooltip-->
	if (typeof jQuery.ui != 'undefined') 
 		$( document ).tooltip();

});

function ajaxAction(allvar, callback, rtn)
{	
	$.ajax({
		type : allvar[0],
		url : allvar[1],
		data : allvar[2],
		dataType : allvar[3],
		async : allvar[4],
		beforeSend : function()
		{			
			if(typeof allvar[5] == 'undefined'){				
				$('.overlay').removeClass('hide');
				$('.loader').removeClass('hide').addClass('ion-loading-a siteblue');
			}
			else{				
				allvar[5]();
			}
		},
		success : function(msg)
		{
			if(typeof msg.event !="undefined" && msg.event == "no-authentication")
			{
				alert("You have logged out now");
				window.location = msg.redirect;
			}
			else
			{
				if(!rtn)
					callback(msg);
				else
					rtn = msg;	
			}
				
		},
		error : function(jqXHR, textStatus, errorThrown)
		{
			var errormsg = (textStatus == 'error' ? jqXHR.status : textStatus) + (":" + errorThrown);
			alert(errormsg);
		},
		complete : function()
		{
			if(typeof allvar[6] == 'undefined'){
				$('.overlay').addClass('hide');
				$('.loader').addClass('hide').removeClass('ion-loading-a siteblue');
			}
			else{
				allvar[6]();
			}
		}
	})
	return rtn;
}

//#### Ajax iframe ####//
function iframeAjax(form, action_url, custom_function) 
{
	// Create the iframe...
	var iframe = document.createElement("iframe");
	iframe.setAttribute("id", "upload_iframe");
	iframe.setAttribute("name", "upload_iframe");
	iframe.setAttribute("width", "0");
	iframe.setAttribute("height", "0");
	iframe.setAttribute("border", "0");
 
	// Add to document...
	form.parentNode.appendChild(iframe);
	window.frames['upload_iframe'].name = "upload_iframe";
 
	iframeId = document.getElementById("upload_iframe");
	// Add event...
	var eventHandler = function () {
			if (iframeId.detachEvent) iframeId.detachEvent("onload", eventHandler);
			else iframeId.removeEventListener("load", eventHandler, false);
 
			// Message from server...
			if (iframeId.contentDocument) {
				content = iframeId.contentDocument.body.innerHTML;
			} else if (iframeId.contentWindow) {
				content = iframeId.contentWindow.document.body.innerHTML;
			} else if (iframeId.document) {
				content = iframeId.document.body.innerHTML;
			}
			custom_function(content);
			// Del the iframe...
			setTimeout('iframeId.parentNode.removeChild(iframeId)', 250);
		}
 
	if (iframeId.addEventListener) iframeId.addEventListener("load", eventHandler, true);
	if (iframeId.attachEvent) iframeId.attachEvent("onload", eventHandler);
 
	// Set properties of form...
	form.setAttribute("target", "upload_iframe");
	form.setAttribute("action", action_url);
	form.setAttribute("method", "post");
	form.setAttribute("enctype", "multipart/form-data");
	form.setAttribute("encoding", "multipart/form-data");
 
	// Submit the form...
	form.submit();
}

function showMsg(parentElm, msgclass, msg, fade, focusthere)
{
	var vice_versa = {'success':'error', 'error':'success'};
	$(parentElm).find('.'+vice_versa[msgclass]).hide();
	if(focusthere)
		$('html, body').animate({ scrollTop: $(parentElm).offset().top }, 'slow');
	if($(parentElm).find('.'+msgclass).length > 0)
		$(parentElm).find('.'+msgclass).show().html(msg);
	else
		$(parentElm).append('<div class="'+msgclass+'">'+msg+'</div>');
	if(fade)
		$(parentElm).find('.'+msgclass).fadeOut(fade);
}

function selectAll(elm)
{
	$(elm).closest( "form" ).find('input[type="checkbox"][name="row_id[]"]').prop("checked",true);
	return false;
}

function unselectAll(elm)
{
	$(elm).closest( "form" ).find('input[type="checkbox"][name="row_id[]"]').prop("checked",false);
	return false;
}

function appendQMInUrl(url)
{
	return url = url.indexOf("?") == -1 ? url + '?' : url;
}
function goFilter(elm)
{
	var filter = $(elm).closest( "form" ).find("#filter_section :input").serialize();
	window.location.href = '?' + filter;
}

function goAction(elm)
{
	var selecterform = $(elm).closest( "form" );
	var action = selecterform.find('#multiple_action_section select[name="action"]').val();
	var row_ids = selecterform.find('input[type="checkbox"][name="row_id[]"]:checked');
	var location_url = appendQMInUrl(document.URL);
	if( action != '' && row_ids.length > 0)
	{
		switch(action)
		{
			case 'delete' : 
				if(confirm(deleteconformstring))
					location_url += '&' + row_ids.serialize()+'&action='+action;
				else
					return false;	
				break;
			case 'permanent_delete' :
				if(confirm(pdeleteconformstring))
					location_url += '&' + row_ids.serialize()+'&action='+action;
				else
					return false;
				break;
			default :
				location_url += '&' + row_ids.serialize()+'&action='+action; 			
		}
		window.location.href = location_url;		
	}
}

function checkUncheck(elm, childs)
{
	if($(elm).is(':checked'))
		$(childs).prop("checked",true);
	else
		$(childs).prop("checked",false);
}

function addMoreElement(cloneFrom, removeButtonAppendTo, cloneWrapperBegin, cloneWrapperEnd, beforeThis)
{
	var first_elm = $(cloneFrom+" :nth-child(1)");	
	var clone = $(first_elm).clone();
	$(clone).find(removeButtonAppendTo).prepend('<a href="#" onclick="return removeThisChild(this)" class="remove">X</a>').find('.error-field').removeClass('error-field');
	$(clone).find('.error-span').remove();
	var first_child = $(clone).html();
	var first_child = cloneWrapperBegin+first_child+cloneWrapperEnd;
	$(beforeThis).before(first_child);
	return false;
}

function removeThisChild(elm)
{
	$(elm).parent().parent().remove();
	return false;
}

////////////////////// for coocke select country in header/////////////////////
$(document).ready(function(e)
{
	var name = "country=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++)
	  {
		 var c = ca[i].trim();
		 if (c.indexOf(name)==0) $('#country_id_for_home').val(c.substring(name.length,c.length));
	  }
});

//Setting Cookie
$('#country_id_for_home').change(function(e)
{
    var cookieVal = "country="+$(this).val();
	document.cookie = cookieVal ;
	location.reload();
});

$('#province_id').change(function(e)
{
    var cookieVal = "province="+$(this).val();
	document.cookie = cookieVal ;
});
// delete cookie
function deleteAllCookies() 
{
    var cookies = document.cookie.split(";");
    for (var i = 0; i < cookies.length; i++) {
    	var cookie = cookies[i];
    	var eqPos = cookie.indexOf("=");
    	var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
    	document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
		location.reload();
    }
}


