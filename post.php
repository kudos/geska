<?php
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// post.php interface for adding and editing posts //////////////////
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
$template = $template_admin_dir."post.tpl";
if($_REQUEST['confirm'] == 'delete'){
db_delete_post($_GET['p']);
header("Location: publish.php");
}
$spaw_root = strrev(substr(strrev($HTTP_SERVER_VARS['SCRIPT_FILENAME']), 9)).$spaw_dir;
require(strrev(substr(strrev($HTTP_SERVER_VARS['SCRIPT_FILENAME']), 8)).$fck_dir.'fckeditor.php');
if($_GET['mode'] == 'edit'){
if(!empty($_POST['post']) && $_GET['action'] == 'edit')
{
  $publish = 0;
  if(isset($_POST['publish']))
  $publish = 1;
  
  db_edit_post($_POST, $_GET['p'], $publish);
  header("Location: publish.php");
}
$pagetitle = 'Edit Post';
$page = implode("", file($template));
$page = template_admin_menu($page);
$page = template_generic($page);
$page = template_copyright($page);
$row = db_get_this_post($_GET['p']);
$page = str_replace('{DELETE}', "<form action='post.php?p={$_GET['p']}' method='POST' onSubmit='return validate()'>
<input type='hidden' name='confirm' value='delete'>
<input type='submit' value='Delete' id='myButton'>
</form>", $page);
$page = str_replace('{FORMURL}', "post.php?mode=edit&action=edit&p={$_GET['p']}", $page);
$page = str_replace('{MODEBUTTON}', 'Save Draft', $page);
$page = str_replace('{TITLE}', $row['title'], $page);
$oFCKeditor = new FCKeditor('post');
$oFCKeditor->BasePath = $fck_base_url.$fck_dir;
$oFCKeditor->Value = stripslashes($row['post']);
$page = explode('{WYSIWYG}', $page);
echo $page[0];
$oFCKeditor->Create();/* outputs WYSIWYG box */
echo $page[1];
} else {
if(!empty($_POST['post']) && $_GET['action'] == 'add')
{
  $publish = 0;
  if(isset($_POST['publish']))
  $publish = 1;
  
  db_add_post($_POST, $publish);
  header("Location: publish.php");
}
auth_auto_login();
$pagetitle = 'Add Post';
$page = implode("", file($template));
$page = template_admin_menu($page);
$page = template_generic($page);
$page = template_copyright($page);
$page = str_replace('{FORMURL}', "post.php?action=add", $page);
$page = str_replace('{DELETE}', '', $page);
$page = str_replace('{MODEBUTTON}', 'Save Draft', $page);
$page = str_replace('{TITLE}', '', $page);
$oFCKeditor = new FCKeditor('post');
$oFCKeditor->BasePath = $fck_base_url.$fck_dir;
$page = explode('{WYSIWYG}', $page);
echo $page[0];
$oFCKeditor->Create();/* outputs WYSIWYG box */
echo $page[1];
}
?>
