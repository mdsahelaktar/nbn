<script type="application/javascript">
var $form =  $( "#<?php echo isset($edit_id) ? 'user_edit_form' : 'user_add_form'?>" );
$form.validate( afterValidCheck );
</script>