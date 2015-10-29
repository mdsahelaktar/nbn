<div id="body">
<div class="wrapper">
<div class="width100 float-left margin-bottom20 margin-top140 padding-bottom25">
<div class="float-left padding-bottom20 margin-bottom20 width100">
<div class="width100 float-left">
<div class="bg-seperator float-left width100">
  <h2 class="helvetica float-left" style="width: auto;">Create Your Business for Sale Ad</h2>
  <input type="button" value="Continue &rarr;" <?php echo $style; ?> class="float-right blue margin-left10 margin-top10" id = "<?php echo $idnamecon; ?>" name = "<?php echo $idnamecon; ?>"/>
  <input type="button" value="Preview &rarr;" <?php echo $style; ?> class="float-right orange margin-top10"  id="<?php echo $idnamepri; ?>" name="<?php echo $idnamepri; ?>"/>
</div>
<div class="float-left width100">
  <p class="font18 margin-top15" >Step <?php echo $step; ?>: Enter Account and Featured Listing Information</p>
  <p class="theme-blue margin-top10">Required fields are in Bold</p>
  <p class="margin-top10">Note: You can upload a photo for this listing once your payment is complete</p>
</div>
<div class="step-cont">
  <div class="bar">&nbsp;</div>
  <ul>
    <li> <dfn class="<?php echo isset($class1)?$class1:'normal'; ?>">1</dfn>
      <p>Create an Account or Login</p>
    </li>
    <li> <dfn class="<?php echo isset($class2)?$class2:'normal'; ?>">2</dfn>
      <p>Enter Basic Info</p>
    </li>
    <li> <dfn class="<?php echo isset($class3)?$class3:normal; ?>">3</dfn>
      <p>Add Other Listing Details (Optional) <span>You will be able to add a photo to your listing after checkout</span> </p>
    </li>
  </ul>
</div>
