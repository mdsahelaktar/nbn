<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ?></title>
<meta name="viewport" content="initial-scale=1">
<?php $this->template->get_admin_css(); ?>
</head>
<body>
<?php $this->template->load_admin_shared_region('header'); ?>
<div id="dash-board_content">
<?php $this->template->load_admin_shared_region('leftpanel'); ?>		
  <div id="right-panel"> <?php echo $content?> </div>
</div>
<!--body end-->
<?php
$this->template->get_admin_js();
?>
</body>
</html>
