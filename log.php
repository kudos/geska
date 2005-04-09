<?php 
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// log.php view http logs by date ///////////////////////////////////
// Copyright (C) 2005 Kudos www.joncremin.com ///////////////////////
// Licensed under the GPL ///////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
require('../include.php');
db_connect($host,$user,$pass,$database);
db_get_site_settings();
session_start();
auth_auto_login();
if($_SESSION['authlevel'] < 2){
header("Location: ../index.php");
exit();
}
$template = $template_admin_dir."log.tpl";
$page1 = implode("", file($template));
$pagetitle = "Logs";
echo "";

$query = "SELECT time FROM ".$db_prefix."logs ORDER BY time DESC";
$result = mysql_query($query);

$i=0;
while($row = mysql_fetch_assoc($result))
{  
  if (date('Y-m-d',@strtotime($array[$i-1])) != date('Y-m-d',strtotime($row['time'])) || $i == 0)
  {
    $array[$i] = $row['time'];
    $i++;
  }
}
if(!isset($_REQUEST['date']))
{
  $date = date('Y-m-d', time());
  $page = 0;
  $perpage = 50;
}
else
{
  $date = $_REQUEST['date'];
  $page = $_GET['page'];
  $perpage = $_GET['perpage'];
}

for($i=0;isset($array[$i]);$i++)
{
  $optionlist[$i] = "<option value='".date('Y-m-d',strtotime($array[$i]))."'";
  if(@$_REQUEST['date'] == date('Y-m-d',strtotime($array[$i]))){
  $optionlist[$i] .= "selected";
  }
  $optionlist[$i] .=  ">".date('Y-m-d',strtotime($array[$i]))."</option>";
}
$page1 = template_admin_select($page1);
/*<option value='25' ";
if($perpage == 25) echo "selected";
echo ">25 per page</option><option value='50' ";
if($perpage == 50) echo "selected";
echo ">50 per page</option><option value='100' ";
if($perpage == 100) echo "selected";
echo ">100 per page</option><option value='150' ";
if($perpage == 150) echo "selected";
echo ">150 per page</option>
</select>
<input type='hidden' name='page' value='0'>
<input type='submit' value='Go' class='button'>
</form>";
html_get_logs($date, $page, $perpage);
echo "</td></tr></table>";
*/
echo $page1;
?>
