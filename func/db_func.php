<?php 
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// db_func.php database interface functions /////////////////////////
// Copyright (C) 2005 Kudos www.joncremin.com ///////////////////////
// Licensed under the GPL ///////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

//
// Function for connecting to a mysql database
//

function db_connect($host,$user,$pass,$database)
{
$connection = mysql_connect($host, $user, $pass, $database)
    or die("Couldn't connect to MySql");
return(mysql_select_db($database, $connection));

}

//
// Functions for database insertion
//

function db_add_user($_POST)
{
  global $db_prefix;
  $username = escape_string(strip_tags($_POST['username']));
  $password = strip_tags($_POST['password']);
  $password2 = strip_tags($_POST['password2']);
  $email = escape_string(strip_tags($_POST['email']));
  $date = date('Y-m-d G:i:s', time());
  if(empty($username) || empty($password) || empty($password2) || empty($email))
  {
	return('One or more fields were left blank.');
  }
  else
  {
	$query = "SELECT * FROM ".$db_prefix."users WHERE username = '$username'";
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
	{
	    return('Username taken. Please select another.');
	}
	else
	{  
	  if(strlen($username) < 3)
	  {
	    return('The username is too short. Must be at least 3 characters.');
	  }
	  else if($password != $password2)
	  {
	    return('The passwords do not match. Please try again.');
	  }
	  else if(strlen($password) < 6)
	  {
	    return('The password is too short. Must be at least 6 characters.');
	  }
	  else
	  {
	    $password = sha1($password);
        $query = "INSERT INTO ".$db_prefix."users (username, password, email, joined)
		          VALUES ('$username', '$password', '$email', '$date')";
	    mysql_query($query)
		  or die("Database problem");
	    return(true);
	  }
	}
  }
}

function db_add_post($_POST, $publish)
{
  global $db_prefix;
  $userid = db_get_userid($_SESSION['authname']);
  $time = time();
  $title = escape_string(trim(strip_tags($_POST['title'])));
  $post = escape_string($_POST['post']);
  $query = "INSERT INTO ".$db_prefix."posts (userid, time, title, post, active)
  VALUES ('$userid', '$time', '$title', '$post', '$publish')";
  mysql_query($query);
}

function db_add_post2($username, $title, $post, $publish)
{
  global $db_prefix;
  $userid = escape_string(db_get_userid($username));
  $time = time();
  $title = escape_string(trim(strip_tags($title)));
  $post = escape_string($post);
  $query = "INSERT INTO ".$db_prefix."posts (userid, time, title, post, active)
  VALUES ('$userid', '$time', '$title', '$post', '$publish')";
  mysql_query($query);
}

function db_add_comment($_POST, $postid)
{ 
  global $db_prefix;
  $postid = escape_string($postid);
  $guestname = escape_string($_POST['guestname']);
  $url = escape_string($_POST['url']);
  $time = time();
  $comment = escape_string(nl2br(trim(strip_tags($_POST['comment']))));
  $user = db_get_user_details(db_get_userid($guestname));
  if(isset($_SESSION['authname']) && !empty($comment))
  {
    $userid = db_get_userid($_SESSION['authname']);
    $query = "INSERT INTO ".$db_prefix."comments (postid, userid, time, comment)
    VALUES ('$postid', '$userid', '$time', '$comment')";
  }
  else if($guestname != $user['username'] && !empty($comment))
  {
    $url = str_replace('http://', '', $url);
    $query = "INSERT INTO ".$db_prefix."comments (postid, guestname, url, time, comment)
    VALUES ('$postid', '$guestname', '$url', '$time', '$comment')";
  } 
  mysql_query($query);
}

function db_add_log($page)
{
  global $db_prefix;
  @$fullreferrer = $_SERVER['HTTP_REFERER'];
  $uri = explode("/",$fullreferrer);
  @$referrer = $uri[2];
  $time = time();
  $date = date('Y-m-d G:i:s', $time);
  if ($referrer != $_SERVER["HTTP_HOST"])
  {
    $query = "INSERT INTO ".$db_prefix."logs (referrer, fullreferrer, time, ip, page)
	      VALUES ('$referrer', '$fullreferrer', '$date', '{$_SERVER['REMOTE_ADDR']}', '$page')";
    mysql_query($query);
  }
}

//
// Functions for database editing
//

function db_edit_user($_POST)
{
  global $db_prefix;
  $query = "SELECT * FROM ".$db_prefix."users WHERE userlevel = '2'";
  $result = mysql_query($query);
  $numadmin = mysql_num_rows($result);
  if($numadmin == 1 && $_POST['userlevel'] != 2){
  return("You must have at least one admin.");
  }
  $username = escape_string(trim(strip_tags($_POST['username'])));
  $password = trim(strip_tags($_POST['password']));
  $password2 = trim(strip_tags($_POST['password2']));
  $email = escape_string(trim(strip_tags($_POST['email'])));
  $query = "SELECT * FROM ".$db_prefix."users WHERE username = '$username' && userid != '{$_GET['userid']}'";
  $result = mysql_query($query);
  if(@mysql_num_rows($result) > 0)
  {
	return('The username you have entered is already in use.');
  }
  else if($password != $password2)
  {
	return('The passwords do not match. Please try again.');
  }
  else if(strlen($password) < 6 && strlen($password) > 0)
  {
	return('The password is too short. Must be at least 6 characters.');
  }
  else if($_SESSION['authlevel'] >= 2)
  {
    if( strlen($username) < 3)
	{
	  return('The username is too short. Must be at least 3 characters.');
	}
	else if(strlen($password) == 0) 
	{
	  $userid = db_get_userid($_SESSION['authname']);
          $query = "UPDATE ".$db_prefix."users SET username = '$username', email = '$email', userlevel = '{$_POST['userlevel']}' WHERE userid = '{$_GET['userid']}'";
	  mysql_query($query);
	  return(true);
	}
	else
	{
	  $password = sha1($password);
	  $userid = db_get_userid($_SESSION['authname']);
      $query = "UPDATE ".$db_prefix."users SET username = '$username', password = '$password', email = '$email', userlevel = '{$_POST['userlevel']}' WHERE userid = '{$_GET['userid']}'";
	  mysql_query($query);
	  return(1);
	}
  }
  else
  {
    if(strlen($password) == 0) 
	{
      $query = "UPDATE ".$db_prefix."users SET email = '$email' WHERE userid = '{$_GET['userid']}'";
	  return(1);
	}
	else
	{
	  $password = sha1($password);
      $query = "UPDATE ".$db_prefix."users SET password = '$password', email = '$email' WHERE userid = '{$_GET['userid']}'";
	  mysql_query($query);
	  return(1);
	}
  }
}

function db_edit_post($_POST, $postid, $publish)
{
  global $db_prefix;
  $title = escape_string(strip_tags($_POST['title']));
  $post = escape_string($_POST['post']);
  $query = "UPDATE ".$db_prefix."posts SET title = '$title', 
            post = '$post', active = '$publish' WHERE postid = '$postid'";
  mysql_query($query);
}

function db_update_config($_POST)
{
  global $db_prefix;
  $_POST['sitename'] = escape_string($_POST['sitename']);
  $_POST['server_root'] = escape_string($_POST['server_root']);
  $_POST['base_url'] = escape_string($_POST['base_url']);
  $_POST['theme'] = escape_string($_POST['theme']);
  $query = "UPDATE ".$db_prefix."config SET sitename = '{$_POST['sitename']}', postnum = '{$_POST['postnum']}', server_root = '{$_POST['server_root']}', base_url = '{$_POST['base_url']}', theme = '{$_POST['theme']}'";
$result = mysql_query($query);
if($result) return("Updated Successfully");
else return("Error Updating Config");
}

function db_update_publish($postid, $active)
{
	global $db_prefix;
	$postid = escape_string($postid);
	if($active == 'on')
	{
		$active = 1;
	} else $active = 0;
  	$query = "UPDATE ".$db_prefix."posts SET active = '$active' WHERE postid = '$postid'";
  	mysql_query($query)
  	or die(mysql_error());
}

//
// Functions for database deletion
//

function db_delete_user($userid)
{
  global $db_prefix;
  $userid = escape_string($userid);
  $query = "SELECT * FROM ".$db_prefix."users WHERE userlevel = '2'";
  $result = mysql_query($query);
  $numadmin = mysql_num_rows($result);
  if($numadmin == 1 && $_POST['userlevel'] != 2){
  return("You must have at least one admin.");
  }
  $query1 = "UPDATE ".$db_prefix."users SET userlevel = '-2' WHERE userid = '$userid'";
  mysql_query($query1);
  return(1);
}

function db_delete_post($postid)
{
  global $db_prefix;
  $postid = escape_string($postid);
  $query = "DELETE FROM ".$db_prefix."comments WHERE postid = '$postid'";
  mysql_query($query);
  $query2 = "DELETE FROM ".$db_prefix."posts WHERE postid = '$postid'";
  mysql_query($query2);
}

function db_delete_comment($commentid)
{
  global $db_prefix;
  $commentid = escape_string($commentid);
  if($_SESSION['authlevel'] >= 2)
  {
    $query = "DELETE FROM ".$db_prefix."comments WHERE commentid = '$commentid'";
	mysql_query($query);
  }
}

//
// Functions for database retrieval
//

function db_get_posts($num = 6, $active = "WHERE active = '1'", $page = 0)
{
  global $db_prefix;
  $active = $active;
  $query = "SELECT * FROM ".$db_prefix."posts $active ORDER BY time DESC";
  if($num > 0) $query.= " LIMIT $page,$num";
  $result = mysql_query($query);
  return($result);
}

function db_get_this_post($postid, $active = 0 )
{
  global $db_prefix;
  $postid = escape_string($postid);
  $query = "SELECT ".$db_prefix."posts.*, ".$db_prefix."users.username, ".$db_prefix."users.userid FROM ".$db_prefix."posts, ".$db_prefix."users WHERE ".$db_prefix."posts.postid = '$postid' && ".$db_prefix."users.userid = ".$db_prefix."posts.userid";
  if($active == 1) $query .= " && ".$db_prefix."posts.active = '1'";
  
  $result = mysql_query($query);
  return(mysql_fetch_array($result));
}

function db_get_userid($username)
{
  global $db_prefix;
  $username = escape_string($username);
  $query = "SELECT userid FROM ".$db_prefix."users WHERE username = '$username' && userlevel >= 0";
  $result = mysql_query($query);
  $user = (mysql_fetch_array($result));
  return($user['userid']);
}

function db_get_user_details($userid)
{
  global $db_prefix;
  $query = "SELECT * FROM ".$db_prefix."users WHERE userid = '$userid' && userlevel >= 0";
  $result = mysql_query($query);
  return(mysql_fetch_array($result));
}

function db_get_num_comments($postid)
{
  global $db_prefix;
  $postid = escape_string($postid);
  $query = "SELECT * FROM ".$db_prefix."comments WHERE postid = '$postid'";
  $result = mysql_query($query);
  return(mysql_num_rows($result));
}

function db_get_comments($postid)
{
  global $db_prefix;
  $postid = escape_string($postid);
  $query = "SELECT ".$db_prefix."comments.* FROM ".$db_prefix."posts, ".$db_prefix."comments WHERE ".$db_prefix."posts.postid = '$postid' && ".$db_prefix."comments.postid = '$postid'";
  $result = mysql_query($query);
  return($result);
}

/*function db_get_logs($date, $pagenum, $perpage)
{
  global $db_prefix;
  $query = "SELECT * FROM ".$db_prefix."logs WHERE time like '%$date%' ORDER BY time DESC LIMIT $pagenum, $perpage";
  $result = mysql_query($query);
  return($result);
}*/

/*function db_get_num_logs($date)
{
  global $db_prefix;
  $query = "SELECT * FROM ".$db_prefix."logs WHERE time like '%$date%'";
  $result = mysql_query($query);
  return(mysql_num_rows($result));
}*/

function db_get_site_settings()
{

  global $server_root;
  global $postnum;
  global $sitename;
  global $spaw_base_url;
  global $db_prefix;
  global $spaw_root;
  global $spaw_dir;
  global $fck_root;
  global $fck_dir;
  global $fck_base_url;
  global $template_dir;
  global $template_admin_dir;
  global $theme;
  $query = "SELECT * FROM ".$db_prefix."config";
  $result = mysql_query($query)
  or die(mysql_error());
  $row = mysql_fetch_assoc($result);
  $theme = stripslashes($row['theme']);
  $server_root = stripslashes($row['server_root']);
  $postnum = stripslashes($row['postnum']);
  $sitename = stripslashes($row['sitename']);
  $spaw_dir = 'spaw/';
  $fck_dir = 'fck/';
  $spaw_base_url = $row['base_url'];
  $fck_base_url = $spaw_base_url;
  $fck_root = $server_root.$fck_dir;
  $spaw_root = $server_root.$spaw_dir;
  $template_dir = "templates/main/$theme/";
  $template_admin_dir = "templates/admin/";
}

function db_get_menu()
{
  global $db_prefix;
  $query = "SELECT * FROM ".$db_prefix."menu ORDER BY menuid ASC";
  $result = mysql_query($query);
  return($result);
}

function db_get_admin_menu()
{
  global $db_prefix;
  $query = "SELECT * FROM ".$db_prefix."admin_menu ORDER BY menuid ASC";
  $result = mysql_query($query);
  return($result);
}

function db_get_num_posts($published = 1)
{
  global $db_prefix;
  $query = "SELECT * FROM ".$db_prefix."posts";
  if($published != 'all') $query .= " WHERE active = '$published'";
  
  $result = mysql_query($query);
  $numposts = mysql_num_rows($result);
  return($numposts);
}


?>
