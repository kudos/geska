<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title>{SITENAME} :: {PAGETITLE}</title>
<link rel="stylesheet" href="./templates/main/kubrick/style.css" type="text/css" media="screen" />
<style type="text/css" media="screen">
	body { background: url("./templates/main/kubrick/images/kubrickbgcolor.jpg"); }	 
	#page { background: url("./templates/main/kubrick/images/kubrickbg.jpg") repeat-y top; border: none; }
	#page { background: url("./templates/main/kubrick/images/kubrickbgwide.jpg") repeat-y top; border: none; } 
	#header { background: url("./templates/main/kubrick/images/kubrickheader.jpg") no-repeat bottom center; }
	#footer { background: url("./templates/main/kubrick/images/kubrickfooter.jpg") no-repeat bottom; border: none;}

/*	Because the template is slightly different, size-wise, with images, this needs to be set here
	If you don't want to use the template's images, you can also delete the following two lines. */
		
	#header 	{ margin: 0 !important; margin: 0 0 0 1px; padding: 1px; height: 198px; width: 758px; }
	#headerimg 	{ margin: 7px 9px 0; height: 192px; width: 740px; } 

/* 	To ease the insertion of a personal header image, I have done it in such a way,
	that you simply drop in an image called 'personalheader.jpg' into your /images/
	directory. Dimensions should be at least 760px x 200px. Anything above that will
	get cropped off of the image. */
	/*
	#headerimg { background: url('./templates/main/kubrick/images/personalheader.jpg') no-repeat top;}
	*/
</style>
</head>
<body>

<div id="page">


<div id="header">
	<div id="headerimg">
		<h1>{SITENAME}</a></h1>
		<div class="description"></div>
	</div>
</div>
<hr />
<div id="content" class="narrowcolumn"><br /><br />
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

	<div id="sidebar">
		<ul>
		<li><h2>Menu</h2>
		{MENUOPEN}
				<ul>
					<li><a href="{MENULINK}">{MENUITEM}</a></li>
				</ul>
		{MENUCLOSE}
		</li>
		</ul>
	</div>
	<hr />
<div id="footer">
	<p>{COPY}
	</p>
</div>
</div>
<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/kubrick/ -->
</body>
</html>