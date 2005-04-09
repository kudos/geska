<?php
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// login.php interface logging into the system //////////////////////
// Copyright (C) 2005 Kudos www.joncremin.com ///////////////////////
// Licensed under the GPL ///////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
require('include.php');
db_connect($host,$user,$pass,$database);
db_get_site_settings();
session_start();
auth_auto_login();
$template = $template_dir."login.tpl";
if(isset($_POST['username']))
$errmesg = auth_login($_POST);

if(isset($_SESSION['authname']))
header("Location: index.php");
$pagetitle = 'Login';
$page = implode("", file($template));
$page = template_generic($page);
$page = template_menu($page);
$page = template_copyright($page);
echo $page;
?>
