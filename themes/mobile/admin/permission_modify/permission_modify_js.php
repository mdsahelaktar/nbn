<script type="application/javascript">
function afterSelect(event, ui)
{
	var user_id = ui.item ? ui.item.id : 0;
	if(user_id > 0)
	{
		$('input[name="user_id"]').val(user_id);	
		getUserAllRoles(user_id,userRolesCallBack);
	}
	else
		$('input[name="user_id"]').val('');
}
$(document).ready(function(){
	<?php
	if($this->router->fetch_method() == 'add'):
	?>	
	autoSuggestUser('#user_name',afterSelect);	
	if(	$('input[name="user_id"]').val() )
	{
		getUserAllRoles($('input[name="user_id"]').val(), userRolesCallBack);
	}
	<?php 
	endif;
	?>
});
</script>