<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

# configuration

$MA_MINIFW_DIR="../../minifw-2";

if (file_exists("$MA_MINIFW_DIR/config/config.php")){
    include("$MA_MINIFW_DIR/config/config.php");
}

# directories
$MA_CONFIG_DIR="$MA_MINIFW_DIR/config";
$MA_INCLUDE_DIR="$MA_MINIFW_DIR/inc";
$MA_CONTENT_DIR="content";
$MA_PLUGIN_DIR="$MA_MINIFW_DIR/plugins";
$MA_TEMPLATE_DIR="template";

# load system
if (file_exists("$MA_CONFIG_DIR/$MA_LANGFILE")){
    include("$MA_CONFIG_DIR/$MA_LANGFILE");
}
for($i=0;$i<count($MA_LIB);$i++){;
    if (file_exists("$MA_INCLUDE_DIR/$MA_LIB[$i]")){
        include("$MA_INCLUDE_DIR/$MA_LIB[$i]");
    }
}


?>
