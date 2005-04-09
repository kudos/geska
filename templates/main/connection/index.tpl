<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME} :: {PAGETITLE} </title>
<link href="./templates/main/connection/style.css" rel="stylesheet" type="text/css">
</head>
<body id="rap">
<div>
	<div id="header">
		<ul id="topnav">
		{MENUOPEN}
    	<li><a href="{MENULINK}" id="nav{MENUITEM}">{MENUITEM}</a></li>
    	{MENUCLOSE}
		</ul>
		<h1><a href="index.php" title="{SITENAME}">{SITENAME}</a></h1>		
	</div>
	<div id="main">
		<div id="content">
			{POSTBODYOPEN}
			<div class="post">
				<p class="post-date">{POSTTIME}</p>
				<div class="post-info">
					<h2 class="post-title"><a href="{POSTLINK}">{POSTTITLE}</a></h2>
					Posted by {POSTUSER}<br/>{COMMENTNUM} <a href="{COMMENTLINK}">Comment(s)</a>
				</div>
				<div class="post-content">
					{POSTTEXT}
					
				</div>
			</div>
			{POSTBODYCLOSE}
		</div>
	</div><center>{COPY}<br />Design ported from <a href="http://wpthemes.info" title="WP Themes.Info">WPThemes.Info</a></center>
</div>
</body>
</html>