<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

#
# NO TOUCH - ne módosítsd
#
# use content/config.php and change this variable if need
# módosítsd a content/config.sys fájlban ezeket a változókat
#
# update function overwrite this file - frissítéskor felülíródik ez a fájl
#

# configuration

$MA_VERSION="20230501";
$MA_UPDATE_SRC="http://localhost/minisys/miniappframe/public";

# directories
$MA_CONFIG_DIR="config";
$MA_ADMIN_DIR="config/admin";
$MA_TEMPLATE_DIR="template";
$MA_MEDIA_DIR="media";
$MA_INCLUDE_DIR="inc";
$MA_CONTENT_DIR="content";
$MA_PLUGIN_DIR="plugins";
$MA_SERVER_DIR="/".substr(__DIR__,1,strlen(__DIR__)-strlen($MA_CONFIG_DIR)-2);

# cookie names
$MA_COOKIE_STYLE="st";
$MA_COOKIE_LOGIN="l";
$MA_COOKIE_UPDATE="u";

# include files
$MA_APP_CONFIG_FILE="config.php";
$MA_TEMPLATE_CONFIG_FILE="config.php";
$MA_ADMINFILE="start.php";
$MA_VIEWFILE="view.php";
$MA_SEARCHFILE="search.php";
$MA_PRIVACYFILE="privacy.php";
$MA_PRINTFILE="print.php";
$MA_DOWNLOADFILE="dl.php";

# language
$MA_LANGFILE="l_hu.php";

# SQL
$MA_SQL_SERVER="localhost";
$MA_SQL_DB="";
$MA_SQL_USER="";
$MA_SQL_PASS="";
$MA_SQL_ERROR="";
$MA_SQL_RESULT=array();
$MA_SQL_ERROR_ECHO=true;
$MA_SQL_INSTALL_FILE="sql_install.sql";
$MA_SQL_UPDATE_FILE="sql_update.sql";
$MA_SQL_BACKUP_FILE="sql_backup.sql";
$MA_SQL_RESTORE_FILE="sql_restore.sql";

# system css
$MA_ENABLE_SYSTEM_CSS=true;
$MA_CSS=array(
			"site-light.css",
			"site-dark.css"
			);
$MA_CSSPRINT="site-print.css";

# system js
$MA_JS_BEGIN="js_begin.js";
$MA_JS_END="js_end.js";
$MA_ENABLE_SYSTEM_JS=true;

# system libraries
$MA_LIB=array(
			"lib.php",
			"libadmin.php",
			"libview.php",
			"libsys.php",
			"libsql.php"
			);

# add directory: load dirname.php, .css, .js from directory
$MA_PLUGINS=array();

# cookies
$MA_COOKIES=array();

# local app php files (no css os js) file
$MA_APPFILE=array("config.php");

# 0 => admin user
$MA_USER_ROLE=array("0","1","2");
$MA_ROLE="9999";

# include files
$MA_DEF_HEADER="header.php";
$MA_DEF_FOOTER="footer.php";
$MA_DEF_HEADER_VIEW="header_view.php";
$MA_DEF_FOOTER_VIEW="footer_view.php";
$MA_DEF_HEADER_PRINT="header_print.php";
$MA_DEF_FOOTER_PRINT="footer_print.php";
$MA_DEF_FAVICON="favicon.png";

# other variables
$MA_HASH_FIRST="$2y$";
$MA_UPDATE_EXT=".tar.gz";
$MA_UPDATE_FILE="";
$MA_NOPAGE=false;
$MA_LOGGEDIN=false;
$MA_ADMIN_USER=false;
$MA_USERNAME="";
$MA_COOKIE_USER="user";
$MA_COOKIE_PASS="pass";


#
# APPLICATION ZONE
#


#
# TEMPLATE ZONE
#


?>
