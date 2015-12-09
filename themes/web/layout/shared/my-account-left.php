<?php $current_user = isLoggedIn(); ?>

<div class="width220 float-left">
  <h3 class="profilehead"><?php echo _e('account_profile')?></h3>
  <ul class="profile-item">
    <li class="<?php echo $current_slug == "edit_profile" ? 'active' : '' ;?>"><a href="<?php echo site_url("user/edit_profile") ?>"><?php echo _e('edit_profile')?></a></li>
    <li class="<?php echo $current_slug == "change_password" ? 'active' : '' ;?>"><a href="<?php echo site_url("user/change_password") ?>"><?php echo _e('change_password')?></a></li>
    <li class="<?php echo $current_slug == "manage_biz_listing" ? 'active' : '' ;?>"><a href="<?php echo site_url("biz_listing/manage") ?>"><?php echo _e('manage_biz_listing')?></a></li>
    <?php if( $current_user["category_id"] == 4 ): //for broker?>
    <li class="<?php echo $current_slug == "edit_broker_profile" ? 'active' : '' ;?>"><?php echo anchor('broker/profileinfo', _e('broker_profile')) ?></li>
    <?php endif;?>
  </ul>
  <h3 class="profilehead">Need Assistance?</h3>
  <div class="float-left bg-grey width100">
    <p class="padding-left10 margin-top10">Email: <a href="mailto:service@neenbiznow.com">service@neenbiznow.com</a></p>
    <p class="padding-left10 margin-top5">Monday	 - 	Friday</p>
    <p class="padding-left10 margin-top5 padding-bottom10 brdr-bot-bold">9am to 5pm, PST</p>
  </div>
</div>
