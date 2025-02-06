<?php

 #
 # MiniFW 3
 #
 # beállítások
 #



class fw_config{
  # verzió adatok
  public $FW_VERSION="0";
  public $FW_VERSION_STR="FW_VERSION";

  # fejlesztői mód
  public $FW_DEV_MODE=true;

  # admin mód
  public $FW_ADMIN_MODE=false;
  public $FW_ADMIN_LINK="admin";

  # könyvtárak
  public $FW_CONFIG_DIR="config";
  public $FW_TEMPLATE_DIR="template";
  public $FW_INCLUDE_DIR="inc";
  public $FW_CONTENT_DIR="content";
  public $FW_MEDIA_DIR="media";
  public $FW_PLUGIN_DIR="plugins";
  public $FW_TMP_DIR="tmp";
  public $FW_FS_MAIN_DIR="";
  public $FW_URI_MAIN_DIR="";

  # nyelvi fájl
  public $FW_LANGFILE="lang-hu_HU.php";

  # SQL
  public $FW_SQL_SERVER="localhost";
  public $FW_SQL_DB="wdb";
  public $FW_SQL_USER="wuser";
  public $FW_SQL_PASS="password";

  # rendszer függvénykönyvtárak
  public $FW_LIB=array(
              "lib_file.php",
              "lib_lang.php",
              "lib_sql.php",
              "lib_sqlm.php",
              "lib_sys.php"
              );

  # betöltendő modulok (könyvtárnév, betöti az azonos nevű .php fájlt)
  public $FW_PLUGINS=array();

  # cookies ($FW_COOKIES=array(array("minifw","adat","1")); - név, adat, tárolás napban
  public $FW_COOKIES=array();

  #
  # APPLICATION ZONE
  #
  public $FW_APP_PHP="app.php";

  #
  #
  # TEMPLATE ZONE
  #
  public $FW_TEMPLATE_PHP="template.php";
  #


  function __construct(){
  }

}



?>
