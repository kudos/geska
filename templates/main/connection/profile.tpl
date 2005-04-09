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
{ERRMESG}
<table width='100%'>
 <form action='profile.php?action=edit&userid={USERID}' method='POST'>
 <tr valign="top">
 {ADMINOPEN}<td align='right'>Name: </td><td align='left'><input type='text' name='username' value='{USERNAME}'> </td>{ADMINCLOSE}
 <td rowspan="7" width='30%' align="left">
 <div id='greynotice' align='center'>If you enter a new password it must be at least 6 characters long.<br /></div>
 </td>
 </tr>
 </tr>
 <tr>
 <td align='right'>Password:
 </td>
 <td >
  <input type='password' name='password' class='main'>
 </td>
 </tr>
 <tr>
 <td align='right'>Password Again:
 </td>
 <td >
  <input type='password' name='password2' class='main'>
 </td>
 </tr>
 <tr>
 <td align='right'>e-mail:
 </td>
 <td >
  <input type='text' name='email' class='main' value="{EMAIL}">
 </td>
 </tr>
{ADMINOPEN}<tr>
 <td align='right'>Userlevel</td>
 <td align='left'>
 <select name='userlevel' class='main'>
 <option value='0' {USERCHECK}>User</option>
 <option value='2' {ADMINCHECK}>Admin</option>
 </select>
 </td>
 </tr>{ADMINCLOSE}
 <tr>
 <td align='center' colspan='3'>
 <input type='submit' value='Edit' class='button'><br /><br />
 </td>
 </tr>
 </form>
 </td></tr>
 </table>
		</div>

	</div><center>{COPY}<br />Design ported from <a href="http://wpthemes.info" title="WP Themes.Info">WPThemes.Info</a></center>
</div>
</body>
</html>