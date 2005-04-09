<?php
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// index.php main interface display frontpage posts /////////////////
// Copyright (C) 2005 Kudos www.joncremin.com ///////////////////////
// Licensed under the GPL ///////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
require('include.php');
if(isset($_SERVER['PATH_TRANSLATED']))
{
	$server_root = $_SERVER['PATH_TRANSLATED'];
}
else $server_root = $_SERVER['SCRIPT_FILENAME'];

$query = "SELECT * FROM ".$db_prefix."config WHERE server_root = '".addslashes(strrev(substr(strrev($server_root), 9)))."'";

if(@db_connect($host,$user,$pass,$database) && @mysql_num_rows(@mysql_query($query)) == 0) {
header("Location: install.php");
exit();
}
db_connect($host,$user,$pass,$database);
db_add_log($_SERVER['SCRIPT_NAME']);
db_get_site_settings();
session_start();
auth_auto_login();
$template = $template_dir."index.tpl";
if(isset($_GET['p'])) {
  $page = implode("", file($template));
  $page = template_entry($page, $_GET['p']);
} else {
  $pagetitle = 'Home';
  $page = implode("", file($template));
  $page = template_index($page);
}
  $page = template_menu($page);
  $page = template_copyright($page);
echo $page;
?>
