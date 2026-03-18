<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #


if ($L_SITENAME<>""){
  $MA_TITLE=$MA_TITLE." - ".$L_SITENAME;
}

echo($MA_DOCTYPE);
echo("<html>");

echo("<head>");
echo("<title>$MA_TITLE</title>");
echo("<meta charset=\"utf-8\" />");
echo("<meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\" />");
echo("<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />");
echo("<link rel=\"icon\" href=\"$MA_FAVICON\" />");
echo("<link rel=\"shortcut icon\" type=\"image/png\" href=\"$MA_FAVICON\" />");

echo("<style>");
if ($MA_ENABLE_SYSTEM_CSS){
  if (file_exists("$MA_INCLUDE_DIR/$MA_CSS[$MA_STYLEINDEX]")){
    include("$MA_INCLUDE_DIR/$MA_CSS[$MA_STYLEINDEX]");
  }else{
    if (file_exists("$MA_INCLUDE_DIR/$MA_CSS[0]")){
      include("$MA_INCLUDE_DIR/$MA_CSS[0]");
    }
  }
}
if ((isset($MA_TEMPLATE_CSS[$MA_STYLEINDEX])) and (file_exists("$MA_TEMPLATE_DIR/$MA_APP_TEMPLATE/$MA_TEMPLATE_CSS[$MA_STYLEINDEX]"))){
  include("$MA_TEMPLATE_DIR/$MA_APP_TEMPLATE/$MA_TEMPLATE_CSS[$MA_STYLEINDEX]");
}else{
  if ((isset($MA_TEMPLATE_CSS[0])) and (file_exists("$MA_TEMPLATE_DIR/$MA_APP_TEMPLATE/$MA_TEMPLATE_CSS[0]"))){
    include("$MA_TEMPLATE_DIR/$MA_APP_TEMPLATE/$MA_TEMPLATE_CSS[0]");
  }
}
echo("</style>");
echo("</head>");

echo("<body>");

?>
