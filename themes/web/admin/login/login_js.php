<script type="application/javascript">
var $form =  $( "#login_form" );
function afterValidCheck($this, errors, event)
{
	if (errors.length == 0)
		logIn($form, afterLogIn);
	return false;			
}

$form.validate( afterValidCheck );
</script>