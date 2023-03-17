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
if (file_exists("$S_TEMPLATE_DIR/$S_TEMPLETE_CSS")){
    include("$S_TEMPLATE_DIR/$S_TEMPLETE_CSS");
}
echo("</style>");

echo("<script>");
if (file_exists("$S_TEMPLATE_DIR/$S_JS_HEAD")){
    include("$S_TEMPLATE_DIR/$S_JS_HEAD");
}
echo("</script>");

echo("</head>");

echo("<body>");
echo("<header>");
echo("</header>");

?>
