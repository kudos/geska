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
	conf = confirm("Are you sure you want to delete this post?");
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
    
<form method='POST' action='publish.php'>
<table width='80%'><tr><td></td><td width='8%'>Publish?</td><td width='6%'>Edit?</td><td width='6%'>Delete?</td></tr>
{ARCHIVELISTOPEN}
    <tr><td><div class="sposttitle">&raquo; <a href="{POSTLINK}">{POSTTITLE}</a></div>
    <div class="timestamp">
		  <span class="time">Posted by </span><span class="timename">{POSTUSER}</span>
		  <span class="time"> - {POSTTIME}</span> </td><td align='right'>{CHECKBOX}</td><td align='center'> <a href="{POSTEDIT}"><img src="./templates/admin/img/editicon.gif" border='0'></a></td><td align='left'><a href="{POSTDELETE}" onClick='return validate()'><img src="./templates/admin/img/deleteicon.gif" border='0'></a></td></tr>
    </div>
{ARCHIVELISTCLOSE}

<br />
{POSTLIST}<tr><td colspan='3'><input type="hidden" name="mode" value="update"><input class="button" type="submit" value="Save Changes"></td></tr>
</table>
</form>
    
    </div>
<div align="center">{PAGINATE}</div>
    <div id="footer">
    {COPY}
    <br />Backend Design by <a href="http://www.ceruleandesigns.com/">Cerulean Designs</a>
    </div>
    
</div></div>
</body>
</html>
