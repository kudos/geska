<html>
<head><title>
{SITENAME} :: {PAGETITLE} 
</title>
<link href="./templates/main/default/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="./images/favicon.ico" />
</head>
<body>
<div id="wrap1">
    <div id="header"><h1>{SITENAME}</h1></div>
    <div id="wrap2"><div id="wrap3">

    <div id="wrap4">
        <div id="welcome">
            <div id="welcome-right">
            {WELCOME}
            </div>
        </div>
    </div>
    
    <div id="pad-wrap">
    
        <div id="menu">
            <div id="menutitle"><span style="display: none;">Menu</span></div>
            <div id="menu_area">
                {MENUOPEN}
                <a href="{MENULINK}" class="menu">{MENUITEM}</a><br />
                {MENUCLOSE}
            </div>
        </div>


        <div id="content">

            {POSTBODYOPEN}

            <div class="posttitle">&raquo; <a href="{POSTLINK}">{POSTTITLE}</a></div>
            <div class="timestamp">
            		  <span class='time'>Posted by </span><span class='timename'>{POSTUSER}</span>
            		  <span class='time'> - {POSTTIME}</span>

            </div>

            <div class="postbody">{POSTTEXT}</div>
            <div align="right" class="time"><span class="comment"><span class="timename">{COMMENTNUM}</span> 
			<a href="{COMMENTLINK}" class="comment" title="Add/View Comments">Comment(s)</a></span></div> 
			{POSTBODYCLOSE}

        </div>

        <div id="footer" class="copy">
                {COPY}
                <br />Design by <a href="http://www.ceruleandesigns.com/">Cerulean Designs</a>
        </div>
        
    </div>
    
    </div></div>
</div>
</body>
</html>
