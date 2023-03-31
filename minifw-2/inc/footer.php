<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

echo("</div>");

$nextstyle=$MA_STYLEINDEX+1;
if ($nextstyle>(count($MA_CSS)-1)){
  $nextstyle=0;
}

if ($MA_ENABLE_FOOTER){
  echo("<footer>");
  echo("<ul class=\"sidenav\">");
  if (substr($MA_COPYRIGHT,0,2)==="<a"){
      echo("<li class=\"lileft\">$MA_COPYRIGHT</li>");
  }else{
      echo("<li class=\"padleft\">$MA_COPYRIGHT</li>");
  }
  if ($MA_LOGGEDIN){
    echo("<li class=\"liright\">");
    for($i=count($MA_FOOTERMENU)-1;$i>=0;$i--){
      echo("<li class=\"liright\">");
      echo("<a href=\"?$MA_MENU_FIELD=".$MA_FOOTERMENU[$i][1]."\">".$MA_FOOTERMENU[$i][0]."</a>");
      echo("</li>");
    }
  }else{
    if ((!$MA_PRIVACY_PAGE)and(!$MA_SEARCH_PAGE)){
      if ($MA_ENABLE_THEME){
        echo("<li class=\"liright\">");
        echo("<a href=\"\" onclick=\"document.cookie='$MA_COOKIE_STYLE=$nextstyle;samesite=Strict;' \">$L_THEME</a>");
        echo("</li>");
      }
      if ((!$MA_PRIVACY_PAGE)and(!$MA_SEARCH_PAGE)and($MA_ENABLE_PRIVACY)){
        echo("<li class=\"liright\">");
        echo("<a href=\"$MA_PRIVACYFILE\" >$L_PRIVACY_MENU</a>");
        echo("</li>");
        }
    }
  }
  echo("</ul>");
  echo("</footer>");

}
echo("</div>");
echo("</body>");
echo("</html>");

?>