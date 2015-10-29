<div id="body">
<div class="wrapper">
<div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
<div class="float-left padding-bottom20 margin-bottom20 width100">
<div class="width100 float-left">
<div class="bg-seperator float-left width100">
  <h2 class="helvetica float-left" style="width: auto;"><?php echo _e( 'create_ad' ); ?></h2>
  <input type="button" value="Continue &rarr;" <?php echo $style; ?> class="float-right blue margin-left10 margin-top10" id = "<?php echo $idnamecon; ?>" name = "<?php echo $idnamecon; ?>"/>
  <input type="button" value="Preview &rarr;" <?php echo $style; ?> class="float-right orange margin-top10"  id="<?php echo $idnamepri; ?>" name="<?php echo $idnamepri; ?>"/>
</div>
<div class="float-left width100">
  <p class="font18 margin-top15" ><?php echo _e( 'step' ); ?> <?php echo $step; ?>: <?php echo _e( 'ac' ); ?></p>
  <p class="theme-blue margin-top10"><?php echo _e( 'requ' ); ?></p>
  <p class="margin-top10"><?php echo _e( 'note' ); ?></p>
</div>
<div class="step-cont">
  <div class="bar">&nbsp;</div>
  <ul>
    <li> <dfn class="<?php echo isset($class1)?$class1:'normal'; ?>">1</dfn>
      <p><?php echo _e( 'login_ac' ); ?></p>
    </li>
    <li> <dfn class="<?php echo isset($class2)?$class2:'normal'; ?>">2</dfn>
      <p><?php echo _e( 'basic_info' ); ?></p>
    </li>
    <li> <dfn class="<?php echo isset($class3)?$class3:normal; ?>">3</dfn>
      <p><?php echo _e( 'opt' ); ?> <span><?php echo _e( 'checkout' ); ?></span> </p>
    </li>
  </ul>
</div>
