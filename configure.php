<?php
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// configure.php sitewide configuration /////////////////////////////
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
$pagetitle = 'Configure';
if(strlen($_POST['sitename']) > 0 && strlen($_POST['base_url']) > 0 && strlen($_POST['server_root']) > 0 && strlen($_POST['postnum']) > 0 && strlen($_POST['theme']) > 0){
$errmesg = db_update_config($_POST);
$template = $template_admin_dir."success.tpl";
db_get_site_settings();
  $page = implode("", file($template));
$page = str_replace('{ERRMESG}', $errmesg, $page);
  $page = template_generic($page);
  $page = template_admin_menu($page);
  $page = template_copyright($page);
} 
else {
  $template = $template_admin_dir."configure.tpl";
  $pagetitle = 'Configure';
  $page = implode("", file($template));
  $keys = array('{POSTNUM}', '{SERVERROOT}', '{BASEURL}');
  $values = array($postnum, $server_root, $spaw_base_url);
  $page = str_replace($keys, $values, $page);
  $page = template_generic($page);
  $page = template_admin_menu($page);
  $page = template_admin_theme($page);
  $page = template_copyright($page); 
}
echo $page;
?>
