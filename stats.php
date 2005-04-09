<?php
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// stats.php incidental site stats //////////////////////////////////
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

$template = $template_admin_dir."stats.tpl";
$pagetitle = 'Stats';
if(isset($_POST['username']))
auth_login($_POST);
$page = implode("", file($template));
$page = template_admin_menu($page);
$page = template_generic($page);
$page = template_copyright($page);
$page = template_admin_stats($page);
echo $page;




?>
