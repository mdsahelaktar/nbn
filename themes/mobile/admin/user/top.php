<h2><?php echo $title ?></h2>
<?php ### Display Message Begin ### ?>
<?php echo renderResposeMessage('user_list', $response) ?>
<?php ### Display Message End ### ?>
<div class="addeditcont float-right"><?php echo anchor( 'admin/user/add', '<span class="ion-android-add"></span>'._e( 'add' ), array( 'title' => _e( 'add_users' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left' ) )?> <?php echo anchor( 'admin/user/edit', '<span class="ion-compose"></span>'._e( 'edit' ), array( 'title' => _e( 'edit_users' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left' ) )?></div>
<div class="clear"></div>