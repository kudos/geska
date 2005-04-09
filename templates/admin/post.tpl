<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>
{SITENAME} :: {PAGETITLE}
</title>
<link href="./templates/admin/style.css" rel="stylesheet" type="text/css">
<script language="javascript">
function isthereatitle() {
 var titleis=document.theform.title.value;
 if (titleis !="") 
 {return true;}
 else alert ('Please enter a Title')
 return false;
}
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
    
<form action='{FORMURL}' method='POST' class='sposttitle' name='theform'>Title:  <input type='text' name='title' class='main' size='30' value='{TITLE}'><br /><br />
{WYSIWYG}
<br /><table><tr><td valign="top">
<input type='submit' name='publish' value='{MODEBUTTON} and Publish' class='button' align='right'></td><td valign="top">
<input type='submit' value='{MODEBUTTON}' class='button' align='right'></td><td valign="top">
</form>
{DELETE}</td></tr></table>
    
    </div>

    <div id="footer">
    {COPY}
    <br />Backend Design by <a href="http://www.ceruleandesigns.com/">Cerulean Designs</a>
    </div>
    
</div></div>
</body>
</html>
