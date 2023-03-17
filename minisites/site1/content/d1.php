<?php


function page(){
    echo("<div class=demo>");
    echo("Tartalom itt...");
    echo("</div>");
}


function main(){
    global $S_TEMPLATE_DIR,$S_TEMPLATE_CSS,$S_TEMPLATE_HEADER,$S_TEMPLATE_FOOTER,
            $S_FAVICON,$S_SITENAME,$S_JS_HEAD,$S_JS_FOOT;

    if (file_exists("$S_TEMPLATE_DIR/$S_TEMPLATE_HEADER")){
        include("$S_TEMPLATE_DIR/$S_TEMPLATE_HEADER");
    }

    page();

    if (file_exists("$S_TEMPLATE_DIR/$S_TEMPLATE_FOOTER")){
        include("$S_TEMPLATE_DIR/$S_TEMPLATE_FOOTER");
    }
}


?>
