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

{POSTBODYOPEN}  

<div class="posttitle">&raquo; <a href="{POSTLINK}">{POSTTITLE}</a></div>
<div class="timestamp">
		  <span class='time'>Posted by </span><span class='timename'>{POSTUSER}</span>
		  <span class='time'> - {POSTTIME}</span>

</div>

<div class='postbody'>{POSTTEXT}</div>
 {POSTBODYCLOSE}   
<div id='posttitle' align='right' class='posttitle'>Comments&nbsp;</div>
{COMMENTOPEN}

<div id='comment'><span class='time'>Posted by </span><span class='timename'>{USERNAME}</span>
		    <span class='time'> - {COMMENTTIME}</span><br/>{COMMENT}<br />
	  
	  <div align='right'><a href='{COMMENTDELETELINK}' class='comment'>{COMMENTDELETE}</a></div>
	  <br /></div><br />
{COMMENTCLOSE}
  <table class='main'>
<tr><td colspan='2' align="right"><div id='posttitle' class="posttitle">Add Comment&nbsp;</div><br /></td></tr>
<tr><td colspan='2' class='main'><div id='greynotice'><i>BBcode:</i> Use '[' and ']' instead of '<' and '>' to use hyperlinks, image, bold, italic tags.
 For example [b]<b>Bold</b>[/b]<br /></div></td></tr>
 <form action='comment.php?p={POSTID}' method='POST' class='main'>
  <input type='hidden' name='postid' value='{POSTID}'>
 <tr>
 <td>Comment:
 </td>
 <td>
 <input type='text' name='gusetname' maxlength='50'/> Name <br />
 <input type='text' name='url' maxlength='50'/> Website <i>Optional</i><br />
 <textarea name='comment' class='main' cols='54' rows='15' maxlength='1000'></textarea>
 </td>
 </tr>
  <tr><td colspan='2' align="right">Use BBcode<input type="checkbox" name="bbcode" value="true" checked></td></tr>
 <tr>
 <td align='center' colspan='2'>
 <input type='submit' value='Submit Post' class='button' >
 </td>
 </tr>
 </form>
 </table></div>
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
