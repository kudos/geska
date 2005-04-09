<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME} :: {PAGETITLE} </title>
<link href="./templates/main/connection/style.css" rel="stylesheet" type="text/css">
<script language="javascript">
function validate()
{
	conf = confirm("Are you sure you want to delete this comment?");
	if (conf)
		return true;
	else
		return false;
}
</script>
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
			{POSTBODYCLOSE}<h3 id="comments">Comments</h3><ol class="commentlist">
			{COMMENTOPEN}
<li class="{ALT}" id="comment-{COMMENTID}"><cite>{USERNAME}</cite> Says: 
<small class="commentmetadata"><a href="#comment-{COMMENTID}" title="">{COMMENTTIME}</a> 
<a href='{COMMENTDELETELINK}' class='comment' onClick='return validate()'>{COMMENTDELETE}</a></small>

			{COMMENT}

		</li>

{COMMENTCLOSE}<h3 id="respond">Leave a Reply</h3>
<table>
<form action="comment.php?p={POSTID}" method="post" id="commentform"> 
<input type='hidden' name='postid' value='{POSTID}' /><tr><td align='left'>
<input type='text' name='guestname' maxlength='50' size="40" value='{AUTHNAME}' {DISABLE} /> Name</td></tr><tr><td align='left'>
<input type='text' name='url' maxlength='50' size="40" {DISABLE} /> Website <i>(Optional)</i></td></tr><tr><td align='left'>
<textarea name='comment' id="comment" cols="30" rows="10" maxlength='3000'></textarea></td></tr><tr><td align='left'>
<input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" /></td></tr>
</form></table>
		</div>
	</div><center>{COPY}<br />Design ported from <a href="http://wpthemes.info" title="WP Themes.Info">WPThemes.Info</a></center>
</div>
</body>
</html>