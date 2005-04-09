<?php
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// profile.php edit user details ////////////////////////////////////
// Copyright (C) 2005 Kudos www.joncremin.com ///////////////////////
// Licensed under the GPL ///////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
require('include.php');
db_connect($host,$user,$pass,$database);
db_add_log($_SERVER['SCRIPT_NAME']);
db_get_site_settings();
session_start();
auth_auto_login();
if(empty($_SESSION['authname'])){
  header("Location: index.php");
  exit();
}
$template = $template_dir."profile.tpl";
  $pagetitle = 'Profile';
  $page = implode("", file($template));

if(isset($_POST['email']))
{
  $errmesg = db_edit_user($_POST);
  if($errmesg == true){
  $errmesg = "You have successfully the profile of {$_POST['username']}";
  $page = template_success($page);
  }
} 

if($errmesg != true)
{
  if(!empty($_GET['userid']))
  {
    $user = db_get_user_details($_GET['userid']);
  } else {
    $user = db_get_user_details(db_get_userid($_SESSION['authname']));
  } 
  if($user['userlevel'] >= 2)
  {
  $admincheck = 'selected';
  } else {
  $usercheck = 'selected';
  }
}
$page = template_profile($page);
$page = template_menu($page);
$page = template_copyright($page);
echo $page;
?>
