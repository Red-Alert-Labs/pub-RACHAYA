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
<title>CyberHound</title>
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

<body class="vertical-layout vertical-menu-modern 1-column  bg-cyan bg-lighten-2 fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="1-column" style='background:#eaeaea;'>

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
<div class="card-header border-0">
<div class="card-title text-center">
<img src="app-assets/images/logo/logo-dark.png" alt="branding logo">
</div>
</div>
<div class="card-content">
<div class="card-body">
<form class="form-horizontal" action="" method="post">
<fieldset class="form-group position-relative has-icon-left">
<input type="text" class="form-control input-lg" id="user-name" placeholder="Your Username" name='username' tabindex="1" required data-validation-required-message="Please enter your username.">
<div class="form-control-position">
<i class="ft-user"></i>
</div>
<div class="help-block font-small-3"></div>
</fieldset>
<fieldset class="form-group position-relative has-icon-left">
<input type="password" class="form-control input-lg" id="password" placeholder="Enter Password" name='password' tabindex="2" required data-validation-required-message="Please enter valid passwords.">
<div class="form-control-position">
<i class="la la-key"></i>
</div>
<div class="help-block font-small-3"></div>
</fieldset>
<button type="submit" class="btn btn-danger btn-block btn-lg" name='login'><i class="ft-unlock"></i> Login</button>
</form>
<?php
if(isset($_POST['login'])){
$username    = $_POST['username'];
$password    = sha1($_POST['password']);
$check  = mysql_fetch_array(mysql_query("SELECT id FROM uaccess WHERE username='$username' AND password='$password'")); //checking if username and password is correct
$check2 =   mysql_fetch_array(mysql_query("SELECT id,attempts,retry_time FROM uaccess WHERE username='$username'")); //query to get login attempts
if(!empty($check['id']) AND $check2['attempts']<3){ //checking if username & password is correct and login attempts less than 3
 session_start(); //starting user session
 $_SESSION['uid']=$check['id']; // assigning session variable for user
 $upd_attempts  =   mysql_query("UPDATE uaccess SET attempts=0, retry_time=NULL WHERE username='$username'"); //resetting login attempts to 0
 ?><script>window.location.replace('dashboard.php');</script><?php
}else if($check2['attempts']==3 AND !empty($check2['retry_time'])){ //checking if attempts is 3 and account lock time is set
  ?><script>alert('Your account has been locaked. Try again in 5 minutes.');</script><?php
  $now  =   date('d-m-Y H:i:s');
  $diff =   (strtotime($now)-strtotime($check2['retry_time']))/60/60/24; //checking if account locked time has reached 5 minutes
  if(round($diff*1000)>=5){
    session_start(); //starting user session
    $_SESSION['uid']=$check['id']; //assigning session variable for user
    $upd_attempts   =   mysql_query("UPDATE uaccess SET attempts=0, retry_time=NULL WHERE username='$username'"); //resetting login attempts to 0 and unlocking account
    ?><script>window.location.replace('dashboard.php');</script><?php //redirecting user to device dashboard
  }
}else{
  if($check2['attempts']==3 AND $check2['retry_time']==NULL){ //checking if attempts is 3 and account lock time is not set
  $retry_time   =   date('d-m-Y H:i:s');
  $upd_attempts =   mysql_query("UPDATE uaccess SET retry_time='$retry_time' WHERE username='$username'"); //locking account and updating locked time
  ?><script>alert('Your account has been locked. Try again in 5 minutes.');</script><?php
  }else{ //if entered password is incorrect
  $upd_attempts =   mysql_query("UPDATE uaccess SET attempts=attempts+1 WHERE username='$username'");   //incrementing login attempts
  ?><script>alert('Username/ Password is incorrect!');</script><?php //alerting user about the incorrect password
  }
}

}
?>
</div>
</div>
<div class="card-footer border-0">
<a href='forgot-password.php'><p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>Forgot Password ?</span></p></a>
<a href="register.php" class="btn btn-info btn-block btn-lg mt-3"><i class="ft-user"></i> Register</a>
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
