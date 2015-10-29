<h2><?php echo $title ?></h2>
<?php ### Display Message Begin ### ?>
<div class="clear"></div>
<?php echo form_label( '<p>'._e( 'User Name [Auto Suggest]' ).'</p>', 'user_name' )?> <?php echo form_input(array('name' => 'user_name', 'id' => 'user_name' ));
?>
<div class="clear"></div>