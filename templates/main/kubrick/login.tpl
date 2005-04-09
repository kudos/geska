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