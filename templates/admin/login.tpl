<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>
{SITENAME} :: {PAGETITLE}
</title>
<link href="./templates/admin/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrap1">
    <div id="header"><h1>{SITENAME}</h1></div>
    <div id="wrap2"><div id="wrap3">

    <div id="welcome">
        <div id="welcome-right">
                </div>
    </div>

    <div id="pad-wrap">
    
    <div id="menu">
            <div id="menutitle"><span style="display: none;">Menu</span></div>
            <div id="menu_area">
                {MENUOPEN}
                <a href="{MENULINK}" class="menu" title="Archives Posts">{MENUITEM}</a><br />
                {MENUCLOSE}
            </div>
    </div>


    <div id="content"> 

<div class="posttitle">&raquo; <a href="{POSTLINK}">Login</a></div>

<div class='postbody'>		
<table class='main' align='center'>
	
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
		</table></div>
</div>
    
    <div id="footer">

         <span class="copy">

{COPY}

</span>
    </div>

    </div>
    
    </div></div>
</div>
</body>
</html>
