<?php

echo("</div>");

echo("<footer>");
#echo("$S_COPYRIGHT");
echo("</footer>");

echo("</div>");

echo("<script>");
if (file_exists("$S_TEMPLATE_DIR/$S_JS_FOOT")){
    include("$S_TEMPLATE_DIR/$S_JS_FOOT");
}
echo("</script>");

echo("</body>");
echo("</html>");

?>
