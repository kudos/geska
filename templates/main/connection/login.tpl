<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME} :: {PAGETITLE} </title>
<link href="./templates/main/connection/style.css" rel="stylesheet" type="text/css">
</head>
<body id="rap">
<div>
	<div id="header">
		<ul id="topnav">
		{MENUOPEN}
    	<li><a href="{MENULINK}" id="nav{MENUITEM}">{MENUITEM}</a></li>
    	{MENUCLOSE}
		</ul>
		<h1><a href="index.php" title="{SITENAME}">{SITENAME}</a></h1>		
	</div>
	<div id="main">
		<div id="content">
<table class='content' align='center'>
	
{ERRMESG}
		<tr valign="top"><td colspan='2' width='65%'>Enter your username and password.</td>
		<td rowspan="7" width='35%' align="left"><div id='greynotice'>Not a member yet?<br /><a href='register.php'>Click here to register</a></div></td></tr>
            <form action='login.php' method='post' class='main'>
            <tr><td>Username: </td><td><input type='text' name='username' class='main' tabindex='1'></td></tr>
            <tr><td>Password: </td><td><input type='password' name='password' class='main' tabindex='2'></td></tr>
			<tr><td colspan='2'>Log me in automatically next time <input type='checkbox' name='autologin' class='main' tabindex='3' ><br /><br /></td></tr>
            <tr><td colspan='3' align='center'><input type='submit' value='Login' class='button' tabindex='4'></td>
</tr>
            </form>
		</table>
		</div>
	</div><center>{COPY}<br />Design ported from <a href="http://wpthemes.info" title="WP Themes.Info">WPThemes.Info</a></center>
</div>
</body>
</html>