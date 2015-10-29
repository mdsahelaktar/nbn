<h2><?php echo $title ?></h2>
<?php ### Display Message Begin ### ?>
<?php echo renderResposeMessage('default_permission', $response) ?>
<?php ### Display Message End ### ?>
<div class="addeditcont float-right"><?php echo anchor( 'admin/default_permission/add', '<span class="ion-android-add"></span>'._e( 'Add' ), array( 'title' => _e( 'Add Default Permission' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left' ) )?> <?php echo anchor( 'admin/default_permission/edit', '<span class="ion-compose"></span>'._e( 'Edit' ), array( 'title' => _e( 'Edit Default Permission' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left' ) )?></div>
<div class="clear"></div>