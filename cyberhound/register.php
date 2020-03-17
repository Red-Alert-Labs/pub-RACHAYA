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
<title>Register - CyberHound</title>
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
<h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Please Sign Up</span></h6>
</div>
<div class="card-content">
<div class="card-body">
<!-- User Registration Form -->
<form class="form-horizontal" action="" method="post" novalidate>

<fieldset class="form-group position-relative has-icon-left">
<input type="text" name="fullname" id="display_name" class="form-control" placeholder="Full Name" tabindex="3" required data-validation-required-message="Please enter display name.">
<div class="form-control-position">
<i class="ft-user"></i>
</div>
<div class="help-block font-small-3"></div>
</fieldset>
<fieldset class="form-group position-relative has-icon-left">
<input type="email" name="email" id="email" class="form-control" placeholder="Email Address" tabindex="4" required data-validation-required-message="Please enter email address.">
<div class="form-control-position">
<i class="ft-mail"></i>
</div>
<div class="help-block font-small-3"></div>
</fieldset>
<fieldset class="form-group position-relative has-icon-left">
<input type="number" name="phone" id="phone" class="form-control" placeholder="Phone Number" tabindex="4" required data-validation-required-message="Please enter Phone Number.">
<div class="form-control-position">
<i class="ft-phone"></i>
</div>
<div class="help-block font-small-3"></div>
</fieldset>
<fieldset class="form-group position-relative has-icon-left">
<input type="text" name="username" id="username" class="form-control" placeholder="Username" tabindex="4" required data-validation-required-message="Please enter username.">
<div class="form-control-position">
<i class="ft-mail"></i>
</div>
<div class="help-block font-small-3"></div>
</fieldset>
<div class="row">
<div class="col-12 col-sm-6 col-md-6">
<fieldset class="form-group position-relative has-icon-left">
<input type="password" name="password" id="password" class="form-control" placeholder="Password" tabindex="5" required onkeyup="return passwordChanged();">
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
<div class="col-12 col-sm-6 col-md-6">
<button type="submit" class="btn btn-info btn-lg btn-block" name='reg'><i class="ft-user"></i> Register</button>
</div>
<div class="col-12 col-sm-6 col-md-6">
<a onclick="window.location.replace('http://localhost/cyberhound/index.php');" class="btn btn-danger btn-lg btn-block"><i class="ft-unlock"></i> Login</a>
</div>
</div>
</form>
<?php
if(isset($_POST['reg'])){
$fullname = $_POST['fullname'];
$email    = $_POST['email'];
$phone    = $_POST['phone'];
$username = $_POST['username'];
$uppercase = preg_match('@[A-Z]@', $_POST['password']);
$lowercase = preg_match('@[a-z]@', $_POST['password']);
$number    = preg_match('@[0-9]@', $_POST['password']);
$specialChars = preg_match('@[^\w]@', $_POST['password']);
$password = sha1($_POST['password']);
if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
?><script>alert('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.');</script><?php
}else{
$check    = mysql_num_rows(mysql_query("SELECT id FROM uaccess WHERE username='$username'")); //checking if entered username already exists!
if($check==1){ 
?><script>alert('Username already exists!');</script><?php //alerting user if the username already exists.
}else{
//Inserting new user into the db
if($createuser = mysql_query("INSERT INTO `uaccess`(`username`, `password`, `fullname`, `emailaddress`, `contactnumber`)
VALUES ('$username','$password','$fullname','$email','$phone')")){
session_start(); //starting session
$getuid = mysql_fetch_array(mysql_query("SELECT id FROM uaccess WHERE username='$username'"));
$uid    = $getuid['id'];
$_SESSION['uid']=$uid; //setting session variable for user
?><script>window.location.replace('http://localhost/cyberhound/');</script><?php //redirecting to home page
}else{
?><script>alert('Something went wrong! Try again later');</script><?php //alerting user if db/ query not executable
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
<script language="javascript">
function passwordChanged() {
var strength = document.getElementById(‘strength’);
var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
var enoughRegex = new RegExp("(?=.{6,}).*", "g");
var pwd = document.getElementById("password");
if (pwd.value.length==0) {
strength.innerHTML = ‘Type Password’;
} else if (false == enoughRegex.test(pwd.value)) {
strength.innerHTML = ‘More Characters’;
} else if (strongRegex.test(pwd.value)) {
strength.innerHTML = ‘<span style="color:green">Strong!</span>’;
} else if (mediumRegex.test(pwd.value)) {
strength.innerHTML = ‘<span style="color:orange">Medium!</span>’;
} else { 
strength.innerHTML = ‘<span style="color:red">Weak!</span>’;
}
}
</script>
</body>
<!-- END: Body-->
<?php
} ?>
</html>
