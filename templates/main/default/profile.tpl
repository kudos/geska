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


    <div id="content"> <div class="posttitle">&raquo; Profile</a></div>
{ERRMESG}
<table class='main' width='100%'>
 <form action='profile.php?action=edit&userid={USERID}' method='POST' class='main'>
 <tr valign="top">
 {ADMINOPEN}<td align='right'>Name: </td><td align='left'><input type='text' name='username' class='main' value='{USERNAME}'> </td>{ADMINCLOSE}
 <td rowspan="7" width='30%' align="left">
 <div id='greynotice' align='center'>If you enter a new password it must be at least 6 characters long.<br /></div>
 </td>
 </tr>
 </tr>
 <tr>
 <td align='right'>Password:
 </td>
 <td >
  <input type='password' name='password' class='main'>
 </td>
 </tr>
 <tr>
 <td align='right'>Password Again:
 </td>
 <td >
  <input type='password' name='password2' class='main'>
 </td>
 </tr>
 <tr>
 <td align='right'>e-mail:
 </td>
 <td >
  <input type='text' name='email' class='main' value="{EMAIL}">
 </td>
 </tr>
{ADMINOPEN}<tr>
 <td align='right'>Userlevel</td>
 <td align='left'>
 <select name='userlevel' class='main'>
 <option value='0' {USERCHECK}>User</option>
 <option value='2' {ADMINCHECK}>Admin</option>
 </select>
 </td>
 </tr>{ADMINCLOSE}
 <tr>
 <td align='center' colspan='3'>
 <input type='submit' value='Edit' class='button'><br /><br />
 </td>
 </tr>
 </form>
 </td></tr>
 </table>
</div>
    
    <div id="footer">

         <span class="copy">


{COPY}
<br />Design by <a href="http://www.ceruleandesigns.com/">Cerulean Designs</a>
</span>
    </div>

    </div>
    
    </div></div>
</div>
</body>
</html>
