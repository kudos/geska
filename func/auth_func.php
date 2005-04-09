<?php
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// ayth_func.php authorisation functions ////////////////////////////
// Copyright (C) 2005 Kudos www.joncremin.com ///////////////////////
// Licensed under the GPL ///////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

//
// Authorisation Functions
//



function auth_login($_POST)
{
  global $db_prefix;
  global $sitename;
  $username = escape_string($_POST['username']);
  $password = sha1($_POST['password']);
  $query = "SELECT * FROM ".$db_prefix."users WHERE username = '$username' && password = '$password'";
  $result = mysql_query($query);
  if(@mysql_num_rows($result) > 0)
  {
    $row = mysql_fetch_array($result);
    $_SESSION['authname'] = $row['username'];
	$_SESSION['password'] = $row['password'];
	$_SESSION['authlevel'] = $row['userlevel'];

	if($_POST['autologin'] == true)
	{ 
	setcookie($sitename.'_user', $row['username'], time()+60*60*24*30 );
	setcookie($sitename.'_pass', $row['password'], time()+60*60*24*30 );
	header("Location : index.php");
	}
	else{
	setcookie($sitename.'_user');
	setcookie($sitename.'_pass');
	header("Location : index.php");
	}
  }
  else
  return("Incorrect Username or password.");
}

function auth_auto_login()
{
  if(!isset($_SESSION['logout']))
  {
  global $db_prefix;
  global $sitename;
  $query = "UPDATE ".$db_prefix."users SET lastactive = '".date('Y-m-d G:i:s', time())."' WHERE username = '".@$_SESSION['authname']."'";
  mysql_query($query);
  if(!empty($_COOKIE[$sitename.'_user']) || !empty($_SESSION['authname']))
  {
    $query = "SELECT * FROM ".$db_prefix."users WHERE (username = '{$_SESSION['authname']}' || username = '{$_COOKIE[$sitename.'_user']}') && (password = '{$_SESSION['password']}' || password = '{$_COOKIE[$sitename.'_pass']}')";
    $result = mysql_query($query);
    if(mysql_num_rows($result) > 0)
    {
      $row = mysql_fetch_array($result);
      $_SESSION['authname'] = $row['username'];
	  $_SESSION['password'] = $row['password'];
      $_SESSION['authlevel'] = $row['userlevel'];
    }
	else {
	auth_logout();
	}
  }  
  }
}

function auth_logout()
{
  global $db_prefix;	
    $query = "UPDATE ".$db_prefix."users SET sessionid = '' WHERE username = '{$_SESSION['oldname']}'";
    @mysql_query($query);
	setcookie($sitename.'_user');
	setcookie($sitename.'_pass');
	if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
	session_destroy();
    }	
}

//blogger API validation
function validate_login($username, $password)
{
  global $db_prefix;
  $username = mysql_escape_string($username);
  $password = sha1($password);
  $query = "SELECT * FROM ".$db_prefix."users WHERE username = '$username' && password = '$password'";
  $result = mysql_query($query);
  if(@mysql_num_rows($result) > 0)
  {
    return(true);
  }
  else {
  return(false);
  }
}


?>
