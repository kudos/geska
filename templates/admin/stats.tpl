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
    
    <table border="0" cellpadding="3" cellspacing="3">
    <tr><td width="125">Registered Users:</td><td>{REGUSERS}</td></tr>
    <tr><td>Newest User:</td><td>{NEWESTUSER}</td></tr>
    <tr><td>Last Active:</td><td>{LASTACTIVE}</td></tr>
    <tr><td>Posts Published:</td><td>{POSTSPUB}</td></tr>
    <tr><td>Posts Pending:</td><td>{POSTSPEN}</td></tr>
    <tr><td>Total Posts:</td><td>{TOTALPOSTS}</td></tr>
    <tr><td>Total Comments:</td><td>{TOTALCOMMENTS}</td></tr>
    </table>
    </div>

    <div id="footer">
    {COPY}
    <br />Backend Design by <a href="http://www.ceruleandesigns.com/">Cerulean Designs</a>
    </div>
    
</div></div>
</body>
</html>
