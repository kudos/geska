<?php
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// comment.php add and display comments /////////////////////////////
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
$disable = '';
$template = $template_dir."comment.tpl";
if(isset($_GET['d']) && $_SESSION['authlevel'] >= 2)
{
	db_delete_comment($_GET['d']);
	exit();
}
if(isset($_POST['comment']))
  db_add_comment($_POST, $_GET['p']);  

  $page = implode("", file($template));
  $page = template_entry($page, $_GET['p']);
  $page = template_comment_list($page, $_GET['p']);
if(isset($_SESSION['authname']))
{
	$disable = 'disabled';
}
  $page = str_replace('{POSTID}', $_GET['p'], $page);
  $page = str_replace('{DISABLE}', $disable, $page);
  $page = str_replace('{AUTHNAME}', $_SESSION['authname'], $page);
  $page = template_menu($page);
  $page = template_copyright($page);
echo $page;

?>
