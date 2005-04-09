<html>
<head><title>
{SITENAME} :: {PAGETITLE} 
</title>
<link href="./templates/main/default/style.css" rel="stylesheet" type="text/css">
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
<div id="wrap1">
    <div id="header"><h1>{SITENAME}</h1></div>
    <div id="wrap2"><div id="wrap3">

    <div id="wrap4">
        <div id="welcome">
            <div id="welcome-right">

            </div>
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

<div id='comment'><span class='time'>Posted by </span><span class='timename'><a href='http://{URL}'>{USERNAME}</a></span>
		    <span class='time'> - {COMMENTTIME}</span><br/>{COMMENT}<br />
	  
	  <div align='right'><a href='{COMMENTDELETELINK}' class='comment' onClick='return validate()'>{COMMENTDELETE}</a></div>
	  <br /></div><br />
{COMMENTCLOSE}
  <table class='main' width='100%'>
<tr><td align="right"><div id='posttitle' class="posttitle">Add Reply&nbsp;</div><br /></td></tr>
 <form action='comment.php?p={POSTID}' method='POST' class='main'>
  <input type='hidden' name='postid' value='{POSTID}'>
 <tr>
 <td>
<input type='text' name='guestname' maxlength='50' size="40" value='{AUTHNAME}' {DISABLE} /> Name</td></tr>
 <tr><td><input type='text' name='url' maxlength='50' size="40" {DISABLE} /> Website <i>(Optional)</i></td></tr>
 <tr><td><textarea name='comment' class='main' cols='82' rows='12' maxlength='1000'></textarea>
 </td>
 </tr>
 <tr>
 <td align='right'>
 <input type='submit' value='Add Reply' class='button'/>
 </td>
 </tr>
 </form>
 </table></div>
    <div id="footer">
		<span class="copy">{COPY}<br />Design by <a href="http://www.ceruleandesigns.com/">Cerulean Designs</a>
		</span>
    </div>
</div>
</div>
</div>
</div>
</body>
</html>
