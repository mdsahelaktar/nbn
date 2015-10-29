<h2><?php echo $title ?></h2>
<?php ### Display Message Begin ### ?>
<?php echo renderResposeMessage('user_list', $response) ?>
<?php ### Display Message End ### ?>
<?php echo anchor( 'admin/user/add', '<span class="ion-android-add"></span>'._e( 'Add' ), array( 'title' => _e( 'Add Users' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left' ) )?> <?php echo anchor( 'admin/user/edit', '<span class="ion-compose"></span>'._e( 'Edit' ), array( 'title' => _e( 'Edit Users' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left' ) )?>
<div class="clear"></div>