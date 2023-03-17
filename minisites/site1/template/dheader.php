<?php

echo($S_DOCTYPE);
echo("<html>");

echo("<head>");
echo("<title>$S_SITENAME</title>");
echo("<meta charset=\"utf-8\" />");
echo("<meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\" />");
echo("<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />");
echo("<link rel=\"icon\" href=\"$S_FAVICON\" />");
echo("<link rel=\"shortcut icon\" type=\"image/png\" href=\"$S_FAVICON\" />");

echo("<style>");
for($i=0;$i<count($S_TEMPLATE_CSS);$i++){
    if (file_exists("$S_TEMPLATE_DIR/$S_TEMPLATE_CSS[$i]")){
        include("$S_TEMPLATE_DIR/$S_TEMPLATE_CSS[$i]");
    }
}
echo("</style>");

echo("<script>");
for($i=0;$i<count($S_JS_HEAD);$i++){
    if (file_exists("$S_TEMPLATE_DIR/$S_JS_HEAD[$i]")){
        include("$S_TEMPLATE_DIR/$S_JS_HEAD[$i]");
    }
}
echo("</script>");

echo("</head>");

echo("<body>");
echo("<header>");
echo("</header>");

?>
