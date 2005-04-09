<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title>{SITENAME} :: {PAGETITLE}</title>
<link rel="stylesheet" href="./templates/main/kubrick/style.css" type="text/css" media="screen" />
<style type="text/css" media="screen">
	body { background: url("./templates/main/kubrick/images/kubrickbgcolor.jpg"); }	 
	#page { background: url("./templates/main/kubrick/images/kubrickbg.jpg") repeat-y top; border: none; }
	#page { background: url("./templates/main/kubrick/images/kubrickbgwide.jpg") repeat-y top; border: none; } 
	#header { background: url("./templates/main/kubrick/images/kubrickheader.jpg") no-repeat bottom center; }
	#footer { background: url("./templates/main/kubrick/images/kubrickfooter.jpg") no-repeat bottom; border: none;}
	.post { background: url("./templates/main/kubrick/images/bar.gif") no-repeat bottom center; border: none;}

/*	Because the template is slightly different, size-wise, with images, this needs to be set here
	If you don't want to use the template's images, you can also delete the following two lines. */
		
	#header 	{ margin: 0 !important; margin: 0 0 0 1px; padding: 1px; height: 198px; width: 758px; }
	#headerimg 	{ margin: 7px 9px 0; height: 192px; width: 740px; } 

/* 	To ease the insertion of a personal header image, I have done it in such a way,
	that you simply drop in an image called 'personalheader.jpg' into your /images/
	directory. Dimensions should be at least 760px x 200px. Anything above that will
	get cropped off of the image. */
	/*
	#headerimg { background: url('./templates/main/kubrick/images/personalheader.jpg') no-repeat top;}
	*/
</style>
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
<body>

<div id="page">


<div id="header">
	<div id="headerimg">
		<h1>{SITENAME}</a></h1>
		<div class="description"></div>
	</div>
</div>
<hr />
<div id="content" class="narrowcolumn">
		{POSTBODYOPEN}
			<div class="post" id="post-{POSTTITLE}">
				<h2><a href="{POSTLINK}">{POSTTITLE}</a></h2>
				<small>{POSTTIME} {POSTUSER}</small>
				
				<div class="entry">
					{POSTTEXT}
				</div><br />
			</div>
		{POSTBODYCLOSE}
		<h3 id="comments">Comments</h3> 

	<ol class="commentlist">{COMMENTOPEN}
		<li class="{ALT}" id="comment-{COMMENTID}">
			<cite>{USERNAME}</cite> Says:
			<br />
			<small class="commentmetadata"><a href="#comment-{COMMENTID}" title="">{COMMENTTIME}</a> <a href='{COMMENTDELETELINK}' class='comment' onClick='return validate()'>{COMMENTDELETE}</a></small>

			{COMMENT}

		</li>{COMMENTCLOSE}
	</ol><h3 id="respond">Leave a Reply</h3>
<form action="comment.php?p={POSTID}" method="post" id="commentform"> 
<input type='hidden' name='postid' value='{POSTID}'>
<input type='text' name='guestname' maxlength='50' size="40" value='{AUTHNAME}' {DISABLE} /> Name<br />
<input type='text' name='url' maxlength='50' size="40" {DISABLE} /> Website <i>(Optional)</i><br />
<textarea name='comment' id="comment" cols="100%" rows="10" maxlength='3000'></textarea>
<input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
</form>
	</div>

	<div id="sidebar">
		<ul>
		<li><h2>Menu</h2>
		{MENUOPEN}
				<ul>
					<li><a href="{MENULINK}">{MENUITEM}</a></li>
				</ul>
		{MENUCLOSE}
		</li>
		</ul>
	</div>
	<hr />
<div id="footer">
	<p>{COPY}
	</p>
</div>
</div>
<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/kubrick/ -->
</body>
</html>