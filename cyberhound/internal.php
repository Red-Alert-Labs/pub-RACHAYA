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
<table class="table table-striped table-bordered zero-configuration">
<thead>
<tr>
<th>Device Name</th>
<th>Vulnerability ID</th>
<th>CVSS</th>
<th>Published Date</th>
</tr>
</thead>
<tbody>
<?php 
//getting all vulnerability details from internal DB
$getint =   mysql_query("SELECT ven_name, dev_name, vul_id, cvss, published FROM internal");
while($gotint   =   mysql_fetch_array($getint)){
?>
<tr>
    <td><?php echo $gotint['ven_name']." ".$gotint['dev_name'];?></td>
    <td><a href='expand.php?ven=<?php echo $gotint['ven_name'];?>&dev=<?php echo $gotint['dev_name'];?>'><?php echo $gotint['vul_id'];?></a></td>
    <td><?php echo $gotint['cvss'];?></td>
    <td><?php echo $gotint['published'];?></td>
</tr>
<?php
}
?>
</tbody>
</table>
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
