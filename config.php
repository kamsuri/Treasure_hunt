<?php
include_once("inc/facebook.php"); //include facebook SDK
######### Facebook API Configuration ##########
$appId = '1192767324074578'; //Facebook App ID
$appSecret = '1d2005991a08d75bebc4ced3eaf2d154'; // Facebook App Secret
$homeurl = 'http://www.techelon.csinsit.org/events/enigmata/index.php';  //return to home
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret

));
$fbuser = $facebook->getUser();
?>