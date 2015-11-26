<script type="application/javascript">
var $form = $( "#<?php echo isset($current_slug) ? $current_slug.'_form' : 'user_add_form'?>" );
$form.validate( afterValidCheck );
</script>