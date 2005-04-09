<?php
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// misc_func.php miscellaneous functions ////////////////////////////
// Copyright (C) 2005 Kudos www.joncremin.com ///////////////////////
// Licensed under the GPL ///////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
function pagination($numpages, $perpage, $currpage, $page)
{
if($currpage > 0 )
{
  $prev = $perpage - $currpage;
  $paginate .= "<a href='".$page."?perpage=$perpage&page=$prev'>&laquo; Prev page</a>";
}
else $paginate .= "</td>";

if(@!$thispage = ($currpage / $perpage) + 1) $thispage = 1;
if($numpages > 0) $paginate .= "<td align='center' width='33%'> Page $thispage of $numpages </td>";
if($thispage < $numpages)
{
  $next += $perpage;
  $paginate .= "<td align='right' width='33%'><a href='".$page."?perpage=$perpage&page=$next'>Next page &raquo;</a>";
}
else $paginate .= "<td align='right' width='33%'>";

$paginate .= "</td></tr></table>";
return($paginate);
}

function escape_string($string) {
   if(version_compare(phpversion(),"4.3.0")=="-1") {
     return mysql_escape_string($string);
   } else {
     return mysql_real_escape_string($string);
   }
}
?>