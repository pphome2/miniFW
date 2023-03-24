<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #


# load config and language file
if (!isset($MA_CONFIG_DIR)){
    if (file_exists("../config/config.php")){
	    include("../config/config.php");
    }
    if (file_exists("../$MA_CONFIG_DIR/$MA_LANGFILE")){
	    include("../$MA_CONFIG_DIR/$MA_LANGFILE");
    }
}

$MA_INCLUDE_DIR="../".$MA_INCLUDE_DIR;
$MA_ENABLE_PRIVACY=false;
$MA_ENABLE_THEME=false;
$MA_MENU=array();
$MA_ADMIN_MENU=array();
$MA_BACKPAGE=true;

for ($i=0;$i<count($MA_LIB);$i++){
	if (file_exists("$MA_INCLUDE_DIR/$MA_LIB[$i]")){
		include("$MA_INCLUDE_DIR/$MA_LIB[$i]");
	}
}

# css setting
setcss();

# build page: header
page_header();

if (function_exists("sql_install")){
    sql_install();
    echo("SQL OK");
}

# page end
page_footer();

?>
