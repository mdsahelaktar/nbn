<!--header start-->
<div id="dash-board_header">
  <div id="dash-board_header_wrapper">
    <div id="dash-board_header_logo-cont">
      <h1><a href="#" target="_self" title="admin home">NeedBizNow Admin</a></h1>
    </div>
    <?php if( isLoggedIn() ) : ?>
    <div id="loggedin_cont">Logged in as : <strong>Admin</strong> | <a href="#" onclick="logOut(afterLogOut)" target="_self"?><?php echo _e('Log Out')?></a></div>
    <?php else :?>
    <div id="loggedin_cont"><?php echo anchor('admin/login/', _e('Log In'))?></div>
    <?php endif ;?>
  </div>
</div>
<!--header end-->
<?php
$login_js = $this->load->view("web/admin/login/login_js_function.php", '', true);
$this->template->embed_asset_code('admin', 'js', 'login_js_function', $login_js);
?>