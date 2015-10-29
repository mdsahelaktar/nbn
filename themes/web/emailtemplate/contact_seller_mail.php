<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NeedbizNow</title>
</head>
<body>
<div style="width:700px; margin:0px auto; background:#f8f8f8; ">
	<div style="width:100%; float:left; margin:0 0 0 0;  height:70px; border-top:2px solid #49b8f0">
    <div style="width:45%; padding:15px; background:#49b8f0; border-radius:0 0 10px 10px; float:left;"><img src="<?php echo site_url();?>themes/web/layout/assets/images/logo_.jpg" /></div>
		
        <div style="width:313px; float:right; margin:0px 0 0 0; font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#434343; text-decoration:none; font-weight:bold; border:0px solid red; line-height:80px;">Contact Business Seller Mail</div>
    </div>
	
    <div style="width:100%; float:left; margin:10px 0 0 0; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; text-align:left; text-decoration:none; line-height:18px; font-weight:bold; border-bottom:1px solid #49b8f0; padding:0 0 20px 0" >
    <br /><br />
    	<p>Dear, Sir. <?php echo $drname; ?></p>
		<h2> Information</h2>
        <p>Name: <?php echo $contactname; ?></p>
		<p>Email: <?php echo $email; ?></p>
        <p>Phone No: <?php echo $phone; ?>
		<p>Message: <br /><?php echo $message; ?></p>
        
    </div>
</div>

</body>
</html>