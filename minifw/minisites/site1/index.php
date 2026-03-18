<?php

 #
 # Site építése
 #


# beállítások betöltése
if (file_exists("../config/config.php")){
    include("../config/config.php");
}
if (file_exists("$MA_CONTENT_DIR/config.php")){
    include("$MA_CONTENT_DIR/config.php");
}

# fej betöltése
if (file_exists("$MA_TEMPLATE_DIR/$S_TEMPLATE/$S_TEMPLATE_HEADER")){
    include("$MA_TEMPLATE_DIR/$S_TEMPLATE/$S_TEMPLATE_HEADER");
}

# css betöltése
echo("<style>");
for($i=0;$i<count($S_TEMPLATE_CSS);$i++){
    if (file_exists("$MA_TEMPLATE_DIR/$S_TEMPLATE/$S_TEMPLATE_CSS[$i]")){
        include("$MA_TEMPLATE_DIR/$S_TEMPLATE/$S_TEMPLATE_CSS[$i]");
    }
}
if (file_exists("$MA_CONTENT_DIR/$S_CSS")){
    include("$MA_CONTENT_DIR/$S_CSS");
}
echo("</style>");

# js betöltése
echo("<script>");
for($i=0;$i<count($S_JS_HEAD);$i++){
    if (file_exists("$MA_TEMPLATE_DIR/$S_TEMPLATE/$S_JS_HEAD[$i]")){
        include("$MA_TEMPLATE_DIR/$S_TEMPLATE/$S_JS_HEAD[$i]");
    }
}
if (file_exists("$MA_CONTENT_DIR/$S_JS")){
    include("$MA_CONTENT_DIR/$S_JS");
}
echo("</script>");

# lap felépítése
if (function_exists("page")){
    page();
}

# js betöltése
echo("<script>");
for($i=0;$i<count($S_JS_FOOT);$i++){
    if (file_exists("$MA_TEMPLATE_DIR/$S_TEMPLATE/$S_JS_FOOT[$i]")){
        include("$MA_TEMPLATE_DIR/$S_TEMPLATE/$S_JS_FOOT[$i]");
    }
}
echo("</script>");

# láb betöltése
if (file_exists("$MA_TEMPLATE_DIR/$S_TEMPLATE/$S_TEMPLATE_FOOTER")){
    include("$MA_TEMPLATE_DIR/$S_TEMPLATE/$S_TEMPLATE_FOOTER");
}

?>
