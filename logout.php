<?php
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// logout.php interface logging out of the system ///////////////////
// Copyright (C) 2005 Kudos www.joncremin.com ///////////////////////
// Licensed under the GPL ///////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
require('include.php');
db_connect($host,$user,$pass,$database);
db_get_site_settings();
session_start();
$_SESSION['oldname'] = @$_SESSION['authname'];
unset($_SESSION['authname']);
unset($_SESSION['password']);
unset($_SESSION['authlevel']);
$_SESSION['logout'] = 'logout';
auth_logout();
$template = $template_dir.'logout.tpl';
$pagetitle = "Logout";
$page = implode("", file($template));
$page = template_generic($page);
$page = template_menu($page);
$page = template_copyright($page);
echo $page;
?>
