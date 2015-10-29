<div style="width: 320px; margin: 0 auto;">
  <div class="wrap">
    <div class="header width96">
      <div class="logo">
        <h1><a title="Logo" href="<?php echo site_url() ?>">Need Biz Now</a></h1>
      </div>
      <div class="menudiv">
         <ul id="menu">
            <li> <?php echo anchor( '', _e( 'Buy a Business' ), array( 'title' => _e( 'Buy a Business' ) ) )?> </li>
            <li>  <?php echo anchor( 'biz_listing/commingsoon', _e( 'Buy a Franchise' ), array( 'title' => _e( 'Buy a Franchise' ) ) )?> </li>
            <li> <?php echo anchor( 'biz_listing/', _e( 'Sell a Business' ), array( 'title' => _e( 'Sell a Business' ) ) )?> </li>
            <li> <?php echo anchor( 'broker', _e( 'Find a Broker' ), array( 'title' => _e( 'Find a Broker' ) ) )?></li>
            <li> <?php echo anchor( 'user?ct=8&rl=1', _e( 'Sign Up' ), array( 'title' => _e( 'Sign Up' ) ) )?></li>
            
		 </ul>
      </div>
      <div class="width100 float-left margin-top5">
      
      <?php echo form_open( 'biz_listing/search', array( 'name' => 'search_form', 'id' => 'search_form', 'method' => 'post', 'class'=>'search float-left margin-top10') )?>
        <input id="cklsearch" name="cklsearch" placeholder="Search Business" type="text" value="<?php echo $cklsearch; ?>"/>
        <input class="search" name="submit" type="submit" value="" />
        <?php echo form_close()?>
        
         <?php if( isLoggedIn() ) : ?>
         <div id="loggedin_cont" class="login"><a href="#" onclick="logOut(afterLogOut)" target="_self"?><?php echo _e('Logout')?></a></div>
        <?php else :?>
        <div class="login"><?php echo anchor('login/', _e('Login'))?></div>
        <?php endif ;?>
      </div>
    </div>
    
    <?php
$login_js = $this->template->admin_view( 'login_js_function', '', true, "login");
$this->template->embed_asset_code('frontend', 'js', 'login_js_function', $login_js);
?>