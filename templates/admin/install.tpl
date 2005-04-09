<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>
{SITENAME} :: {PAGETITLE}
</title>
<link href="./templates/admin/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrapout"><div id="wrap1">
    <div id="header1"><div id="header2">
        <div class="nodisplay">Geska</div>
    </div></div>

    <div id="site-name">{SITENAME}</div>

    <div id="admin-menu">
    <div id="a-head"><div class="nodisplay">Editor Options</div></div>
    {ADMINMENUOPEN}
    <a href='{ADMINMENULINK}'>{ADMINMENUITEM}</a><br />
    {ADMINMENUCLOSE}
    </div>

    <div id="editable">
    <div id="e-head"><div id="e-head-left">{PAGETITLE}</div></div>
    
{ERRMESG}
<form method="POST" action="install.php" class="main">
<table border="0" cellpadding="3" cellspacing="3">
<tr><td width="125px">Username:</td><td><input type="text" name="username" value="{USERNAME}"><td></tr>
<tr><td>Password:</td><td><input type="password" name="password"></td></tr>
<tr><td>Password Again:</td><td><input type="password" name="password2"></td></tr>
<tr><td>Email:</td><td><input type="text" name="email" value="{EMAIL}"></td></tr>
<tr><td>Sitename:</td><td><input type="text" name="sitename" value="{SITENAMEFORM}"></td></tr>
<tr><td>Posts on frontpage:</td><td><input type="text" name="postnum" value="{POSTNUM}"></td></tr>
<tr><td><input type="submit" value="Install" class="button"></td></tr>
</table>
</form>
    
    </div>

    <div id="footer">
    {COPY}
    <br />Backend Design by <a href="http://www.ceruleandesigns.com/">Cerulean Designs</a>
    </div>
    
</div></div>
</body>
</html>
