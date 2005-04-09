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

{ARCHIVELISTOPEN}  

    <div class="sposttitle">&raquo; <a href="{POSTLINK}">{POSTTITLE}</a></div>
    <div class="timestamp">
	   <span class='time'>Posted by </span><span class='timename'>{POSTUSER}</span>
	   <span class='time'> - {POSTTIME}</span>
    </div>

{ARCHIVELISTCLOSE}

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
