<?php

echo("</div>");

echo("<footer>");
#echo("$S_COPYRIGHT");
echo("</footer>");

echo("</div>");

echo("<script>");
for($i=0;$i<count($S_JS_FOOT);$i++){
    if (file_exists("$S_TEMPLATE_DIR/$S_JS_FOOT[$i]")){
        include("$S_TEMPLATE_DIR/$S_JS_FOOT[$i]");
    }
}
echo("</script>");

echo("</body>");
echo("</html>");

?>
