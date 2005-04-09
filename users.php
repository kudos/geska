<?php
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// users.php admin edit user details ////////////////////////////////
// Copyright (C) 2005 Kudos www.joncremin.com ///////////////////////
// Licensed under the GPL ///////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
require('include.php');
db_connect($host,$user,$pass,$database);
db_get_site_settings();
session_start();
auth_auto_login();
if($_SESSION['authlevel'] < 2){
  header("Location: index.php");
  exit();
}
$pagetitle = 'Users';
if(isset($_POST['delete']))
{
  $template = $template_admin_dir."profile.tpl";
  $page = implode("", file($template));
  $errmesg = db_delete_user($_POST['delete']);
  if($errmesg == 1){
  $errmesg = "You have successfully deleted the user {$_POST['username']}";
  }
$page = template_admin_success($page);
}
if(isset($_POST['email']))
{
  $template = $template_admin_dir."profile.tpl";
  $page = implode("", file($template));
  $errmesg = db_edit_user($_POST);
  if($errmesg == 1){
  $errmesg = "You have successfully edited the profile of {$_POST['username']}";
  }
$page = template_admin_success($page);
} else if(!isset($_POST['user'])){
$template = $template_admin_dir."users.tpl";
$page = implode("", file($template));
$query = "SELECT * FROM ".$db_prefix."users WHERE userid > '0' && userlevel >= 0";
$result = mysql_query($query);
$splitpage = explode('{ADMINOPEN}', $page);
$pagetop = $splitpage[0];
$user = explode('{ADMINCLOSE}', $splitpage[1]);
$pagebottom = $user[1];
$i = 0;
while($row = mysql_fetch_array($result)) {
$users[$i] = str_replace('{USERID}', $row['userid'], $user[0]);
$users[$i] = str_replace('{USERNAME}', $row['username'], $users[$i]);
$i++;
}
$i = 0;
while(isset($users[$i])) {
$userage .= $users[$i];
$i++;
}
$page = $pagetop.$userage.$pagebottom;
$page = template_generic($page);
} else {
  $template = $template_admin_dir."profile.tpl";
  $page = implode("", file($template));

if(!empty($_POST['user']))
{
  $user = db_get_user_details($_POST['user']);
} else {
  $user = db_get_user_details(db_get_userid($_SESSION['authname']));
} 
if($user['userlevel'] >= 2)
{
$admincheck = 'selected';
} else {
$usercheck = 'selected';
}

$page = template_admin_profile($page);
}
$page = template_admin_menu($page);
$page = template_copyright($page);
echo $page;




?>
