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
if(!isset($_SESSION['uid'])){
header('Location:logout.php');
}else{
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<title>Dashboard CyberHound</title>
<link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
<link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
<link rel="stylesheet" type="text/css" href="app-assets/vendors/css/weather-icons/climacons.min.css">
<link rel="stylesheet" type="text/css" href="app-assets/fonts/meteocons/style.css">
<link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/morris.css">
<link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/chartist.css">
<link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/chartist-plugin-tooltip.css">
<link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/datatables.min.css">
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
<link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.css">
<link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="app-assets/css/pages/timeline.css">
<link rel="stylesheet" type="text/css" href="app-assets/css/pages/dashboard-ecommerce.css">
<!-- END: Page CSS-->

<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
<div class="navbar-wrapper">
<div class="navbar-header">
<ul class="nav navbar-nav flex-row">
<li class="nav-item mobile-menu d-lg-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
<li class="nav-item mr-auto"><a class="navbar-brand" href="index.html"><img class="brand-logo" alt="modern admin logo" src="app-assets/images/logo/logo.png">
<h3 class="brand-text">Cyber Hound</h3>
</a></li>
<li class="nav-item d-none d-lg-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>
<li class="nav-item d-lg-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
</ul>
</div>
<div class="navbar-container content">
<div class="collapse navbar-collapse" id="navbar-mobile">
<ul class="nav navbar-nav mr-auto float-left">
<li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
<li class="dropdown nav-item mega-dropdown d-none d-lg-block"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
  <b>Hi <?php echo $getu['fullname'];?>, Welcome to your Dashboard!</b></a>
</li>
</ul>
</div>
</div>
</div>
</nav>
<!-- END: Header-->


<!-- BEGIN: Main Menu-->

<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
<div class="main-menu-content">
<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
  <?php include "sidebar.php";?>
</ul>
</div>
</div>

<!-- END: Main Menu-->
<!-- BEGIN: Content-->
<div class="app-content content">
<div class="content-wrapper">
<div class="content-header row mb-1">
</div>
<div class="content-body">
  <div class="col-md-12 card"><br>
    <?php
    //displaying page title based on user action to edit/ add new device
if(isset($_GET['edit'])){
?><h3>Edit Device</h3><hr><?php
}else{
?><h3>Add New Device</h3><hr><?php
  }
  ?>
  <div class='col-md-12'>
    <?php
    //getting device information from user selected edit device id
$gete = mysql_fetch_array(mysql_query("SELECT * FROM device WHERE id='".$_GET['edit']."'"));
    ?>
    <!-- Form to Add/Edit New Device -->
  <form action='' method='post' class='row col-md-12'>
    <input type='text' class='form-control col-md-6' name='dev_name' placeholder="Device Name" value='<?php echo $gete[3];?>' required><br>
    <input type='text' class='form-control col-md-6' name='dev_type' placeholder='Device Type' value='<?php echo $gete[4];?>'><Br>
    <input type='text' class='form-control col-md-6' name='manu_name' placeholder='Manufacture Name' value='<?php echo $gete[5];?>'><Br>
    <input type='number' class='form-control col-md-6' name='model_num' placeholder='Model Number' value='<?php echo $gete[6];?>'><br>
    <input type='text' class='form-control col-md-6' name='ip_add' placeholder='IP Address' value='<?php echo $gete[7];?>'><br>
    <input type='text' class='form-control col-md-6' name='sensor_type' placeholder='Sensor Type' value='<?php echo $gete[8];?>'><br>
    <input type='text' class='form-control col-md-6' name='cloud_type' placeholder='Cloud Type' value='<?php echo $gete[9];?>'><br>
    <input type='text' class='form-control col-md-6' name='commercial_name' placeholder='Commercial Name' value='<?php echo $gete[10];?>'><br>
    <input type='text' class='form-control col-md-6' name='process' placeholder='Processor' value='<?php echo $gete[11];?>'><Br>
    <input type='text' class='form-control col-md-6' name='datarate' placeholder='Data Rate' value='<?php echo $gete[12];?>'><Br>
    <input type='text' class='form-control col-md-6' name='storecap' placeholder='Storage Capacity' value='<?php echo $gete[13];?>'><br>
    <input type='text' class='form-control col-md-6' name='connect_type' placeholder='Connectivity Type' value='<?php echo $gete[14];?>'><br>
    <input type='text' class='form-control col-md-6' name='data_security' placeholder='Data Security' value='<?php echo $gete[15];?>'><br>
    <input type='text' class='form-control col-md-6' name='comm_range' placeholder='Communication Range' value='<?php echo $gete[16];?>'><br>
    <input type='text' class='form-control col-md-6' name='dynamic_nature' placeholder='Dynamic Nature' value='<?php echo $gete[17];?>'><br>
    <input type='text' class='form-control col-md-6' name='protocol_used' placeholder='Protocol Used' value='<?php echo $gete[18];?>'><br>
    <input type='text' class='form-control col-md-6' name='battery_life' placeholder='Battery Life' value='<?php echo $gete[19];?>'><br>
    <?php
if(isset($_GET['edit'])){
?><input type='submit' class='btn btn-primary col-md-6' name='edit' value='Edit'><?php
}else{
?><input type='submit' class='btn btn-primary col-md-6' name='add_new' value='Add New'><?php } ?>
  </form>
  <?php
  if(isset($_POST['edit'])){
  $dev_name = html_entity_decode(mysql_real_escape_string($_POST['dev_name']));
  $dev_type = html_entity_decode(mysql_real_escape_string($_POST['dev_type']));
  $manu_name  = html_entity_decode(mysql_real_escape_string($_POST['manu_name']));
  $model_num  = html_entity_decode(mysql_real_escape_string($_POST['model_num']));
  $ip_add   = html_entity_decode(mysql_real_escape_string($_POST['ip_add']));
  $sensor_type  = html_entity_decode(mysql_real_escape_string($_POST['sensor_type']));
  $cloud_type   = html_entity_decode(mysql_real_escape_string($_POST['cloud_type']));
  $commercial_name  = html_entity_decode(mysql_real_escape_string($_POST['commercial_name']));
  $process  = html_entity_decode(mysql_real_escape_string($_POST['process']));
  $datarate = html_entity_decode(mysql_real_escape_string($_POST['datarate']));
  $storecap = html_entity_decode(mysql_real_escape_string($_POST['storecap']));
  $connect_type = html_entity_decode(mysql_real_escape_string($_POST['connect_type']));
  $data_security  = html_entity_decode(mysql_real_escape_string($_POST['data_security']));
  $comm_range = html_entity_decode(mysql_real_escape_string($_POST['comm_range']));
  $dynamic_nature = html_entity_decode(mysql_real_escape_string($_POST['dynamic_nature']));
  $protocol_used  = html_entity_decode(mysql_real_escape_string($_POST['protocol_used']));
  $battery_life = html_entity_decode(mysql_real_escape_string($_POST['battery_life']));
  $doa = date('d-m-Y');
  //Updating existing device information from user selected edit variable from device id from the URL
  if($upd = mysql_query("UPDATE `device` SET `dev_name`='$dev_name',`dev_type`='$dev_type',`manu_name`='$manu_name',`model_num`='$model_num',`ip_add`='$ip_add',`sensor_type`='$sensor_type',
                                          `cloud_type`='$cloud_type',`commercial_name`='$commercial_name',`process`='$process',`datarate`='$datarate',`storecap`='$storecap',`connect_type`='$connect_type',
                                          `data_security`='$data_security',`comm_range`='$comm_range',`dynamic_nature`='$dynamic_nature',`protocol_used`='$protocol_used',`battery_life`='$battery_life' WHERE `id`='".$_GET['edit']."'")){
    ?><script>alert('Device Updated Successfully!');window.location.replace('new-device.php?edit=<?php echo $_GET['edit'];?>');</script><?php
  }else{
    ?><script>alert('Something went wrong! Try agian later.');</script><?php
  }
  }else if(isset($_POST['add_new'])){
  $dev_name = html_entity_decode(mysql_real_escape_string($_POST['dev_name']));
  $dev_type = html_entity_decode(mysql_real_escape_string($_POST['dev_type']));
  $manu_name  = html_entity_decode(mysql_real_escape_string($_POST['manu_name']));
  $model_num  = html_entity_decode(mysql_real_escape_string($_POST['model_num']));
  $ip_add   = html_entity_decode(mysql_real_escape_string($_POST['ip_add']));
  $sensor_type  = html_entity_decode(mysql_real_escape_string($_POST['sensor_type']));
  $cloud_type   = html_entity_decode(mysql_real_escape_string($_POST['cloud_type']));
  $commercial_name  = html_entity_decode(mysql_real_escape_string($_POST['commercial_name']));
  $process  = html_entity_decode(mysql_real_escape_string($_POST['process']));
  $datarate = html_entity_decode(mysql_real_escape_string($_POST['datarate']));
  $storecap = html_entity_decode(mysql_real_escape_string($_POST['storecap']));
  $connect_type = html_entity_decode(mysql_real_escape_string($_POST['connect_type']));
  $data_security  = html_entity_decode(mysql_real_escape_string($_POST['data_security']));
  $comm_range = html_entity_decode(mysql_real_escape_string($_POST['comm_range']));
  $dynamic_nature = html_entity_decode(mysql_real_escape_string($_POST['dynamic_nature']));
  $protocol_used  = html_entity_decode(mysql_real_escape_string($_POST['protocol_used']));
  $battery_life = html_entity_decode(mysql_real_escape_string($_POST['battery_life']));
  $doa = date('d-m-Y');
  //adding new device into the device table on the DB
  if($ins = mysql_query("INSERT INTO `device`(`postedby`, `doa`, `dev_name`, `dev_type`, `manu_name`, `model_num`, `ip_add`, `sensor_type`, `cloud_type`, `commercial_name`, `process`,
                                              `datarate`, `storecap`, `connect_type`, `data_security`, `comm_range`, `dynamic_nature`, `protocol_used`, `battery_life`)
                                      VALUES ('$uid','$doa','$dev_name','$dev_type','$manu_name','$model_num','$ip_add','$sensor_type','$cloud_type','$commercial_name','$process',
                                      '$datarate','$storecap','$connect_type','$data_security','$comm_range','$dynamic_nature','$protocol_used','$battery_life')")){
    ?><script>alert('New Device Registered Successfully!');</script><?php
  }else{
    ?><script>alert('Something went wrong! Try again later.');</script><?php
  }
}
  ?>
  <hr>
</div>
  </div>
</div>
</div>
</div>
<!-- END: Content-->


<!-- BEGIN: Vendor JS-->
<script src="app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="app-assets/vendors/js/charts/chartist.min.js"></script>
<script src="app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js"></script>
<script src="app-assets/vendors/js/charts/raphael-min.js"></script>
<script src="app-assets/vendors/js/charts/morris.min.js"></script>
<script src="app-assets/vendors/js/timeline/horizontal-timeline.js"></script>
<script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="app-assets/js/core/app-menu.js"></script>
<script src="app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>
<!-- END: Page JS-->

</body>
<!-- END: Body-->
<?php
}
?>
</html>
