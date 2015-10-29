<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ?></title>
<meta name="viewport" content="initial-scale=1">
<?php $this->template->get_frontend_css(); ?>
</head>
<body>
<div id="maindiv">
  <?php $this->template->load_frontend_shared_region('header'); ?>
  <?php echo $content?> 
  <!--body end-->
  <?php $this->template->load_frontend_shared_region('footer'); ?>
</div>
<?php $this->template->get_admin_js(); ?>
<?php $this->template->get_frontend_js(); ?>
</body>
</html>