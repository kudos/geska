<?php
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// publish.php post management system ///////////////////////////////
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
$pagetitle = 'Manage Posts';
if($_POST['mode'] == 'update')
{
	$i = 0;
	$list = explode(',', $_POST['postlist']);
	while(isset($list[$i]))
	{
		$num = $list[$i];
		db_update_publish($list[$i], $_POST[$num]);
		$i++;
	}
}
$template = $template_admin_dir."publish.tpl";
$page = implode("", file($template));
$page = template_admin_publish($page);
$page = template_admin_menu($page);
$page = template_copyright($page);
echo $page;
?>
