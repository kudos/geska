<?php
////////////////////////////////////////
//        Blogger API Warpper         //
//       bios at bios dot org         //
////////////////////////////////////////
//
//
//
//
//
//
//
//





/////////////////////////////////////////
//          Stuff for Geska            //
/////////////////////////////////////////
require_once("../db_config.php");
require_once("../func/db_func.php");
require_once("../func/auth_func.php");
require_once("../func/misc_func.php");
db_connect($host,$user,$pass,$database);
db_get_site_settings();


/////////////////////////////////////////


require_once("xml.inc.php");//XMLRPC lib, slightly changed to work with a php with --enable-xmlrpc and to work with php5
$xmlrpc_methods = array();
$xmlrpc_methods['blogger.getUsersBlogs']  = 'blogger_getUsersBlogs';//done, only returns the site title really
$xmlrpc_methods['blogger.getUserInfo']    = 'blogger_getUserInfo';//done, nothing seems to use so untested
$xmlrpc_methods['blogger.getRecentPosts'] = 'blogger_getRecentPosts';//done, loads lists of posts with proper id
$xmlrpc_methods['blogger.newPost']        = 'blogger_newPost';//done, posts, not the greatest title stripping but every tested client works
$xmlrpc_methods['blogger.editPost']       = 'blogger_editPost';//done, works but some clients return an error after posting
$xmlrpc_methods['blogger.getPost']        = 'blogger_getPost';//NOT DONE--- no client i have used uses this, maybe later
$xmlrpc_methods['blogger.deletePost']    = 'blogger_deletePost';//done
$xmlrpc_methods['method_not_found']       = 'XMLRPC_method_not_found';//works but doesn't give you the called meothd

///////////////////////////////////
//          DEBUG                //
///////////////////////////////////
//$handle = fopen('output.txt', 'w');//outputs http headers to file, ie: what the client is sending
//fwrite($handle,$HTTP_RAW_POST_DATA );
////////////////////////////////////






$xmlrpc_request = XMLRPC_parse($HTTP_RAW_POST_DATA);
$methodName = XMLRPC_getMethodName($xmlrpc_request);
$params = XMLRPC_getParams($xmlrpc_request);







if(!isset($xmlrpc_methods[$methodName])){
	$xmlrpc_methods['method_not_found']($methodName);
}else{
	$xmlrpc_methods[$methodName]($params);
}



function blogger_getUsersBlogs($args)
{
	global $db_prefix;
	global $sitename;
	global $spaw_base_url;
	$username =$args[1];
	$password = sha1($args[2]);
	$query = "SELECT * FROM ".$db_prefix."users WHERE username = '$username' && password = '$password' && userlevel = '2'";
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
	{	
		$row = mysql_fetch_assoc($result);
		$posts = array();
		$post['isAdmin']=$row['userid'];
		$post['url']= $spaw_base_url;      
		$post['blogName'] = $sitename;
		$post['blogid'] = "1";
		$posts[] = $post;
		
		
		XMLRPC_response(XMLRPC_prepare($posts), WEBLOG_XMLRPC_USERAGENT);
		
	}
	else
	{
		XMLRPC_error("2", "Username or Password is incorrect in getUsersBlogs.", WEBLOG_XMLRPC_USERAGENT);
	}
}

function blogger_getUserInfo($args)
{
	global $db_prefix;
	global $sitename;
	global $spaw_base_url;
	$username = mysql_escape_string($args[1]);
	$password = sha1($args[2]);
	$query = "SELECT * FROM ".$db_prefix."users WHERE username = '$username' && password = '$password' && userlevel = '2'";
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
	{	
		$row = mysql_fetch_assoc($result);
		$posts = array();
		$post['nickname']=$row['username']; 
		$post['userid']=$row['userid'];      
		$post['url'] =$spaw_base_url;
		$post['email'] = $row['email'];
		$post['lastname']="";     
		$post['firstname'] = $sitename;
		$posts[] = $post;
		
		XMLRPC_response(XMLRPC_prepare($posts), WEBLOG_XMLRPC_USERAGENT);
	}
	else
	{
		XMLRPC_error("2", "Username or Password is incorrect.", WEBLOG_XMLRPC_USERAGENT);
	}
	
}

function blogger_getRecentPosts($args)
{
	global $db_prefix;
	$numposts = mysql_escape_string($args[4]);
	$username = mysql_escape_string($args[2]);
	$password = sha1($args[3]);
	$query = "SELECT * FROM ".$db_prefix."users WHERE username = '$username' && password = '$password' && userlevel = '2'";
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
	{	
		
		$result = mysql_query("SELECT postid, time, title, post FROM ".$db_prefix."posts ORDER BY time DESC");
		$posts = array();
		while($row = mysql_fetch_array($result))
		{
			$post[]= array(
						   'userid' => '1',
						   'dateCreated' => XMLRPC_convert_timestamp_to_iso8601($row['time']),
						   'content' => $row['post'],
						   'postid' => (string)$row['postid'],);
		}
		
		$posts = array();
		for ($j=0; $j<count($post); $j++)
		{
			array_push($posts, $post[$j]);
		}
		XMLRPC_response(XMLRPC_prepare($posts), WEBLOG_XMLRPC_USERAGENT);
	}
	else
	{
		XMLRPC_error("2", "Username or Password is incorrect.", WEBLOG_XMLRPC_USERAGENT);
	}
	
}

function blogger_newPost($args)
{
	global $db_prefix;
	$postid = mysql_escape_string($args[1]);
	$username = mysql_escape_string($args[2]);
	$password = sha1($args[3]);
	$content    = trim($args[4]);
	$publish    = $args[5];
	$query = "SELECT * FROM ".$db_prefix."users WHERE username = '$username' && password = '$password' && userlevel = '2'";
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
	{	
		
		if (substr($content,0,7)== "<title>")
		{
			$thetitle = substr($content,7,(strpos($content,"</title>")-7));
			$content = substr_replace($content, '', 0,(strpos($content,"</title>")));
		}
		
		elseif ( substr($content,0,7)== "<Title>")
	{
			$thetitle = substr($content,7,(strpos($content,"</Title>")-7));
			$content = substr_replace($content, '', 0,(strpos($content,"</title>")));
	}
		elseif (substr($content,0,7)== "<TITLE>")
	{
			$thetitle = substr($content,7,(strpos($content,"</TITLE>")-7));
			$content = substr_replace($content, '', 0,(strpos($content,"</title>")));
	}
		elseif ((strpos($content,"\n")))
	{
			$thetitle = substr($content,0,(strpos($content,"\n")));
			$content = substr_replace($content, '', 0,(strpos($content,"\n")));
	}
		else
		{
			$thetitle = substr($content,0,(strpos($content,"\r")));
			$content = substr_replace($content, '', 0,(strpos($content,"\r")));
		}	
		$query = "INSERT INTO ".$db_prefix."posts (userid, time, title, post, active) VALUES ('".db_get_userid($username)."', '".time()."','".trim($thetitle)."', '".mysql_escape_string(trim($content))."','".mysql_escape_string((int)$publish)."')";
		$result = mysql_query($query);
		$query = "SELECT * FROM ".$db_prefix."posts WHERE  post = '".trim($content)."'";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		
		$posts = (int)$row['postid'];
		XMLRPC_response(XMLRPC_prepare($posts), WEBLOG_XMLRPC_USERAGENT);
	}
	else
	{
		XMLRPC_error("2", "Posting failed bai.", WEBLOG_XMLRPC_USERAGENT);
	}
}

function blogger_editPost($args)
{
	global $db_prefix;
	$postid = mysql_escape_string($args[1]);
	$username = mysql_escape_string($args[2]);
	$password = sha1($args[3]);
	$content = mysql_escape_string(trim($args[4]));
	$publish = mysql_escape_string($args[5]);
	$query = "SELECT * FROM ".$db_prefix."users WHERE username = '$username' && password = '$password' && userlevel = '2'";
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
		if(mysql_num_rows($result) > 0)
		{	
			if (substr($content,0,7)== "<title>" || substr($content,0,7)== "<Title>" || substr($content,0,7)== "<TITLE>")
			{
				$thetitle = substr($content,7,(strpos($content,"</title>")-7));
				$content = substr_replace($content, '', 0,(strpos($content,"</title>")));
			}
			elseif ((strpos($content,"\n")))
		{
				$thetitle = substr($content,0,(strpos($content,"\n")));
				$content = substr_replace($content, '', 0,(strpos($content,"\n")));
		}
			else
			{
				$thetitle = substr($content,0,(strpos($content,"\r")));
				$content = substr_replace($content, '', 0,(strpos($content,"\r")));
			}	
			
			$query = "UPDATE ".$db_prefix."posts SET title = '".$thetitle."', SET post = '".$content."', SET active = '".(int)$publish." ' WHERE postid = '".$postid."'";
			$result = mysql_query($query);
			
			$posts = (boolean)1;			
			XMLRPC_response(XMLRPC_prepare($posts), WEBLOG_XMLRPC_USERAGENT);
		}
			else
			{
				XMLRPC_error("2", "Username or Password is incorrect.", WEBLOG_XMLRPC_USERAGENT);
			}
			
}


function blogger_deletePosts($args)
{
	global $db_prefix;
	$postid = mysql_escape_string($args[1]);
	$username = mysql_escape_string($args[2]);
	$password = sha1($args[3]);
	$query = "SELECT * FROM ".$db_prefix."users WHERE username = '$username' && password = '$password' && userlevel = '2'";
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
	{	
		
		db_delete_post($postid);
		XMLRPC_response(XMLRPC_prepare($postid), WEBLOG_XMLRPC_USERAGENT);
	}
	else
	{
		XMLRPC_error("2", "Username or Password is incorrect.", WEBLOG_XMLRPC_USERAGENT);
	}
	
}






function XMLRPC_method_not_found($met)
{
	//$cool[4]="<>FUCKERSSSSSSSSSSSS";
	//$cool[2]="kudos";
	//$cool[3]="asdasd";
	//blogger_newPost($cool);
	XMLRPC_error("2", "can't find,". XMLRPC_prepare($met).", in list.", WEBLOG_XMLRPC_USERAGENT);
}

?>