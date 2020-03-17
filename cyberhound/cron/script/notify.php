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
<?php
include "../../connect.php"; //including db connection file
$getusers   =   mysql_query("SELECT id, emailaddress FROM uaccess"); //getting all users
while($gotusers =   mysql_fetch_array($getusers)){
$useremail  =   $gotusers['emailaddress'];
$getdev    =   mysql_query("SELECT dev_name FROM device WHERE postedby='".$gotusers['id']."'"); //getting individual user's registered devices
while($gotdev   =   mysql_fetch_array($getdev)){
$dev   =   explode(' ',$gotdev['dev_name'],2);

$ch	=	curl_init();
$url    =   "https://cve.circl.lu/api/search/".strtolower($dev[0])."/".strtolower($dev[1]); //getting vulnerability from cve for registered devices
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
$check  =   mysql_fetch_array(mysql_query("SELECT id FROM internal WHERE vul_id='$id'")); //checking if vulnerability id is already present in internal db
if(empty($check['id'])){
foreach($references as $ref){
    //inserting vulnerability reference links if not found in internal db
    $insref    =   mysql_query("INSERT INTO `ref_links`(`vul_id`, `ref_links`) VALUES ('$id','$ref')");
}
//inserting vulnerability information if not found in internal db
$ins = mysql_query("INSERT INTO `internal`(`ven_name`, `dev_name`, `vul_id`, `published`, `modified`, `cvss`, `cvssvector`, `assigner`, `summary`) 
                                    VALUES ('$ven_name','$dev_name','$id','$published','$modified','$cvss','$cvssvector','$assigner','$summary')");
                                    
//setting up mail settings
$to = $useremail;
$subject = "New Vulnerability for ".$dev[0]." ".$dev[1]." | Cyber Hound";
$message = "
<html>
<body>
<p>Hello User!<br>A New Vulnerability has been found for one of your registered device, ".$dev[0]." ".$dev[1]."
<a href='http://vkmbs.com/hound/'>Login</a> in to your dashboard to know more about the vulnerability.<Br><br>Thanks,<Br>Cyber Hound. </p>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <support@cyberhound.com>' . "\r\n";

mail($to,$subject,$message,$headers); //sending out mail alert for registered users with new vulnerability information

}
}
}
}
}
?>