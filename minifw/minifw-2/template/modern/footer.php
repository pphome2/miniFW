<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

echo("</div>");

if ($MA_ENABLE_FOOTER){
  echo("<footer>");
  echo("<div class=footerline>");
  
  if ($MA_LOGGEDIN){
    echo("<li class=\"liright\">");
    for($i=count($MA_FOOTERMENU)-1;$i>=0;$i--){
      echo("<li class=\"liright\">");
      echo("<a href=\"?$MA_MENU_FIELD=".$MA_FOOTERMENU[$i][1]."\">".$MA_FOOTERMENU[$i][0]."</a>");
      echo("</li>");
    }
  }else{
    $nextstyle=$MA_STYLEINDEX+1;
    if ($nextstyle>(count($MA_CSS)-1)){
      $nextstyle=0;
    }
    if ($MA_ENABLE_THEME){
      echo("<li class=\"liright\">");
      echo("<a href=\"\" onclick=\"document.cookie='$MA_COOKIE_STYLE=$nextstyle;samesite=Strict;' \">$L_THEME</a>");
      echo("</li>");
    }
  }
  echo("</footer>");
  echo("</div>");
}
echo("</div>");
echo("</body>");
echo("</html>");

?>
