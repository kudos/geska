<?php
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// template_admin_parser.php create html from tpl files /////////////
// Copyright (C) 2005 Kudos www.joncremin.com ///////////////////////
// Licensed under the GPL ///////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
function template_admin_menu($page)
{
global $pagetitle;
$menu = explode('{ADMINMENUOPEN}', $page);
$pagetop = $menu[0];
$menu = explode('{ADMINMENUCLOSE}', $menu[1]);
$menubody = $menu[0];
$pagebottom = $menu[1];
$menukeys = array('{ADMINMENULINK}', '{ADMINMENUITEM}');
$result = db_get_admin_menu($pagetitle);
$i = 0;
while($row = @mysql_fetch_array($result))
  {  
  	$menuvalues = array($row['menulink'], $row['menuname']);
  	$menulist[$i] = str_replace($menukeys, $menuvalues, $menubody);
	if($pagetitle == $row['menuname']) {
	$menulist[$i] = strip_tags("&raquo; ".$menulist[$i], "<br>");
	}
 	$i++;
  }
$i = 0;
while(isset($menulist[$i])) {
$menubar .= $menulist[$i];
$i++;
}
return($pagetop.$menubar.$pagebottom);
}

function template_admin_stats($page)
{
global $sitename;
global $pagetitle;
global $numusers;
global $db_prefix;

$query = "SELECT * FROM ".$db_prefix."users WHERE userid > 0";
$result = mysql_query($query);
$numusers = @mysql_num_rows($result);

$query = "SELECT * FROM ".$db_prefix."users WHERE userid > 0 ORDER BY joined DESC LIMIT 0,1";
$result = mysql_query($query);
$row = @mysql_fetch_assoc($result);

$query = "SELECT * FROM ".$db_prefix."users WHERE username != '{$_SESSION['authname']}' && userid > 0 ORDER BY lastactive DESC LIMIT 0,1";
$result = mysql_query($query);
$row2 = @mysql_fetch_assoc($result);

$query = "SELECT * FROM ".$db_prefix."posts WHERE active = '0'";
$result = mysql_query($query);
$numdead = @mysql_num_rows($result);

$query = "SELECT * FROM ".$db_prefix."posts WHERE active = '1'";
$result = mysql_query($query);
$numactive = @mysql_num_rows($result);

$query = "SELECT * FROM ".$db_prefix."posts";
$result = mysql_query($query);
$numposts = @mysql_num_rows($result);

$query = "SELECT * FROM ".$db_prefix."comments";
$result = mysql_query($query);
$numcomments = @mysql_num_rows($result);

$keys = array('{SITENAME}', '{PAGETITLE}', '{ERRMESG}', '{REGUSERS}', '{NEWESTUSER}', '{LASTACTIVE}', '{POSTSPUB}', '{POSTSPEN}', '{TOTALPOSTS}', '{TOTALCOMMENTS}', '{VISITS}');
$values = array($sitename, $pagetitle, $errmesg, $numusers, $row['username'], $row2['username'],$numactive, $numdead, $numposts, $numcomments, $i);
return(str_replace($keys, $values, $page));
}
/*
function template_admin_select($page)
{
global $optionbody;
global $optionlist;
global $page;
$option = explode('{OPTIONLISTOPEN}', $page);
$pagetop = $option[0];
$option = explode('{OPTIONLISTCLOSE}', $option[1]);
$$optionbody = $option[0];
$pagebottom = $option[1];
$i = 0;
while(isset($option[$i])){
$optionage[$i] = $option[$i];
$optionage[$i] = str_replace('{LOGTIME}', $optionlist[$i], $optionage[$i]);
$i++;
}
$i = 0 ;
while(isset($optionage[$i])) {
$options .= $optionage[$i];
$i++;
}
}
return($pagetop.$options.$pagebottom);*/

function template_admin_profile($page)
{
global $sitename;
global $pagetitle;
global $errmesg;
global $admincheck;
global $usercheck;
global $user;
$keys = array('{SITENAME}', '{PAGETITLE}', '{ERRMESG}', '{ADMINCHECK}', '{USERCHECK}', '{USERNAME}', '{EMAIL}', '{USERID}');
$values = array($sitename, $pagetitle, $errmesg, $admincheck, $usercheck, stripslashes($user['username']), stripslashes($user['email']), $user['userid']);
$splitpage = explode('{ADMINOPEN}', $page);
$pagetop = $splitpage[0];
$admin1 = explode('{ADMINCLOSE}', $splitpage[1]);
$admin2 = explode('{ADMINCLOSE}', $splitpage[2]);
$pagebottom = $admin2[1];
$page = $pagetop.$admin1[0].$admin1[1].$admin2[0].$pagebottom;
return(str_replace($keys, $values, $page));
}

function template_admin_users($page)
{

$keys = array('{USERNAME}', '{EMAIL}', '{USERID}');
$values = array(stripslashes($user['username']), stripslashes($user['email']), $user['userid']);
$splitpage = explode('{ADMINOPEN}', $page);
$pagetop = $splitpage[0];
$admin1 = explode('{ADMINCLOSE}', $splitpage[1]);
//$admin2 = explode('{ADMINCLOSE}', $splitpage[2]);
$pagebottom = $admin2[1];
$page = $pagetop.$admin1[0].$admin1[1].$admin2[0].$pagebottom;
return(str_replace($keys, $values, $page));
}

function template_admin_success($page)
{
global $sitename;
global $pagetitle;
global $errmesg;
global $template_admin_dir;
$template = $template_admin_dir."success.tpl";
$page = implode("", file($template));
$keys = array('{SITENAME}', '{PAGETITLE}', '{ERRMESG}');
$values = array($sitename, $pagetitle, $errmesg);
return(str_replace($keys, $values, $page));
}

function template_admin_publish($page)
{
global $sitename;
global $pagetitle;
global $postkeys;
global $postbody;
global $i;
$keys = array('{SITENAME}', '{PAGETITLE}');
$values = array($sitename, $pagetitle);
$postkeys = array('{POSTLINK}', '{POSTTITLE}', '{POSTDELETE}', '{POSTEDIT}', '{POSTUSER}', '{POSTTIME}', '{CHECKBOX}');
// split the template up
$post = explode('{ARCHIVELISTOPEN}', $page);
$pagetop = $post[0];
$post = explode('{ARCHIVELISTCLOSE}', $post[1]);
$postbody = $post[0];
//$pagebottom = $post[1];
$pagetop = str_replace($keys, $values, $pagetop);
if(!isset($_GET['perpage']))
{
	$_GET['perpage'] = 20;
	$_GET['page'] = 0;
}
$result = db_get_posts($_GET['perpage'], "", $_GET['page']); // pass a number to this function to specify the number of articles on the front page
$i = 0;
// parse each post
while($row = @mysql_fetch_array($result))
{
  $listage .= $row['postid'].",";
  $postage[$i] = template_admin_post($row);
  $i++;
}
$i = 0;
while(isset($postage[$i])) {
$posts .= $postage[$i];
$i++;
}
$postlist = "<input type='hidden' name='postlist' value='$listage'>";
$pagebottom = str_replace('{POSTLIST}', $postlist, $post[1]);
$page = $pagetop.$posts.$pagebottom;
$numposts = db_get_num_posts('all');
$totalpages = ceil($numposts/20);
$paginate = pagination($totalpages, $_GET['perpage'], $_GET['page'], 'publish.php');
$page = str_replace('{PAGINATE}', $paginate, $page);

return($page);
}

function template_admin_post($row)
{
  global $postkeys;
  global $postbody;
  global $i;
  $num = db_get_num_comments($row['postid']);
  $user = db_get_user_details($row['userid']);
  if($row['active'] == 1)
  {
  	$checked = " checked";
  }
  $postvalues = array("index.php?p={$row['postid']}", stripslashes($row['title']), "post.php?confirm=delete&p={$row['postid']}", "post.php?mode=edit&p={$row['postid']}", stripslashes($user['username']), date("j M Y g:ia", $row['time']), "<input type='checkbox' name='{$row['postid']}' $checked>");
  return(str_replace($postkeys, $postvalues, $postbody));
}


function template_admin_theme($page)
{
global $server_root;
global $theme;
$menu = explode('{SELECTTHEMEOPEN}', $page);
$pagetop = $menu[0];
$menu = explode('{SELECTTHEMECLOSE}', $menu[1]);
$menubody = $menu[0];
$pagebottom = $menu[1];
$dir = $server_root."templates/main/";
$dh  = opendir($dir);
while (false !== ($filename = readdir($dh))) {
   $files[] = $filename;
}
$i = 0;
foreach($files as $value)
{
	if(is_dir($server_root."templates/main/".$value))
	{
  		$menulist[$i] = str_replace('{THEME}', $value, $menubody);
  		if($theme == $value)
  		{
  			$menulist[$i] = str_replace('{SELECTED}', ' selected', $menulist[$i]);
  		}
  		else $menulist[$i] = str_replace('{SELECTED}', "", $menulist[$i]);
  	}
  	$i++;
}
$i = 0;
while(isset($menulist[$i])) {
if(!strpos($menulist[$i], '.') && !strpos($menulist[$i], '..'))
{
	$menubar .= $menulist[$i];
}
$i++;
}
return($pagetop.$menubar.$pagebottom);
}

?>
