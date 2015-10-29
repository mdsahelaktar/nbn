<!--left panel start-->
<div id="left-panel">
  <div class="applemenu">
    <ul>
      <li class="silverheader"><?php echo anchor( 'admin/user', '<span class="ion-android-social-user"></span>'._e( 'User Settings' ), array( 'title' => _e( 'User Settings' ) ) )?>
        <ul class="submenu">
          <?php if( hasAccess( 1 ) ) : ?>
          <li><?php echo anchor( 'admin/user_category/add', _e( 'User Categories' ), array( 'title' => _e( 'User Categories' ) ) )?></li>
          <?php endif;?>
          <?php if( hasAccess( 6 ) ) : ?>
          <li><?php echo anchor( 'admin/user_role/add', _e( 'User Roles' ), array( 'title' => _e( 'User Roles' ) ) )?></li>
          <?php endif;?>
          <?php if( hasAccess( 11 ) ) : ?>
          <li><?php echo anchor( 'admin/user_map/add', _e( 'User Mapping C&R' ), array( 'title' => _e( 'User Mapping C&R' ) ) )?></li>
          <?php endif;?>
          <?php if( hasAccess( 19 ) ) : ?>
          <li><?php echo anchor( 'admin/user/add', _e( 'Users' ), array( 'title' => _e( 'Users' ) ) )?></li>
          <?php endif;?>
        </ul>
      </li>
      <li class="silverheader"><?php echo anchor( 'admin/permission', '<span class="ion-android-hand"></span>'._e( 'Permission Settings' ), array( 'title' => _e( 'Permission Settings' ) ) )?>
        <ul class="submenu">
          <?php if( hasAccess( 27 ) ) : ?>
          <li><?php echo anchor( 'admin/permission_group/add', _e( 'Permission Group' ), array( 'title' => _e( 'Permission Group' ) ) )?></li>
          <?php endif;?>
          <?php if( hasAccess( 31 ) ) : ?>
          <li><?php echo anchor( 'admin/permission/add', _e( 'Permission' ), array( 'title' => _e( 'Permission' ) ) )?></li>
          <?php endif;?>
          <?php if( hasAccess( 36 ) ) : ?>
          <li><?php echo anchor( 'admin/default_permission/add', _e( 'Default Permission' ), array( 'title' => _e( 'Default Permission' ) ) )?></li>
          <?php endif;?>
          <?php if( hasAccess( 41 ) ) : ?>
          <li><?php echo anchor( 'admin/permission_modify/add', _e( 'Permission Modify' ), array( 'title' => _e( 'Permission Modify' ) ) )?></li>
          <?php endif;?>
        </ul>
      </li>
      <li class="silverheader"><?php echo anchor( 'admin/theme', '<span class="ion-android-settings"></span>'._e( 'Theme & Language' ), array( 'title' => _e( 'Theme & Language' ) ) )?>
        <ul class="submenu">
          <?php if( hasAccess( 44 ) ) : ?>
          <li><?php echo anchor( 'admin/theme/add', _e( 'Themes' ), array( 'title' => _e( 'Themes' ) ) )?></li>
          <?php endif;?>
          <?php if( hasAccess( 49 ) ) : ?>
          <li><?php echo anchor( 'admin/language/add', _e( 'Languages' ), array( 'title' => _e( 'Languages' ) ) )?></li>
          <?php endif;?>
        </ul>
      </li>
      <li class="silverheader"><?php echo anchor( 'admin/biz_listing', '<span class="ion-ios7-people"></span>'._e( 'Listing' ), array( 'title' => _e( 'Listing' ) ) )?>
        <ul class="submenu">
          <?php if( hasAccess( 56 ) ) : ?>
          <li><?php echo anchor( 'admin/biz_listing/add', _e( 'Biz listing' ), array( 'title' => _e( 'Biz listing' ) ) )?></li>
          <?php endif;?>          
        </ul>
      </li>
      
      <li class="silverheader"><?php echo anchor( 'admin/miscellaneous', '<span class="ion-android-data"></span>'._e( 'Miscellaneous' ), array( 'title' => _e( 'Miscellaneous' ) ) )?>
        <ul class="submenu">
          <?php if( hasAccess( 57 ) ) : ?>
          <li><?php echo anchor( 'admin/context/add', _e( 'Context' ), array( 'title' => _e( 'Context' ) ) )?></li>
          <li><?php echo anchor( 'admin/image/add', _e( 'Image' ), array( 'title' => _e( 'Image' ) ) )?></li>
          <?php endif;?>          
        </ul>
      </li>
    </ul>
  </div>
</div>
<!--left panel end-->