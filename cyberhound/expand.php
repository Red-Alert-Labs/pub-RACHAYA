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
<h3><?php echo $_GET['ven']." ".$_GET['dev']." Vulnerabilities";?></h3><hr>
<div class='row col-md-12'>
<?php
//Getting Deviec Vulnerabilities from CVE
$ch	=	curl_init();
$url    =   "https://cve.circl.lu/api/search/".strtolower($_GET['ven'])."/".strtolower($_GET['dev']);
//  Initiate curl
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);

// Will dump a beauty json :3
$json = json_decode($result, true);
if($json['total']!=0){
for($i=0; $i<$json['total'];$i++){
$ven_name   =   $_GET['ven'];
$dev_name   =   $_GET['dev'];
$id = $json['results'][$i]['id'];
$published  =   $json['results'][$i]['Published'];
$modified   =   $json['results'][$i]['Modified'];
$cvss       =   $json['results'][$i]['cvss'];
$summary    =   $json['results'][$i]['summary'];
$cvssvector =   $json['results'][$i]['cvss-vector'];
$assigner   =   $json['results'][$i]['assigner'];
$references =   $json['results'][$i]['references'];
$check  =   mysql_fetch_array(mysql_query("SELECT id FROM internal WHERE vul_id='$id'"));
//Checking if vulnerability already exists in Internal DB
if(empty($check['id'])){
//Displaying new vulnerability here
echo "<small>ID: ".$id." | Published: ".$published." | Modified: ".$modified." | CVSS: ".$cvss." | Vector: ".$cvssvector." | Assigner: ".$assigner."</small><br>";
echo $summary."<br><br>";
echo "<small>References:<br>";
foreach($references as $ref){
    ?><a href='<?php echo $ref;?>'><?php
    // Inserting Vulnerability Reference Links
    $insref    =   mysql_query("INSERT INTO `ref_links`(`vul_id`, `ref_links`) VALUES ('$id','$ref')");
    echo $ref."</a><br>";
}
echo "</small><br><hr>";
//Inserting new found vulnerability into the Internal DB
$ins = mysql_query("INSERT INTO `internal`(`ven_name`, `dev_name`, `vul_id`, `published`, `modified`, `cvss`, `cvssvector`, `assigner`, `summary`) 
                                    VALUES ('$ven_name','$dev_name','$id','$published','$modified','$cvss','$cvssvector','$assigner','$summary')");
}else{
//Getting all existing vulnerability from the Internal DB and displaying
$internal   =   mysql_query("SELECT * FROM internal WHERE vul_id='$id'");
while($int  =   mysql_fetch_array($internal)){
?>
<small>ID: <?php echo $int['vul_id'];?> | Published: <?php echo $int['published'];?> | Modified: <?php echo $int['modified'];?> | CVSS: <?php echo $int['cvss'];?> 
| Vector: <?php echo $int['cvssvector']; ?> | Assigner: <?php echo $int['assigner'];?></small><br>
<?php echo $int['summary']; ?><br><br>
<small>References:<br>
<?php
$getreflinks    =   mysql_query("SELECT * FROM ref_links WHERE vul_id='".$int['vul_id']."'");
while($reflinks =   mysql_fetch_array($getreflinks)){
?><a href='<?php echo $reflinks['ref_links'];?>'><?php echo $reflinks['ref_links']; ?></a><br>
<?php
}
?></small><br><hr>
<?php
} 
}
}
}else{
echo "No Vulnerability found from the external api.";
}
?>
</div>
</div>
<div class='col-md-12 card'><br>
<!-- User Based Reviews/ Vulnerability posting access -->
<h4>Posted by Users</h4><hr>
<div class='row col-md-12'>
    <form action='' method='post' class='col-md-12'>
        <textarea class='form-control col-md-12' name='comment' placeholder='Post your vulnerability finding for this device.'></textarea>
        <input type='submit' class='col-md-12 btn btn-primary' value='Post' name='postt'>
    </form>
    <?php
    if(isset($_POST['postt'])){
        $comment    =   $_POST['comment'];
        //Inserting User posted vulnerability for selected Device from URL variables
        if($ins =   mysql_query("INSERT INTO `user_vulnerability`(`vulnerability`, `ven_name`, `dev_name`) VALUES ('$comment','".$_GET['ven']."','".$_GET['dev']."')")){
            ?><script>alert('New Vulnerability added successfully!');</script><?php
        }else{
            ?><script>alert('Something went wrong! Try again later.');</script><?php
        }
    }
    ?><br><br><br><br><hr>
    <div class='col-md-12'>
    <?php
    //Displaying already posted user found vulnerabilities from internal db
    $user_vul   =   mysql_query("SELECT vulnerability FROM user_vulnerability WHERE ven_name='".$_GET['ven']."' AND dev_name='".$_GET['dev']."'");
    while($u_vul    =   mysql_fetch_array($user_vul)){
        ?><br><p><?php echo $u_vul['vulnerability'];?></p><hr><?php
    }
    ?></div>
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
