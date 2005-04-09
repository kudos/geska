<?
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// install.php Geska installer //////////////////////////////////////
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

$query = "SELECT * FROM ".$db_prefix."config WHERE server_root = '".addslashes(strrev(substr(strrev($server_root), 11)))."'";

if(@db_connect($host,$user,$pass,$database) && @mysql_num_rows(@mysql_query($query)) > 0) {
header("Location: index.php");
exit();
}
if(!isset($_POST['sitename'])) {
$template = "templates/admin/install.tpl";
$sitename = "Geska";
$pagetitle = 'Install';
$page = implode("", file($template));
$page = template_copyright($page);
$page = template_generic($page);
$keys = array('{USERNAME}','{EMAIL}','{SITENAMEFORM}', '{POSTNUM}');
$values = array($_POST['username'], $_POST['email'], $_POST['sitename'], '10');
$page = str_replace($keys, $values, $page);
$adminmenu = array('{ADMINMENUOPEN}', '{ADMINMENUITEM}', '{ADMINMENUCLOSE}');
$page = str_replace($adminmenu, '', $page);
echo $page;
} else if(!isset($_POST['sitename']) || !isset($_POST['postnum'])){
echo "Form incomplete."; 
} else if($_POST['password'] != $_POST['password2']){
echo "Passwords do not match."; 
} else {
db_connect($host,$user,$pass,$database);
//"CREATE DATABASE IF NOT EXISTS `$database`";
//"USE $database";
$createtable = array("CREATE TABLE IF NOT EXISTS `".$db_prefix."comments` (
  `commentid` smallint(6) NOT NULL auto_increment,
  `postid` smallint(6) NOT NULL default '0',
  `userid` smallint(6) NOT NULL default '-1',
  `guestname` varchar(50) NULL,
  `url` varchar(150) NOT NULL default '#',
    `time` varchar(10) NOT NULL default '',
  `comment` text NOT NULL,
  PRIMARY KEY  (`commentid`)
)",
"CREATE TABLE IF NOT EXISTS `".$db_prefix."logs` (
  `id` mediumint(9) NOT NULL auto_increment,
  `referrer` varchar(50) NOT NULL default '',
  `fullreferrer` varchar(250) NOT NULL default '',
  `time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ip` varchar(16) NOT NULL default '',
  `page` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
)",
"CREATE TABLE IF NOT EXISTS `".$db_prefix."posts` (
  `postid` smallint(6) NOT NULL auto_increment,
  `userid` smallint(6) NOT NULL default '0',
  `time` varchar(10) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `post` text NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`postid`)
)",
"CREATE TABLE IF NOT EXISTS `".$db_prefix."users` (
  `userid` mediumint(8) NOT NULL auto_increment,
  `username` varchar(20) NOT NULL default '',
  `password` varchar(40) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  `userlevel` tinyint(1) NOT NULL default '0',
  `sessionid` varchar(50) default '0',
  `active` tinyint(1) NOT NULL default '1',
  `joined` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastactive` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`userid`)
)",
"CREATE TABLE IF NOT EXISTS `".$db_prefix."admin_menu` (
  `menuid` smallint(2) NOT NULL default '0',
  `menuname` varchar(25) NOT NULL default '',
  `menulink` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`menuid`)
)",
"CREATE TABLE IF NOT EXISTS `".$db_prefix."config` (
  `server_root` varchar(100) NOT NULL default '',
  `postnum` tinyint(2) NOT NULL default '',
  `sitename` varchar(50) NOT NULL default '',
  `base_url` varchar(100) NOT NULL default '',
  `theme` varchar(50) NOT NULL default ''
) ",
"CREATE TABLE IF NOT EXISTS `".$db_prefix."menu` (
  `menuid` smallint(2) NOT NULL default '0',
  `menuname` varchar(25) NOT NULL default '',
  `menulink` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`menuid`)
)",
"INSERT INTO `".$db_prefix."users` (`userid`, `username`, `password`, `email`, `userlevel`,`joined`) VALUES (-1, 'Guest', '', '', -1, '".date('Y-m-d H:i:s',time())."')",
"INSERT INTO `".$db_prefix."users` (`userid`, `username`, `password`, `email`, `userlevel`,`joined`) VALUES (1, '{$_POST['username']}', '".sha1($_POST['password'])."', '{$_POST['email']}', 2, '".date('Y-m-d H:i:s',time())."')",
"INSERT INTO `".$db_prefix."posts` (`userid`, `time`, `title`, `post`, `active`) VALUES (1, '".time()."', 'Geska v0.5', 'This is the a demonstration post.<br />\r\nGeska has been succesfully set-up.<br />\r\nYou can now login, delete this post and start posting your own!<br />\r\n<br />\r\n/kudos', 1)",
"INSERT INTO `".$db_prefix."config` (`server_root`, `postnum`, `sitename`, `base_url`, `theme`) VALUES ('".addslashes(strrev(substr(strrev($server_root), 11)))."', '{$_POST['postnum']}', '".addslashes($_POST['sitename'])."', '".addslashes("http://".$_SERVER['HTTP_HOST'].strrev(substr(strrev($_SERVER['SCRIPT_NAME']), 11)))."', 'default')",
"INSERT INTO `".$db_prefix."menu` VALUES (0, 'Home', 'index.php')",
"INSERT INTO `".$db_prefix."menu` VALUES (1, 'Archive', 'archive.php')",
"INSERT INTO `".$db_prefix."menu` VALUES (2, 'Profile', 'profile.php')",
"INSERT INTO `".$db_prefix."menu` VALUES (3, 'Logout', 'logout.php')",
"INSERT INTO `".$db_prefix."menu` VALUES (4, 'Login', 'login.php')",
"INSERT INTO `".$db_prefix."menu` VALUES (5, 'Register', 'register.php')",
"INSERT INTO `".$db_prefix."menu` VALUES (6, 'Admin', 'stats.php')",

"INSERT INTO `".$db_prefix."admin_menu` VALUES (0, 'Blog', 'index.php')",
"INSERT INTO `".$db_prefix."admin_menu` VALUES (1, 'Stats', 'stats.php')",
"INSERT INTO `".$db_prefix."admin_menu` VALUES (2, 'Users', 'users.php')",
"INSERT INTO `".$db_prefix."admin_menu` VALUES (3, 'Add Post', 'post.php')",
"INSERT INTO `".$db_prefix."admin_menu` VALUES (4, 'Manage Posts', 'publish.php')",
"INSERT INTO `".$db_prefix."admin_menu` VALUES (5, 'Configure', 'configure.php')"
);


for($i=0;isset($createtable[$i]);$i++)
{
  mysql_query($createtable[$i])
  or die(mysql_error());
}
$template = "templates/admin/success.tpl";
$sitename = "Geska";
$pagetitle = 'Install';
$page = implode("", file($template));
$errmesg = "Database succesfully set-up. <br />Click <a href='index.php'>here</a> to view your new blog!";
$page = template_copyright($page);
$page = template_generic($page);
$adminmenu = array('{ADMINMENUOPEN}', '{ADMINMENUITEM}', '{ADMINMENUCLOSE}');
$page = str_replace($adminmenu, '', $page);
echo $page;
}
?>
