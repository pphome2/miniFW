<?php

 #
 # MiniFW - Admin app
 #
 # info: main folder copyright file
 #
 #

# configuration
$MA_MINIFW_DIR="../minifw-2";

$MA_APP_CODENAME="admin";
$MA_APP_TEMPLATE="miniapp";

if (file_exists("$MA_MINIFW_DIR/config/config.php")){
    include("$MA_MINIFW_DIR/config/config.php");
}

$MA_ADMIN_CONFIG="acfg.php";

# SQL
$MA_SQL_FILE="$MA_MINIFW_DIR/$MA_CONFIG_DIR/$MA_SQL_FILE";

# main page
$MA_ROOT_HOME=$MA_MINIFW_DIR;

# directories
$MA_CONFIG_DIR="config";
$MA_INCLUDE_DIR="$MA_MINIFW_DIR/inc";
$MA_CONTENT_DIR="content";
$MA_PLUGIN_DIR="$MA_MINIFW_DIR/plugins";
$MA_TEMPLATE_DIR="$MA_MINIFW_DIR/template";
$MA_TEMPLATE_CONFIG="config.php";

# disable privacy page
$MA_ENABLE_PRIVACY=false;

# load system
if (file_exists("$MA_CONFIG_DIR/$MA_LANGFILE")){
    include("$MA_CONFIG_DIR/$MA_LANGFILE");
}
for($i=0;$i<count($MA_LIB);$i++){;
    if (file_exists("$MA_INCLUDE_DIR/$MA_LIB[$i]")){
        include("$MA_INCLUDE_DIR/$MA_LIB[$i]");
    }
}

$MA_BACKPAGE=false;
$MA_MENU=array();
$MA_ADMINMENU=array();
$MA_FOOTERMENU=array();
$MA_ENABLE_LOGIN=true;
$MA_MENU_FIELD="a";

?>
