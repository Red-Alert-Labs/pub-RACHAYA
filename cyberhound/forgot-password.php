<!DOCTYPE html>
/*
* Copyright (c) 2019 Red Alert Labs S.A.S.
* All Rights Reserved.
*
* This software is the confidential and proprietary information of
* Red Alert Labs S.A.S. (Confidential Information). You shall not
* disclose such Confidential Information and shall use it only in
* accordance with the terms of the license agreement you entered
* into with Red Alert Labs S.A.S.
*
* RED ALERT LABS S.A.S. MAKES NO REPRESENTATIONS OR WARRANTIES ABOUT THE
* SUITABILITY OF THE SOFTWARE, EITHER EXPRESS OR IMPLIED, INCLUDING
* BUT NOT LIMITED TO THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS
* FOR A PARTICULAR PURPOSE, OR NON-INFRINGEMENT. RED ALERT LABS S.A.S. SHALL
* NOT BE LIABLE FOR ANY DAMAGES SUFFERED BY LICENSEE AS A RESULT OF USING,
* MODIFYING OR DISTRIBUTING THIS SOFTWARE OR ITS DERIVATIVES.
*/
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<?php
//Including DB Connection File
include "connect.php";
//Checking if Session has started or logs out dashboard
if(isset($_SESSION['uid'])){
header('Location:dashboard.php');
}else{
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<title>Forgot Password - CyberHound</title>
<link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
<link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
<link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/custom.css">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
<link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
<link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
<!-- END: Theme CSS-->

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
<link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="app-assets/css/pages/login-register.css">
<!-- END: Page CSS-->

<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column  bg-cyan bg-lighten-2 fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">

<!-- BEGIN: Content-->
<div class="app-content content">
<div class="content-wrapper">
<div class="content-header row mb-1">
</div>
<div class="content-body">
<section class="flexbox-container">
<div class="col-12 d-flex align-items-center justify-content-center">
<div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
<div class="card border-grey border-lighten-3 m-0">
<div class="card-header border-0 pb-0">
<div class="card-title text-center">
<img src="app-assets/images/logo/logo-dark.png" alt="branding logo">
</div>
<h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Forgot Password</span></h6>
</div>
<div class="card-content">
<div class="card-body">
<?php
//Checking URL variables from password reset link from user mail
if(isset($_GET['m']) AND isset($_GET['t'])){
$mail   =   $_GET['m'];
?>
<form class='form-horizontal' action='' method='post' novalidate>
<div class="row">
<div class="col-12 col-sm-6 col-md-6">
<fieldset class="form-group position-relative has-icon-left">
<input type="password" name="password" id="password" class="form-control" placeholder="New Password" tabindex="5" required>
<div class="form-control-position">
<i class="la la-key"></i>
</div>
<div class="help-block font-small-3"></div>
</fieldset>
</div>
<div class="col-12 col-sm-6 col-md-6">
<fieldset class="form-group position-relative has-icon-left">
<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" tabindex="6" data-validation-matches-match="password" data-validation-matches-message="Password & Confirm Password must be the same.">
<div class="form-control-position">
<i class="la la-key"></i>
</div>
<div class="help-block font-small-3"></div>
</fieldset>
</div>
</div>
<div class="row">
<div class="col-12 col-sm-12 col-md-12">
<button type="submit" class="btn btn-info btn-lg btn-block" name='resett'>Reset Password</button>
</div>
</form>
<?php
if(isset($_POST['resett'])){
$password   =   sha1($_POST['password']); //Encrypting Password using SHA1
if($upd =   mysql_query("UPDATE uaccess SET password='$password' WHERE emailaddress='$mail'")){ //Updating new password
echo "<br><p>Password Updated Successfully!";
?>
<a href='http://localhost/cyberhound/'>Click Here</a> to login.
<?php
}else{
echo "<br><p>Something went wrong! Try again later.</p>";
}
}
}else{
?>
<form class="form-horizontal" action="" method="post" novalidate>
<fieldset class="form-group position-relative has-icon-left">
<input type="email" name="email" id="email" class="form-control" placeholder="Email Address" tabindex="4" required data-validation-required-message="Please enter email address.">
<div class="form-control-position">
<i class="ft-mail"></i>
</div>
<div class="help-block font-small-3"></div>
</fieldset>
<div class="row">
<div class="col-12 col-sm-12 col-md-12">
<button type="submit" class="btn btn-info btn-lg btn-block" name='reset'><i class="ft-user"></i> Send Password Reset Link</button>
</div>
</div>
</form>
<?php
//Password reset request
if(isset($_POST['reset'])){
$email  =   $_POST['email'];
$check  =   mysql_fetch_array(mysql_query("SELECT id FROM uaccess WHERE emailaddress='$email'"));
if(empty($check['id'])){ //Checking if user entered mail address is found in the db 
    ?><Br><p>We cannot find the given email address with us. Would you like to <a href='register.php'>create</a> a new account?</p><?php
}else{
// sending registered use password reset link with timestamp for link time validation
 $to = $email;
 $timestamp =   time();
$subject = "Password Reset | Cyber Hound";
$message = "
<html>
<body>
<p>Hello User!<br>You <a href='http://localhost/cyberhound/forgot-password.php?m=".$email."&t=".$timestamp."'>
click here</a> to reset your password or open the following link in a new window.<br>
http://localhost/cyberhound/forgot-password.php?m=".$email."&t=".$timestamp."<br>
The link in this mail will only be active for a couple of hours.<Br><br>Thanks,<Br>Cyber Hound. </p>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <support@cyberhound.com>' . "\r\n";

if(mail($to,$subject,$message,$headers)){
   ?><br><p>A password reset link has been sent to your mail address.</p> <?php
}
}
}
}
?>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
</div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>


<!-- BEGIN: Vendor JS-->
<script src="app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
<script src="app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="app-assets/js/core/app-menu.js"></script>
<script src="app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="app-assets/js/scripts/forms/form-login-register.js"></script>
<!-- END: Page JS-->

</body>
<!-- END: Body-->
<?php
} ?>
</html>
