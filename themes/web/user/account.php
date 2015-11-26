<div id="body">
  <div class="wrapper">
    <div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
      <div class="width220 float-left">
        <h3 class="profilehead"><?php echo _e('account_profile')?></h3>
        <ul class="profile-item">
          <li class="<?php echo $current_prfile_section == "edit_profile" ? 'active' : '' ;?>"><a href="<?php echo site_url("user/edit_profile") ?>"><?php echo _e('edit_profile')?></a></li>
          <li class="<?php echo $current_prfile_section == "change_password" ? 'active' : '' ;?>"><a href="<?php echo site_url("user/change_password") ?>"><?php echo _e('change_password')?></a></li>
        </ul>
        <h3 class="profilehead">Need Assistance?</h3>
        <div class="float-left bg-grey width100">
          <p class="padding-left10 margin-top10">Email: <a href="mailto:service@neenbiznow.com">service@neenbiznow.com</a></p>
          <p class="padding-left10 margin-top5">Monday	 - 	Friday</p>
          <p class="padding-left10 margin-top5 padding-bottom10 brdr-bot-bold">9am to 5pm, PST</p>
        </div>
      </div>
      <div class="profile-steps">
        <h2 class="helvetica bg-seperator padding-bottom20 float-left">Welcome to Needbiznow
          <p class="font14 light-black margin-top10">We're glad to have you as part of our businesss for sale community. Here are three easy steps to get started:</p>
        </h2>
        <div msg="user"></div>
        <?php echo $current_profile_section_html; ?>
      </div>
    </div>
  </div>
</div>
<!--body end-->
<?php
$user_js_function = $this->load->view("web/admin/user/user_js_function.php", '', true);
$this->template->embed_asset_code('frontend', 'js', 'user_js_function', $user_js_function);
    
$user_js = $this->template->frontend_view('user_js', '', true, "user");
$this->template->embed_asset_code('frontend', 'js', 'user_js', $user_js); 
