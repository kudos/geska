<?php
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// register.php site registration ///////////////////////////////////
// Copyright (C) 2005 Kudos www.joncremin.com ///////////////////////
// Licensed under the GPL ///////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
require('include.php');
db_connect($host,$user,$pass,$database);
db_get_site_settings();
session_start();
auth_auto_login();
$template = $template_dir.'register.tpl';
if(isset($_POST['username'])){
$errmesg = db_add_user($_POST);
}
$pagetitle = 'Register';
$page = implode("", file($template));
if(strlen($errmesg) > 10){
$page = template_generic($page);
} else if($errmesg == true){
$errmesg = "You have succesfully registered as {$_POST['username']}";
$page = template_success($page);
} else {
$errmesg = '';
$page = template_generic($page);
}
$page = template_menu($page);
$page = template_copyright($page);
echo $page;
?>
