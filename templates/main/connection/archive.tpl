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
		<h2>Archives</h2>
			{ARCHIVELISTOPEN}
			<div class="post">
				
				<div class="post-info">
					<h2 class="post-title"><a href="{POSTLINK}">{POSTTITLE}</a></h2>{POSTTIME}<br />
					Posted by {POSTUSER}
				</div>
			</div>
			{ARCHIVELISTCLOSE}
		</div>
		<div align="center">{PAGINATE}</div>
	</div><center>{COPY}<br />Design ported from <a href="http://wpthemes.info" title="WP Themes.Info">WPThemes.Info</a></center>
</div>
</body>
</html>