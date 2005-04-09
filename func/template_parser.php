<?php
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// template_parser.php create html from tpl files ///////////////////
// Copyright (C) 2005 Kudos www.joncremin.com ///////////////////////
// Licensed under the GPL ///////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
function template_menu($page)
{
global $pagetitle;
$menu = explode('{MENUOPEN}', $page);
$pagetop = $menu[0];
$menu = explode('{MENUCLOSE}', $menu[1]);
$menubody = $menu[0];
$pagebottom = $menu[1];
$menukeys = array('{MENULINK}', '{MENUITEM}');
$result = db_get_menu();
$i = 0;
while($row = @mysql_fetch_array($result))
{
  if(isset($_SESSION['authname']) && ($row['menuname'] == 'Login' || $row['menuname'] == 'Register')){

  } else if(!isset($_SESSION['authname']) && ($row['menuname'] == 'Logout' || $row['menuname'] == 'Profile')){

  } else if($_SESSION['authlevel'] < 2 && $row['menuname'] == 'Admin'){

  } else 
  {  
  	$menuvalues = array($row['menulink'], $row['menuname']);
  	$menulist[$i] = str_replace($menukeys, $menuvalues, $menubody);
	if($pagetitle == $row['menuname']) {
	$menulist[$i] = strip_tags($menulist[$i], "<br>");
	}
 	$i++;
  }
}
$i = 0;
while(isset($menulist[$i])) {
$menubar .= $menulist[$i];
$i++;
}
return($pagetop.$menubar.$pagebottom);
}

function template_comment_list($page, $postid)
{
global $commentbody;
global $commentkeys;
$nocomment;
$comment = explode('{COMMENTOPEN}', $page);
$pagetop = $comment[0];
$comment = explode('{COMMENTCLOSE}', $comment[1]);
$commentbody = $comment[0];
$pagebottom = $comment[1];
$result = db_get_comments($postid);
$i = 0;
while($row = mysql_fetch_array($result)){
$commentage[$i] = template_comment($row);
$i++;
}
if(mysql_num_rows($result) == 0)
{
	$commentage[0] = "<br /><center>No Comments Added<center>";
}
$i = 0 ;
while(isset($commentage[$i])) {
$comments .= $commentage[$i];
$i++;
}
return($pagetop.$comments.$pagebottom);
}

function template_comment($row)
{
global $commentbody;
global $nocomment;
$commentkeys = array('{USERNAME}', '{URL}', '{COMMENTTIME}', '{COMMENT}', '{COMMENTDELETELINK}', '{COMMENTDELETE}');
if($row['userid'] == -1){
$user = $row['guestname'];
} else {
$user = db_get_user_details($row['userid']);
$user = $user['username'];
}
$delete = "";
if($_SESSION['authlevel'] >= 2){
$deletelink = "comment.php?p={$row['postid']}&d={$row['commentid']}";
$delete = "Delete Comment";
}
$commentvalues = array(stripslashes($user), $row['url'], date("j M Y g:ia", $row['time']), html_smilies(stripslashes($row['comment'])), $deletelink, $delete);
return(str_replace($commentkeys, $commentvalues, $commentbody));

}

function template_index($page)
{
global $sitename;
global $pagetitle;
global $postkeys;
global $postbody;
global $postnum;
if(isset($_SESSION['authname'])){
$welcome = "Welcome <b>".$_SESSION['authname']."</b>";
}
$keys = array('{SITENAME}', '{PAGETITLE}', '{WELCOME}');
$values = array($sitename, $pagetitle,  $welcome);
$page = str_replace($keys, $values, $page);
$postkeys = array('{POSTLINK}', '{POSTTITLE}', '{POSTUSER}', '{POSTTIME}', '{POSTTEXT}', '{COMMENTNUM}', '{COMMENTLINK}');
// split the template up
$post = explode('{POSTBODYOPEN}', $page);
$pagetop = $post[0];
$post = explode('{POSTBODYCLOSE}', $post[1]);
$postbody = $post[0];
$pagebottom = $post[1];
$result = db_get_posts($postnum); // pass a number to this function to specify the number of articles on the front page
$i = 0;
// parse each post
while($row = @mysql_fetch_array($result))
{
  $postage[$i] = template_post($row);
  $i++;
}
$i = 0;
while(isset($postage[$i])) {
$posts .= $postage[$i];
$i++;
}
return($pagetop.$posts.$pagebottom);
}

function template_entry($page, $postid)
{
global $sitename;
global $postkeys;
global $postbody;
if(isset($_SESSION['authname'])){
$welcome = "Welcome <b>".$_SESSION['authname']."</b>";
}
$row = db_get_this_post($postid);
$keys = array('{SITENAME}', '{PAGETITLE}', '{WELCOME}');
$values = array($sitename, $row['title'],  $welcome);
$page = str_replace($keys, $values, $page);
$postkeys = array('{POSTLINK}', '{POSTTITLE}', '{POSTUSER}', '{POSTTIME}', '{POSTTEXT}', '{COMMENTNUM}', '{COMMENTLINK}');
// split the template up
$post = explode('{POSTBODYOPEN}', $page);
$pagetop = $post[0];
$post = explode('{POSTBODYCLOSE}', $post[1]);
$postbody = $post[0];
$pagebottom = $post[1];
$postage = template_post($row);
return($pagetop.$postage.$pagebottom);
}

function template_post($row)
{
  global $postkeys;
  global $postbody;
  $num = db_get_num_comments($row['postid']);
  $user = db_get_user_details($row['userid']);
  $postvalues = array("index.php?p={$row['postid']}", stripslashes($row['title']), stripslashes($user['username']), date("j M Y g:ia", $row['time']), stripslashes($row['post']), $num, "comment.php?p={$row['postid']}");
  return(str_replace($postkeys, $postvalues, $postbody));
}

function template_archive($page)
{
global $sitename;
global $pagetitle;
global $postkeys;
global $postbody;
global $postnum;
$keys = array('{SITENAME}', '{PAGETITLE}');
$values = array($sitename, $pagetitle);
$postkeys = array('{POSTLINK}', '{POSTTITLE}', '{POSTUSER}', '{POSTTIME}');
// split the template up
$post = explode('{ARCHIVELISTOPEN}', $page);
$pagetop = $post[0];
$post = explode('{ARCHIVELISTCLOSE}', $post[1]);
$postbody = $post[0];
$pagebottom = $post[1];
$pagetop = str_replace($keys, $values, $pagetop);
if(!isset($_GET['perpage']))
{
	$_GET['perpage'] = 10;
	$_GET['page'] = 0;
}
$result = db_get_posts($_GET['perpage'], '', $_GET['page']+$postnum);  // pass a number to this function to specify the number of articles on the front page
$i = 0;
// parse each post
if(mysql_num_rows($result) > 0)
{
while($row = @mysql_fetch_array($result))
{
  $postage[$i] = template_post($row);
  $i++;
}
$i = 0;
while(isset($postage[$i])) {
$posts .= $postage[$i];
$i++;
}
}
else {
$posts = "<br /><br /><center>No archived posts</center><br /><br />";
$pagebottom = str_replace('{PAGINATE}', '', $pagebottom);
}
$page = $pagetop.$posts.$pagebottom;
$numposts = db_get_num_posts();
$totalpages = ceil(($numposts-$postnum)/10);
$paginate = pagination($totalpages, $_GET['perpage'], $_GET['page'], 'archive.php');
$page = str_replace('{PAGINATE}', $paginate, $page);

return($page);}

function template_generic($page)
{
global $sitename;
global $pagetitle;
global $errmesg;
$keys = array('{SITENAME}', '{PAGETITLE}', '{ERRMESG}');
$values = array($sitename, $pagetitle, $errmesg);
return(str_replace($keys, $values, $page));
}

function template_success($page)
{
global $sitename;
global $pagetitle;
global $errmesg;
global $template_dir;
$template = $template_dir."success.tpl";
$page = implode("", file($template));
$keys = array('{SITENAME}', '{PAGETITLE}', '{ERRMESG}');
$values = array($sitename, $pagetitle, $errmesg);
return(str_replace($keys, $values, $page));
}

function template_profile($page)
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
if($_SESSION['authlevel'] >= 2){
$page = $pagetop.$admin1[0].$admin1[1].$admin2[0].$pagebottom;
} else { 
$page = $pagetop.$admin1[1].$pagebottom;
}
return(str_replace($keys, $values, $page));

}

function template_copyright($page)
{
global $copyright;
return(str_replace('{COPY}', $copyright, $page));
}

function html_smilies($string)
{
	//The closing tag is a bollocks and i don't want to use regexp :(
	$html = array('<img src="images/smiles/icon_smile.gif">',
				  '<img src="images/smiles/icon_sad.gif">',
				  '<img src="images/smiles/icon_wink.gif">',
				  '<img src="images/smiles/icon_razz.gif">',
				  '<img src="images/smiles/icon_razz.gif">',
				  '<img src="images/smiles/icon_neutral.gif">',
				  '<img src="images/smiles/icon_biggrin.gif">',
				  '<img src="images/smiles/icon_lol.gif">',
				  '<img src="images/smiles/icon_evil.gif">',
				  '<img src="images/smiles/icon_cry.gif">',
				  );
	$bbcode = array(':)',':(',';)',':P',':p',':|',':D',':lol:',':evil:',':cry:');
    return(str_replace($bbcode, $html, $string));
}
?>
