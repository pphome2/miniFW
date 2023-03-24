<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

# configuration

# directories
$MA_CONFIG_DIR="config";
$MA_ADMIN_DIR="config/admin";
$MA_TEMPLATE_DIR="template";
$MA_MEDIA_DIR="media";
$MA_INCLUDE_DIR="inc";
$MA_CONTENT_DIR="content";
$MA_PLUGIN_DIR="plugins";

# cookie names
$MA_COOKIE_STYLE="st";
$MA_COOKIE_LOGIN="l";

# include files
$MA_APP_CONFIG_FILE="config.php";
$MA_TEMPLATE_CONFIG_FILE="config.php";
$MA_ADMINFILE="start.php";
$MA_VIEWFILE="view.php";
$MA_SEARCHFILE="search.php";
$MA_PRIVACYFILE="privacy.php";
$MA_PRINTFILE="print.php";

# language
$MA_LANGFILE="l_hu.php";

# system css
$MA_ENABLE_SYSTEM_CSS=true;
$MA_CSS=array(
			"sitew.css",
			"siteb.css"
			);
$MA_CSSPRINT="sitepr.css";

# system js
$MA_JS_BEGIN="js_begin.js";
$MA_JS_END="js_end.js";
$MA_ENABLE_SYSTEM_JS=true;

# system libraries
$MA_LIB=array(
			"lib.php",
			"libview.php",
			"libadmin.php",
			"libsql.php"
			);

# add directory: load dirname.php, .css, .js from directory
$MA_PLUGINS=array();

# local app php files (no css os js) file
$MA_APPFILE=array(
				"config.php"
			);

# SQL
$MA_SQL_SERVER="localhost";
$MA_SQL_DB="minifw";
$MA_SQL_USER="admin";
$MA_SQL_PASS="minifwadmin";
$MA_SQL_ERROR="";
$MA_SQL_RESULT=array();
$MA_SQL_FILE="inst.sql";

# 0 => admin user
$MA_USER_ROLE=array("0","1","2");
$MA_ROLE="9999";

# other variables
$MA_HASH_FIRST="$2y$";
$MA_NOPAGE=false;
$MA_LOGGEDIN=false;
$MA_ADMIN_USER=false;
$MA_COOKIE_USER="user";
$MA_COOKIE_PASS="pass";

?>
