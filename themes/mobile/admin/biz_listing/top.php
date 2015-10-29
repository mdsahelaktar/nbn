<h2><?php echo $title ?></h2>
<?php ### Display Message Begin ### ?>
<?php echo renderResposeMessage('biz_listing', $response) ?>
<?php ### Display Message End ### ?>
<?php echo anchor( 'admin/biz_listing/add', '<span class="ion-android-add"></span>'._e( 'Add' ), array( 'title' => _e( 'Add Biz Listings' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left' ) )?> <?php echo anchor( 'admin/biz_listing/edit', '<span class="ion-compose"></span>'._e( 'Edit' ), array( 'title' => _e( 'Edit Biz Listings' ), 'class' => 'btn-type1 margin-right10 margin-top10 float-left' ) )?>
<div class="clear"></div>