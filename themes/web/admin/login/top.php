<div id="login-head-cont">
  <div id="login-head-wrapper">
    <div id="login-form">
      <h1><?php echo anchor( 'admin', _e( 'Admin Home' ), array( 'title' => _e( 'Admin Home' ) ) )?></h1>
      <div class="login-form"> 
        <?php ### Display Message Begin ### ?>
<?php echo renderResposeMessage('login', $response) ?>
        <?php ### Display Message End ### ?>