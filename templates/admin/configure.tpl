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
<form method='POST' action='configure.php' class="main">
<table border="0" cellpadding="3" cellspacing="3">
<tr><td width="125px">Sitename: </td><td><input type="text" name="sitename" value="{SITENAME}"><td></tr>
<tr><td>Posts on frontpage: </td><td><input type='text' name='postnum' value='{POSTNUM}'></td></tr>
<tr><td>Server Root: </td><td><input type='text' name='server_root' value='{SERVERROOT}'><font color='red'> *</font></td></tr>
<tr><td>Base Url: </td><td><input type='text' name='base_url' value='{BASEURL}'><font color='red'> *</font></td></tr>
<tr><td>Theme: </td><td><select name='theme'>{SELECTTHEMEOPEN}
<option value='{THEME}'{SELECTED}>{THEME}</option>{SELECTTHEMECLOSE}
</select></td></tr><tr><td>
<input type='submit' value='Save'></td></tr>
</table>
</form>
    <i><font color='red'>*</font>(Change if you rename the geska folder, affects WYSIWYG editor)</i>
    </div>

    <div id="footer">
    {COPY}
    <br />Backend Design by <a href="http://www.ceruleandesigns.com/">Cerulean Designs</a>
    </div>
    
</div></div>
</body>
</html>
