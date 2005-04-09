<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>
{SITENAME} :: {PAGETITLE}
</title>
<link href="./templates/admin/style.css" rel="stylesheet" type="text/css">
<script language="javascript">
function validate()
{
	conf = confirm("Are you sure you want to delete this user?");
	if (conf)
		return true;
	else
		return false;
}
</script>
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
If you enter a new password it must be at least 6 characters long.<br />
<form action="users.php?userid={USERID}" method="POST" class="main">
<table border="0" cellpadding="3" cellspacing="3">
<tr><td width="100px">Name:</td><td><input type="text" name="username" class="main" value="{USERNAME}"></td></tr>
<tr><td>Password:</td><td><input type="password" name="password" class="main"></td></tr>
<tr><td>Password Again:</td><td><input type="password" name="password2" class="main"></td></tr>
<tr><td>e-mail:</td><td><input type="text" name="email" class="main" value="{EMAIL}"></td></tr>
{ADMINOPEN}
<tr><td>Userlevel:</td><td>
 <select name="userlevel" class="main">
 <option value="0" {USERCHECK}>User</option>
 <option value="2" {ADMINCHECK}>Admin</option>
 </select></td></tr>
{ADMINCLOSE}
</table>
<input type="submit" value="Edit" class="button"><br />
</form>

<form action="users.php" method="POST" class="main" onSubmit='return validate()'>
<input type="hidden" name="delete" value="{USERID}">
<input type="submit" value="Delete">
</form>
    
    </div>

    <div id="footer">
    {COPY}
    <br />Backend Design by <a href="http://www.ceruleandesigns.com/">Cerulean Designs</a>
    </div>
    
</div></div>
</body>
</html>
