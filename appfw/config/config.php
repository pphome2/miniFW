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



  function __destruct(){
  }

  const DEVELOPER="WSWDTeam";
  function byebye() {
    return(self::DEVELOPER);
  }



  # öröklődés
  # class d{
  #   protected static function get(){return("get");}
  # }
  # class dx extends d{
  #   public $n;
  #   public function __construct() {
  #     $this->n=parent::get();
  #   }
  # }
  #
  # interfész
  # - nincs változó
  # - csak publikus fg
  # - öröklés után megírv a fg-k
  # interface inter1{
  #   public function fg1();
  #   public function fg2($n,$c);
  # }
  #
  # absztrakt
  # abstract class abs{
  #   public $n;
  #   public function fg($n) {
  # }
  #
  # öröklés, kiterjesztés
  # class test extends inter1{
  #   function fg1(){echo("1");}
  #   function fg2(){echo("2");}
  # }
  #
  # többszörös öröklés
  # trait m1 {
  #   public function msg1() {echo("1");}
  # }
  # trait m2 {
  #   public function msg2() {echo("2");}
  # }
  # class or{
  #   use m1,m2
  # }
  #
  # staikus fg - nem kell létrehozni obj-t
  # a class írásakor már használható a saját fg
  # class gr{
  #   public static $stat="W";
  #   public static function w(){echo("H");}
  # }
  # gr::w();
  # gr::$stat;
  #
  # első sor kell legyen a fájlban
  # namespace Html;
  # class T{}
  # hivatkozás a namspace objektumra
  # $x=new Html/T();
  # alias: fájl első sora
  # use Html as H;
  # $x=new H/T();
  # alias obj
  # use H/T as Tx;
  # $x=new Tx();

}



?>
